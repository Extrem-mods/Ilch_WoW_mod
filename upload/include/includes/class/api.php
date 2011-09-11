<?php

abstract class Api{
  protected $_lastError = '';
protected abstract function  loadDatasByDb();
protected abstract function  loadDatasByApi();
public abstract function loadDatas();
public abstract function  saveDatas();
public abstract function getAsArray();

public function getLastError(){
  $error = $this->_lastError;
  $this->_lastError = ''; 
  return $error;
}

}