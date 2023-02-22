<?php
//sleep(300);
z:

system('rm cookie.txt');
error_reporting(0);
function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
//$proxy = 'http://pujcvpjv:wzjxit7uyig0@144.168.217.88:8780';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);        
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_COOKIE,TRUE);
        curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt"); 
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }

function timer($t){
     $timr=time()+$t;
      while(true):
      echo "\r                                                    \r";
      $res=$timr-time();
      if($res < 1){break;}
if($res==$res){
//  $str= str_repeat("\033[1;92m◼",$res)."              \r";
}
      echo " \033[1;97mPlease Wait \033[1;91m".date('i:s',$res)." ";
      sleep(1);
      endwhile;
}


function get($url,$host){
  return curl($url,'',head($host))[1];
}

function post($url,$data,$host){
  return curl($url,$data,head($host))[1];
}

function head($host){
$ta = rand(111,999);
$user = "Mozilla/5.0 (Linux; Android 10; M2004J19C Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.5414.118 Mobile Safari/537.36";
//$cookie='ci_session=81nkte8079997214vgrruuqkj2tqo2fo;csrf_cookie_name=9672f099c1888398a80cf9321626681e';
  $h[]="Host: $host";
  $h[]="content-type: application/x-www-form-urlencoded";
  $h[]="user-agent: $user";
  return $h;
}

$mk = "tetitewe@gmail.com";

$host="trampocoins.biz";
$url="https://trampocoins.biz/";
$rev=get($url,$host);

$csf = explode('">' ,explode('<input type="hidden" name="csrf_token_name" id="token" value="', $rev)[1])[0];
$host="trampocoins.biz";
$login = "https://trampocoins.biz/auth/login";
$data = "wallet=".$mk."&csrf_token_name=$csf";
$icc = post($login,$data,$host);
$ic = explode("'," ,explode("html: '", $icc)[1])[0];
if($ic == "Login Success"){
echo" \033[1;97m$ic \n";
}else{
goto z;
}

k:
$d = 1;

a:
if($d == "50"){
sleep(20);
goto k;
}
$host="trampocoins.biz";
$url="https://trampocoins.biz/faucet/currency/fey";
$rev=get($url,$host);
$tem = explode(',' ,explode('let timer =', $rev)[1])[0];
$toki = explode('">' ,explode('<input type="hidden" name="auto_faucet_token" value="', $rev)[1])[0];
$csf = explode('">' ,explode('<input type="hidden" name="csrf_token_name" id="token" value="', $rev)[1])[0];
$tok = explode('">' ,explode('<input type="hidden" name="token" value="', $rev)[1])[0];
$dag = explode('</div>' ,explode('<div class="alert alert-danger text-center">', $rev)[1])[0];
if($dag == "Daily claim limit for this coin reached, please comeback again tomorrow."){
exit;
}
$left = explode('<' ,explode('<p class="lh-1 mb-1 font-weight-bold">', $rev)[3])[0];
sleep(1);
//timer($tem);



$host="trampocoins.biz";
$login = "https://trampocoins.biz/faucet/verify/fey";
$data = "auto_faucet_token=$toki&csrf_token_name=$csf&token=$tok";
$cc = post($login,$data,$host);
$suc = explode("'," ,explode("html: '", $cc)[1])[0];


echo" \033[1;33m[$left] \033[1;92m$suc \n";


if($suc == "You have been rate-limited. Please try again in a few seconds."){
sleep(37);
}
if($left == "1/1440"){
sleep(3600);
exit;
}


$d = $d + 1;
goto a;