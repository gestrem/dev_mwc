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
            if ($this->Client->findByLogin($this->request->data['login'])) {
                $message = 'Login already used';
            } else if ($this->Client->findByEmail($this->request->data['email'])) {
                $message = 'Email already used';
            } else {
                $this->request->data['token_insc']=sha1(rand(0,100000).$this->request->data['email']);
                $client= array();
                $client['Client']=$this->request->data;
                if ($this->Client->save($client)) {
                    $message = 'Vous êtes bien inscrit, veuillez valider votre email';
                    /*$Email = new CakeEmail();
                    $Email->config('default');
                    $Email->template('welcome','welcome');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('value' => $this->request->data['token_insc']));
                    $Email->from('lucas.estebanzucco@gmail.com');
                    $Email->sender('lucas.estebanzucco@gmail.com', 'MyApp emailer');
                    $Email->to($this->request->data['email']);
                    $Email->subject('Validate your inscription');
                    $Email->send();*/
                } else {
                    $message='Problem trying to save the client';
                }
            }
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    public function singIn() {
        $this->loadModel('Client');
        if($this->request->is('post')) {
            $login=$this->Client->login($this->request->data['login'],$this->request->data['password']);
            if ($login['etat']==1) {
                $this->set(array(
                    'login' => $login,
                    '_serialize' => array('login')
                ));
            } else if ($login['etat']==9){
                $message='You have been disabled, please contact the Murphy Wine Company';
                $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
            } else if ($login['etat']==0){
                $message='You need to validate your email, please check your mailbox';
                $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
            } else if ($login['etat']==2){
                $message='You must pay to access this service';
                $this->set(array(
                    'message' => $message,
                    '_serialize' => array('message')
                ));
            }
        }
    }

    public function forgottenPassword ($email) {
        if($client=$this->Client->findByEmail($email)) {
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
                $Email->subject('Change your password');
                $Email->send();
            }
        } else {
            $message ='Erreur, impossible d\'effectuer l\'action '.$email;
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
    public function changeUnit($login,$token,$unit) {
        $this->loadModel('Client');
        if ($client=RestController::verifyToken($login,$token)) {
            $client['Client']['unite']=$unit;
            unset($client['Client']['token']);
            if($this->Client->save($client)) {
                $this->set(array(
                    'message'=>'modification enregistrée ',
                    '_serialize' => array('message')
                ));
            } else {
                $this->set(array(
                    'message'=>'Erreur lors de la sauvegarde ',
                    '_serialize' => array('message')
                ));
            }

        } else {
    $this->set(array(
        'message'=>'wrong token',
        '_serialize' => array('message')
    ));
}
    }
    public function changeCurrency($login,$token,$cur) {
        $this->loadModel('Client');
        if ($client=RestController::verifyToken($login,$token)) {
            $client['Client']['devise_favorite']=$cur;
            unset($client['Client']['token']);

            if($this->Client->save($client)) {
                $this->set(array(
                    'message'=>'modification enregistrée ',
                    '_serialize' => array('message')
                ));
            } else {
                $this->set(array(
                    'message'=>'Erreur lors de la sauvegarde ',
                    '_serialize' => array('message')
                ));
            }

        } else {
            $this->set(array(
                'message'=>'wrong token',
                '_serialize' => array('message')
            ));
        }
    }

}