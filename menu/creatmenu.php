<?php
class Menu{
    function GetToken()
    {
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
          $fp = fopen(ROOT."/service/access_token.json", "w");
          fwrite($fp, json_encode($data));
          fclose($fp);
        }
      } else {
        $access_token = $data->access_token;
      }
      return $access_token;
    }
function createMenu($data,$access_token)
{
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token);
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
    function getMenu($access_token){
    $MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$access_token;
		$cu = curl_init();
		curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($cu, CURLOPT_URL, $MENU_URL);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
		$menu_json = curl_exec($cu);
		$info = curl_getinfo($cu);
		$menu = json_decode($menu_json);
		curl_close($cu);
		return $menu;
    }
}
?>
