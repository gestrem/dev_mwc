<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 10/12/15
 * Time: 11:36
 */
App::uses('HttpSocket', 'Network/Http');
App::import('Controller', 'Rest');


class RestRatesController extends RestController {
    public function index($base) {

        $this->Http = new HttpSocket();
        $json = $this->Http->get(
            'http://api.fixer.io/latest?base='.$base);
        $this->set(array(
            'rates' => (array) json_decode($json['body']),
            '_serialize' => array('rates')
        ));
    }
}