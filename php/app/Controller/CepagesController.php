<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 17:00
 */
App::uses('Model','Cepage');

class CepagesController extends AppController{

    public function index() {
        $cepages=$this->Cepage->find('all');
        $this->set('cepages',$cepages);
        $this->set('title_for_layout', 'Administration Cepages');
    }

    public function edit($id = null)
    {
        if ($cepage = $this->Cepage->findById($id)) {
            $this->set('cepage', $cepage);
            $this->set('title_for_layout', 'Modification cepage');
            if ($this->request->is('post') ) {
                $cepage = $this->request->data['Cepage'];
                $this->Cepage->id = $id;
                if ($this->Cepage->save($cepage)) {
                    $this->redirect('/cepages');
                }
            }
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
                $cepage ['Cepage']= $this->request->data['Cepage'];
                if ($this->Cepage->save($cepage)) {
                    $this->redirect('/cepages');
                }
        }
    }
    public function delete($id) {
        if($this->Cepage->delete($id)) {
            $this->redirect('/cepages');
        }
    }
}