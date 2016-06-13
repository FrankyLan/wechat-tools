<?php
function getdata($userid,$info,$type){
    $url="";

    $data='{
           "touser":"'.$userid.'",
           "template_id":"Kgt3Na-wCDPJ8ojBm7ybJ1tVlwn_MvmFeDDV-wC2kLI",
           "url":"'.$url.'",
           "topcolor":"#FF0000",
           "data":{
                   "first": {
                       "value":"您的申请已通过审核",
                       "color":"#000"
                   },
                   "keynote1":{
                       "value":"'.$info.'",
                       "color":"#000"
                   },
                   "keynote2": {
                       "value":"'.date('Y-m-d',time()).'",
                       "color":"#000"
                   },
                   "remark":{

                   }
           }
       }';
    return $data;
}
include("send_mp.php");
include("get_token.php");
$access_token=Get_Normal_Token();
$data=getdata($_GET['userid'],$_GET['info'],$_GET['type']);
echo Send_Mp($access_token,$data);
?>
