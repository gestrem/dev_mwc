<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 01/12/15
 * Time: 14:03
 */
App::uses('Model','Client');
App::uses('HttpSocket', 'Network/Http');

class ClientsController extends AppController{

    public $components = array('Paginator');
    public function beforeFilter() {
        parent::beforeFilter();
        // Permet aux utilisateurs de s'enregistrer et de se déconnecter
        $this->Auth->allow('validateEmail', 'reinitializePassword','inscription');
    }

    public function index() {
        $clients=$this->Client->find('all');
        $this->set('title_for_layout', 'Administration clients');

        if($this->request->is('post')) {
            $recherche = $this->request->data['recherche'];
            $conditions=array( "OR" => array(
                "Client.nom LIKE" => "%".$recherche."%",
                "Client.societe LIKE" => "%".$recherche."%",
                "Client.prenom LIKE" => "%".$recherche."%",
                "Client.login LIKE" => "%".$recherche."%",
            ));
            $clients=$this->Client->find('all',array('conditions' => $conditions));
        }
        $this->set('clients',$clients);

        /* $this->Http = new HttpSocket();
         $json = $this->Http->get(
             'http://api.fixer.io/latest');
         var_dump($json['body']);
         $decoded=(array) json_decode($json['body']);
         var_dump($decoded);
         var_dump($decoded['rates']);
         var_dump($decoded['base']);*/

    }

    public function inscription($id=null) {
        $form=0;
        $this->loadModel('Client');
        if($id==null){
            if($this->Client->save($this->request->data)) {
                $this->redirect('/client/signUp/'.$this->Client->id);
            }
        }
        if($id!=null) {
            if($client=$this->Client->findById($id)) {
                if($client['Client']['etat']==0) {
                    $form=1;
                } else if ($client['Client']['date_fin_abonnement']==null || $client['Client']['date_limite_abonnement']< time()) {
                    $form=2;
                }
            } else {
                $form =3;
            }
        }
        $this->set('form',$form);
    }

    public function edit($id = null)
    {
        if ($client = $this->Client->findById($id)) {
            $this->set('client', $client);
            $this->set('title_for_layout', 'Modification client');
            if ($this->request->is('post') ) {
                //si le mot de passe n'a pas été modifié
                if (empty($this->request->data['pass1'])) {
                    $client = $this->request->data['Client'];
                    $this->Client->id = $id;
                    if ($this->Client->save($client)) {
                        $this->redirect('/clients');
                    }
                } //si le mot de passe a été modifier
                else if ($this->request->data['pass1'] == $this->request->data['pass2']) {
                    $client = $this->request->data['Client'];
                    $client['Client']['password']= $this->request->data['pass1'];
                    $this->Client->id = $id;
                    if ($this->Client->save($client)) {
                        $this->redirect('/clients');
                    }
                }
            }
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            if ($this->request->data['pass1'] == $this->request->data['pass2']) {
                $client ['Client']= $this->request->data['Client'];
                $client['Client']['password'] = $this->request->data['pass1'];
                $client['Client']['date_limite_abonnement']=4071772800;
                if ($this->Client->save($client)) {
                    $this->redirect('/clients');
                }
            }
        }
    }

    public function view($id) {
        $this->loadModel('Consultation');

        $paginate = array(
            'fields' => array('Consultation.id', 'Consultation.date,Cepage.label,Origine.label,Consultation.is_detail'),
            'limit' => 20,
            'recursive'=>2,
            'conditions' => array('Client.id' =>$id ),
            'order' => array(
                'Consultation.date' => 'desc'
            )
        );

        $this->Paginator->settings = $paginate;
        $data = $this->Paginator->paginate('Consultation');
        $this->set('data', $data);
    }

    public function delete($id) {
        if($this->Client->delete($id)) {
            $this->redirect('/clients');
        }
    }
    //fonction pour désactiver un client ou le réactiver
    public function disable($id) {
        $client=$this->Client->findById($id);
        $client["Client"]["etat"]=!$client["Client"]["etat"];
        if($this->Client->save($client)) {
            $this->redirect('/clients');
        }
    }

    public function validateEmail($token) {
        $message='Token invalide';
        if($token!=null && $token!=0)  {
            $this->loadModel('Client');
            if($client=$this->Client->findByTokenInsc($token)) {
                $client['Client']['etat']=1;
                $client['Client']['token_insc']=0;
                if($this->Client->save($client['Client'])) {
                    $message='Votre email a été validé';
                }
            }
        }
        $this->set('message',$message);
    }

    public function reinitializePassword($token) {
        $this->loadModel('Client');
        $print=0;
        if ($token==null || $token=='0') {
            $this->Session->setFlash("Erreur impossible de trouver 1");
        } elseif (!($client=$this->Client->findByTokenPassword($token))) {
            $this->Session->setFlash("Erreur impossible de trouver 2");
        } else {
            $print=1;
            if ($this->request->is('post') && $this->request->data['pass1']==$this->request->data['pass2']) {
                $client['Client']['password']=$this->request->data['pass1'];
                $client['Client']['token_password']=null;
                if($this->Client->save($client)) {
                    $this->Session->setFlash("New password saved");
                }
            }
        }
        $this->set('print',$print);

    }
}