<?php

class Pager{

    public static $num    = ""; //ページング数
    public static $start  = ""; //ページング開始
    public static $end    = ""; //ページング終了

    public static $num_sp    = ""; //ページング数
    public static $start_sp  = ""; //ページング開始
    public static $end_sp    = ""; //ページング終了
    
    function dataList($_= array("total"=>"","limit"=>"","page"=>"")){

        $_["num"] = floor($_["total"] / $_["limit"]) + 1;
        
        if(
        !($_["total"] % $_["limit"])
        ){
            $_["num"]--; //割り切れちゃうときは減算
        }

        $_["start"] = ($_["page"] - 6);
        if(
        $_["start"] < 0
        ){
            $_["start"] = 1;
        } elseif(
        $_["start"] < 6
        ){
            $_["start"] = $_["start"]+2;
        }

        $_["end"] = $_["start"]+8;

        if(
        $_["end"] > $_["num"]
        ){ 

           $_["end"] = $_["num"];
        }

        if($_["page"] > (9-1)){
            if(
            ($_["end"] - $_["start"]) <> (9-1)
            ){
                $_["start"] = $_["end"] - (9-1);
            }
        } else if($_["page"] == (9-1) && $_["num"] < (9+1)) {
                $_["start"] = 1;
        }
        
        Pager::$num = $_["num"];
        Pager::$start = $_["start"];
        Pager::$end = $_["end"];

    }

    function dataListSp($_= array("total"=>"","limit"=>"","page"=>"")){

        $_["num"] = floor($_["total"] / $_["limit"]) + 1;
        
        if(
        !($_["total"] % $_["limit"])
        ){
            $_["num"]--; //割り切れちゃうときは減算
        }

        $_["start"] = ($_["page"] - 2);
        if(
        $_["start"] < 0
        ){
            $_["start"] = 1;
        } elseif(
        $_["start"] < 3
        ){
            $_["start"] = $_["start"]+1;
        }

        $_["end"] = $_["start"]+4;

        if(
        $_["end"] > $_["num"]
        ){ 

           $_["end"] = $_["num"];
        }

        if($_["page"] > (5-1)){
            if(
            ($_["end"] - $_["start"]) <> (5-1)
            ){
                $_["start"] = $_["end"] - (5-1);
            }
        } else if($_["page"] == (5-1) && $_["num"] < (5+1)) {
                $_["start"] = 1;
        }
        
        Pager::$num_sp = $_["num"];
        Pager::$start_sp = $_["start"];
        Pager::$end_sp = $_["end"];

    }
    
    function dataHtml($_= array("total"=>"","limit"=>"","page"=>"","num"=>"","start"=>"","end"=>"","prev"=>"","next"=>"","url"=>"","pms"=>"")){
        $htm = array();

        $_["prev"] = $_["page"]-1;//前のページ番号
        $_["next"] = $_["page"]+1;//次のページ番号
        
        if ($_["total"] > $_["limit"]){
        
             $htm[] = '<div class="pager">';
             $htm[] = '<ul class="clearfix">';
             
             if ($_["page"] > 1){
                 $htm[] = "<li class='prev'>";
                 if(!empty($_["url"])){
                     $htm[] = "<a href='".$_["url"]."page-".$_["prev"]."/'>";
                 }
                 if(!empty($_["pms"])){
                     if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                         $d = "?";
                     } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                         $d = "&";
                     } else {
                         $d = "?";
                     }
                     $htm[] = "<a href='".$_["pms"].$d."page=".$_["prev"]."'>";
                 }
                 $htm[] = "前へ</a></li>";
             }


    		for($i=$_["start"];$i<=$_["end"];$i++){
                 
                 if($i == $_["page"]){
                     $htm[] = '<li class="on"><span>';
                 } else {
                     $htm[] = '<li>';
                     $htm[] = '<a ';

                     if(!empty($_["url"])){
                         $htm[] = 'href="'.$_["url"];
                         $htm[] = "page-".$i;
                         $htm[] = '/">';
                     }
                     if(!empty($_["pms"])){

                         if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                             $d = "?";
                         } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                             $d = "&";
                         } else {
                             $d = "?";
                         }
                         $htm[] = 'href="'.$_["pms"];
                         $htm[] = $d."page=".$i;
                         $htm[] = '">';
                     }
                     
                 }
                 $htm[] = $i;
                 
                 if($i == $_["page"]){
                     $htm[] = '</span>';
                 } else {
                     $htm[] = '</a>';
                 }
                 
                 $htm[] = '</li>';
             }

             if ($_["page"] < $_["num"]){

                 $htm[] = "<li class='next'>";

                 if(!empty($_["url"])){
                     $htm[] = "<a href='".$_["url"]."page-".$_["next"]."/'>";
                 }
                 if(!empty($_["pms"])){
                         if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                         $d = "?";
                     } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                         $d = "&";
                     } else {
                         $d = "?";
                     }
                     $htm[] = "<a href='".$_["pms"].$d."page=".$_["next"]."'>";
                 }
                 $htm[] = "次へ</a></li>";
             }
         
             $htm[] = '</ul>';
             $htm[] = '</div>';
         
         }

         $htm = implode("", $htm);
         return $htm;
    }

    function dataHtmlSp($_= array("total"=>"","limit"=>"","page"=>"","num"=>"","start"=>"","end"=>"","prev"=>"","next"=>"","url"=>"","pms"=>"")){
        $htm = array();

        $_["prev"] = $_["page"]-1;//前のページ番号
        $_["next"] = $_["page"]+1;//次のページ番号
        
        if ($_["total"] > $_["limit"]){
        
             $htm[] = '<div class="pager">';
             $htm[] = '<ul class="clearfix">';
             
             if ($_["page"] > 1){
                 $htm[] = "<li class='prev'>";
                 if(!empty($_["url"])){
                     $htm[] = "<a href='".$_["url"]."page-".$_["prev"]."/'>";
                 }
                 if(!empty($_["pms"])){
                     if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                         $d = "?";
                     } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                         $d = "&";
                     } else {
                         $d = "?";
                     }
                     $htm[] = "<a href='".$_["pms"].$d."page=".$_["prev"]."'>";
                 }
                 $htm[] = "前へ</a></li>";
             }


    		for($i=$_["start"];$i<=$_["end"];$i++){
                 
                 if($i == $_["page"]){
                     $htm[] = '<li class="on"><span>';
                 } else {
                     $htm[] = '<li>';
                     $htm[] = '<a ';

                     if(!empty($_["url"])){
                         $htm[] = 'href="'.$_["url"];
                         $htm[] = "page-".$i;
                         $htm[] = '/">';
                     }
                     if(!empty($_["pms"])){

                         if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                             $d = "?";
                         } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                             $d = "&";
                         } else {
                             $d = "?";
                         }
                         $htm[] = 'href="'.$_["pms"];
                         $htm[] = $d."page=".$i;
                         $htm[] = '">';
                     }
                     
                 }
                 $htm[] = $i;
                 
                 if($i == $_["page"]){
                     $htm[] = '</span>';
                 } else {
                     $htm[] = '</a>';
                 }
                 
                 $htm[] = '</li>';
             }

             if ($_["page"] < $_["num"]){

                 $htm[] = "<li class='next'>";

                 if(!empty($_["url"])){
                     $htm[] = "<a href='".$_["url"]."page-".$_["next"]."/'>";
                 }
                 if(!empty($_["pms"])){
                         if(preg_match("/^(.*?)\?page/u", $_SERVER["REQUEST_URI"])){
                         $d = "?";
                     } else if(preg_match("/^(.*?)\?/u", $_SERVER["REQUEST_URI"])){
                         $d = "&";
                     } else {
                         $d = "?";
                     }
                     $htm[] = "<a href='".$_["pms"].$d."page=".$_["next"]."'>";
                 }
                 $htm[] = "次へ</a></li>";
             }
         
             $htm[] = '</ul>';
             $htm[] = '</div>';
         
         }

         $htm = implode("", $htm);
         return $htm;
    }
    
}
