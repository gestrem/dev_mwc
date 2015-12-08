<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 17:35
 */



class PricesController extends AppController {
    public function index() {
        $this->loadModel('Cepage');
        $this->loadModel('Vin');
        $this->loadModel('Origine');
        $this->loadModel('Price');
        $cepages=$this->Cepage->find('all');
        $origines=$this->Origine->find('all');
        $vins=$this->Vin->find('all');
        var_dump($vins);

        $this->set('vins',$vins);
        $this->set('origines',$origines);
        $this->set('cepages',$cepages);

        if($this->request->is('post')) {
            if($this->request->data['selectedOrigine'] || $this->request->data['selectedCepage']) {
                $vins=$this->Vin->findAllByOrigineIdOrCepageId($this->request->data['selectedOrigine'],$this->request->data['selectedCepage']);
                $this->set('vins',$vins);
            }
        }
    }

    public function addvin() {
        if($this->request->is('post')) {
            $this->loadModel('Vin');
            $vin=$this->request->data['Vin'];
            if($this->Vin->save($vin)) {
                $this->redirect('/prices');
            }
        }
    }

    public function savePrices() {
        var_dump($this->request->data);
        $this->loadModel('Vin');
        $this->loadModel('Price');
        if($this->Vin->saveAll($this->request->data['vins'])) {
            $this->redirect('/prices');
        }
    }
}