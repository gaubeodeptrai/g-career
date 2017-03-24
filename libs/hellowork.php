<?php
class Hellowork{


    //ハローワークデータ
    public static function data($_=array("all"=>"","w_updated"=>"","w_created"=>"","w_status"=>"")){
        
        $where = array();
        
        $now = date("Y-m-d H:i:s");
        $now = DB::quote($now);
        $where[] = "(hw_deleted >= {$now} or hw_deleted = '' )";

        if(!empty($_["w_status"])){
            $where[] = " hw_status = '1'";
        }

        if(!empty($_["w_created"])){
            $created = "%".dbLikeEsc($_["w_created"])."%";
            $where[] = " hw_created like '".$created."'";
        }
        
        if(!empty($_["w_updated"])){
            $updated = "%".dbLikeEsc($_["w_updated"])."%";
            $where[] = " hw_updated like '".$updated."'";
        }
        
        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        hw_code,hw_created,hw_updated,hw_title
        from recruits_CC_hellowork
        {$where}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            if(!empty($_["all"])){
                while($r = DB::fetch()){
                    $d[$r["hw_code"]] = $r;
                }
            } else {
                while($r = DB::fetch()){
                    $d[$r["hw_code"]] = $r["hw_code"];
                }
            }
            DB::fetchClose();
            
        }
        
        return $d;

    }


    //ハローワークデータ
    public static function data_kaigo($_=array("all"=>"","w_updated"=>"","w_created"=>"","w_status"=>"")){
        
        $where = array();
        
        $now = date("Y-m-d H:i:s");
        $now = DB::quote($now);
        $where[] = "(hw_deleted >= {$now} or hw_deleted = '' )";

        if(!empty($_["w_status"])){
            $where[] = " hw_status = '1'";
        }

        if(!empty($_["w_created"])){
            $created = "%".dbLikeEsc($_["w_created"])."%";
            $where[] = " hw_created like '".$created."'";
        }
        
        if(!empty($_["w_updated"])){
            $updated = "%".dbLikeEsc($_["w_updated"])."%";
            $where[] = " hw_updated like '".$updated."'";
        }
        
        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        hw_code,hw_created,hw_updated,hw_title
        from recruits_hellowork
        {$where}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            if(!empty($_["all"])){
                while($r = DB::fetch()){
                    $d[$r["hw_code"]] = $r;
                }
            } else {
                while($r = DB::fetch()){
                    $d[$r["hw_code"]] = $r["hw_code"];
                }
            }
            DB::fetchClose();
            
        }
        
        return $d;

    }

    //replace
    public static function replace($val=""){

        $val = str_replace("</th>","",$val);
        $val = str_replace("<td>","",$val);
        $val = str_replace('<td style="width:505px;">',"",$val);
        $val = str_replace("<div>","",$val);
        $val = str_replace("</div>","",$val);
        $val = str_replace('<div class="wordBreak">',"",$val);
        $val = str_replace("<br>","\n",$val);
        $val = str_replace("<br />","\n",$val);
        $val = str_replace("<br/>","\n",$val);

        $val = str_replace("&nbsp;","",$val);
        $val = str_replace("<span>","",$val);
        $val = str_replace("</span>","",$val);
        $val = str_replace("<p>","",$val);
        $val = str_replace("</p>","",$val);

        $val = str_replace('<div class="xab010-ml10">',"",$val);
        $val = str_replace('<div class="xab010-ml10 wordBreak">',"",$val);
        
        $val = str_replace(" ","",$val);
        $val = str_replace("ロ","口",$val);
        $val = trim($val);
        
        $val = substr($val, 0, strcspn($val,'</'));
        
        return $val;
        
    }
    
    
    //エラー
    public static function errorFnc($txt=""){

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        mb_detect_order("ASCII, JIS, UTF-8, EUC-JP, SJIS");

        $to = "moribe@kipply.jp";
        // $to = "moribe@kipply.jp,kipply@i.softbank.jp";
        $subject = "ハローワーク求人取得エラー";
        $from = '"moribe@kipply.jp"';
        $header  = "From: {$from}";
        if($r = mb_send_mail($to, $subject, $txt, $header)){
        }

    }

    //業種
    public static function jobIndustry($val=""){

        $li = array(
        "A"=>  "1",
        "B"=>  "2",
        "C"=>  "3",
        "D"=>  "4",
        "E"=>  "5",
        "F"=>  "6",
        "G"=>  "7",
        "H"=>  "8",
        "I"=>  "9",
        "J"=>  "10",
        "K"=>  "11",
        "L"=>  "12",
        "M"=>  "13",
        "N"=>  "14",
        "O"=>  "15",
        "P"=>  "16",
        "Q"=>  "17",
        "E"=>  "18",
        "S"=>  "19",
        "T"=>  "20",

        );
        
        if(!empty($val)){
            if(!empty($li[$val])){
                return $li[$val];
            } else {
                return $val;
            }
        } else {
            return $li;
        }
        
    }

    //雇用形態
    public static function jobtype($val=""){

        $li = array(
        "正社員"=>  "3",
        "正社員以外"=>  "6",
        "有期雇用派遣"=>  "1",
        "無期雇用派遣"=>  "1",
        );
        
        if(!empty($val)){
            if(!empty($li[$val])){
                return $li[$val];
            } else {
                return $val;
            }
        } else {
            return $li;
        }
        
    }
    
}