<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 09/12/15
 * Time: 15:49
 */
App::uses('Model','Consultation');
App::import('Controller', 'Rest');

class RestConsultationsController extends RestController{
    public $uses = array('Consultation');

    public function consult() {
        if($this->request->is('post')) {
            $consultation = array();
            /*$consultation['Consultation']['client_id']=$this->request->data['client_id'];
            $consultation['Consultation']['is_detail']=$this->request->data['is_detail'];
            $consultation['Consultation']['cepage_id']=$this->request->data['cepage_id'];
            $consultation['Consultation']['origine_id']=$this->request->data['origine_id'];*/
            $this->Consultation->save($this->request->data);
        }
    }
}