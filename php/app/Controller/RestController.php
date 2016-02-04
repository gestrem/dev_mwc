<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 07/12/15
 * Time: 17:30
 */

class RestController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');
    public $uses=array('Client');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();

        if($this->RequestHandler->ext == '') {
            $this->RequestHandler->ext = 'json';
        };
    }

    public function verifyToken($login,$token) {
        $this->loadModel('Client');
        return $this->Client->verifyToken($login,$token);
    }
}
?>