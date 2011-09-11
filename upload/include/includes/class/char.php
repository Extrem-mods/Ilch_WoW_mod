<?php
# WoW Char mod by finke
# Support: http://www.extrem-mods.de

define('NONE', 0);
define('WITH_STATS', 1);
define('WITH_ITEMS', 2);
define('WITH_APPEARANCE', 4);
define('WITH_TALENTS', 8);
define('WITH_TITLES', 16);
define('WITH_PROFESSIONS', 32);
define('WITH_COMPANIONS', 64);
define('WITH_PROGRESSION', 128);


class Char extends Api{
  private $_cID;             
  private $_name;           
  private $_level;           
  private $_realm;
  private $_class;         
  private $_race;          
  private $_gender;           
  private $_achievementPoints;
  private $_thumbnail;        
  private $_lastModified = NULL;     
  private $_updated;
  
  private $_mods = array();
  
  public function __construct($name, $realm = NULL, $mods = NONE, $loadData=true){
    if($realm == NULL && is_numeric($name)){
      $this->_cID = $name;
    }else{     
      $this->_name = $name;
      $this->_realm = $realm;
    }
    if($loadData) $this->getDatas($mods);   
  }   
  
  // laed einen Char aus der DB 
  protected function getDatasByDb($mods = NONE, $ignorTime = false){
    $sql ="SELECT
    `cID` , `name` , `level` , `realm` , `class`, `race`, `gender` , `achievementPoints` , `thumbnail` , UNIX_TIMESTAMP(`lastModified`) as  `lastModified`, UNIX_TIMESTAMP(`updated`) as `updated` 
    FROM `prefix_chars`
    WHERE (`cID` = '{$this->_cID}' OR (`name` LIKE '{$this->_name}' AND `realm` LIKE '{$this->_realm}'))";
    $result =  db_query($sql);
    if($result = mysql_fetch_array($result)){
      $this->_cID = $result['cID'];
      $this->_name = $result['name'];           
      $this->_realm = $result['realm'];
      if(empty($result['level']) || empty($result['class']) || empty($result['race'])){
        return NULL;      
      }else{           
        $this->_level = $result['level'];           
        $this->_class = $result['class'];         
        $this->_race = $result['race'];          
        $this->_gender = $result['gender'];           
        $this->_achievementPoints = $result['achievementPoints'];
        $this->_thumbnail = $result['thumbnail'];        
        $this->_lastModified = $result['lastModified'];     
        $this->_updated = $result['updated'];
        if($ignorTime || $result['updated'] > time() -($allgAr['wow_reload_time']*60)){
          return true;
        }
      }
    }
    return false;
  }
  // laed einen Char aus dem WOW Arsenal
  protected function getDatasByapi($mods = NONE){
    if($this->_name == NULL || $this->_realm== NULL)  return false;
    $lm = (empty($this->_lastModified)?0:$this->_lastModified);    
    $url = 'http://eu.battle.net/api/wow/character/'.$this->_realm.'/'. $this->_name;
    $curl = new Curl();
	  $curl->setURL($url);
	  $tmp = json_decode($curl->getResult(), true);
    if(isset($tmp['status']) && $tmp['status'] == 'nok'){
      $this->_lastError = $tmp['reason'];
      return false;
    }	               
    $this->_name = $tmp['name'];           
    $this->_level = $tmp['level'];           
    $this->_realm = $tmp['realm'];
    $this->_class = $tmp['class'];         
    $this->_race = $tmp['race'];          
    $this->_gender = $tmp['gender'];           
    $this->_achievementPoints = $tmp['achievementPoints'];
    $this->_thumbnail = $tmp['thumbnail'];        
    $this->_lastModified = floor($tmp['lastModified'] / 1000); // Blizzard logt auf die Microsekunde Genau :)     
    $this->_updated = time();       
    $this->saveDatas();

    if($mods && $lm < $this->_lastModified){
    $options = '?fields=stats,items,appearance,talents,titles,professions,companions,progression';
    $url = 'http://eu.battle.net/api/wow/character/'.$this->_realm.'/'. $this->_name . $options;
    echo $url;
    $curl->setURL($url);
	  $tmp = json_decode($curl->getResult(), true);
    if(isset($tmp['status']) && $tmp['status'] == 'nok'){
      $this->_lastError = $tmp['reason'];
      return false;
    }
    if(WITH_STATS & $mods){
      $this->_mods[WITH_STATS] = new CharStats($this->_cID, $tmp['stats']);
      $this->_mods[WITH_STATS]->saveDatas();       
    }  
    if(WITH_ITEMS & $mods){
      $this->_mods[WITH_ITEMS] = new CharItems($this->_cID, $tmp['items']);
      $this->_mods[WITH_ITEMS]->saveDatas();  
    } 
    if(WITH_APPEARANCE & $mods){
    } 
    if(WITH_TALENTS & $mods){
    } 
    if(WITH_TITLES & $mods){
    } 
    if(WITH_PROFESSIONS & $mods){
    } 
    if(WITH_COMPANIONS & $mods){
    } 
    if(WITH_PROGRESSION & $mods){
    }	               
    //! TODO Laden der gewuenschten Mods
    unset($curl);
    return true; 
}
}
  //!TODO Muss mal nochmal Ueberarbeitet werden
  public function getDatas($mods = NONE){ 
    if($this->getDatasByDb($mods) == true) return true;
    return $this->getDatasbyApi($mods);
  }
  
  public function saveDatas(){
    if($this->_name == NULL || $this->_realm== NULL || $this->_lastModified == NULL)  return false;
    $sql="INSERT INTO `prefix_chars` 
        (`name` , `level` , `realm` , `class`, `race`, `gender` , `achievementPoints` , `thumbnail` , `lastModified`)
        VALUES 
        ('{$this->_name}', '{$this->_level}', '{$this->_realm}', '{$this->_class}', '{$this->_race}', '{$this->_gender}', '{$this->_achievementPoints}', '{$this->_thumbnail}', FROM_UNIXTIME({$this->_lastModified}))
        ON DUPLICATE KEY UPDATE
        `name` =  VALUES(`name`), `level` = VALUES(`level`), `realm` = VALUES(`realm`), `class` = VALUES(`class`), `race` = VALUES(`race`), `gender` = VALUES(`gender`), `achievementPoints` = VALUES(`achievementPoints`), `thumbnail` = VALUES(`thumbnail`), `lastModified`= VALUES(`lastModified`)";
        return db_query($sql);
  }
  
  public function getAsArray(){
  if($this->_name == NULL || $this->_realm== NULL || $this->_lastModified == NULL)  return false;
  $tmp = array(
  'cID' =>$this->_cID,             
  'name' => $this->_name,           
  'level' => $this->_level,           
  'realm' => $this->_realm,
  'class' => $this->_class,         
  'race' => $this->_race,          
  'gender' => $this->_gender,           
  'achievementPoints' => $this->_achievementPoints,
  'thumbnail' => $this->_thumbnail,        
  'lastModified' => $this->_lastModified,     
  'update' => $this->_updated);
  return $tmp;  
  }
  
  //!TODO Auf die Konstanten umstellen   
  public function getMods($mod= ''){
    if(!empty($mod)){
      if(!is_array($mod)) $mod = array($mod);
      $tmp = array();
      foreach ($mod as $name){
        if(in_array($name, $this->_mods)){
        $tmp[$name] = $this->_mods[$name];
        }        
      }
      return $tmp;
    }
    return $_mods; 
  }
}
