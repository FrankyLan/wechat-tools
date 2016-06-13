<?php
function uploadMedia($url){
        $file = realpath('1.mp3'); //要上传的文件
        $fields['media'] = '@'.$file;
        $ch = curl_init($url) ;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch) ;
        if (curl_errno($ch)) {
         return curl_error($ch);
        }
        curl_close($ch);
        return $result;
      }
function saveMedia($url){
  define("ROOT", $_SERVER['DOCUMENT_ROOT']);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);

        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time().rand(100,999).".{$fileExt}";
        $dirname = ROOT."/temppic/";
        if(!file_exists($dirname)){
            mkdir($dirname,0777,true);
        }
        file_put_contents($dirname.$filename,$media['mediaBody']);
        return $filename;
    }
    ?>
