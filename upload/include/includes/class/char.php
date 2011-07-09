<?php
# WoW Char mod by finke
# Support: http://www.extrem-mods.de

defined ('main') or die ( 'no direct access' );

class Char{
private $name; //string
private $server; //string
private $values = array(); //array
 
 // laed einen Char aus der DB 
public function loadFromDB(){
}
// laed einen Char aus dem WOW Arsenal
public function loadFromArsenal(){
}
// laed zusaetzlich angegebene Infos aus der DB
public function loadAddInfos(){
}

}