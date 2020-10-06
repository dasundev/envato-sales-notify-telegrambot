<?php

/***************************************
 * Created by PhpStorm.
 * Author: Dasun Tharanga ( @dasundev )
 * Email: hello@dasun.dev
 * Date: 10/6/2020
 * Time: 11:29 PM
 ***************************************/

//API KEYS
$telegramApiKey = "XXXXXXXXXXXXXXXXXXXXXXX"; //TELEGRAM API KEY
$envatoApiKey = "XXXXXXXXXXXXXXXXXXXXXXX"; //ENVATO API KEY
$chatID = "xxxxxxx"; //TELEGRAM CHAT ID

//HEADERS
$opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>"Authorization: Bearer ".$envatoApiKey
    )
);

//SET HEADERS
$envatocontext = stream_context_create($opts);

//FETCH AUTHOR SALES ENVATO API USING THE HTTP HEADERS SET ABOVE
$envatoRes = file_get_contents('https://api.envato.com/v3/market/author/sales/', false, $envatocontext);

//GET NEW SALE DATA
$new_sale = json_decode($envatoRes, true)[0];

//NEW SALE COUNT
$new_sales_count = $new_sale['item']['number_of_sales'];

//READ CURRENT SALES COUNT
$readFile = fopen("sales_count.txt", "r") or die("Unable to open file!");
$current_sales_count =  fread($readFile,filesize("sales_count.txt"));
fclose($readFile);


//CHECK NEW SALE
if($new_sales_count > $current_sales_count) {

    callTelegramBot($new_sale, $new_sales_count, $telegramApiKey);

}


/**
 * @param $new_sale
 * @param $new_sales_count
 * @param $telegramApiKey
 * @param $chatID
 * @throws Exception
 */
function callTelegramBot($new_sale, $new_sales_count, $telegramApiKey, $chatID) {
    //WRITE NEW SALES COUNT
    $writeFile = fopen("sales_count.txt", "w") or die("Unable to open file!");
    fwrite($writeFile, $new_sales_count);
    fclose($writeFile);

    //CREATE A $utc OBJECT WITH THE UTC TIMEZONE
    $IST = new DateTime($new_sale['sold_at'], new DateTimeZone('UTC'));

    //CHANGE THE TIMEZONE OF THE OBJECT WITHOUT CHANGING IT'S TIME
    $IST->setTimezone(new DateTimeZone('Asia/Colombo'));
 
    //TELEGRAM DATA
    $data = [
        'chat_id' => $chatID,
        'text' => "<b>NEW SALE ALERT!</b> \n\nAMOUNT: ".$new_sale['amount']."USD \nLICENSE: ".$new_sale['license']."\nSOLD TIME: ".$IST->format('Y-m-d h:m:s A')." \nSUPPORT AMOUNT: ".$new_sale['support_amount']."USD"
    ];
    
    //FETCH TELEGRAM API FOR SEND THE MESSAGE
    $response = file_get_contents("https://api.telegram.org/bot$telegramApiKey/sendMessage?parse_mode=HTML&" . http_build_query($data) );
}

?>