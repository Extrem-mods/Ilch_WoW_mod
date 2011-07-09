<?php 
class Realm{
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

  private function getDatasByDB(){
    $result =  db_query("SELECT `name` , `type` , `queue` , `status` , `population` , UNIX_TIMESTAMP(`refresh`) as `time` FROM prefix_realms WHERE `slug` = '{$this->_slug}'");
    if($result = mysql_fetch_array($result)){
      if($result['time'] < time()-60*60*24) return false;
      
      $this->_type = $result['type'];
      $this->_queue  = $result['queue'];
      $this->_status = $result['status'];
      $this->_population = $result['population']; 
      $this->_name = $result['name'];
        
    }else{
      return false;
    }
  }
  
  private function getDatasbyAPI(){
    $url = 'http://eu.battle.net/api/wow/realm/status';
    $curl = new Curl();
	  $curl->setURL($url. '?realms=' . $this->_slug);
	  $tmp = json_decode($curl->getResult(), true);
    var_dump($tmp); 
  }
  
  public function saveDatas(){
    return(db_query("INSERT INTO `prefix_realms` 
                    (`slug`, `name`, `type`, `queue`, `status`, `population`)
                    VALUES 
                    ('{$this->_slug}', '{$this->_name}', '{$this->_type}', '{$this->_queue}', '{$this->_status}', '{$this->_population}')
                    ON DUPLICATE KEY UPDATE
                    `slug` = VALUES(`slug`), `name` = VALUES(`name`), `type` = VALUES(`type`), `queue` = VALUES(`queue`), `status` = VALUES(`status`), `population` = VALUES(`population`)
                    WHERE `slug` = VALUES(`slug`);")
  }
  public function setAll($data){
    if(is_array($data){
      $this->_type = $data['type'];
      $this->_queue  = $data['queue'];
      $this->_status = $data['status'];
      $this->_population = $data['population']; 
      $this->_name = $data['name'];
      return true;
    }
    return false;
  }
  
  public function getDatas(){
    if(!getDatasByDB()) return getDatasbyAPI();
    return true; 
  }
  
  public getType(){ return $this->_type;}
  public getQueue(){ return $this->_queue;}
  public getStatus(){ return $this->_status;}
  public getPopulation(){ return $this->_population;}
  public getName(){ return $this->_name;}
  public getSlug(){ return $this->_slug;}
  public function getAsArray(){
  return array('type' => $this->_type, 'queue' => $this->_queue, 'status' => $this->_status, 'population' => $this->_population, 'name' => $this->_name, 'slug' $this->_slug);
  
  }
}