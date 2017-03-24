<?php
class AdminRecruit{

    // 利用する値
    function values(){
        return array(
        "csv_id"   => array(),
        "csv_type" => "normal",
        );
    }

    function adjustValues($_){
        foreach(AdminRecruit::values() as $k => $v){
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

        $sql = "select column_name, column_comment from  information_schema.columns where table_schema='g-career00001' and table_name = 'recruits'";
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

    // 求人(支店用)カラム
    function branchColumnLi($_){
        $li = array();
        
        // 並び順(提供のCSVに、0からの数値を振って取得したもの)
        foreach(explode(",", "
0,2,141,7,8,9,10,18,19,26,28,23,24,31,61,62,63,64,72,73,74,75,118,120,84,85,87,88,90,91,93,94,108,109,110,111,112,114,115,116,117,121,122,123,119,83,76,78,21,22,37,43,49,55,124,125,127,129,131,133,135,137,139,4,5,142,143,144,6,3,145,146,147
") as $k){
            $k = trim($k);
            $li[] = $_[$k];
        }
        return $li;
    }

    // 求人のカラム(セルジョブ)
    function columnLi_HN(){

        $sql = "select column_name, column_comment from  information_schema.columns where table_schema='g-career00001' and table_name = 'recruits_HN'";
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

    function columnLi_CC(){

        $sql = "select column_name, column_comment from  information_schema.columns where table_schema='g-career00001' and table_name = 'recruits_CC'";
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

    // コンバート用求人のカラム
    function convertColumnLi(){

        $li = array();
        $li[] = array("pre_id","求人ID"); //"求人ID";
        $li[] = array("pre_effect","有効性"); //"有効性";
        $li[] = array("status","状態"); //"状態";
        $li[] = array("pre_name","求人名"); //"求人名";
        $li[] = array("title","タイトル"); //"タイトル";
        $li[] = array("catchcopy","求人一覧用タイトル"); //"求人一覧用タイトル";
        $li[] = array("company","企業名"); //"企業名";
        $li[] = array("company_flg","企業公開フラグ"); //"企業公開フラグ";
        $li[] = array("cate_codes","業種・職種1");  //"業種・職種1";
        $li[] = array("pre_cate","業種・職種2");  //"業種・職種2";
        $li[] = array("jobtype_codes","雇用形態");  //"雇用形態";
        $li[] = array("pref_code","勤務地（都道府県）"); //"勤務地（都道府県）";
        $li[] = array("city_code","勤務地（市区町村）"); //"勤務地（市区町村）";
        $li[] = array("ap_shoptype","店舗形態（アパレルWORK専用項目）"); //"店舗形態（アパレルWORK専用項目）";
        $li[] = array("st1_code","最寄り駅1"); //"最寄り駅1";
        $li[] = array("st2_code","最寄り駅2"); //"最寄り駅2";
        $li[] = array("st3_code","最寄り駅3"); //"最寄り駅3";
        $li[] = array("st4_code","最寄り駅4"); //"最寄り駅4";
        $li[] = array("st5_code","最寄り駅5"); //"最寄り駅5";
        $li[] = array("jobway","アクセス"); //"アクセス";
        $li[] = array("pre_salarygp","給与グループ"); //"給与グループ";
        $li[] = array("salarytime_low","給与"); //"給与";
        $li[] = array("salary","給与（フリー入力）"); //"給与（フリー入力）";
        $li[] = array("ap_salary_flg","給与表示フラグ（アパレルWORK専用項目）"); //"給与表示フラグ（アパレルWORK専用項目）";
        $li[] = array("pre_free","フリーコメント"); //"フリーコメント";
        $li[] = array("contents","仕事内容"); //"仕事内容";
        $li[] = array("jobtime","勤務日・勤務時間"); //"勤務日・勤務時間";
        $li[] = array("holiday","休日・休暇"); //"休日・休暇";
        $li[] = array("welfare","待遇"); //"待遇";
        $li[] = array("skill","応募資格"); //"応募資格";
        $li[] = array("other","その他（職場情報等）"); //"その他（職場情報等）";
        $li[] = array("ap_brand","ブランド（アパレルWORK専用項目）"); //"ブランド（アパレルWORK専用項目）";
        $li[] = array("ap_brand_flg","ブランド公開フラグ（アパレルWORK専用項目）"); //"ブランド公開フラグ（アパレルWORK専用項目）";
        $li[] = array("flow","選考の流れ"); //"選考の流れ";
        $li[] = array("exp_flg","実務経験"); //"実務経験";
        $li[] = array("sort","表示優先度"); //"表示優先度";
        $li[] = array("siteid","サテライトリスト"); //"サテライトリスト";
        $li[] = array("feature_codes","こだわり条件"); //"こだわり条件";
        $li[] = array("pic1_code","画像（一覧・詳細1）"); //"画像（一覧・詳細1）";
        $li[] = array("pic2_code","画像（詳細2）"); //"画像（詳細2）";
        $li[] = array("pic3_code","画像（担当者）"); //"画像（担当者）";
        $li[] = array("section1","登録管理者親部署"); //"登録管理者親部署";
        $li[] = array("section2","登録管理者部署"); //"登録管理者部署";
        $li[] = array("pre_editor_first","登録管理者");//"登録管理者";
        $li[] = array("pre_editor_last","最終更新管理者"); //"最終更新管理者";
        $li[] = array("no1","登録日時"); //"登録日時";
        $li[] = array("no2","最終更新日時"); //"最終更新日時";
        $li[] = array("pre_comment","備考"); //"備考";
        
        return $li;
    }


    // コンバート用求人のカラム（介護用）
    function convertColumnLi_KG(){

        $li = array();
        $li[] = array("pre_id","求人ID"); //"求人ID";
        $li[] = array("pre_effect","有効性"); //"有効性";
        $li[] = array("status","状態"); //"状態";
        $li[] = array("pre_name","求人名"); //"求人名";
        $li[] = array("title","タイトル"); //"タイトル";
        $li[] = array("catchcopy","求人一覧用タイトル"); //"求人一覧用タイトル";
        $li[] = array("company","企業名"); //"企業名";
        $li[] = array("company_flg","企業公開フラグ"); //"企業公開フラグ";
        $li[] = array("pre_cate","業種・職種1");  //"業種・職種1";
        $li[] = array("cate_codes","業種・職種2");  //"業種・職種2";
        $li[] = array("jobtype_codes","雇用形態");  //"雇用形態";
        $li[] = array("pref_code","勤務地（都道府県）"); //"勤務地（都道府県）";
        $li[] = array("city_code","勤務地（市区町村）"); //"勤務地（市区町村）";
        $li[] = array("ap_shoptype","店舗形態（アパレルWORK専用項目）"); //"店舗形態（アパレルWORK専用項目）";
        $li[] = array("st1_code","最寄り駅1"); //"最寄り駅1";
        $li[] = array("st2_code","最寄り駅2"); //"最寄り駅2";
        $li[] = array("st3_code","最寄り駅3"); //"最寄り駅3";
        $li[] = array("st4_code","最寄り駅4"); //"最寄り駅4";
        $li[] = array("st5_code","最寄り駅5"); //"最寄り駅5";
        $li[] = array("jobway","アクセス"); //"アクセス";
        $li[] = array("pre_salarygp","給与グループ"); //"給与グループ";
        $li[] = array("salarytime_low","給与"); //"給与";
        $li[] = array("salary","給与（フリー入力）"); //"給与（フリー入力）";
        $li[] = array("ap_salary_flg","給与表示フラグ（アパレルWORK専用項目）"); //"給与表示フラグ（アパレルWORK専用項目）";
        $li[] = array("pre_free","フリーコメント"); //"フリーコメント";
        $li[] = array("contents","仕事内容"); //"仕事内容";
        $li[] = array("jobtime","勤務日・勤務時間"); //"勤務日・勤務時間";
        $li[] = array("holiday","休日・休暇"); //"休日・休暇";
        $li[] = array("welfare","待遇"); //"待遇";
        $li[] = array("skill","応募資格"); //"応募資格";
        $li[] = array("other","その他（職場情報等）"); //"その他（職場情報等）";
        $li[] = array("ap_brand","ブランド（アパレルWORK専用項目）"); //"ブランド（アパレルWORK専用項目）";
        $li[] = array("ap_brand_flg","ブランド公開フラグ（アパレルWORK専用項目）"); //"ブランド公開フラグ（アパレルWORK専用項目）";
        $li[] = array("flow","選考の流れ"); //"選考の流れ";
        $li[] = array("exp_flg","実務経験"); //"実務経験";
        $li[] = array("sort","表示優先度"); //"表示優先度";
        $li[] = array("siteid","サテライトリスト"); //"サテライトリスト";
        $li[] = array("feature_codes","こだわり条件"); //"こだわり条件";
        $li[] = array("pic1_code","画像（一覧・詳細1）"); //"画像（一覧・詳細1）";
        $li[] = array("pic2_code","画像（詳細2）"); //"画像（詳細2）";
        $li[] = array("pic3_code","画像（担当者）"); //"画像（担当者）";
        $li[] = array("section1","登録管理者親部署"); //"登録管理者親部署";
        $li[] = array("section2","登録管理者部署"); //"登録管理者部署";
        $li[] = array("pre_editor_first","登録管理者");//"登録管理者";
        $li[] = array("pre_editor_last","最終更新管理者"); //"最終更新管理者";
        $li[] = array("created","登録日時"); //"登録日時";
        $li[] = array("updated","最終更新日時"); //"最終更新日時";
        $li[] = array("pre_comment","備考"); //"備考";
        
        return $li;
    }
    
    // コンバート用求人のカラム(CCナビ用)
    function convertColumnLi_CC(){

        $li = array();
        $li[] = array("pre_id","求人ID"); //"求人ID";
        $li[] = array("pre_effect","有効性"); //"有効性";
        $li[] = array("status","状態"); //"状態";
        $li[] = array("text","求人名"); //"求人名";
        $li[] = array("title","タイトル"); //"タイトル";
        $li[] = array("catchcopy","求人一覧用タイトル"); //"求人一覧用タイトル";
        //$li[] = array("company","企業名"); //"企業名";
        $li[] = array("company_code","企業名"); //"企業名";
        $li[] = array("company_flg","企業公開フラグ"); //"企業公開フラグ";
        $li[] = array("pre_cate","業種・職種1");  //"業種・職種1";
        $li[] = array("cate_codes","業種・職種2");  //"業種・職種2";
        $li[] = array("jobtype_codes","雇用形態");  //"雇用形態";
        $li[] = array("pref_code","勤務地（都道府県）"); //"勤務地（都道府県）";
        $li[] = array("city_code","勤務地（市区町村）"); //"勤務地（市区町村）";
        $li[] = array("ap_shoptype","店舗形態（アパレルWORK専用項目）"); //"店舗形態（アパレルWORK専用項目）";
        $li[] = array("st1_code","最寄り駅1"); //"最寄り駅1";
        $li[] = array("st2_code","最寄り駅2"); //"最寄り駅2";
        $li[] = array("st3_code","最寄り駅3"); //"最寄り駅3";
        $li[] = array("st4_code","最寄り駅4"); //"最寄り駅4";
        $li[] = array("st5_code","最寄り駅5"); //"最寄り駅5";
        $li[] = array("jobway","アクセス"); //"アクセス";
        $li[] = array("pre_salarygp","給与グループ"); //"給与グループ";
        $li[] = array("salarytime_low","給与"); //"給与";
        $li[] = array("salary","給与（フリー入力）"); //"給与（フリー入力）";
        $li[] = array("ap_salary_flg","給与表示フラグ（アパレルWORK専用項目）"); //"給与表示フラグ（アパレルWORK専用項目）";
        $li[] = array("pre_free","フリーコメント"); //"フリーコメント";
        $li[] = array("contents","仕事内容"); //"仕事内容";
        $li[] = array("jobtime","勤務日・勤務時間"); //"勤務日・勤務時間";
        $li[] = array("holiday","休日・休暇"); //"休日・休暇";
        $li[] = array("welfare","待遇"); //"待遇";
        $li[] = array("skill","応募資格"); //"応募資格";
        $li[] = array("other","その他（職場情報等）"); //"その他（職場情報等）";
        $li[] = array("ap_brand","ブランド（アパレルWORK専用項目）"); //"ブランド（アパレルWORK専用項目）";
        $li[] = array("ap_brand_flg","ブランド公開フラグ（アパレルWORK専用項目）"); //"ブランド公開フラグ（アパレルWORK専用項目）";
        $li[] = array("flow","選考の流れ"); //"選考の流れ";
        $li[] = array("exp_flg","実務経験"); //"実務経験";
        $li[] = array("sort","表示優先度"); //"表示優先度";
        $li[] = array("siteid","サテライトリスト"); //"サテライトリスト";
        $li[] = array("feature_codes","こだわり条件"); //"こだわり条件";
        $li[] = array("pic1_code","画像（一覧・詳細1）"); //"画像（一覧・詳細1）";
        $li[] = array("pic2_code","画像（詳細2）"); //"画像（詳細2）";
        $li[] = array("pic3_code","画像（担当者）"); //"画像（担当者）";
        $li[] = array("section1","登録管理者親部署"); //"登録管理者親部署";
        $li[] = array("section2","登録管理者部署"); //"登録管理者部署";
        $li[] = array("editor_first","登録管理者");//"登録管理者";
        $li[] = array("editor_last","最終更新管理者"); //"最終更新管理者";
        $li[] = array("no1","登録日時"); //"登録日時";
        $li[] = array("no2","最終更新日時"); //"最終更新日時";
        $li[] = array("id","備考"); //"備考";
        
        return $li;
    }
    
}
