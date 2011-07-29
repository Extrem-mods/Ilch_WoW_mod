<?php

defined ('main') or die ( 'no direct access' );

class CharStats implements Api{
  private $_stats = array();
  
  public __construct($cid){
    $_stats['cID'] = $cid;
  }
  
  private function  getDatasByDb(){
    $sql =  "SELECT * FROM `prefix_char_stats` WHERE `cID` = {$this->_stats['cID']}";
    $result = db_query($sql);
    if($result = mysql_fetch_assoc($result)){
    $this->_stats = $result;   
    }
  }
  
  private function  getDatasByapi(){
    return false;
  }
  
  public function getDatas(){
    return getDatasByDb();
  }
  
  public function  saveDatas(){
  }
}