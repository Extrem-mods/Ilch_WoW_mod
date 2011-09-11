<?php

class CharItems extends Api{
 private $_slots = array('neck', 'shoulder', 'back', 'chest', 'shirt', 'tabard',
                                  'wrist', 'hands', 'waist', 'legs', 'feet', 'finger1',
                                  'finger2', 'trinket1', 'trinket2','mainHand', 'offHand', 'ranged');
private $_items = array();
  public function __construct($cid, $datas = NULL){
    echo 'test';
  
  }
  protected function loadDatasbyDb(){
  }
  protected function loadDatasbyApi(){
    return;                 // eventuell an dieser stelle ncohmal ne Spezielle Funktion
                            //moechte aber vermeiden das zu viele Queries hintereinander an die API gehen
                            //daher die Items immer zusammen mit dem Char neu Laden. 
  }
  public function loadDatas(){
    return;
  
  }
  public function saveDatas(){
    return;
  }
  public function getAsArray(){
  	return;
  }                                     
}