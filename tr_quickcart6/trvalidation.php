<?php
/**
 * Created by tpay.com.
 * Date: 02.05.2017
 * Time: 12:40
 */
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
require_once DIR_PLUGINS.'tpay/tpay_validation.php';
require_once DIR_PLUGINS.'tpay/tpay_config.php';
$tpayConfig = TpayConfig::getConfig();
new TpayValidation($tpayConfig);
