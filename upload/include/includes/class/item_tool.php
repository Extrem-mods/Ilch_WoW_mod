<?php

class item_tool extends item{
private $_eiID;
private $_gem0;
private $_gem1;
private $_gem2;
private $_enchant;
private $_set;
private $_reforge;

  public function __construct($id){
    $this->_eiID= $id;
    getDatas();
  }
  protected function loadDatasbyDb(){
  }
  protected function loadDatasbyApi(){
    return getDatasbyDb();  // eventuell an dieser stelle ncohmal ne Spezielle Funktion
                            //moechte aber vermeiden das zu viele Queries hintereinander an die API gehen
                            //daher die Itemtools immer zusammen mit dem Char neu Laden. 
  }
  public function loadDatas(){
    return getDatasbyDb();
  
  }
  public function saveDatas(){
    return;
  }  
} 