<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 *
 * Uncomment the bolded line below in file /var/www/command/index.php
 * sendMpdCmd($sock, $_GET['cmd']);
 * $result = readMpdResp($sock);
 * closeMpdSock($sock);
 * //echo $result;
 
 * http://192.168.1.55/command/?cmd=currentsong

/* * ***************************Includes********************************* */
require_once __DIR__ . '/../../../../core/php/core.inc.php';

class coincoin extends eqLogic
{
	/*     * *************************Attributs****************************** */

    /*
     * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
     * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
     public static $_widgetPossibility = array();
     */

     /*     * ***********************Methode static*************************** */


     // Fonction exécutée automatiquement toutes les minutes par Jeedom
     
     

     
  
  
  
    public function coincoin_value_set($message)
     {
     	
     	log::add('coincoin', 'info', ' ');
     	log::add('coincoin', 'info', ' --------INIT CoinCoin -----------');
     	log::add('coincoin', 'info', ' ');
     	
     	#$URL_param = $this->getConfiguration('URL_param');
     	
     	log::add('coincoin', 'info', '-----SET UP URL----------');
     	
     	$value_param=$this->getConfiguration('value_param');
     	log::add('coincoin', 'info', 'Value param : '.$value_param);
       	$value_currency=$this->getConfiguration('value_currency');
		log::add('coincoin', 'info', 'Value_currency : '.$value_currency);
      
        $api = "https://api.coingecko.com/api/v3/coins/markets";
		if (empty($value_param)){
        $cmd = "vs_currency=".$value_currency."&ids=".$message;
        }
      else{
        $cmd = "vs_currency=".$value_currency."&ids=".$value_param;
      }
      $api=$api."?".$cmd;
     	
     	log::add('coincoin', 'info', 'Api : ' . $api);
     	log::add('coincoin', 'info', '-----EXECUTION ADD COMMAND ----------');
     	
	   
     
        log::add('coincoin', 'info', 'URL_radio : ' . $message);
      
      
     	$dataArray = array("cmd"=>'add');
     	$ch = curl_init();
     	$data = http_build_query($dataArray);
     	$getUrl = $api;
       log::add('coincoin', 'info', 'URL_complet : ' . $getUrl);
     	
      $json = file_get_contents($api);

if($json === FALSE) { } else {
//Step 2: Decodage du JSON et recuperation des infos souhaitees
$jsonData = json_decode($json,true);
//$scenario->setlog('-----DECODE-----');


if(is_array($jsonData)){
//$scenario->setlog('-----IMPORT SUCCESS-----');

 
foreach ($jsonData as $value=>$jsonKey) 
{
log::add('coincoin', 'info', 'id_name : ' . $jsonKey['id']);
$this->checkAndUpdateCmd('id_name',$jsonKey['id']);

log::add('coincoin', 'info', 'symbol: ' . $jsonKey['symbol']);
$this->checkAndUpdateCmd('symbol',$jsonKey['symbol']);
  
log::add('coincoin', 'info', 'name : ' . $jsonKey['name']);
$this->checkAndUpdateCmd('n_name',$jsonKey['name']);

  
log::add('coincoin', 'info', 'current_price : ' . $jsonKey['current_price']);
$this->checkAndUpdateCmd('current_price',$jsonKey['current_price']);

log::add('coincoin', 'info', 'price_change : ' . $jsonKey['price_change_percentage_24h']);
$this->checkAndUpdateCmd('price_change',$jsonKey['price_change_percentage_24h']);

  
  log::add('coincoin', 'info', 'last_updated : ' . $jsonKey['last_updated']);
$this->checkAndUpdateCmd('last_updated',$jsonKey['last_updated']);
  
  log::add('coincoin', 'info', 'image : ' . "<img src=".$jsonKey['image'].">]");
$this->checkAndUpdateCmd('image',"<img width='64' height='64' src=".$jsonKey['image'].">");

    log::add('coincoin', 'info', 'total_volume : ' . $jsonKey['total_volume']);
$this->checkAndUpdateCmd('total_volume',$jsonKey['total_volume']);


      log::add('coincoin', 'info', 'high_24h : ' . $jsonKey['high_24h']);
$this->checkAndUpdateCmd('high_24',$jsonKey['high_24h']);
  
      log::add('coincoin', 'info', 'low_24h : ' . $jsonKey['low_24h']);
$this->checkAndUpdateCmd('low_24',$jsonKey['low_24h']);
  
        log::add('coincoin', 'info', 'currency : ' .$value_currency);
$this->checkAndUpdateCmd('currency',	$value_currency);
  
     
}
}} 
    }
     
   
  /* public function cron() {
      foreach (eqLogic::byType(__CLASS__, true) as $eqLogic) {  // pour tous les équipements actifs de la classe moodeaudio
        $eqLogic->coincoin_value_set('default');
    }
   
     }
*/
    /*
     * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
     public static function cron5() {
     }
     */

    
     # Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
     public static function cron10() {
        foreach (eqLogic::byType(__CLASS__, true) as $eqLogic)  {
   $eqLogic->coincoin_value_set('default');
     }}
     

    /*
     * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom
     public static function cron15() {
     }
     */


    //Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
     //public static function cron30() {
     // log::add('moodeaudio', 'info', ' ');
     // log::add('moodeaudio', 'info', ' --------CRON-----------');
     // log::add('moodeaudio', 'info', ' ');
    //foreach (eqLogic::byType(__CLASS__, true) as $eqLogic) {  // pour tous les équipements actifs de la classe moodeaudio
    //  $eqLogic->collect_agenda();
    //}
//}



   
    /* // Fonction exécutée automatiquement toutes les heures par Jeedom
     public static function cronHourly() {
  foreach (eqLogic::byType(__CLASS__, true) as $eqLogic) {  // pour tous les équipements actifs de la classe moodeaudio
  
    }
     }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
     public static function cronDaily() {
     }
     */

     

     /*     * *********************Méthodes d'instance************************* */
     public function randomcoincoin()
     {
        //test
     }
    // Fonction exécutée automatiquement avant la création de l'équipement 
     public function preInsert()
     {

     }

    // Fonction exécutée automatiquement après la création de l'équipement 
     public function postInsert()
     {

     }

    // Fonction exécutée automatiquement avant la mise à jour de l'équipement 
     public function preUpdate()
     {
     	if (empty($this->getConfiguration('value_param'))) {
     		throw new Exception(__('L\'URL du WEB SITE doit être renseigné', __FILE__));
     	} else {

            // throw new Exception(__('L\'URL est renseigné '.$this->getConfiguration('param1'),__FILE__));
     	}
     
       
       	if (empty($this->getConfiguration('value_currency'))) {
     		throw new Exception(__('La devise doit être renseigné', __FILE__));
     	} else {

            // throw new Exception(__('L\'URL est renseigné '.$this->getConfiguration('param1'),__FILE__));
     	}
     	
       
     }

    // Fonction exécutée automatiquement après la mise à jour de l'équipement 
     public function postUpdate()
     {

     }

    // Fonction exécutée automatiquement avant la sauvegarde (création ou mise à jour) de l'équipement 
     public function preSave()
     {

     }



    // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement 
     public function postSave()
     {

     	     
        $coincoin_set = $this->getCmd(null, 'coincoin_set');
        if (!is_object($coincoin_set)) {
            $coincoin_set = new coincoinCmd();
            $coincoin_set->setIsVisible(0);
            $coincoin_set->setOrder(1);
         $coincoin_set->setDisplay('icon', '<i class="fas fa-link"></i>');
            $coincoin_set->setName(__('Value ID', __FILE__));
        }
        $coincoin_set->setEqLogic_id($this->getId());
     	$coincoin_set->setLogicalId('coincoin_set');
        $coincoin_set->setType('action');
        $coincoin_set->setSubType('message');
        $coincoin_set->save();
       
       
       /* $refresh = $this->getCmd(null, 'refresh');
     	if (!is_object($refresh)) {
     		$refresh = new coincoinCmd();
		  $coincoin_set->setIsVisible(0);
     		$refresh->setOrder(1);
        //   $refresh_song->setDisplay('icon', '<i class="fas jeedomapp-reload"></i>');
     		$refresh->setName(__('Rafraichir', __FILE__));
     	}
     	$refresh->setEqLogic_id($this->getId());
     	$refresh->setLogicalId('refresh');
     	$refresh->setType('action');
     	$refresh->setSubType('other');
     	$refresh->save();
       */
       
       	$symbol = $this->getCmd(null, 'symbol');
     	if (!is_object($symbol)) {
     		$symbol = new coincoinCmd();
     		$symbol->setName(__('symbol', __FILE__));
     	}
     	$symbol->setLogicalId('symbol');
     	$symbol->setEqLogic_id($this->getId());
     	$symbol->setIsVisible(1);
     	$symbol->setType('info');
     	$symbol->setSubType('string');
     	$symbol->save();
     	
     
       $id_name = $this->getCmd(null, 'id_name');
     	if (!is_object($id_name)) {
     		$id_name = new coincoinCmd();
     		$id_name->setName(__('id_name', __FILE__));
     	}
     	$id_name->setLogicalId('id_name');
     	$id_name->setEqLogic_id($this->getId());
     	$id_name->setIsVisible(1);
     	$id_name->setType('info');
     	$id_name->setSubType('string');
     	$id_name->save();
       
         	$n_name = $this->getCmd(null, 'n_name');
     	if (!is_object($n_name)) {
     		$n_name = new coincoinCmd();
     		$n_name->setName(__('n_name', __FILE__));
     	}
     	$n_name->setLogicalId('n_name');
     	$n_name->setEqLogic_id($this->getId());
     	$n_name->setIsVisible(1);
     	$n_name->setType('info');
     	$n_name->setSubType('string');
     	$n_name->save();
     	
        	$current_price = $this->getCmd(null, 'current_price');
     	if (!is_object($current_price)) {
     		$current_price = new coincoinCmd();
     		$current_price->setName(__('current_price', __FILE__));
     	}
     	$current_price->setLogicalId('current_price');
     	$current_price->setEqLogic_id($this->getId());
     	$current_price->setIsVisible(1);
     	$current_price->setType('info');
     	$current_price->setSubType('string');
     	$current_price->save();
     	
       
         	$price_change = $this->getCmd(null, 'price_change');
     	if (!is_object($price_change)) {
     		$price_change = new coincoinCmd();
     		$price_change->setName(__('price_change', __FILE__));
     	}
     	$price_change->setLogicalId('price_change');
     	$price_change->setEqLogic_id($this->getId());
     	$price_change->setIsVisible(1);
     	$price_change->setType('info');
     	$price_change->setSubType('string');
     	$price_change->save();
       
       
         	$last_updated = $this->getCmd(null, 'last_updated');
     	if (!is_object($last_updated)) {
     		$last_updated = new coincoinCmd();
     		$last_updated->setName(__('last_updated', __FILE__));
     	}
     	$last_updated->setLogicalId('last_updated');
     	$last_updated->setEqLogic_id($this->getId());
     	$last_updated->setIsVisible(1);
     	$last_updated->setType('info');
     	$last_updated->setSubType('string');
     	$last_updated->save();
     	
       
         	$image = $this->getCmd(null, 'image');
     	if (!is_object($image)) {
     		$image = new coincoinCmd();
     		$image->setName(__('image', __FILE__));
     	}
     	$image->setLogicalId('image');
     	$image->setEqLogic_id($this->getId());
     	$image->setIsVisible(1);
     	$image->setType('info');
     	$image->setSubType('string');
     	$image->save();
     	
        	$total_volume = $this->getCmd(null, 'total_volume');
     	if (!is_object($total_volume)) {
     		$total_volume = new coincoinCmd();
     		$total_volume->setName(__('total_volume', __FILE__));
     	}
     	$total_volume->setLogicalId('total_volume');
     	$total_volume->setEqLogic_id($this->getId());
     	$total_volume->setIsVisible(1);
     	$total_volume->setType('info');
     	$total_volume->setSubType('string');
     	$total_volume->save();
     	
       
         	$high_24 = $this->getCmd(null, 'high_24');
     	if (!is_object($high_24)) {
     		$high_24 = new coincoinCmd();
     		$high_24->setName(__('high_24', __FILE__));
     	}
     	$high_24->setLogicalId('high_24');
     	$high_24->setEqLogic_id($this->getId());
     	$high_24->setIsVisible(1);
     	$high_24->setType('info');
     	$high_24->setSubType('string');
     	$high_24->save();
     	
  	$low_24 = $this->getCmd(null, 'low_24');
     	if (!is_object($low_24)) {
     		$low_24 = new coincoinCmd();
     		$low_24->setName(__('low_24', __FILE__));
     	}
     	$low_24->setLogicalId('low_24');
     	$low_24->setEqLogic_id($this->getId());
     	$low_24->setIsVisible(1);
     	$low_24->setType('info');
     	$low_24->setSubType('string');
     	$low_24->save();
     	
       
         	$currency = $this->getCmd(null, 'currency');
     	if (!is_object($currency)) {
     		$currency = new coincoinCmd();
     		$currency->setName(__('currency', __FILE__));
     	}
     	$currency->setLogicalId('currency');
     	$currency->setEqLogic_id($this->getId());
     	$currency->setIsVisible(1);
     	$currency->setType('info');
     	$currency->setSubType('string');
     	$currency->save();
     	
       
       
       
     }

    // Fonction exécutée automatiquement avant la suppression de l'équipement 
     public function preRemove()
     {

     }

    // Fonction exécutée automatiquement après la suppression de l'équipement 
     public function postRemove()
     {

     }

    /*
     * Non obligatoire : permet de modifier l'affichage du widget (également utilisable par les commandes)
     public function toHtml($_version = 'dashboard') {
    
     }
     */

    /*
     * Non obligatoire : permet de déclencher une action après modification de variable de configuration
     public static function postConfig_<Variable>() {
     }
     */

    /*
     * Non obligatoire : permet de déclencher une action avant modification de variable de configuration
     public static function preConfig_<Variable>() {
     }
     */

     /*     * **********************Getteur Setteur*************************** */

 }


 class coincoinCmd extends cmd
 {
 	/*     * *************************Attributs****************************** */

    /*
    public static $_widgetPossibility = array();
    */
    
    /*     * ***********************Methode static*************************** */
    
    
    /*     * *********************Methode d'instance************************* */
    
    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
     public function dontRemoveCmd() {
     return true;
     }
     */

    // Exécution d'une commande  

     

     public function execute($_options = array())
     {
        $eqlogic = $this->getEqLogic(); //récupère l'éqlogic de la commande $this
        switch ($this->getLogicalId()) {
        	case 'refresh': 
        	       	       	
        	break;
        	
        	           
            case 'coincoin_set':
             $message = rawurlencode($_options['message']);
             $message = str_replace("%3A", ":", $message);
       		 $message = str_replace("%2F", "/", $message);
     
            log::add('coincoin', 'info', 'URL Message : '.$message);
           	$eqlogic->coincoin_value_set($message);
        	break;
        	
        	
        }
    }
}