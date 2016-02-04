<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 10:37
 */
class Cepage extends AppModel{
    public $hasMany = array(
        'Vin' => array(
            'className' => 'Vin',
            'dependent' => true
        )
    );
}