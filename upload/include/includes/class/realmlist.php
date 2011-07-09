<?php

class RealmList{
  private $_list = array();
  
  private function getDatasByDB(){
  }
  private function getDatasbyAPI(){
  }
  public function getDatas(){
    if(!getDatasByDB()) return getDatasbyAPI();
    return true; 
  }
}