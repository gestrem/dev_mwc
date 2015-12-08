<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 01/12/15
 * Time: 14:03
 */
App::uses('Model','Client');

class ClientsController extends AppController{

    public function index() {
        $clients=$this->Client->find('all');
        $this->set('clients',$clients);
        $this->set('title_for_layout', 'Administration clients');
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
                if ($this->Client->save($client)) {
                    $this->redirect('/clients');
                }
            }
        }
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
}