<?php
namespace tpay;

class TpayCheckout
{

    private $aOrder;
    private $iOrder;
    private $config;
    private $oOrder;

    public function __construct($aOrder, $iOrder, $oOrder, $list = 1)
    {
        require_once('lib/src/_class_tpay/exception.php');
        require_once('lib/src/_class_tpay/lang.php');
        require_once('lib/src/_class_tpay/paymentBasic.php');
        require_once('lib/src/_class_tpay/validate.php');
        require_once('lib/src/_class_tpay/util.php');
        require_once('tpay_config.php');
        Lang::setLang('pl');
        if (strtolower($aOrder['mPayment']) == 'tpay.com') {
            $this->config = \TpayConfig::getConfig();
            $this->iOrder = $iOrder;
            $this->aOrder = $aOrder;
            $this->oOrder = $oOrder;
            $form = '';
            switch ($list) {
                case 1:
                    $form = $this->getBankForm(false);
                    break;
                case 2:
                    $form = $this->getBankForm(true);
                    break;
                case 3:
                    $form = $this->getRedirectForm();
                    break;
                default:
                    break;
            }
            echo $form;
        }
    }

    public function getBankForm($list = false)
    {
        $tpay = new PaymentBasic(
            (int)$this->config['id'], $this->config['kod']
        );

        return $tpay->getBankSelectionForm($this->getTransactionConfig(), $list);
    }

    private function getTransactionConfig()
    {
        return array(
            'opis'         => 'Zamówienie nr: ' . $this->aOrder['iOrder'],
            'kwota'        => $this->oOrder->aOrders[$this->iOrder]['sOrderSummary'],
            'email'        => $this->aOrder['sEmail'],
            'nazwisko'     => $this->aOrder['sLastName'],
            'imie'         => $this->aOrder['sFirstName'],
            'adres'        => $this->aOrder['sStreet'],
            'miasto'       => $this->aOrder['sCity'],
            'kod'          => $this->aOrder['sZipCode'],
            'telefon'      => $this->aOrder['sPhone'],
            'pow_url'      => $this->config['back_url'],
            'wyn_url'      => $this->config['notify_url'],
            'pow_url_blad' => $this->config['error_url'],
            'crc'          => base64_encode($this->aOrder['iOrder']),
        );
    }

    public function getRedirectForm()
    {
        $tpay = new PaymentBasic(
            (int)$this->config['id'], $this->config['kod']
        );

        return $tpay->getTransactionForm($this->getTransactionConfig());
    }
}

?>
