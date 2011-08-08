<?php

class CharItems extends Api{
 private $_slots = array('neck', 'shoulder', 'back', 'chest', 'shirt', 'tabard',
                                  'wrist', 'hands', 'waist', 'legs', 'feet', 'finger1',
                                  'finger2', 'trinket1', 'trinket2','mainHand', 'offHand', 'ranged');
private $_items = array();
  public function __construct($cid){
  
  }
  protected function getDatasbyDb(){
  }
  protected function getDatasbyApi(){
    return;                 // eventuell an dieser stelle ncohmal ne Spezielle Funktion
                            //moechte aber vermeiden das zu viele Queries hintereinander an die API gehen
                            //daher die Items immer zusammen mit dem Char neu Laden. 
  }
  public function getDatas(){
    return;
  
  }
  public function saveDatas(){
    return;
  }                                     
}