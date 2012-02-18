<?php

class DKP{
	private $_cid;
	private $_history = array();
	private $_saldo;

	public function __construct($cid){
		$this->_cid = $cid;
		if(!mysql_num_rows(db_query('select `cID` FROM `prefix_chars` WHERE `cID` = '.$this->_cid)))
			throw Exeption('Char ist nicht in der Datenbank vorhanden');
		$this->loadDatas();
	}
	
	private function loadDatas(){
		$this->_saldo = 0;
		$this->_history = array();
		$history = db_query('select `time`, `dscription`, `change` FROM `prefix_dkp_his` WHERE char='.$this->_cid);
		while($row = mysql_fetch_assoc($history){
			$this->_history[] = $row;
			$this->_saldo = $this->_saldo + $row['change'];
		}
	}
	
	public static function getHistory($cid){
		if(!mysql_num_rows(db_query('select `cID` FROM `prefix_chars` WHERE `cID` = '.$cid)))
			throw Exeption('Char ist nicht in der Datenbank vorhanden');
		$history = db_query('select `time`, `dscription`, `change` FROM `prefix_dkp_his` WHERE char='.$cid);
		$end = array();
		while($row = mysql_fetch_assoc($history){
			$end = $row;
		}
		return $end;
	
	}
	
	public function getHistory(){
		return $this->_history;
	}
	
	public function changeSaldo($description, $value){
		$now = time();
		$db_query('INSERT INTO `prefix_dkp_his` (`char`, `time`, `dscription`, `change`) VALUES ('.$this->_cid.', '.$time.', \''.$description.'\', '. intval($value).')');
		$this->_history[] = array('time' => $time, 'description' => $description, 'change' => $value);
		$this->_saldo = $this->_saldo + $value;
		return $this->_saldo;
	
	}
	
	public function useRule($id, $description==''){
		$tmp = db_query('select `changes` FROM `prefix_dkp_rules` WHERE `id`='.$id);
		if(mysql_num_rows($tmp) != 1)	return false;
		$value = mysql_fetch_array($value);	$value = $value['changes'];
		return changeSaldo((!empty($description)?$description:$value['description']), $value);
	}
}
