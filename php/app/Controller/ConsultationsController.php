<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 09/12/15
 * Time: 18:46
 */
class ConsultationsController extends AppController{
    public $components = array('Paginator');

    public $paginate = array(
        'fields' => array('Consultation.id', 'Consultation.date,Client.nom,Client.prenom,Cepage.label,Origine.label'),
        'limit' => 10,
        'recursive'=>2,
        'order' => array(
            'Consultation.date' => 'desc'
        )
    );

    public function index() {
        $this->Paginator->settings = $this->paginate;

        $data = $this->Paginator->paginate('Consultation');
        $this->set('data', $data);
        var_dump($data);
    }

}
