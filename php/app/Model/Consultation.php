<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 09/12/15
 * Time: 18:46
 */
class Consultation extends AppModel{
    public $belongsTo = array('Client','Cepage','Origine');
}