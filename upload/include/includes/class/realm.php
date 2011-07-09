<?php

class Realm{
  private $_type; //typ (pve,pvp, rp)
  private $_queue;  //Warteschlange (bool)
  private $_status; //status (bool)
  private $_population; 
  private $_name;
  private $_slug;

  private function getDatasByDB(){
  }
  private function getDatasbyAPI(){
  }
  public function getDatas(){
    if(!getDatasByDB()) return getDatasbyAPI();
    return true; 
  }
}