<?php

class Item{
  private $_id;
  private $_name;
  private $_icon;
  private $_quality;
  
  public function __construct($id){
  
  }
  private function getDatasbyDb(){
  $query = "SELECT `name`, `icon`, `quality FROM `prefix_items` WHERE `iID` = $_id";
    
  }
  private function getDatasbyApi(){
    $url = 'http://eu.battle.net/api/wow/data/item/';
    $curl = new Curl();
	  $curl->setURL($url.$this->_id);
	  $tmp = json_decode($curl->getResult(), true);
    var_dump($tmp);
    unset($curl); 
  }
  /**
   *Gibt einen Link auf das Itemicon. Wenn das Icon auf dem Server ist verwiest es dahin,
   *Ansonsten wird es versucht Blizzard zu laden, und lokal zu speichern.
   *Geht das scvhief, verweist es direkt auf den Bestand von Blizzard       
   */      
  public getIconUrl(){
  
  }
  private loadIconFromServer(){
  }  
}