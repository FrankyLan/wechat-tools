<?php
function New_Get_Token(){
  define("ROOT", $_SERVER['DOCUMENT_ROOT']);
  $appid ="";
$appsecret = "";
  $data = json_decode(file_get_contents("access_token.json"));
  if ($data->expire_time < time()) {
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $res = json_decode($output);
   $access_token = $res->access_token;
    if ($access_token) {
      $data->expire_time = time() + 7000;
      $data->access_token = $access_token;
      $fp = fopen("access_token.json", "w");
      fwrite($fp, json_encode($data));
      fclose($fp);
    }
  } else {
    $access_token = $data->access_token;
  }
  return $access_token;
}

/*
非中控accesstoken获取方法
*/
    function Get_Normal_Token(){
      $appid ="wx29f6f7e25c1f71da";
$appsecret = "a9ef9475dc2b793c548efae1bead5e40";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output, true);
$access_token =$jsoninfo["access_token"];
return $access_token;
    }
    function Get_Super_Token($code){
      $appid ="wx29f6f7e25c1f71da";
$appsecret = "a9ef9475dc2b793c548efae1bead5e40";
    $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code";
    $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output, true);
$data =array("access_token"=>$jsoninfo["access_token"],"openid"=>$jsoninfo["openid"]);
return $data;
    }

?>
