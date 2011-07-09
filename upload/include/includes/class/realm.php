<?php

class Realm{
  private $_type; //typ (pve,pvp, rp)
  private $_queue;  //Warteschlange (bool)
  private $_status; //status (bool)
  private $_population; 
  private $_name;
  private $_slug;
  
  public function __construct($slug, $loadData=true){
    $this->_slug = $slug;
    if($loadData) $this->getDatas(); 
  }

  private function getDatasByDB(){
    $result =  db_query("SELECT * FROM prefix_realms WHERE `slug` = '{$this->_slug}'");
    if($result = mysql_fetch_array($result)){
      if($result['refresh'] < time()-60*60*24) return false;
      
      $this->_type = $result['type'];
      $this->_queue  = $result['queue'];
      $this->_status = $result['status'];
      $this->_population = $result['population']; 
      $this->_name = $result['name'];
        
    }else{
      return false;
    }
  }
  
  private function getDatasbyAPI(){
  
    $erfolg = false;
    if($erfolg) saveDatas();
    return $erfolg; 
  }
  
  private function saveDatas(){
  }
  
  public function getDatas(){
    if(!getDatasByDB()) return getDatasbyAPI();
    return true; 
  }
  
  public getType(){ return $this->_type;}
  public getQueue(){ return $this->_queue;}
  public getStatus(){ return $this->_status;}
  public getPopulation(){ return $this->_population;}
  public getName(){ return $this->_name;}
  public getSlug(){ return $this->_slug;}
}