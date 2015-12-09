<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 09/12/15
 * Time: 15:47
 */
App::uses('Model','Cepage');
App::import('Controller', 'Rest');

class RestOriginesController extends RestController{
    public $uses = array('Origine');

    public function index() {
        $origines = $this->Origine->find('all',array('recursive'=>0));
        $this->set(array(
            'origines' => $origines,
            '_serialize' => array('origines')
        ));
    }
}