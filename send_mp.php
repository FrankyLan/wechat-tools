<?php
function Send_Mp($access_token,$data){
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$access_token);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 $tmpInfo = curl_exec($ch);
 if (curl_errno($ch)) 
 {
  return curl_error($ch);
 }
 curl_close($ch);
 return $tmpInfo;
}
?>