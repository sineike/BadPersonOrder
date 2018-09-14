<?php
require_once __DIR__ . '/vendor/autoload.php';
use BadpersonOrder\OrderApi;


$res =  OrderApi::getInstance();

print_r($res);die;