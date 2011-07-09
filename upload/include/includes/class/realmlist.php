<?php

class RealmList{
  private $_list = array();
  
  public function getDatas(){
    foreach($this->_list as $realm){
      $realm->getDatas();
    }
     
  }
}