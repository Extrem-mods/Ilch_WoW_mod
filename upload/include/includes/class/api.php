<?php

interface Api{
private abstract function  getDatasByDb();
private abstract function  getDatasByapi();
public abstract function getDatas();
public abstract function  saveDatas();
}