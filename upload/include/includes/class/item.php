<?php

class Item extends Api{
  private $_id;
  private $_name;
  private $_icon;
  private $_quality;
  private  $_LOCAL_ICON_PATH; 
   const REMOTE_ICON_PATH = 'http://eu.media.blizzard.com/wow/icons/56/';
  
  public function __construct($id){
    $this->_LOCAL_ICON_PATH = dirname($_SERVER['PHP_SELF']). 'include/images/wow_mod/items/';
    $this->_id = $id;
    $this->getDatas();
  }
  
  protected function getDatasbyDb(){
  $sql = "SELECT `name`, `icon`, `quality` FROM `prefix_items` WHERE `iID` = {$this->_id}";
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
    if(!$this->getDatasByDb()){
        return $this->getDatasbyApi();  
      }
    return true; 
  }
  
  protected function getDatasbyApi(){
    $url = 'http://eu.battle.net/api/wow/data/item/';
    $curl = new Curl();
	  $curl->setURL($url.$this->_id);
	  echo $url.$this->_id;
	  $tmp = json_decode($curl->getResult(), true);    
    unset($curl);
    if(empty($tmp) || (isset($tmp['status']) && $tmp['status'] == 'nok')){
      $this->_lastError = (isset($tmp['reason'])?$tmp['reason']:'Keine Daten Empfangen');
      return false;
    }
    var_dump($tmp);	              
       
    $this->saveDatas(); 
  }
  
  public function saveDatas(){
    $sql = "INSERT INTO `prefix_items` (`iID`, `name`, `icon`, `quality`) VALUES ({$this->_id}}, '".mysql_real_escape_string($this->_name)."', '{$this->_icon}', {$this->_quality})";
  }
  
  public function getAsArray(){
    return array(
      'id' =>$this->_id,
      'name' =>$this->_name,
      'icon' =>$this->_icon,
      'quality' =>$this->_quality,
      'URL' => getIconUrl()  
    );
  }
  
  /**
   * Gibt einen Link auf das Itemicon. Wenn das Icon auf dem Server ist verwiest es dahin,
   * Ansonsten wird es versucht Blizzard zu laden, und lokal zu speichern.
   * Geht das schief, verweist es direkt auf den Bestand von Blizzard       
   */      
  public function getIconUrl(){
    if(!file_exists(self::LOCAL_ICON_PATH.$_icon.'.jpg')){
      if($this->loadIconFromServer()){
        return self::LOCAL_ICON_PATH.$_icon.'.jpg';
      }else{
        return self::REMOTE_ICON_PATH.$_icon.'.jpg';
      }         
    }
  }
  
  /**
   *
   */     
  private function loadIconFromServer(){
    return (bool) file_put_contents(
      self::LOCAL_ICON_PATH.$_icon.'.jpg',
      file_get_contents(self::REMOTE_ICON_PATH.$_icon.'.jpg')
    );
  }  
}