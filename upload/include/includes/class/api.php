<?php

abstract class Api{
  protected $_lastError = '';
protected abstract function  getDatasByDb();
protected abstract function  getDatasByApi();
public abstract function getDatas();
public abstract function  saveDatas();
public function getLastError(){
  $error = $this->_lastError;
  $this->_lastError = ''; 
  return $error;
}

}