<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Lana
 * Date: 16.02.14
 * Time: 16:04
 * To change this template use File | Settings | File Templates.
 */
function get_bitly_access_token($bitlyLogin, $bitlyPass)
{
    /*$bitlyLogin = 'alexpirog';
    $bitlyPass = 'veryfast19';  */
   
    $bitlyAuth = 'Basic ' . base64_encode($bitlyLogin.':'.$bitlyPass);
    $url = 'https://api-ssl.bitly.com/oauth/access_token';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: '.$bitlyAuth,
        'Content-Type: application/x-www-form-urlencoded',
        'Content-Length: 0'.$_SERVER['CONTENT_LENGTH']
        ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $access_token = curl_exec($ch);
    curl_close($ch);

    return $access_token;
}
if(isset($_REQUEST['check_bitly'])&& $_REQUEST['check_bitly']!=''){
    if (get_bitly_access_token($_REQUEST['login'] , $_REQUEST['pass']) != 'INVALID_LOGIN'){
        echo get_bitly_access_token($_REQUEST['login'] , $_REQUEST['pass']);
    } else {echo 'INVALID_LOGIN';}

}
if(isset($_REQUEST['logout_bitly'])&& $_REQUEST['logout_bitly']!=''){
    var_dump($_REQUEST);
}

