<?php

defined ('main') or die ( 'no direct access' );

class CharStats extends Api{
  private $_stats = array();
  
  public __construct($cid, $daten = NULL){
    $_stats['cID'] = $cid;
    if(!empty($daten) && is_array($daten)){
      getDatasByapi($cid);
      saveDatas();
    }else{
      getDatas();
    }
  }
  
  protected function  getDatasByDb(){
    $sql =  "SELECT * FROM `prefix_char_stats` WHERE `cID` = {$this->_stats['cID']}";
    $result = db_query($sql);
    if($result = mysql_fetch_assoc($result)){
    $this->_stats = $result;   
    }
  }
  /**Daten werden Der Funktion übergeben, nur im notaff besteht die möglchkeit sei aus der API zu holen
   *
   */     
  protected function getDatasByapi($daten, $api = FALSE){
    
  }
  
  public function getDatas(){
    return getDatasByDb();
  }
  
  public function saveDatas(){
  }
}