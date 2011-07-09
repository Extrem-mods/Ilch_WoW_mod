<?php
function_exists('curl_init') or die('Die PHP erweiterung cURL ist auf Ihrem System nicht instaliert. Diese Version unterstützt cURL leider nur über die PHP-Erweiterung.');
class Curl{
  private  $curl;
  public function __construct(){
  $this->curl = curl_init();
  }
  public function __destruct() {
      curl_close($this->curl);
   }
   
   public function setOpt($opt, $value){
       return curl_setopt($this->curl, $opt, $value);
   }
   
   public function setOptArray($array, &$error){
       foreach ($array as $option => $value) {
           if (!curl_setopt($this->curl, $option, $value)) {
               $error = $option;
               return false;
           } 
       }
       $error = NULL;
       return true;
   }
   public function version($age= CURLVERSION_NOW){
       return curl_version($age);
   }
   public function getResult(){
      $this->setOpt(CURLOPT_RETURNTRANSFER, true);   
      return curl_exec($this->curl);  
   }
   public function printResult(){
      $this->setOpt(CURLOPT_RETURNTRANSFER, false);   
      return curl_exec($this->curl);
  }
  public function setURL($url){
    $this->setOpt(CURLOPT_URL,$url);
  }
}