<style rel="stylesheet" type="text/css" >
    .checked_v {
        box-shadow: 0px 0px 10px 3px #15428F;

    }
    .channel {
        display: inline-block; 
        width: 140px; 
        height:70px; 
        cursor:pointer;
        text-align:center;
    }
    #kanaly div.selected {
        border: 2px solid #1E63A9;
        border-radius: 4px 4px 4px 4px;
        margin: 3px 3px -1px -1px;
    }

    #kanaly div {
        background-position: left top;
        background-repeat: no-repeat;
        border: 1px solid #DADADA;
        cursor: pointer;
        float: left;
        height: 88px;
        margin-right: 4px;
        margin-top: 4px;
        padding: 5px;
        position: relative;
        width: 127px;
        z-index: 4;
    }

    #kanaly div p.label {
        border: 0 none;
        bottom: 0;
        color: #345565;
        cursor: pointer;
        font-size: 0.625em;
        font-weight: bold;
        left: 0;
        margin: 0;
        padding: 0 0 3px;
        position: absolute;
        right: 0;
        text-align: center;

    }
    #transferuj_content {
        border-radius: 4px;
        border-style: groove;
        border-width: 1px;
        border-color: blue;
        margin: 10px 0 25px 0;
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript">
    function ShowChannelsCombo()
    {
        var str = '<div  style="text-align: center; font-family:Arial;font-size:17px;font-style:normal;font-weight:bold; color:#0000AB; margin:20px 0 25px 0"  id="kanal"><label>Wybierz bank:</label></div>';

        for (var i = 0; i < tr_channels.length; i++) {
            str += '<div   class="channel"  "><img id="' + tr_channels[i][0] + '" class="check" style="height: 80%" src="' + tr_channels[i][3] + '"></div>';
        }

        var container = jQuery("#kanaly_v");
        container.append(str);

        jQuery(document).ready(function () {
            jQuery(".check").click(function () {
                jQuery(".check").removeClass("checked_v");
                jQuery(this).addClass("checked_v");
                jQuery("html,body").animate({scrollTop: 1200}, 600);
                var kanal = 0;
                kanal = jQuery(this).attr("id");
                jQuery('#channel').val(kanal);

            });

            jQuery("form[name=transferujForm]").submit(function (e) {

                if (jQuery('#channel').attr("value") == " ") {

                    alert("Wybierz bank");
                    return false;

                }
                else {
                    return true;
                }
            });
        });


    }

    jQuery.getScript("https://secure.transferuj.pl/channels-<?php echo $config['ids']; ?>0.js", function () {
        ShowChannelsCombo()
    });
</script>

<form action="https://secure.tpay.com" method="post" id="transferujForm" name="transferujForm"> 
    <?php
    error_reporting(0);
    $btn_txt = iconv('windows-1250', 'UTF-8', 'Zap³aæ z tpay.com');
    if (strtolower($aOrder[mPayment]) == 'tpay.com') {
        echo '<div id="transferuj_content"> <div id="kanaly_v"></div></div>
                              <div style="text-align:center">
                       
            <label for="akceptuje_regulamin">
                    <input id="akceptuje_regulamin" type="checkbox" checked="checked" value="1" name="akceptuje_regulamin">
                Akceptuje <a target="_blank" href="https://secure.transferuj.pl/regulamin.pdf"><b>regulamin</b></a> serwisu tpay.com</label>
                             <br>
                            <input type="submit" style="color: white;
                                            margin-top:20px;
                                            width: 225px;
                                            background: #2994E7;
                                            padding: 8px 14px 10px;
                                            box-shadow: 0px 1px 6px 2px #FBA01C;
                                            border-radius: 10px;"
                                            value="Zaplac z tpay.com"></div>';
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
    <input type="hidden" id="channel"  name="kanal" value=" ">
</form>	