<?php
class AdminApply{

    // 利用する値
    function values(){
        return array(
        "csv_id"   => array(),
        "csv_type" => "normal",
        );
    }

    function adjustValues($_){
        foreach(AdminApply::values() as $k => $v){
            if(
            !isset($_[$k])
            ){
                $_[$k] = $v;
            } else{
                $_[$k] = filter($_[$k]);
                if(
                is_array($v) and
                count($v)
                ){
                    foreach($v as $kk => $vv){
                        $_[$k][$kk] = isset($_[$k][$kk])?$_[$k][$kk]:$vv;
                    }
                }
            }
        }

        if(
        !is_array($_["csv_id"])
        ){
            $tmp = trim($_["csv_id"]);
            $tmp = explode(",", $_["csv_id"]);
            $tmp = array_filter($tmp);
            $tmp = array_unique($tmp);
            $_["csv_id"] = array();
            foreach($tmp as $v){
                $_["csv_id"][$v] = $v;
            }
        }
        return $_;
    }


    // 求人のカラム
    function columnLi(){

        $sql = "select column_name, column_comment from  information_schema.columns where table_schema='g-career00001' and table_name = 'entry'";
        $li = array();
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $li[] = array("column" => $r["column_name"], "value" => $r["column_comment"]);
            }
        }
        return $li;
    }

}
