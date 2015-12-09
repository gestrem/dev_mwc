<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 09/12/15
 * Time: 15:46
 */
App::uses('Model','Cepage');
App::import('Controller', 'Rest');

class RestCepagesController extends RestController{
    public $uses = array('Cepage');

    public function index() {
        $cepages = $this->Cepage->find('all',array('recursive'=>0));
        $this->set(array(
            'cepages' => $cepages,
            '_serialize' => array('cepages')
        ));
    }
}