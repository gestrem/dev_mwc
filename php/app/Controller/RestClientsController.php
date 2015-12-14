<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 11/12/15
 * Time: 10:46
 */
App::import('Controller', 'Rest');
App::uses('CakeEmail', 'Network/Email');

class RestClientsController extends RestController{
    public $uses = array('Client');

    public function signUp() {
        if($this->request->is('post')) {
            $this->request->data['token_insc']=sha1(rand(0,100000).$this->request->data['email']);
            if ($this->Client->save($this->request->data)) {
                $this->set(array(
                    'message' => 'Vous êtes bien inscrit, veuillez valider votre email',
                    '_serialize' => array('message')
                ));
                $Email = new CakeEmail();
                $Email->config('default');
                $Email->template('welcome','welcome');
                $Email->emailFormat('html');
                $Email->viewVars(array('value' => $this->request->data['token_insc']));
                $Email->from('lucas.estebanzucco@gmail.com');
                $Email->sender('lucas.estebanzucco@gmail.com', 'MyApp emailer');
                $Email->to($this->request->data['email']);
                $Email->subject('Validate your inscription');
                $Email->send();
            }
        }
    }

    public function signIn() {
        if($this->request->is('post')) {

        }
    }

    public function forgottenPassword ($id) {
        if($client=$this->Client->findById($id)) {
            $client['Client']['token_password']=sha1(rand(0,154896258952));
            if($this->Client->save($client)) {
                $message='Un email va vous être envoyer pour changer votre mot de passe';
                $Email = new CakeEmail();
                $Email->config('default');
                $Email->emailFormat('html');
                $Email->template('newpassword');
                $Email->viewVars(array('value' => $client['Client']['token_password']));
                $Email->from('lucas.estebanzucco@gmail.com');
                $Email->sender('lucas.estebanzucco@gmail.com', 'MyApp emailer');
                $Email->to($client['Client']['email']);
                $Email->subject('Validate your inscription');
                $Email->send();
            }
        } else {
            $message ='Erreur, impossible d\'effectuer l\'action ';
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function changePassword($id) {
        $this->loadModel('Client');
        if($this->request->is('post')) {
            if($this->Client->changePassword($id,$this->request->data['old'],$this->request->data['new'])) {
                $message='Mot de passe changé';
            } else {
                $message='Erreur lors du changement de mot de passe';
            }
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

}