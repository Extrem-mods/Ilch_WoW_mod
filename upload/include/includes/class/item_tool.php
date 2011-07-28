<?php

class item_tool extends item{
private $eiID;
private $gem0;
private $gem1;
private $gem2;
private $enchant;
private $set;
private $reforge;

  public function __construct($id){
  }
  private function getDatasbyDb(){
  }
  private function getDatasbyApi(){
  return getDatasbyDb();  // eventuell an dieser stelle ncohmal ne Spezielle Funktion
                          //moechte aber vermeiden das zu viele Queries hintereinander an die API gehen
                          //daher die Items immer zusammen mit dem Char neu Laden. 
  }  
} 