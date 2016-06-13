<?PHP
define("ROOT", $_SERVER['DOCUMENT_ROOT']);
include("get_info.php");
include("get_token.php");
$data=Get_Super_Token($_GET['code']);
$access_token=Get_Normal_Token();
$info=Get_Info($data['openid'],$access_token);
//以上为获取用户基本信息过程
//入口网址
?>
