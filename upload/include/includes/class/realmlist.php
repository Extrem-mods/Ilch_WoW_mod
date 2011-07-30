<?php

class RealmList extends Api{
  private $_list = array();
 
  public function getDatas(){
    $realms = $this->getDatasbyAPI();
    foreach($realms as $realm){
      if(!isset($this->_list[$realm['slug']])){
        $this->_list[$realm['slug']] = new Realm($realm['slug'], false);
      }
      $this->_list[$realm['slug']]->setAll($realm);
      $this->_list[$realm['slug']]->saveDatas();
    }
  }
  
  protected function getDatasByApi(){
    $url = 'http://eu.battle.net/api/wow/realm/status';
    $curl = new Curl();
	  $curl->setURL($url);
	  $tmp = json_decode($curl->getResult(), true);
	  unset($curl);
    return $tmp['realms'];
  }
protected function getDatasByDb(){
  return getDatasByApi();
}

  public function getRealm($slug){
    return $this->_list[$slug];
  }
  public function saveDatas(){
    foreach($_list as $realm){
      $realm->saveDatas();
    }
  }
  
  public function getSlugs($asList=false){
    $tmp= '';
    foreach($this->_list as $k => $v){
      $tmp .= $k. ':';
    }
    if(!$asList) $tmp = explode(':', substr($tmp,0,-1));
    return $tmp; 
  }
}
