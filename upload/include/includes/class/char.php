<?php
# WoW Char mod by finke
# Support: http://www.extrem-mods.de

defined ('main') or die ( 'no direct access' );

class Char{
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
  
  public function __construct($name, $realm, $loadData=true){
  $this->_name = $name;
  $this->_realm = $realm;
  if($loadData) $this->getDatas();   
  }
  public function __construct($cid, $loadData=true){
  $this->_cID = $cid;
  if($loadData) $this->getDatas();   
  }          
  
 // laed einen Char aus der DB 
  private function getDatasByDb(){
    $sql ="SELECT
    `cID` , `name` , `level` , `realm` , `class`, `race`, `gender` , `achievementPoints` , `thumbnail` , UNIX_TIMESTAMP(`lastModified`) as  `lastModified`, UNIX_TIMESTAMP(`updated`) as `updated` 
    FROM `prefix_chars`
    WHERE `cID` ={$this->_cID} OR (`name` LIKE '{$this->_name}' AND `realm` LIKE '{$this->_realm}')";
    $result =  db_query($sql);
    if($result = mysql_fetch_array($result)){
      if($result['time'] < time()-60*60*24) return false;
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
    }else{
      return false;
    }
  }
// laed einen Char aus dem WOW Arsenal
private function getDatasByapi(){
}
public function getDatas(){

}