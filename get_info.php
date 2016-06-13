<?php   
function Get_Info($openid,$access_token)
{
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$jsoninfo = json_decode($output, true);
return $jsoninfo;        
}
?>