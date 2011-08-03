<?php 
class Realm extends Api{
  private $_type; //typ (pve,pvp, rp)
  private $_queue;  //Warteschlange (bool)
  private $_status; //status (bool)
  private $_population; 
  private $_name;
  private $_slug;
  
  public function __construct($slug, $loadData=true){
    $this->_slug = $slug;
    if($loadData) $this->getDatas(); 
  }

  protected function getDatasByDb(){
    $result =  db_query("SELECT `name` , `type` , `queue` , `status` , `population` , UNIX_TIMESTAMP(`refresh`) as `time` FROM prefix_realms WHERE `slug` = '{$this->_slug}'");
    if($result = mysql_fetch_array($result)){
      if($result['time'] < time()-(60*60*24)) return false;
      $this->_type = $result['type'];
      $this->_queue  = $result['queue'];
      $this->_status = $result['status'];
      $this->_population = $result['population']; 
      $this->_name = $result['name'];
      return true;        
    }else{
      return false;
    }
  }
  
  protected function getDatasbyApi(){
    $url = 'http://eu.battle.net/api/wow/realm/status';
    $curl = new Curl();
	  $curl->setURL($url. '?realms=' . $this->_slug);
	  $tmp = json_decode($curl->getResult(), true);
    //var_dump($tmp); //array(1) { ["realms"]=> array(1) { [0]=> array(6) { ["type"]=> string(3) "pvp" ["queue"]=> bool(false) ["status"]=> bool(true) ["population"]=> string(4) "high" ["name"]=> string(9) "Blackrock" ["slug"]=> string(9) "blackrock" } } }
    $this->_type = $tmp["realms"][0]['type'];
    $this->_queue  = $tmp["realms"][0]['queue'];
    $this->_status = $tmp["realms"][0]['status'];
    $this->_population = $tmp["realms"][0]['population']; 
    $this->_name = addslashes($tmp["realms"][0]['name']); 
    unset($curl);
    $this->saveDatas(); 
  }
  
  public function saveDatas(){
    return(db_query("INSERT INTO `prefix_realms` 
                    (`slug`, `name`, `type`, `queue`, `status`, `population`)
                    VALUES 
                    ('{$this->_slug}', '{$this->_name}', '{$this->_type}', '{$this->_queue}', '{$this->_status}', '{$this->_population}')
                    ON DUPLICATE KEY UPDATE
                    `slug` = VALUES(`slug`), `name` = VALUES(`name`), `type` = VALUES(`type`), `queue` = VALUES(`queue`), `status` = VALUES(`status`), `population` = VALUES(`population`), `refresh` = NOW();"));
  }
  public function setAll($data){
    if(is_array($data)){
      $this->_type = $data['type'];
      $this->_queue  = $data['queue'];
      $this->_status = $data['status'];
      $this->_population = $data['population']; 
      $this->_name = addslashes($data['name']);
      return true;
    }
    return false;
  }
  
  public function getDatas(){
    if(!$this->getDatasByDb()) return $this->getDatasbyApi();
    return true; 
  }
  
  public function getType(){ return $this->_type;}
  public function getQueue(){ return $this->_queue;}
  public function getStatus(){ return $this->_status;}
  public function getPopulation(){ return $this->_population;}
  public function getName(){ return stripslashes($this->_name);}
  public function getSlug(){ return $this->_slug;}
  public function getAsArray(){
  return array('type' => $this->_type, 'queue' => $this->_queue, 'status' => $this->_status, 'population' => $this->_population, 'name' => stripslashes($this->_name), 'slug' => $this->_slug);
  
  }
}
