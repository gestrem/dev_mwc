<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 07/12/15
 * Time: 17:34
 */

class Vin extends AppModel{
    public $belongsTo = array('Price','Cepage','Origine');
    public $hasOne = array('Comment');
}