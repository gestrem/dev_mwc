<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 01/12/15
 * Time: 14:03
 */

class ClientsController extends AppController{

    public function index() {
        $this->loadModel('Clients');
        $clients=$this->Clients->find('all');
        $this->set('clients',$clients);
    }
}