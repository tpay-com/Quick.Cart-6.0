<?php

/**
 * Created by tpay.com.
 * Date: 02.05.2017
 * Time: 12:47
 */
class TpayValidation
{
    protected $tpayConfig;

    public function __construct($tpayConfig)
    {

        require_once('lib/src/_class_tpay/exception.php');
        require_once('lib/src/_class_tpay/lang.php');
        require_once('lib/src/_class_tpay/paymentBasic.php');
        require_once('lib/src/_class_tpay/validate.php');
        require_once('lib/src/_class_tpay/util.php');

        $this->tpayConfig = $tpayConfig;
        $this->checkPayment();

    }

    public function checkPayment()
    {
        $tpay = new tpay\PaymentBasic(
            (int)$this->tpayConfig['id'], $this->tpayConfig['kod']
        );
        $res = $tpay->checkPayment();
        $oOrder = new OrdersAdmin ();
        $oOrder->generateCache();
        $order_id = base64_decode($_POST['tr_crc']);
        if ($res['tr_status'] == 'TRUE' && $res['tr_error'] == 'none') {
            $aData = $oOrder->throwOrder($order_id);
            $aData['iStatus'] = 2;
            $aData['sComment'] = (isset($res['test_mode']) && $res['test_mode'] == 1)? 'Transakcja w trybie testowym!' : '';
            $oOrder->saveOrder($aData);
        }
    }

}

?>
