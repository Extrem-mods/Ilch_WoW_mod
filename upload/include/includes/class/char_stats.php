<?php

defined ('main') or die ( 'no direct access' );

class CharStats extends Api{
  private $_stats = array();
  
  public function __construct($cid, $daten = NULL){
    $_stats['cID'] = $cid;
    if(!empty($daten) && is_array($daten)){
      loadDatasByapi($daten);
      saveDatas();
    }else{
      loadDatas();
    }
  }
  
  protected function loadDatasByDb(){
    $sql =  "SELECT * FROM `prefix_char_stats` WHERE `cID` = {$this->_stats['cID']}";
    $result = db_query($sql);
    if($result = mysql_fetch_assoc($result)){
    $this->_stats = $result;   
    }
  }
  /**Daten werden der Funktion uebergeben, nur im Notfall besteht die moeglchkeit sei aus der API zu holen
   *
   */     
  protected function loadDatasByapi($daten, $api = FALSE){
  	
    
  }
  
  public function loadDatas(){
    return getDatasByDb();
  }
  
  public function saveDatas(){
  	
  }
}