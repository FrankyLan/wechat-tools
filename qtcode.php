<?php
function getQtcodeTicket($scene_id){
include_once(__DIR__.'/get_token.php');
include_once(__DIR__.'/http.class.php');
$access_token=New_Get_Token();
$data='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": '.$scene_id.'}}}';
$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
$http=new http();
$temp_res=$http->httpPost($url,$data);
$res=json_decode($temp_res,true);
return $res['ticket'];
}
 ?>
