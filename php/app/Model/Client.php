<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 01/12/15
 * Time: 14:03
 */

class Client extends AppModel{

    public function beforeSave($options = array()) {
        if (!empty($this->data['Client']['password'])) {
            $this->data['Client']['password']=$this->cryptpass($this->data['Client']['password']);
        }
        if (!empty($this->data['password'])) {
            $this->data['password']=$this->cryptpass($this->data['password']);
        }
        return true;
    }

    public function changePassword($id,$old,$new) {
        $client=$this->findById($id);
        if($client['Client']['password']==$this->cryptpass($old)) {
            $client['Client']['password']=$new;
            if($this->save($client)) {
                return true;
            }
        }
        return false;
    }

    public function cryptpass($pass) {
        return crypt($pass,'lucasetguillaumesont des tueurs de fous');
    }

}