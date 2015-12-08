<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 07/12/15
 * Time: 17:32
 */

App::uses('Model','Vin');
App::import('Controller', 'Rest');

class RestVinsController extends RestController{
    public $uses = array('Vin');

    public function index() {
        $vins = $this->Vin->find('all',array('recursive'=>0));
        $this->set(array(
            'vins' => $vins,
            '_serialize' => array('vins')
        ));
    }
}