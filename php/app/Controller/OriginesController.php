<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 17:08
 */
App::uses('Model','Origines');

class OriginesController extends AppController{

    public function index() {
        $origines=$this->Origine->find('all');
        $this->set('origines',$origines);
        $this->set('title_for_layout', 'Administration Origines');
    }

    public function edit($id = null)
    {
        if ($origine = $this->Origine->findById($id)) {
            $this->set('origine', $origine);
            $this->set('title_for_layout', 'Modification origine');
            if ($this->request->is('post') ) {
                $origine = $this->request->data['Origine'];
                $this->Origine->id = $id;
                if ($this->Origine->save($origine)) {
                    $this->redirect('/origines');
                }
            }
        }
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $origine ['Origine']= $this->request->data['Origine'];
            if ($this->Origine->save($origine)) {
                $this->redirect('/origines');
            }
        }
    }
    public function delete($id) {
        if($this->Origine->delete($id)) {
            $this->redirect('/origines');
        }
    }
}