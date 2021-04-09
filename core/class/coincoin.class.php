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
     */
    #public static $_widgetPossibility = array();


    /*     * ***********************Methode static*************************** */


     // Fonction exécutée automatiquement toutes les minutes par Jeedom


  public static $_widgetPossibility = array('custom' => true); // c'est cette ligne qu'il faut ajouter






  public function coincoin_value_set($message)
  {

      log::add('coincoin', 'info', ' ');
      log::add('coincoin', 'info', ' --------INIT CoinCoin -----------');
      log::add('coincoin', 'info', ' ');

     	#$URL_param = $this->getConfiguration('URL_param');

      log::add('coincoin', 'info', '-----SET UP URL----------');


      $source_param=$this->getConfiguration('source_param');

      log::add('coincoin', 'info', 'Source : ' .$source_param);
      if ($source_param=="coingecko"){
       log::add('coincoin', 'info', '-----SET CoinGecko Web Socket----------');

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



       log::add('coincoin', 'info', 'URL_simple : ' . $message);


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
     				#$this->checkAndUpdateCmd('n_name',"<p style='font-size:25px'><strong>".$jsonKey['name']."</strong></p>");
             $this->checkAndUpdateCmd('n_name',$jsonKey['name']);

             log::add('coincoin', 'info', 'current_price : ' . $jsonKey['current_price']);
             $this->checkAndUpdateCmd('current_price',$jsonKey['current_price']);

             log::add('coincoin', 'info', 'price_change : ' . $jsonKey['price_change_percentage_24h']);
             $this->checkAndUpdateCmd('price_change',round($jsonKey['price_change_percentage_24h'],2));


             log::add('coincoin', 'info', 'last_updated : ' . $jsonKey['last_updated']);
             $this->checkAndUpdateCmd('last_updated',$jsonKey['last_updated']);

             log::add('coincoin', 'info', 'image : ' . $jsonKey['image']);
     				#$this->checkAndUpdateCmd('image',"<img width='64' height='64' src=".$jsonKey['image'].">");
             $this->checkAndUpdateCmd('image',$jsonKey['image']);

             log::add('coincoin', 'info', 'total_volume : ' . $jsonKey['total_volume']);
             $this->checkAndUpdateCmd('total_volume',$jsonKey['total_volume']);


             log::add('coincoin', 'info', 'high_24h : ' . $jsonKey['high_24h']);
             $this->checkAndUpdateCmd('high_24',$jsonKey['high_24h']);

             log::add('coincoin', 'info', 'low_24h : ' . $jsonKey['low_24h']);
             $this->checkAndUpdateCmd('low_24',$jsonKey['low_24h']);

             log::add('coincoin', 'info', 'currency : ' .$value_currency);
             $this->checkAndUpdateCmd('currency',$value_currency);

             log::add('coincoin', 'info', 'market_cap : ' .$jsonKey['market_cap']);
             $this->checkAndUpdateCmd('market_cap',$jsonKey['market_cap']);


             log::add('coincoin', 'info', 'market_cap_rank : ' .$jsonKey['market_cap_rank']);
             $this->checkAndUpdateCmd('market_cap_rank',$jsonKey['market_cap_rank']);

             log::add('coincoin', 'info', 'price_change_24h : ' .$jsonKey['price_change_24h']);
             $this->checkAndUpdateCmd('price_change_24h',$jsonKey['price_change_24h']);

             log::add('coincoin', 'info', 'ath : '.$jsonKey['ath']);
             $this->checkAndUpdateCmd('ath',$jsonKey['ath']);

             log::add('coincoin', 'info', 'atl : '.$jsonKey['atl']);
             $this->checkAndUpdateCmd('atl',$jsonKey['atl']);


         }
     }
 } 
}


if ($source_param=="binance"){
   log::add('coincoin', 'info', '-----SET Binance Web Socket----------');

   $value_param=$this->getConfiguration('value_param_short');
   log::add('coincoin', 'info', 'Value param : '.$value_param);

   $value_currency=$this->getConfiguration('value_currency');
   $value_currency=strtoupper($value_currency);
   log::add('coincoin', 'info', 'Value_currency : '.$value_currency);

   $api = "https://api.binance.com/api/v3/ticker/24hr";
   if (empty($value_param)){
       $cmd = "symbol=".$message.$value_currency."T";
   }
   else{
       $cmd = "symbol=".$value_param.$value_currency."T";
   }
   $api=$api."?".$cmd;

   log::add('coincoin', 'info', 'Api : ' . $api);
   log::add('coincoin', 'info', '-----EXECUTION ADD COMMAND ----------');



   log::add('coincoin', 'info', 'URL_simple : ' . $message);


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


          log::add('coincoin', 'info', 'id_name : ' . $jsonData['id']);
          $this->checkAndUpdateCmd('id_name',$jsonData['id']);

          log::add('coincoin', 'info', 'symbol: ' . $jsonData['symbol']);
          $this->checkAndUpdateCmd('symbol',$jsonData['symbol']);

          log::add('coincoin', 'info', 'name : ' . $jsonData['symbol']);
     				#$this->checkAndUpdateCmd('n_name',"<p style='font-size:25px'><strong>".$jsonKey['name']."</strong></p>");
          $this->checkAndUpdateCmd('n_name',$jsonData['symbol']);

          log::add('coincoin', 'info', 'current_price : ' . $jsonData['lastPrice']);
          $this->checkAndUpdateCmd('current_price',$jsonData['lastPrice']);


          
          log::add('coincoin', 'info', 'price_change : ' . $jsonData['priceChangePercent']);
          $this->checkAndUpdateCmd('price_change',round($jsonData['priceChangePercent'],2));

          log::add('coincoin', 'info', 'last_updated : ' . $jsonData['count']);
          $this->checkAndUpdateCmd('last_updated',$jsonData['count']);

          log::add('coincoin', 'info', 'image : ' . $jsonData['image']);
     				#$this->checkAndUpdateCmd('image',"<img width='64' height='64' src=".$jsonKey['image'].">");
          $this->checkAndUpdateCmd('image',$jsonData['image']);

          log::add('coincoin', 'info', 'total_volume : ' . $jsonData['volume']);
          $this->checkAndUpdateCmd('total_volume',$jsonData['volume']);


          log::add('coincoin', 'info', 'high_24h : ' . $jsonData['highPrice']);
          $this->checkAndUpdateCmd('high_24',$jsonData['highPrice']);

          log::add('coincoin', 'info', 'low_24h : ' . $jsonData['lowPrice']);
          $this->checkAndUpdateCmd('low_24',$jsonData['lowPrice']);

          log::add('coincoin', 'info', 'currency : ' .$value_currency);
          $this->checkAndUpdateCmd('currency',$value_currency);

          log::add('coincoin', 'info', 'market_cap : ' .$jsonData['market_cap']);
          $this->checkAndUpdateCmd('market_cap',$jsonData['market_cap']);


          log::add('coincoin', 'info', 'market_cap_rank : ' .$jsonData['market_cap_rank']);
          $this->checkAndUpdateCmd('market_cap_rank',$jsonData['market_cap_rank']);

          log::add('coincoin', 'info', 'price_change_24h : ' .$jsonData['priceChange']);
          $this->checkAndUpdateCmd('price_change_24h',$jsonData['priceChange']);

          log::add('coincoin', 'info', 'ath : '.$jsonData['ath']);
          $this->checkAndUpdateCmd('ath',$jsonData['ath']);

          log::add('coincoin', 'info', 'atl : '.$jsonData['atl']);
          $this->checkAndUpdateCmd('atl',$jsonData['atl']);

          
          
          
          foreach ($jsonData as $value=>$jsonKey) 
          {
          }
      }
  } 
  log::add('coincoin', 'info', '-----EXECUTION CoinGecko Pour collecter Image ----------');
  $value_param=strtolower($value_param);

  $api = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd";
  log::add('coincoin', 'info', 'URL_complet_coingecko : ' . $api);

  $json = file_get_contents($api);

  if($json === FALSE) { } else {
//Step 2: Decodage du JSON et recuperation des infos souhaitees
   $jsonData = json_decode($json,true);
//$scenario->setlog('-----DECODE-----');


   if(is_array($jsonData)){
//$scenario->setlog('-----IMPORT SUCCESS-----');


    foreach ($jsonData as $value=>$jsonKey) 
    {




     if    ($jsonKey['symbol']==$value_param) 
     {

      log::add('coincoin', 'info', 'Seek for: '.$value_param);

      
      log::add('coincoin', 'info', 'JSON Symbol: '.$jsonKey['symbol']);

               #Force l'affichage de la crypto
      log::add('coincoin', 'info', 'Found image : ' . $jsonKey['image']);
      $this->checkAndUpdateCmd('image',$jsonKey['image']);

               #Force le nom de la crypto
      log::add('coincoin', 'info', 'name : ' . $jsonKey['name']);
      $this->checkAndUpdateCmd('n_name',$jsonKey['name']);


  }

}
}
}


}

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
     	if (empty($this->getConfiguration('value_param')) and (empty($this->getConfiguration('value_param_short')))) {
     		throw new Exception(__('Le symbol doit être renseigné', __FILE__));
     	} else {

            // throw new Exception(__('L\'URL est renseigné '.$this->getConfiguration('param1'),__FILE__));
     	}
     	
     	
     	if (empty($this->getConfiguration('value_currency'))) {
     		throw new Exception(__('La devise doit être renseigné', __FILE__));
     	} else {

            // throw new Exception(__('L\'URL est renseigné '.$this->getConfiguration('param1'),__FILE__));
     	}
     	
     	
       if (empty($this->getConfiguration('source_param'))) {
           throw new Exception(__('Le site web doit être renseigné', __FILE__));
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
     
     $refresh = $this->getCmd(null, 'refresh');
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
     
     
     $symbol = $this->getCmd(null, 'symbol');
     if (!is_object($symbol)) {
         $symbol = new coincoinCmd();
         $symbol->setName(__('symbol', __FILE__));
     }
     $symbol->setLogicalId('symbol');
     $symbol->setEqLogic_id($this->getId());
     $symbol->setIsVisible(0);
     $symbol->setOrder(2);
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
     $id_name->setOrder(3);
     $id_name->setIsVisible(0);
     $id_name->setType('info');
     $id_name->setSubType('string');
     $id_name->save();
     
     
     $image = $this->getCmd(null, 'image');
     if (!is_object($image)) {
         $image = new coincoinCmd();
         $image->setName(__('image', __FILE__));
     }
     $image->setLogicalId('image');
     $image->setEqLogic_id($this->getId());
     $image->setIsVisible(1);
     $image->setOrder(4);
     $image->setType('info');
       $image->setDisplay("showNameOndashboard",0);// Sauvegarder et regarder le rendu.
       $image->setSubType('string');
       $image->save();
       
       $n_name = $this->getCmd(null, 'n_name');
       if (!is_object($n_name)) {
       	$n_name = new coincoinCmd();
       	$n_name->setName(__('n_name', __FILE__));
       }
       $n_name->setLogicalId('n_name');
       $n_name->setEqLogic_id($this->getId());
       $n_name->setIsVisible(1);
       $n_name->setOrder(5);
            $n_name->setDisplay("showNameOndashboard",0);// Sauvegarder et regarder le rendu.
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
            $current_price->setIsHistorized(1);
            $current_price->setOrder(6);
                 $current_price->setDisplay("showNameOndashboard",0);// Sauvegarder et regarder le rendu.
                 $current_price->setType('info');
                 $current_price->setSubType('numeric');
                 $current_price->save();
                 
                 
                 $currency = $this->getCmd(null, 'currency');
                 if (!is_object($currency)) {
                 	$currency = new coincoinCmd();
                 	$currency->setName(__('currency', __FILE__));
                 }
                 $currency->setLogicalId('currency');
                 $currency->setEqLogic_id($this->getId());
                 $currency->setIsVisible(0);
                 $currency->setOrder(7);
                 $currency->setType('info');
                 $currency->setSubType('string');
                 $currency->save();
                 
                 
                 
                 
                 
                 $price_change = $this->getCmd(null, 'price_change');
                 if (!is_object($price_change)) {
                 	$price_change = new coincoinCmd();
                 	$price_change->setName(__('price_change', __FILE__));
                 }
                 $price_change->setLogicalId('price_change');
                 $price_change->setEqLogic_id($this->getId());
                 $price_change->setIsVisible(1);
                 $price_change->setOrder(8);
                 $price_change->setType('info');
                 $price_change->setSubType('numeric');
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
                 $last_updated->setOrder(9);
                 $last_updated->setSubType('string');
                 $last_updated->save();
                 
                 
                 
                 
                 $total_volume = $this->getCmd(null, 'total_volume');
                 if (!is_object($total_volume)) {
                 	$total_volume = new coincoinCmd();
                 	$total_volume->setName(__('total_volume', __FILE__));
                 }
                 $total_volume->setLogicalId('total_volume');
                 $total_volume->setEqLogic_id($this->getId());
                 $total_volume->setIsVisible(1);
                 $total_volume->setOrder(10);
                 $total_volume->setType('info');
                 $total_volume->setSubType('numeric');
                 $total_volume->save();
                 
                 
                 $high_24 = $this->getCmd(null, 'high_24');
                 if (!is_object($high_24)) {
                 	$high_24 = new coincoinCmd();
                 	$high_24->setName(__('high_24', __FILE__));
                 }
                 $high_24->setLogicalId('high_24');
                 $high_24->setEqLogic_id($this->getId());
                 $high_24->setIsVisible(1);
                 $high_24->setOrder(11);
                 $high_24->setType('info');
                 $high_24->setSubType('numeric');
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
                 $low_24->setOrder(12);
                 $low_24->setSubType('numeric');
                 $low_24->save();
                 
                 $market_cap = $this->getCmd(null, 'market_cap'); 
                 if (!is_object($market_cap)) { 
                 	$market_cap = new coincoinCmd(); 
                 	$market_cap->setName(__('market_cap', __FILE__)); 
                 } 
                 $market_cap->setLogicalId('market_cap'); 
                 $market_cap->setEqLogic_id($this->getId()); 
                 $market_cap->setIsVisible(1); 
                 $market_cap->setType('info'); 
                 $market_cap->setOrder(13); 
                 $market_cap->setSubType('numeric'); 
                 $market_cap->save(); 
                 
                 
                 $market_cap_rank = $this->getCmd(null, 'market_cap_rank'); 
                 if (!is_object($market_cap_rank)) { 
                 	$market_cap_rank = new coincoinCmd(); 
                 	$market_cap_rank->setName(__('market_cap_rank', __FILE__)); 
                 } 
                 $market_cap_rank->setLogicalId('market_cap_rank'); 
                 $market_cap_rank->setEqLogic_id($this->getId()); 
                 $market_cap_rank->setIsVisible(1); 
                 $market_cap_rank->setType('info'); 
                 $market_cap_rank->setOrder(14); 
                 $market_cap_rank->setSubType('numeric'); 
                 $market_cap_rank->save(); 
                 
                 $price_change_24h = $this->getCmd(null, 'price_change_24h'); 
                 if (!is_object($price_change_24h)) { 
                 	$price_change_24h = new coincoinCmd(); 
                 	$price_change_24h->setName(__('price_change_24h', __FILE__)); 
                 } 
                 $price_change_24h->setLogicalId('price_change_24h'); 
                 $price_change_24h->setEqLogic_id($this->getId()); 
                 $price_change_24h->setIsVisible(1); 
                 $price_change_24h->setType('info'); 
                 $price_change_24h->setOrder(15); 
                 $price_change_24h->setSubType('numeric'); 
                 $price_change_24h->save(); 

                 $ath = $this->getCmd(null, 'ath'); 
                 if (!is_object($ath)) { 
                 	$ath = new coincoinCmd(); 
                 	$ath->setName(__('ath', __FILE__)); 
                 } 
                 $ath->setLogicalId('ath'); 
                 $ath->setEqLogic_id($this->getId()); 
                 $ath->setIsVisible(1); 
                 $ath->setType('info'); 
                 $ath->setOrder(16); 
                 $ath->setSubType('numeric'); 
                 $ath->save(); 
                 
                 
                 $atl = $this->getCmd(null, 'atl'); 
                 if (!is_object($atl)) { 
                 	$atl = new coincoinCmd(); 
                 	$atl->setName(__('atl', __FILE__)); 
                 } 
                 $atl->setLogicalId('atl'); 
                 $atl->setEqLogic_id($this->getId()); 
                 $atl->setIsVisible(1); 
                 $atl->setType('info'); 
                 $atl->setOrder(17); 
                 $atl->setSubType('numeric'); 
                 $atl->save(); 
                 
                 
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
    */

    public function toHtml($_version = 'dashboard') {
		  $replace = $this->preToHtml($_version); //récupère les informations de notre équipement
		  if (!is_array($replace)) {
         return $replace;
     }
		  $this->emptyCacheWidget(); //vide le cache. Pratique pour le développement
		  $version = jeedom::versionAlias($_version);
		  

          # $replace['#n_name#'] = ($this->getName() != '') ? $this-> getName() : "Default name";
       $n_nameCmd = $this->getCmd('info', 'n_name');
       $replace['#n_name#'] = (is_object($n_nameCmd)) ? $n_nameCmd->execCmd() : "";


       $currencyCmd = $this->getCmd('info', 'currency');
       $replace['#currency#'] = (is_object($currencyCmd)) ? $currencyCmd->execCmd() : "";

       $current_priceCmd = $this->getCmd('info','current_price');
       $replace['#current_price#'] = (is_object($current_priceCmd)) ? $current_priceCmd->execCmd() : "";

    #            $current_priceID = $this->getObject_id();
	# $replace['#current_price_id#'] = (is_object($current_priceID)) ? $current_priceID->execCmd() : "";
       $replace['#current_price_id#'] = $this->getCmd('info','current_price')->getId();

       $imageCmd = $this->getCmd('info','image');
       $replace['#image#'] = (is_object($imageCmd)) ? $imageCmd->execCmd() : "";


       $high_24Cmd = $this->getCmd('info','high_24');
       $replace['#high_24#'] = (is_object($high_24Cmd)) ? $high_24Cmd->execCmd() : "";

       $low_24Cmd = $this->getCmd('info','low_24');
       $replace['#low_24#'] = (is_object($low_24Cmd)) ? $low_24Cmd->execCmd() : "";


       $price_changeCmd = $this->getCmd('info','price_change_24h');
       $replace['#price_change_24h#'] = (is_object($price_changeCmd)) ? $price_changeCmd->execCmd() : "";

       $price_changeCmd = $this->getCmd('info','price_change');
       $replace['#price_change#'] = (is_object($price_changeCmd)) ? $price_changeCmd->execCmd() : "";


       $last_updatedCmd = $this->getCmd('info','last_updated');
       $replace['#last_updated#'] = (is_object($last_updatedCmd)) ? $last_updatedCmd->execCmd() : "";


       $total_volumeCmd = $this->getCmd('info','total_volume');
       $replace['#total_volume#'] = (is_object($total_volumeCmd)) ? $total_volumeCmd->execCmd() : "";

       return $this->postToHtml($_version, template_replace($replace, getTemplate('core', $version, 'eqlogic', 'coincoin')));//  retourne notre template qui se nomme eqlogic pour le widget	  
   }
   


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
        	$eqlogic->coincoin_value_set($message);   	       	
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