<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 15/12/15
 * Time: 11:44
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController {
    public function login() {

        if ($this->request->is('post')) {
            $passwordHasher = new SimplePasswordHasher();
           //var_dump($passwordHasher->hash('adminMWC'));
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__("Nom d'user ou mot de passe invalide, réessayer"));
            }
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}