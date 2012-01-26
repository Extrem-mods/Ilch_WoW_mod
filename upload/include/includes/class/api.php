<?php

abstract class Api{
  protected $_lastError = '';
protected abstract function  loadDatasByDb();
protected abstract function  loadDatasByApi();
public abstract function loadDatas();
public abstract function  saveDatas();
public abstract function getAsArray();
private static $_server= '';
private static $_locale= '';

public function getLastError(){
  $error = $this->_lastError;
  $this->_lastError = ''; 
  return $error;
}
public static function getServer(){
	global $allgAr;
	if(!empty(self::$_server))	return self::$_server;
	$result = db_query('select `prefix_wow_regions`.`server`
	from `prefix_wow_regions`
	INNER JOIN `prefix_wow_locale` ON (`prefix_wow_regions`.`id` = `prefix_wow_locale`.`rid`)
	WHERE `prefix_wow_locale`.`id` = '.$allgAr['wow_locale']);
	if($row = mysql_fetch_row($result)){
		self::$_server = $row[0];
		return $row[0];
	}
	throw new Exception('Der Server konnte nicht bestimmt werden, bitte Überprüfe die Einstellung im Adminmenü');
}
public static function getLocale(){
	global $allgAr;
	if(!empty(self::$_locale))	return self::$_locale;
	$result = db_query('select `prefix_wow_locale`.`short` from `prefix_wow_locale` WHERE `id` = '.$allgAr['wow_locale']);
	if($row = mysql_fetch_row($result)){
		self::$_locale = $row[0];
		return $row[0];
	}
	throw new Exception('Die Lacale Einstellung konnte nicht erfolgreich geladen werden. Bitte Überprüfe die EInstellung im Adminmenü');
	}
}