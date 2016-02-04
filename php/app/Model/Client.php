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

 /*   public function afterFind($results = array(), $primary) {
        foreach($results as $key => $value) {
            if(isset($results[$key][$this->modelAlias]['password'])) {
                unset($results[$key][$this->modelAlias]['password']);
            }
        }
    }*/
    public function beforeFind( $query ) {
        # Don't return the password field unless it's specified.
        $query['fields'] = empty( $query['fields'] )
            ? array_diff( array_keys( $this->schema() ), array( 'password' ) )
            : $query['fields'];

        return $query;
    }

    public function login($login,$password) {
        $result=array();
        if ($client=$this->findByLoginAndPassword($login,$this->cryptpass($password))) {
            if ($client['Client']['etat']==0) {
                $result['message']='merci de valider votre email';
            } else if($client['Client']['etat']==2) {
                $result['message']='You must pay to logIn';
            } else {
                $client['Client']['token']=sha1('letokendefou'.date('l jS \of F Y h:i:s A').$login);
                unset($client['Client']['password']);
                $this->save($client);
                $result['token']=$client['Client']['token'];
                $result['login']=$client['Client']['login'];
                $result['id']=$client['Client']['id'];
                $result['devise']=$client['Client']['devise_favorite'];
                $result['unite']=$client['Client']['unite'];
                $result['nom']=$client['Client']['nom'];
                $result['prenom']=$client['Client']['prenom'];
                $result['societe']=$client['Client']['societe'];
                $result['email']=$client['Client']['email'];
                $result['etat']=$client['Client']['etat'];
            }
        } else {
            $result['message']='mauvaise combinaison user password';
        }
        return $result;

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

    public function verifyToken($login,$token) {
        if ($client=$this->findByLoginAndToken($login,$token)) {
            return $client;
        } else {
            return false;
        }
    }

}