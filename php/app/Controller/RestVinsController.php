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

    public function index($login,$token) {
        if ($client=RestController::verifyToken($login,$token)) {
            $vins = $this->Vin->find('all',array('recursive'=>0));
            $devise=$client['Client']['devise_favorite'];
            $unite = $client['Client']['unite'];
            $this->set(array(
                'devise'=>$devise,
                'unite' => $unite,
                'vins' => $vins,
                '_serialize' => array('devise','unite','vins')
            ));
        } else {
            $this->set(array(
                'message'=>'mauvais token',
                '_serialize' => array('message')
            ));
        }
    }

    public function indexbis() {
            $vins = $this->Vin->find('all',array('recursive'=>0));
            $devise='USD';
            $unite = 'GAL';
            $this->set(array(
                'devise'=>$devise,
                'unite' => $unite,
                'vins' => $vins,
                '_serialize' => array('devise','unite','vins')
            ));
    }
}