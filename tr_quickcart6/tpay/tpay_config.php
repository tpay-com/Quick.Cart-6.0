<?php
/**
 * Created by tpay.com.
 * Date: 02.05.2017
 * Time: 12:47
 */

class TpayConfig
{

    public static function getConfig()
    {
        //id sprzedawcy
        $config['id'] = "1010";
        //kod potwierdzajacy
        $config['kod'] = "demo";
        //adres powrotny po wykonaniu transakcji z wynikiem blednym
        $config['error_url'] = "http://domena.pl/error";
        // adres strony z podziekowaniami.
        $config['back_url'] = "http://domena.pl/success";
        //uzupelnij swoja domene w celu lokalizacji pliku trvalidation.php
        $config['notify_url'] = "http://domena.pl/trvalidation.php";

        return $config;
    }
}
