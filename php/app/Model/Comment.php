<?php
/**
 * Created by PhpStorm.
 * User: lucasesteban
 * Date: 08/12/15
 * Time: 10:37
 */
class Comment extends AppModel{
    public $belongsTo=array('Vin','Cepage','Origine');
}