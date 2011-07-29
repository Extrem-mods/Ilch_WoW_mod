<?php

defined ('main') or die ( 'no direct access' );

class CharStats implements Api{
  private $_cID;
  private $_health;
  private $_powerType;
  private $_power;
  private $_str;
  private $_agi;
  private $_sta;
  private $_int;
  private $_spr;
  private $_attackPower;
  private $_rangedAttackPower;
  private $_mastery;
  private $_masteryRating;
  private $_crit;
  private $_critRating;
  private $_hitRating;
  private $_hasteRating;
  private $_expertiseRating;
  private $_spellPower;
  private $_spellPen;
  private $_spellCrit;
  private $_spellCritRating;
  private $_mana5;
  private $_mana5Combat;
  private $_armor;
  private $_dodge;
  private $_dodgeRating;
  private $_parry;
  private $_parryRating;
  private $_block;
  private $_blockRating;
  private $_resil;
  private $_mainHandDmgMin;
  private $_mainHandDmgMax;
  private $_mainHandSpeed;
  private $_mainHandDps;
  private $_mainHandExpertise;
  private $_offHandDmgMin;
  private $_offHandDmgMax; 
  private $_offHandSpeed;
  private $_offHandDps;
  private $_offHandExpertise;
  private $_rangedDmgMin;
  private $_rangedDmgMax;
  private $_rangedSpeed;
  private $_rangedDps;
  private $_rangedCrit;
  private $_rangedCritRating;
  private $_rangedHitRating;
  
  public __construct($cid){
    $_cID = $cid;
  }
  
  private function  getDatasByDb(){
  }
  
  private function  getDatasByapi(){
    return false;
  }
  
  public function getDatas(){
    return getDatasByDb();
  }
  
  public function  saveDatas(){
  }
}