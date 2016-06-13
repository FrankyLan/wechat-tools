<?php
class http{
function httpGet($url) {
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_TIMEOUT, 500);
  curl_setopt($curl, CURLOPT_URL, $url);

  $res = curl_exec($curl);
  curl_close($curl);

  return $res;
}
 function httpPost($url,$data){
  $ch =curl_init ();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//规避ssl证书检查
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  if (curl_errno($ch))
  {
   return curl_error($ch);
  }
$res = curl_exec($ch);
curl_close($ch);
return $res;
}
}
?>
