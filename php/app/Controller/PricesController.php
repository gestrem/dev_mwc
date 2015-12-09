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
        $this->set('vins',$vins);
        $this->set('origines',$origines);
        $this->set('cepages',$cepages);

        if($this->request->is('post')) {
            if($this->request->data['selectedOrigine'] || $this->request->data['selectedCepage']) {
                $vins=$this->Vin->findAllByOrigineIdOrCepageId($this->request->data['selectedOrigine'],$this->request->data['selectedCepage']);
                $this->set('vins',$vins);
            }
        }
        var_dump($vins[0]);
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
        $this->loadModel('Vin');
        $this->loadModel('Price');
        foreach($this->request->data['vins'] as $vin) {
            $this->Price->create();
            $now = new DateTime();
            $vin['Vin']['Price']['vin_id']=$vin['Vin']['id'];
            $vin['Vin']['Price']['date_price']=$now->format('Y-m-d H:i:s');// MySQL datetime format
            $this->Price->save($vin['Vin']['Price']);
            $id = $this->Price->id;
            $this->Price->clear();
            unset($vin['Vin']['Price']);
            $vin['Vin']['price_id']=$id;
            $this->Vin->save($vin['Vin']);
        }
        $this->redirect('/prices');
    }
}