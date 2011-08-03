<?php

abstract class Api{
protected abstract function  getDatasByDb();
protected abstract function  getDatasByApi();
public abstract function getDatas();
public abstract function  saveDatas();

}