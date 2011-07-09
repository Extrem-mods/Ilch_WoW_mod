<?php

class RealmList{
  private $_list = array();
  
  public function getDatas(){
    $realms = $this->getDatasbyAPI();
    foreach($realms as $realm){
      if(!isset($this->_list[$realm['slug']])){
        $this->_list[$realm['slug']] = new Realm($realm['slug']);
      }
      $this->_list[$realm['slug']]->setAll($realm);      
    }
     
  }
  
  private function getDatasbyAPI(){
    $url = 'http://eu.battle.net/api/wow/realm/status';
    $curl = new Curl();
	  $curl->setURL($url);
	  $tmp = json_decode($curl->getResult(), true);
    return $tmp['realms'] 
  }
  public function getRealm($slug){
    return $this->_list[$slug];
  }
  
  public function getrealmList($asList=false){
    $tmp= '';
    foreach($this->_list as $k => $v){
      $tmp .= $k. ':';
    }
    if(!$asList) $tmp = explode(':', substr($tmp,0,-1));
    return $tmp; 
  }
}