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

    public function beforeFilter()
    {
        parent::beforeFilter();
        if($this->RequestHandler->ext == '') {
            $this->RequestHandler->ext = 'json';
        };
    }
}
?>