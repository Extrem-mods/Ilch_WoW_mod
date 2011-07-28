<?php

class Item extends Api{
  private $_id;
  private $_name;
  private $_icon;
  private $_quality;
  private static const LOCAL_ICON_PATH = dirname($_SERVER['PHP_SELF']). 'include/images/wow_mod/items/';
  private static const REMOTE_ICON_PATH = 'http://eu.media.blizzard.com/wow/icons/56/';
  
  public function __construct($id){
    getDatas();
  }
  
  private function getDatasbyDb(){
  $query = "SELECT `name`, `icon`, `quality FROM `prefix_items` WHERE `iID` = $_id";
  $result =  db_query($sql);
    if($result = mysql_fetch_array($result)){                   
      $this->_name = $result['name'];
      $this->_icon = $result['icon'];           
      $this->_quality = $result['quality'];           
      return true;
    }
    return false;    
  }
  public function getDatas(){
    if(!getDatasByDb()){
        return getDatasbyApi();  
      }
    return true; 
  }
  
  private function getDatasbyApi(){
    $url = 'http://eu.battle.net/api/wow/data/item/';
    $curl = new Curl();
	  $curl->setURL($url.$this->_id);
	  $tmp = json_decode($curl->getResult(), true);
    var_dump($tmp);
    unset($curl);
    
    saveDatas(); 
  }
  private function saveDatas(){
  }
  public function getAsArray(){
  }
  
  /**
   * Gibt einen Link auf das Itemicon. Wenn das Icon auf dem Server ist verwiest es dahin,
   * Ansonsten wird es versucht Blizzard zu laden, und lokal zu speichern.
   * Geht das schief, verweist es direkt auf den Bestand von Blizzard       
   */      
  public getIconUrl(){
    if(!file_exists(self::LOCAL_ICON_PATH.$_icon.'.jpg')){
      if($this->loadIconFromServer()){
        return self::LOCAL_ICON_PATH.$_icon.'.jpg'
      }else{
        return self::REMOTE_ICON_PATH.$_icon.'.jpg';
      }         
    }
  }
  
  /**
   *
   */     
  private loadIconFromServer(){
    return (bool) file_put_contents(self::LOCAL_ICON_PATH.$_icon.'.jpg',file_get_contents(self::REMOTE_ICON_PATH.$_icon.'.jpg'));
  }  
}