<?php

class Curl{
  private $_curlAvailable = TRUE;
  private $_curl;
  private $_urlö = array();

  public function __construct(){
    if(!function_exists('curl_init'))$this->_curlAvailable = FALSE;
    if($this->_curlAvailable) $this->_curl = curl_init();
  }
  
  public function __destruct() {
     if($this->_curlAvailable) curl_close($this->_curl);
   }
   
   public function setOpt($opt, $value){
       return curl_setopt($this->_curl, $opt, $value);
   }
   
   public function setOptArray($array, &$error){
    if($this->_curlAvailable){
       foreach ($array as $option => $value) {
           if (!curl_setopt($this->_curl, $option, $value)) {
               $error = $option;
               return false;
           } 
       }
       $error = NULL;
       return true;
       }
       return false;
   }

   public function version($age= CURLVERSION_NOW){
       if($this->_curlAvailable) return curl_version($age);
       return NULL;
   }
   public function getResult(){
      if($this->_curlAvailable){
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
        return curl_exec($this->_curl);
      }
      return file_get_contents($this->url[0]);
   }

   public function printResult(){
    if($this->_curlAvailable){
      $this->setOpt(CURLOPT_RETURNTRANSFER, false);
      return curl_exec($this->_curl);
    }
    return file_get_contents($this->url[0]);
  }

  public function setURL($url, $port = 80){
    $this->url = array($url, $port);
    if($this->_curlAvailable){
      $this->setOpt(CURLOPT_URL,$this->url[0]);
      $this->setOpt(CURLOPT_PORT, $this->url[1]);
    }
  }
}