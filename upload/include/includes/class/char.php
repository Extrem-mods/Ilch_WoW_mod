<?php
# WoW Char mod by finke
# Support: http://www.extrem-mods.de

defined ('main') or die ( 'no direct access' );

define('NONE', 0);
define('WITH_STATS', 1);
define('WITH_items', 2);
define('WITH_APPEARANCE', 4);
define('WITH_TALENTS', 8);
define('WITH_TITLES', 16);



class Char implements Api{
  private $_cID;             
  private $_name;           
  private $_level;           
  private $_realm;
  private $_class;         
  private $_race;          
  private $_gender;           
  private $_achievementPoints;
  private $_thumbnail;        
  private $_lastModified;     
  private $_updated;
  
  private $_mods = array();
  
  public function __construct($name, $realm, $loadData=true, $mods = NONE){
  $this->_name = $name;
  $this->_realm = $realm;
  if($loadData) $this->getDatas();   
  }
  public function __construct($cid, $loadData=true){
  $this->_cID = $cid;
  if($loadData) $this->getDatas();   
  }          
  
 // laed einen Char aus der DB 
  private function getDatasByDb($ignorTime = false){
    $sql ="SELECT
    `cID` , `name` , `level` , `realm` , `class`, `race`, `gender` , `achievementPoints` , `thumbnail` , UNIX_TIMESTAMP(`lastModified`) as  `lastModified`, UNIX_TIMESTAMP(`updated`) as `updated` 
    FROM `prefix_chars`
    WHERE `cID` ={$this->_cID} OR (`name` LIKE '{$this->_name}' AND `realm` LIKE '{$this->_realm}')";
    $result =  db_query($sql);
    if($result = mysql_fetch_array($result)){
      if($result['updated'] < time()-60*60*24 && !$ignorTime) return false;
      $this->_cID = $result['cID'];             
      $this->_name = $result['name'];           
      $this->_level = $result['level'];           
      $this->_realm = $result['realm'];
      $this->_class = $result['class'];         
      $this->_race = $result['race'];          
      $this->_gender = $result['gender'];           
      $this->_achievementPoints = $result['achievementPoints'];
      $this->_thumbnail = $result['thumbnail'];        
      $this->_lastModified = $result['lastModified'];     
      $this->_updated = $result['updated'];
      return true;
    }
      return false;
  }
// laed einen Char aus dem WOW Arsenal
private function getDatasByapi(){
  if($this->_name == NULL || $this->_realm== NULL)  return false;
    $url = 'http://eu.battle.net/api/wow/character/'.$this->_realm.'/'. $this->_name;
    $curl = new Curl();
	  $curl->setURL($url);
	  $tmp = json_decode($curl->getResult(), true);
    var_dump($tmp);
    $this->saveDatas();
    unset($curl); 
}
  public function getDatas(){
    if(!getDatasByDb()){
      if(!getDatasbyApi()){
        getDatasByDb();
        return getDatasbyApi();  
      }
    } 
    return true; 
  }
  
  public function saveDatas(){
    if($this->_name == NULL || $this->_realm== NULL || $this->_lastModified == NULL)  return false;
    sql="INSERT INTO `prefix_chars` 
        (`name` , `level` , `realm` , `class`, `race`, `gender` , `achievementPoints` , `thumbnail` , `lastModified`)
        VALUES 
        ('{$this->_name}', '{$this->_level}', '{$this->_realm}', '{$this->_class}', '{$this->_race}', '{$this->_gender}', '{$this->_achievementPoints}', '{$this->_thumbnail}', '{$this->_lastModified}')
        ON DUPLICATE KEY UPDATE
        `name` =  VALUES(`name`), `level` = VALUES(`level`), `realm` = VALUES(`realm`), `class` = VALUES(`class`), `race` = VALUES(`race`), `gender` = VALUES(`gender`), `achievementPoints` = VALUES(`achievementPoints`), `thumbnail` = VALUES(`thumbnail`), `lastModified`= VALUES(`lastModified`)
        WHERE `cID` = {$this->cID};";
  }
  public function getAsArray(){
  return array(
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
  }
}
