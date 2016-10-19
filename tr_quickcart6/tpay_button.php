

<form action="https://secure.transferuj.pl" method="post" id="transferujForm" name="transferujForm"> 
    <?php
    error_reporting(0);
    $btn_txt = iconv('windows-1250', 'UTF-8', 'Zap³aæ online z tpay.com');
    if (strtolower($aOrder[mPayment]) == 'tpay.com') {
        echo '<div id="transferuj_content"> <div id="kanaly_v"></div></div>
                              <div style="text-align:center; margin-top:10px;">
                       
          <image src="https://statice.transferstatic.com//img/platnosci-internetowe/transferuj-full-color-449x162.png"></br>
                    
                            <input type="submit" style="color: white;
                                            margin-top:20px;
                                            width: 225px;
                                            background: #2994E7;
                                            padding: 8px 14px 10px;
                                            box-shadow: 0px 1px 6px 2px #FBA01C;
                                            border-radius: 10px;"
                                            value="Zap³aæ online z tpay.com"></div>';
    }
    echo('<input type="hidden" name="id" value="' . $config['ids'] . '"/>');
    ?> 
    <input type="hidden" name="kwota" value=<?php echo $oOrder->aOrders[$iOrder]['sOrderSummary']; ?> /> 
    <?php
    $tekst = 'Zamówienie nr: ' . $aOrder[iOrder];
    $tekst = iconv('windows-1250', 'UTF-8', $tekst);
    echo('<input type="hidden" name="opis" value="' . $tekst . '" />');
    ?> 
    <input type="hidden" name="email" value=<?php echo $aOrder[sEmail]; ?> /> 
    <input type="hidden" name="nazwisko" value=<?php echo $aOrder[sLastName]; ?> /> 
    <input type="hidden" name="imie" value=<?php echo $aOrder[sFirstName]; ?> /> 
    <input type="hidden" name="adres" value=<?php echo $aOrder[sStreet]; ?> /> 
    <input type="hidden" name="miasto" value=<?php echo $aOrder[sCity]; ?> /> 
    <input type="hidden" name="kraj" value="Polska" /> 
    <input type="hidden" name="kod" value=<?php echo $aOrder[sZipCode]; ?> /> 
    <?php
    $crc = base64_encode($aOrder[iOrder]);
    echo '<input type="hidden" name="crc" value="' . $crc . '" />';
    ?> 
    <input type="hidden" name="telefon" value=<?php echo $aOrder[sPhone]; ?> /> 
    <input type="hidden" name="pow_tekst" value=<?php echo $config[tekstp]; ?> /> 
    <input type="hidden" name="pow_url" value=<?php echo $config[back_url]; ?> /> 
    <input type="hidden" name="wyn_url" value=<?php echo $config[notify_url]; ?> /> 
    <input type="hidden" name="pow_url_blad" value=<?php echo $config[error_url]; ?> />
    <input type="hidden" name="md5sum" value=<?php echo md5($config['ids'] . $oOrder->aOrders[$iOrder]['sOrderSummary'] . $crc . $config['kodp']); ?> />
</form>	