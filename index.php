<?php 
// Get IP Client
$ip = get_client_ip().PHP_EOL;
// Create or open file
$tempFile = fopen("visit.txt", "ab") or fopen("visit.txt", "w"); 
// Write ip to file
fwrite($tempFile, $ip) or die('fwrite failed');
// Get Request Count
$lines = file('visit.txt');
$arr_count = array_count_values($lines);
echo $arr_count[$ip].'x request dari '.$ip.' ke '.$_SERVER['SERVER_ADDR'];

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>