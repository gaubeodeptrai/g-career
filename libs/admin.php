<?php

if($_SESSION["kaigoi"]["admin"]["login"]["logon"]!=1){
    
    header("Location: /admin/");
    exit;
}

    //求人パラメータセッション削除
    if(!preg_match ("/^\/admin\/recruit_hn\/+/u", $_SERVER["REQUEST_URI"]) and !preg_match ("/^\/admin\/pop\/+/u", $_SERVER["REQUEST_URI"])){   
        unset($_SESSION["admin/recruit_hn_pms"]);
    }
    if(!preg_match ("/^\/admin\/recruit\/+/u", $_SERVER["REQUEST_URI"]) and !preg_match ("/^\/admin\/pop\/+/u", $_SERVER["REQUEST_URI"])){   
        unset($_SESSION["admin/recruit_pms"]);
    }
    if(!preg_match ("/^\/admin\/recruit_cc\/+/u", $_SERVER["REQUEST_URI"]) and !preg_match ("/^\/admin\/pop\/+/u", $_SERVER["REQUEST_URI"])){   
        unset($_SESSION["admin/recruit_cc_pms"]);
        unset($_SESSION["admin/recruit_cc_pv_pms"]);
        unset($_SESSION["admin/recruit_cc_hw_pms"]);
    }
    if(!preg_match ("/^\/admin\/company\/+/u", $_SERVER["REQUEST_URI"]) and !preg_match ("/^\/admin\/pop\/+/u", $_SERVER["REQUEST_URI"])){   
        unset($_SESSION["admin/company_pms"]);
    }
    if(!preg_match ("/^\/admin\/center\/+/u", $_SERVER["REQUEST_URI"]) and !preg_match ("/^\/admin\/pop\/+/u", $_SERVER["REQUEST_URI"])){   
        unset($_SESSION["admin/center_pms"]);
    }
    
    if(!empty($_SESSION["kaigoi"]["admin"]["login"]["level"]) and
    $_SESSION["kaigoi"]["admin"]["login"]["level"]==2){

        $error == 0;
        
        
        //管理者
        if(preg_match ("/^\/admin\/manage\/entry.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["manage"][2]) and
            empty($_REQUEST["view"])
            ){
                 $error = 1;
            }
        
        } elseif(preg_match ("/^\/admin\/manage\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["manage"])){
                 $error = 1;
            }
        
        }


        //求人情報（介護iランド）
        if(preg_match ("/^\/admin\/recruit\/entry.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/recruit\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][2])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][1])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/recruit\/csv.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][4])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][1])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/recruit\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"])){
                 $error = 1;
            }
            
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][1])
            ){
                 $error = 1;
            }
            
        }



        //求人情報（セルジョブ）
        if(preg_match ("/^\/admin\/recruit_hn\/entry.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/recruit_hn\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][2])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][2])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/recruit_hn\/csv.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][4])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][2])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/recruit_hn\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"])){
                 $error = 1;
            }
            
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][2])
            ){
                 $error = 1;
            }
            
        }


        //求人情報（CCナビ）
        if(preg_match ("/^\/admin\/recruit_cc\/entry.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/recruit_cc\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][2])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][3])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/recruit_cc\/csv.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][4])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][3])
            ){
                 $error = 1;
            }

        } elseif(preg_match ("/^\/admin\/recruit_cc\/pv.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][5])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][3])
            ){
                 $error = 1;
            }

        } elseif(preg_match ("/^\/admin\/recruit_cc\/hellowork.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"][6])
            ){
                 $error = 1;
            }

            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][3])
            ){
                 $error = 1;
            }
                                    
        } elseif(preg_match ("/^\/admin\/recruit_cc\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit"])){
                 $error = 1;
            }
            
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["domain"][3])
            ){
                 $error = 1;
            }
            
        }
        

        //企業・センター管理
        if(
        preg_match ("/^\/admin\/company\/entry.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/center\/entry.htm.+$/u", $_SERVER["REQUEST_URI"])
        ){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["company"][2]) and
            empty($_REQUEST["view"])
            ){
                 $error = 1;
            }

        } elseif(
        preg_match ("/^\/admin\/company\/delete.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/center\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])
        ){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["company"][2])
            ){
                 $error = 1;
            }
            

        } elseif(
        preg_match ("/^\/admin\/company\/csv.htm.+$/u", $_SERVER["REQUEST_URI"]) or
        preg_match ("/^\/admin\/center\/csv.htm.+$/u", $_SERVER["REQUEST_URI"])
        ){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["company"][4])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/company\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["company"])){
                 $error = 1;
            }
        
        }
        
        //応募情報
        if(preg_match ("/^\/admin\/apply\/entry.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["apply"][2]) and
            empty($_REQUEST["view"])
            ){
                 $error = 1;
            }

        } elseif(preg_match ("/^\/admin\/apply\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["apply"][2])
            ){
                 $error = 1;
            }
            
        } elseif(preg_match ("/^\/admin\/apply\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["apply"])){
                 $error = 1;
            }
        
        }


        //登録会
        if(preg_match ("/^\/admin\/entry_apply\/entry.htm.+$/u", $_SERVER["REQUEST_URI"])){
        
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["entry"][3]) and
            empty($_REQUEST["view"])
            ){
                 $error = 1;
            }

        } elseif(preg_match ("/^\/admin\/entry_apply\/delete.htm.+$/u", $_SERVER["REQUEST_URI"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["apply"][3])
            ){
                 $error = 1;
            }

        } elseif(preg_match ("/^\/admin\/entry_apply\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["entry"][2]) and
            empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["entry"][3])){
                 $error = 1;
            }
                        
        } elseif(preg_match ("/^\/admin\/entry\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["entry"])){
                 $error = 1;
            }
        
        }
        

        //画像登録
        if(preg_match ("/^\/admin\/recruit_pic\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["recruit_pic"])){
                 $error = 1;
            }
        }

        //マスタ
        if(preg_match ("/^\/admin\/master\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["master"])){
                 $error = 1;
            }
        }
        
        //サイト
        if(preg_match ("/^\/admin\/site\/.+$/u", $_SERVER["SCRIPT_NAME"])){
            
            if(empty($_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]["site"])){
                 $error = 1;
            }
        }

        if($error == 1){
            header("Location: /admin/top.html");
            exit;
        }
    }
    
    $_SESSION["kaigoi"]["admin"]["login"]["authority_flg"]
    
?>
