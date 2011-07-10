<?php

class Item{
  private $_id;
  private $_name;
  private $_icon;
  private $_quality;
  
  public function __construct($id){
  
  }
  private function getDatasbyDb(){
    
  }
  private function getDatasbyApi(){
    $url = 'http://eu.battle.net/api/wow/data/item/';
    $curl = new Curl();
	  $curl->setURL($url.$this->_id);
	  $tmp = json_decode($curl->getResult(), true);
    var_dump($tmp);
    unset($curl); 
  }  
}