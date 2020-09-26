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
echo $arr_count[$ip].'x request dari '.$ip.' ke '.get_ip_public();

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

function get_ip_public(){
    // persiapkan curl
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://api.ipify.org?format=json");

    // return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // tutup curl
    curl_close($ch);

    // menampilkan hasil curl

    $output = json_decode($output);
    $ip = $output->ip;
    return $ip;
}

?>