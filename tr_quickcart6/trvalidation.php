<?php

/* Zapytania z tpay.com*/

require 'database/config/general.php';
require DB_CONFIG_LANG;
require 'database/_fields.php';
require_once DIR_LANG.LANGUAGE.'.php';
require_once DIR_LIBRARIES.'file-jobs.php';
require_once DIR_LIBRARIES.'flat-files.php';
require_once DIR_LIBRARIES.'image-jobs.php';
require_once DIR_LIBRARIES.'trash.php';
require_once DIR_PLUGINS.'plugins.php';
require_once DIR_CORE.'common.php';
require_once DIR_CORE.'common-admin.php';
require_once DIR_CORE.'pages.php';
require_once DIR_CORE.'pages-admin.php';
require_once DIR_CORE.'lang-admin.php';
require_once DIR_CORE.'files.php';
require_once DIR_CORE.'files-admin.php';
require_once DIR_CORE.'products.php';
require_once DIR_CORE.'products-admin.php';
require_once DIR_CORE.'orders.php';
require_once DIR_CORE.'orders-admin.php';

echo "TRUE";
$oOrder=new OrdersAdmin ();
$oOrder->generateCache();

$ip_table=array(
		'195.149.229.109',
		'148.251.96.163',
		'178.32.201.77',
		'46.248.167.59',
		'46.29.19.106'
		);
if(!empty($_POST) && in_array($_SERVER['REMOTE_ADDR'], $ip_table)) {
	$order_id=base64_decode($_POST['tr_crc']);	
	$opis='Zamowienie nr: '.$order_id;
	$sid=$config['ids'];
	$tr_id=$_POST['tr_id'];
	$blad = $_POST['tr_error'];
	$status_transakcji = $_POST['tr_status'];
	$tr_amount=$_POST['tr_amount'];
	$tr_crc=$_POST['tr_crc'];
        $tr_md = $_POST['md5sum'];
	$kod = $config['kodp'];
       
	$sumamd5=md5($sid.$tr_id.$tr_amount.$tr_crc.$kod); 
         
      
        if(strcmp($tr_md, $sumamd5) == 0){
	if ($status_transakcji=='TRUE' && $blad=='none'  ){
              $aData = $oOrder->throwOrder($order_id);
              $aData['iStatus']=2;
              $oOrder->saveOrder($aData);
            }
       }
}
?>