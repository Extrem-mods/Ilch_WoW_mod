<?php

abstract class Api{
  protected $_lastError = '';
protected abstract function  getDatasByDb();
protected abstract function  getDatasByApi();
public abstract function getDatas();
public abstract function  saveDatas();
public function getLastError(){
  return $this->_lastError;
}

}