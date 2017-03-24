<?php

include('data_hn_recruits.php');
include('data_cc_recruits.php');
include('data_convert.php');

class Data{

    public static $dataTotal    = ""; //トータル件数


    //サイトID
    function siteCode($_=array()) {
        $li = array(
        "1"=>    "介護iランド",
        "2"=>    "セルジョブ",
        "3"=>    "CCナビ",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    

    //権限
    function AuthorityParents($_=array()) {
        $li = array(
        "domain"=>   "サイト",
        "manage"=>   "管理者",
        "recruit"=>  "求人情報",
        "apply"=>    "応募情報",
        "company"=>  "企業情報",
        "center"=>   "企業・センター情報",
        "entry"=>    "登録会",
        "recruit_pic"=>   "画像",
        "master"=>   "マスタ",
        "site"=>   "サイト設定",
        "convert"=>   "求人コンバート",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    function Authority($_=array()) {
        $li = array(
        "domain"=>   array("1"=>"介護iランド","2"=>"セルジョブ","3"=>"CCナビ"),
        "manage"=>   array("1"=>"閲覧","2"=>"登録・編集・削除"),
        "recruit"=>   array("1"=>"閲覧","2"=>"登録・編集・削除","3"=>"ダウンロード","4"=>"アップロード","5"=>"PVランキング","6"=>"ハローワーク"),
        "company"=>   array("1"=>"閲覧","2"=>"登録・編集・削除","3"=>"ダウンロード","4"=>"アップロード"),
        "apply"=>   array("1"=>"閲覧","2"=>"編集・削除","3"=>"ダウンロード"),
        "entry"=>   array("1"=>"登録会管理","2"=>"応募情報閲覧","3"=>"応募情報編集・削除","4"=>"応募情報ダウンロード"),
        "recruit_pic"=>   array("1"=>"設定"),
        "master"=>   array("1"=>"設定"),
        "site"=>   array("1"=>"設定"),
        "convert"=>   array("1"=>"設定"),
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //お問い合わせ内容
    function contactCategory($_=array()) {
        $li = array(
        "1"=>    "ご利用頂いている求人サイトに関して",
        "2"=>    "お仕事内容に関して",
        "3"=>    "給与・有給休暇・年末調整・源泉徴収に関して",
        "4"=>    "社会保険・雇用保険に関して",
        "5"=>    "各種証明書の発行に関して",
        "6"=>    "登録内容の変更・削除に関して",
        "7"=>    "その他内容のお問い合わせ",
        "8"=>    "当社へのご意見・ご要望など",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //表示件数
    function showLimit($_=array()) {
        $li = array(
        "20"=>    "20件",
        "50"=>    "50件",
        "100"=>    "100件",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //表示件数
    function showLimit2($_=array()) {
        $li = array(
        "50"=>    "50件",
        "100"=>    "100件",
        "200"=>    "200件",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //掲載ステータス
    function status($_=array()) {
        $li = array(
        "MAKING"=>  "製作中",
        "OPEN"=>    "掲載中",
        "CLOSED"=>  "掲載終了",
        "CONVERT"=>  "コンバート求人",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //掲載ステータス
    function status2($_=array()) {
        $li = array(
        "1"=>  "公開",
        "2"=>    "非公開",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //adminステータス
    function statusAdmin($_=array()) {
        $li = array(
        "1"=>  "管理責任者",
        "2"=>    "広告管理者",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //ステータス
    function statusRes($_=array()) {
        $li = array(
        "0"=>  "未対応",
        "1"=>  "対応",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //ソート
    function jobsort($_=array()) {
        $li = array(
        "0"=>  "通常",
        "1"=>  "優先",
        "2"=>  "急募",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    
    //必要資格
    function skill($_=array()) {
        $li = array(
        "0"=>  "なし",
        "1"=>    "あり",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    function skill2($_=array()) {
        $li = array(
        "0"=>    "必要ないお仕事",
        "1"=>    "必要あるお仕事",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //必要経験
    function experience($_=array()) {
        $li = array(
        "0"=>  "なし",
        "1"=>    "あり",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    function experience2($_=array()) {
        $li = array(
        "0"=>    "必要ないお仕事",
        "1"=>    "必要あるお仕事",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }


    //募集状況
    function jobstatus($_=array()) {
        $li = array(
        "募集中",
        "クローズ",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //徒歩・バス
    function accesshow($_=array()) {
        $li = array(
        "1"=>    "徒歩",
        "2"=>    "バス",
        );
        //(empty($_))?$_="":"";
        if(
        //!empty($_)
        !is_array($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //性別
    function sex($_=array()) {
        $li = array(
        "1"=>    "男性",
        "2"=>    "女性",
        );
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //生年月日
    function birthYear($_=array()) {
        $li = array();
        $Y = date('Y')-14;
        for($i=$Y;$i>=1940;$i--){
            $li[$i] = $i;
        }
        
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    function birthMonth($_=array()) {
        $li = array();
        for($i=1;$i<=12;$i++){
            $li[$i] = $i;
        }
        
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    function birthDay($_=array()) {
        $li = array();
        for($i=1;$i<=31;$i++){
            $li[$i] = $i;
        }
        
        (empty($_))?$_="":"";
        if(
        !empty($_)
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //時給
    function salarytime($_=array()) {
        $li = array();
        for($i=700;$i<=2000;$i=$i+50){
            $li[] = $i;
        }
        
        (empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //部署
    function jobSections($_=array('s'=>'','w_type'=>'','w_except'=>'','w_groupid'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,group_id,type";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }

        if(!empty($_["w_except"])){
            $where[] = "except_flg = 1";
        }

        if(!empty($_["w_type"])){

            if(is_array($_["w_type"])){
                $types = array();
                foreach($_["w_type"] as $v){
                   $types[] = DB::quote($v);
                }
                $types = implode(",", $types);
                $where[] = "type in ({$types})";
            
            } else {
                $typeid = DB::quote($_["w_type"]);
                $where[] = "type = {$typeid}";
            }
            
        }
        
        if(!empty($_["w_groupid"])){
            $groupid = DB::quote($_["w_groupid"]);
            $where[] = "group_id = {$groupid}";
        }
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobSections
        {$where}
        order by substr(id,1,5)
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }
    
    //特色フラグ(介護iランド)
    function jobFeatures($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        {$clm}
        from jobFeatures
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }

    //特色フラグ(セルジョブ)
    function jobFeatures_HN($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        {$clm}
        from jobFeatures_HN
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }

    //特色フラグ(CCナビ)
    function jobFeatures_CC($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        {$clm}
        from jobFeatures_CC
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }
    
    //募集職種(介護iランド)
    function jobCategories($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobCategories
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }

    //募集職種(セルジョブ)
    function jobCategories_HN($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobCategories_HN
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }


    //募集職種(CCナビ)
    function jobCategories_CC($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobCategories_CC
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }
    
    
    //業種(セルジョブ)
    function jobIndustry_HN($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobIndustry_HN
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }    

    //業種(CCナビ)
    function jobIndustry_CC($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobIndustry_CC
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }
    
    //サービス種類
    function jobServices($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobServices
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        if(
        isset($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]["name"]:'';
        }
        return $d;
    }


    //勤務時間
    function jobtimes($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobtimes
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }


    //勤務日数
    function jobdays($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobdays
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }

    //勤務曜日
    function jobweeks($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobweeks
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
        }
        
        return $d;
    }

    //雇用形態
    function jobtypes($_=array('s'=>'','w_status'=>'',
    'w_id'=>'','limitStart'=>'','limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,sort";
        } else {
            $clm = "*";
        }

        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from jobtypes
        {$where}
        order by sort desc, id asc
        {$limit}";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }

            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }
        
        return $d;
    }

    //雇用形態省略
    function jobtypes_S($_=array()) {
        $li = array(
        "派遣社員"=>  "派遣社員",
        "パート・アルバイト"=>    "パート・<span>アルバイト</span>",
        "正社員"=>    "正社員",
        "紹介予定派遣"=>    "紹介予定<span>派遣</span>",
        "契約社員"=>    "契約社員",
        "その他"=>    "その他",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }

    //雇用形態省略2
    function jobtypes_SS($_=array()) {
        $li = array(
        "派遣社員"=>  "派",
        "パート・アルバイト"=>    "ア",
        "正社員"=>    "正",
        "紹介予定派遣"=>    "紹",
        "契約社員"=>    "契",
        "その他"=>    "他",
        );
        ($_!='0' and empty($_))?$_="":"";
        if(
        isset($li[$_])
        ){
            return isset($li[$_])?$li[$_]:"";
        }
        return $li;
    }
    
    //都道府県
    function prefectures($_=array('ids'=>'','idgps'=>'','w_pref'=>'','s'=>'','w_status'=>'','o_select'=>'')) {
        
        if(!empty($_["s"])){
            $clm = "id,name";
        } else {
            $clm = "*";
        }

        $where = array();
        if(
        !is_array($_)
        ){

            $id = DB::quote($_);
            $where[] = "id = {$id}";

        } else{
            if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "id in ({$ids})";
            }
            if(!empty($_["idgps"])){
            $idgps = array();
            foreach($_["idgps"] as $v){
               $idgps[] = DB::quote($v);
            }
            $idgps = implode(",", $idgps);
            $where[] = "gp_id in ({$idgps})";
            }
            if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "name = {$pref}";
            }
            if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $where[] = "status = {$status}";
            }
        }


        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        
        $orderby = "";
        
        if(!empty($_["o_select"])){
             $orderby .= "case id when '13' then 1 else 10 end,";
             $orderby .= "case id when '14' then 2 else 10 end,";
             $orderby .= "case id when '12' then 3 else 10 end,";
             $orderby .= "case id when '11' then 4 else 10 end,";
             $orderby .= "case id when '10' then 5 else 10 end,";
             $orderby .= "case id when '1' then 6 else 10 end,";
             $orderby .= "case id when '8' then 7 else 10 end,";
       }
        
        
        $sql = "select
        {$clm}
        from _prefectures
        {$where}
        order by {$orderby}sort desc, id asc";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
        }
        
        if(
        !is_array($_)
        ){
            return isset($d[$_]["name"])?$d[$_]["name"]:'';
        }
        return $d;
    }

    //市区町村
    function cities($_=array('ids'=>'','s_town'=>'','w_pref'=>'','w_zip'=>'','w_city'=>'')) {

        if(
        !is_array($_)
        ){
            $select = "id,city,pref";
        } else{
        if(!empty($_["s_town"])){
            $select = "id,pref,town";
        } else {
            $select = "id,city,pref";
        }
        }
        

        $where = array();
        if(
        !is_array($_)
        ){
            $id = DB::quote($_);
            $where[] = "id = {$id}";
        } else{
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "id in ({$ids})";
        }
        
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "pref = {$pref}";
        }

        if(!empty($_["w_zip"])){
            $zip = DB::quote($_["w_zip"]);
            $where[] = "zip = {$zip}";
        }
        
        if(!empty($_["w_city"])){
            $city = DB::quote($_["w_city"]);
            $where[] = "city = {$city}";
        }
        
        }
        
        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        distinct
        {$select}
        from _address
        {$where} 
        order by id asc";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
        }
        
        if(
        !is_array($_)
        ){
            return isset($d[$_]["city"])?$d[$_]["city"]:'';
        }
        return $d;
    }

    //駅
    function stations($_=array('ids'=>'','lineids'=>'','cmpids'=>'','w_stname'=>'','w_pref'=>'','w_word'=>'')) {

        $where = array();

        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "_station.station_cd in ({$ids})";
        }
        
        if(!empty($_["lineids"]) && !empty($_["cmpids"])){
            $whereOr = "(";
        }
        if(!empty($_["lineids"])){
            $ids = array();
            foreach($_["lineids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            
            if(!empty($_["cmpids"])){
                $whereOr .= "_line.line_cd in ({$ids})";
            } else {
                $where[] = "_line.line_cd in ({$ids})";
            }
        }

        if(!empty($_["cmpids"])){
            $ids = array();
            foreach($_["cmpids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            
            if(!empty($_["lineids"])){
                $whereOr .= " or _stcompany.company_cd in ({$ids})";
            } else {
                $where[] = "_stcompany.company_cd in ({$ids})";
            }
        }
        if(!empty($_["lineids"]) && !empty($_["cmpids"])){
            $whereOr .= ")";
            $where[] = $whereOr;
        }
                
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "_station.pref_cd = {$pref}";
        }

        //フリーワード
        if(!empty($_["w_word"])){
            $pmsWord = urldecode($_["w_word"]);
            $pmsWordLi = srcMix($pmsWord);
            $pmsWord = implode(" ",$pmsWordLi);
            
            $cmlLi = array("_line.line_name","_station.station_name");
            
            $where_pms = " ";
            foreach($pmsWordLi as $key => $val){
                if(!empty($val)){

                    if($key!=0){
                         $where_pms .= " and ";
                    }
                    
                    $where_pms .= " (";
                        
                    foreach($cmlLi as $key2 => $clm){

                        if($key2!=0){
                             $where_pms .= " or ";
                        }
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $where_pms .= " {$clm} like '".$pmsQt."'";
                    }
                    
                    $where_pms .= ")";
                }
            }
            $where[] = $where_pms;
        
        }
        
        $where[] = "_station.e_status = 0";
        $where[] = "_line.e_status = 0";
        $where[] = "_stcompany.e_status = 0";
        
        if(!empty($_["w_stname"])){
            $stname = $_["w_stname"];
            $stname = filter($stname);
            $stnameQt = "%".dbLikeEsc($stname)."%";
            $where[] = "_station.station_name like '".$stnameQt."'";
        }

        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";
        
        $sql = "select
        _station.station_cd as id,
        _station.station_g_cd as idg,
        _station.station_name as name,
        _line.line_name as line_name,
        _line.line_cd as line_id,
        _stcompany.company_name as cmp_name,
        _stcompany.company_cd as cmp_id,
        _station.pref_cd as pref_cd
        from
        (_station inner join _line  on _station.line_cd = _line.line_cd)
        inner join _stcompany  on _line.company_cd = _stcompany.company_cd
        {$where} 
        order by _station.station_cd asc";
//echo $sql;
        
        $d = array();
        
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
        }
        
        return $d;
    }
    
    //画像グループ
    function picturesGroup($_=array(
    's'=>'',
    'w_id'=>'',
    'o_id'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {
    
        if(!empty($_["s"])){
            $clm = "id,name";
        } else {
            $clm = "*";
        }

        $where = array();

        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "id {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "updated {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from picturesGroup
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]["name"]:"";
         }
     
        return $d;
    }

    //画像
    function pictures($_=array(
    's'=>'',
    'id'=>'',
    'ids'=>'',
    'w_id'=>'',
    'w_groupid'=>'',
    'w_word'=>'',
    'w_deleted'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {
    
        if(!empty($_["s"])){
            $clm = "id,name,pic,group_id";
        } else {
            $clm = "*";
        }

        $where = array();

        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "id in ({$ids})";
        }
        
        if(!empty($_["w_groupid"])){
            $groupid = DB::quote($_["w_groupid"]);
            $where[] = "group_id = {$groupid}";
        }
        

        if(!empty($_["w_word"])){
            $v = $_["w_word"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " keyword like '".$pmsQt."'";
        }
        
        if(empty($_["w_deleted"])){
            $where[] = "deleted = ''";
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }


        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "id {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "updated {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from pictures
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]["name"]:"";
         }
     
        return $d;
    }


    //企業
    function company($_=array(
    's'=>'',
    'ids'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_name'=>'',
    'w_namekana'=>'',
    'w_industry'=>'',
    'w_pref'=>'',
    'w_word'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_sort'=>'',
    'o_created'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "company.id, company.status, company.name, company.namekana, company.pref_code, company.industry, company.created, company.updated";
        } else {
            $clm = "
            company.id,
            company.status,
            company.name,
            company.namekana,
            company.pref_code,
            company.address,
            company.address2,
            company.industry,
            company.business,
            company.office,
            company.establishment,
            company.ceo,
            company.staff,
            company.capital,
            company.sales,
            company.url,
            company.feature,
            company.remarks,
            company.remarks2,
            company.created,
            company.updated,
            company.deleted
            ";
        }

        $where = array();

        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(company.deleted >= {$now} or company.deleted = '' )";
        }
        
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "company.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "company.id = {$id}";
        }
        
        if(!empty($_["w_status"])){

            if(is_array($_["w_status"])){
                $status = array();
                foreach($_["w_status"] as $v){
                   $status[] = DB::quote($v);
                }
                $status = implode(",", $status);
                $where[] = "company.status in ({$status})";
            
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "company.status = {$status}";
            }
            
        }
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "company.pref_code = {$pref}";
        }
        if(!empty($_["w_name"])){
            $pmsQt = "%".$_["w_name"]."%";
            $where[] = " company.name like '".$pmsQt."'";
        }
        if(!empty($_["w_namekana"])){
            $pmsQt = "%".dbLikeEsc($_["w_namekana"])."%";
            $where[] = " company.namekana like '".$pmsQt."'";
        }
        if(!empty($_["w_industry"])){
            $pmsQt = "%".dbLikeEsc($_["w_industry"])."%";
            $where[] = " company.industry like '".$pmsQt."'";
        }
        
        if(!empty($_["w_word"])){
            $pmsWord = urldecode($_["w_word"]);
            $pmsWordLi = srcMix($pmsWord);
            $pmsWord = implode(" ",$pmsWordLi);
            
            $where_nm = array();
            foreach($pmsWordLi as $key => $val){
                if(!empty($val)){
                    $where_nm[] = $val;
                }
                
            }
            foreach($where_nm as $val){
           
                $whereWord = "(";
                $nm = 0;
                foreach(array("company.name", "company.namekana", "company.address", "company.address2", "company.industry", "company.business", "company.office", "company.establishment", "company.ceo",
                              "company.staff", "company.capital", "company.sales", "company.url", "company.feature", "company.remarks", "company.remarks2", "_prefectures.name") as $key2 => $c){
                    $whereWord .= ($nm!=0)?" or ":"";
                    $pmsQt = "%".dbLikeEsc($val)."%";
                    $whereWord .= " {$c} like '".$pmsQt."'";
                    $nm ++;
                }
                $whereWord .= ")";
                
                $where[] = $whereWord;
                
            }
        
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "company.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "company.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "company.created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "company.updated {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from company inner join _prefectures on _prefectures.id = company.pref_code
        {$where}
        order by {$orderby} company.id desc
        {$limit}
        ";
        
       
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }
    

    //センター
    function center($_=array(
    's'=>'',
    'ids'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_name'=>'',
    'w_company'=>'',
    'w_company_code'=>'',
    'w_word'=>'',
    'w_pref'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_sort'=>'',
    'o_created'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "center.id, center.status, center.name, center.company_code, company.name as cmp_name, company.deleted as cmp_deleted, _prefectures.name as pref";
        } else {
            $clm = "
            center.id,
            center.status,
            center.name,
            center.company_code,
            center.pref_code,
            center.address,
            center.address2,
            center.map,
            center.workenv,
            center.arroundenv,
            center.sexratio,
            center.agerange,
            center.education,
            center.team,
            center.interview,
            center.introduction,
            center.feature,
            center.remarks,
            center.remarks2,
            center.updated,
            center.created,
            center.deleted,
            company.name as cmp_name
            ";
        }

        $where = array();
            
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(center.deleted >= {$now} or center.deleted = '' )";
        }
        
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "center.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "center.id = {$id}";
        }

        if(!empty($_["w_status"])){

            if(is_array($_["w_status"])){
                $status = array();
                foreach($_["w_status"] as $v){
                   $status[] = DB::quote($v);
                }
                $status = implode(",", $status);
                $where[] = "center.status in ({$status})";
            
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "center.status = {$status}";
            }
            
        }
        if(!empty($_["w_name"])){
            $pmsQt = "%".$_["w_name"]."%";
            $where[] = " center.name like '".$pmsQt."'";
        }

        if(!empty($_["w_company"])){
            $pmsQt = "%".$_["w_company"]."%";
            $where[] = " company.name like '".$pmsQt."'";

            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(company.deleted >= {$now} or company.deleted = '' )";
        
        }

        if(!empty($_["w_company_code"])){
            $id = DB::quote($_["w_company_code"]);
            $where[] = "center.company_code = {$id}";
        }
        
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "center.pref_code = {$pref}";
        }
        
        if(!empty($_["w_word"])){

            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(company.deleted >= {$now} or company.deleted = '' )";
            
            $pmsWord = urldecode($_["w_word"]);
            $pmsWordLi = srcMix($pmsWord);
            $pmsWord = implode(" ",$pmsWordLi);
            
            $where_nm = array();
            foreach($pmsWordLi as $key => $val){
                if(!empty($val)){
                    $where_nm[] = $val;
                }
                
            }
            foreach($where_nm as $val){
           
                $whereWord = "(";
                $nm = 0;
                foreach(array("center.name", "center.address", "center.address2", "center.map", "center.workenv", "center.arroundenv", "center.sexratio", "center.agerange", "center.education"
                , "center.team", "center.interview", "center.introduction", "center.feature", "center.remarks", "center.remarks2", "company.name", "_prefectures.name") as $key2 => $c){
                    $whereWord .= ($nm!=0)?" or ":"";
                    $pmsQt = "%".dbLikeEsc($val)."%";
                    $whereWord .= " {$c} like '".$pmsQt."'";
                    $nm ++;
                }
                $whereWord .= ")";
                
                $where[] = $whereWord;
                
            }
        
        }
        
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "center.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "center.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "center.created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "center.updated {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from (center inner join _prefectures on _prefectures.id = center.pref_code) left join company on center.company_code = company.id
        {$where}
        order by {$orderby} center.id desc
        {$limit}
        ";
        
        //echo $sql;
        
       
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }
    
    
    //求人
    function recruits($_=array(
    'id'=>'',
    'ids'=>'',
    's'=>'',
    'ss'=>'',
    'w_status'=>'',
    'w_startdate'=>'',
    'w_pref'=>'',
    'w_prefs'=>'',
    'w_deleted'=>'',
    'o_sort'=>'',
    'o_rand'=>'',
    'w_new'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["ss"])){
            $clm = "id,title";
        } else if(!empty($_["s"])){
            $clm = "id,title,city_code,pref_code,st1_code,st2_code,st3_code,st4_code,st5_code,cate_codes,service_code,exp_flg,skill_flg,
            jobtime1_code,jobtime2_code,jobtime3_code,jobtime4_code,jobday_codes,feature_codes,city_code,section1,section2,startdate,jobtype_codes";
        } else {
            $clm = "*";
        }

        $where = array();
        if(!empty($_["id"])){
            $id = DB::quote($_["id"]);
            $where[] = "id = {$id}";
        }

        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "id in ({$ids})";
        }
        
        if(!empty($_["w_status"])){

            if(is_array($_["w_status"])){
                $status = array();
                foreach($_["w_status"] as $v){
                   $status[] = DB::quote($v);
                }
                $status = implode(",", $status);
                $where[] = "status in ({$status})";
            
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
            
        }
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "pref_code = {$pref}";
        }
        if(!empty($_["w_prefs"])){
            $pmsPrefLi = $_["w_prefs"];
            $PrefCode = array();
            
            foreach($pmsPrefLi as $val){
                if(!empty($val)){
                    $PrefCode[] = DB::quote($val);
                }
                
            }
            $PrefCode = implode(",", $PrefCode);
            $where[] = "pref_code in ($PrefCode)";
        }
        if(!empty($_["w_startdate"])){
            $startdate = DB::quote($_["w_startdate"]);
            $where[] = "startdate <= {$startdate}";
        }
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(deleted >= {$now} or deleted = '' )";
        }

        if(!empty($_["w_new"])){
            $newdate = date("Y-m-d",strtotime("-2week"));
            $newdate = DB::quote($newdate);
            $where[] = "startdate >= {$newdate}";
        }
        
        $where = implode(" and ", $where);
        
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        $orderby = "";
        if(!empty($_["o_sort"])){
            $orderby = "sort desc,";
        }
        if(!empty($_["o_rand"])){
            $orderby = "rand(),";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from recruits
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }


    //like検索カラム
    function recruitsColumnLikes(){
       $txt = "recruits.title
recruits.catchcopy
recruits.text
recruits.pic1cap
recruits.pic2cap
recruits.pic3cap
recruits.busetc
recruits.jobway
recruits.jobtime1
recruits.jobtime2
recruits.jobtime3
recruits.jobtime4
recruits.jobday
recruits.jobweek
recruits.contents
recruits.exp
recruits.skill
recruits.salarytime_low
recruits.salarytime_high
recruits.salary
recruits.transport
recruits.welfare
recruits.holiday
recruits.other
recruits.message
recruits.flow";

       
       //adminだけ、もしくは、フラグ判別
       $txt .= "
recruits.staffname
recruits.tel
recruits.company
recruits.shop
";
       
        $li = array();
        foreach(txt2Array($txt) as $k => $v){
            $li[$k] = $v;
        }
        return $li;
    }


    //求人
    function recruitsSearch($_=array(
    's'=>'',
    'ids'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_statuses'=>'',
    'w_startdate'=>'',
    'w_pref'=>'',
    'w_city'=>'',
    'w_sta'=>'',
    'w_cate'=>'',
    'w_srv'=>'',
    'w_type'=>'',
    'w_skill'=>'',
    'w_exp'=>'',
    'w_day'=>'',
    'w_time'=>'',
    'w_fea'=>'',
    'w_word'=>'',
    'w_section1'=>'',
    'w_section2'=>'',
    'w_deleted'=>'',
    'o_sort'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_sort'=>'',
    'o_created'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "
            recruits.id,
            recruits.title,
            recruits.cate_codes,
            recruits.service_code,
            recruits.pref_code,
            recruits.city_code,
            recruits.st1_code,
            recruits.st2_code,
            recruits.st3_code,
            recruits.st4_code,
            recruits.st5_code,
            recruits.salarytime_low,
            recruits.salarytime_high,
            recruits.salary,
            recruits.salary_flg,
            recruits.jobday_codes,
            recruits.jobweek_codes,
            recruits.feature_codes,
            recruits.pic1_code,
            recruits.pic1_flg,
            recruits.pic2_code,
            recruits.pic2_flg,
            recruits.pic3_code,
            recruits.pic3_flg,
            recruits.startdate,
            recruits.jobtype_codes,
            recruits.jobtime1_code,
            recruits.jobtime1,
            recruits.jobtime1break,
            recruits.jobtime2_code,
            recruits.jobtime2,
            recruits.jobtime2break,
            recruits.jobtime3_code,
            recruits.jobtime3,
            recruits.jobtime3break,
            recruits.jobtime4_code,
            recruits.jobtime4,
            recruits.jobtime4break,
            recruits.jobtime5_code,
            recruits.jobtime5,
            recruits.jobtime5break,
            recruits.jobtime6_code,
            recruits.jobtime6,
            recruits.jobtime6break,
            recruits.jobtime7_code,
            recruits.jobtime7,
            recruits.jobtime7break,
            recruits.jobtime8_code,
            recruits.jobtime8,
            recruits.jobtime8break,
            recruits.jobtime,
            recruits.contents,
            recruits.catchcopy,
            recruits.catchcopy_flg,
            recruits.text,
            recruits.text_flg,
            recruits.st1_code,
            recruits.st2_code,
            recruits.st3_code,
            recruits.st4_code,
            recruits.st5_code,
            recruits.st1out,
            recruits.st1way_code,
            recruits.st1bustime,
            recruits.st1bus,
            recruits.st1walktime,
            recruits.st2out,
            recruits.st2way_code,
            recruits.st2bustime,
            recruits.st2bus,
            recruits.st2walktime,
            recruits.st3out,
            recruits.st3way_code,
            recruits.st3bustime,
            recruits.st3bus,
            recruits.st3walktime,
            recruits.st4out,
            recruits.st4way_code,
            recruits.st4bustime,
            recruits.st4bus,
            recruits.st4walktime,
            recruits.st5out,
            recruits.st5way_code,
            recruits.st5bustime,
            recruits.st5bus,
            recruits.st5walktime,
            recruits.busetc
            ";
        } else {
            $clm = "
            recruits.id,
            recruits.receivedate,
            recruits.status,
            recruits.sort,
            recruits.section1,
            recruits.section2,
            recruits.startdate,
            recruits.service_code,
            recruits.cate_codes,
            recruits.company_flg,
            recruits.company,
            recruits.companykana,
            recruits.companyaddress,
            recruits.companysection,
            recruits.companystaff,
            recruits.companypost,
            recruits.companytel,
            recruits.companyfax,
            recruits.shop_flg,
            recruits.shop,
            recruits.shopkana,
            recruits.shopsection,
            recruits.shoppost,
            recruits.shopfax,
            recruits.shopinfo,
            recruits.staffname,
            recruits.tel,
            recruits.address_flg,
            recruits.address,
            recruits.pref_code,
            recruits.city_code,
            recruits.st1_code,
            recruits.st2_code,
            recruits.st3_code,
            recruits.st4_code,
            recruits.st5_code,
            recruits.st1out,
            recruits.st1way_code,
            recruits.st1bustime,
            recruits.st1bus,
            recruits.st1walktime,
            recruits.st2out,
            recruits.st2way_code,
            recruits.st2bustime,
            recruits.st2bus,
            recruits.st2walktime,
            recruits.st3out,
            recruits.st3way_code,
            recruits.st3bustime,
            recruits.st3bus,
            recruits.st3walktime,
            recruits.st4out,
            recruits.st4way_code,
            recruits.st4bustime,
            recruits.st4bus,
            recruits.st4walktime,
            recruits.st5out,
            recruits.st5way_code,
            recruits.st5bustime,
            recruits.st5bus,
            recruits.st5walktime,
            recruits.busetc,
            recruits.jobway,
            recruits.nightwork,
            recruits.sex,
            recruits.age,
            recruits.specs_must,
            recruits.specs_want,
            recruits.specs_ngt,
            recruits.type_must,
            recruits.type_want,
            recruits.type_ngt,
            recruits.othercond,
            recruits.request_salary,
            recruits.salarytime_low,
            recruits.salarytime_high,
            recruits.salary,
            recruits.salary_flg,
            recruits.transport,
            recruits.transport_flg,
            recruits.referralfee,
            recruits.annualincome,
            recruits.conflictdate,
            recruits.feature_codes,
            recruits.jobtime1_code,
            recruits.jobtime1,
            recruits.jobtime1break,
            recruits.jobtime2_code,
            recruits.jobtime2,
            recruits.jobtime2break,
            recruits.jobtime3_code,
            recruits.jobtime3,
            recruits.jobtime3break,
            recruits.jobtime4_code,
            recruits.jobtime4,
            recruits.jobtime4break,
            recruits.jobtime5_code,
            recruits.jobtime5,
            recruits.jobtime5break,
            recruits.jobtime6_code,
            recruits.jobtime6,
            recruits.jobtime6break,
            recruits.jobtime7_code,
            recruits.jobtime7,
            recruits.jobtime7break,
            recruits.jobtime8_code,
            recruits.jobtime8,
            recruits.jobtime8break,
            recruits.jobtime,
            recruits.jobday_codes,
            recruits.jobday,
            recruits.jobweek_codes,
            recruits.jobweek,
            recruits.jobtype_codes,
            recruits.contents,
            recruits.exp_flg,
            recruits.exp,
            recruits.skill_flg,
            recruits.skill,
            recruits.welfare,
            recruits.holiday,
            recruits.other,
            recruits.message,
            recruits.flow,
            recruits.title,
            recruits.catchcopy,
            recruits.catchcopy_flg,
            recruits.text,
            recruits.text_flg,
            recruits.pic1_code,
            recruits.pic1cap,
            recruits.pic1_flg,
            recruits.pic1cap_flg,
            recruits.pic2_code,
            recruits.pic2cap,
            recruits.pic2_flg,
            recruits.pic2cap_flg,
            recruits.pic3_code,
            recruits.pic3cap,
            recruits.pic3_flg,
            recruits.pic3cap_flg,
            recruits.jobstatus,
            recruits.tag_title,
            recruits.tag_description,
            recruits.tag_keywords,
            recruits.updated,
            recruits.created,
            recruits.deleted,
            recruits.editor_first,
            recruits.editor_last
            ";
        }

        $where_nm = array("1");
        $where = array();
        $whereDf = array();
        $whereSation = array();
        $wherePref = array();
        $whereCate = array();
        $whereService = array();
        $whereFeature = array();
        $whereJobtime = array();
        $whereJobday = array();
        $whereJobweek = array();
        $whereJobtype = array();

        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $whereDf[] = "recruits.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $whereDf[] = "recruits.id = {$id}";
        }
        if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $whereDf[] = "recruits.status = {$status}";
        }

        if(!empty($_["w_statuses"])){
            $pmsStatusLi = $_["w_statuses"];
            $StatusCode = array();
            
            foreach($pmsStatusLi as $val){
                if(!empty($val)){
                    $StatusCode[] = DB::quote($val);
                }
                
            }
            $StatusWhere = "(";
            foreach($StatusCode as $k => $v){
                $StatusWhere .= ($k!=0)?" or ":"";
                $StatusWhere .= "recruits.status = {$v}";
            }
            $StatusWhere .= ")";
            $whereDf[] = $StatusWhere;
        }
        
        if(!empty($_["w_startdate"])){
            $startdate = DB::quote($_["w_startdate"]);
            $whereDf[] = "recruits.startdate <= {$startdate}";
        }

        if(!empty($_["w_section1"])){
            $section1 = DB::quote($_["w_section1"]);
            $whereDf[] = "recruits.section1 = {$section1}";
        }
        if(!empty($_["w_section2"])){
            $section2 = DB::quote($_["w_section2"]);
            $whereDf[] = "recruits.section2 = {$section2}";
        }
        
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $whereDf[] = "(recruits.deleted >= {$now} or recruits.deleted = '' )";
        }

        
        if(!empty($_["w_pref"])){
            $pmsPrefLi = $_["w_pref"];
            $PrefCode = array();
            
            foreach($pmsPrefLi as $val){
                if(!empty($val)){
                    $PrefCode[] = DB::quote($val);
                }
                
            }
            $PrefCode = implode(",", $PrefCode);
            $whereDf[] = "recruits.pref_code in ($PrefCode)";
        }

        //市区町村
        if(!empty($_["w_city"])){
            $pmsCityLi = $_["w_city"];
            $CityCode = array();
            
            foreach($pmsCityLi as $val){
                if(!empty($val)){
                    $CityCode[] = DB::quote($val);
                }
                
            }
            $CityCode = implode(",", $CityCode);
            $whereDf[] = "recruits.city_code in ($CityCode)";
        }

        //駅
        if(!empty($_["w_sta"])){
            $pmsStaLi = $_["w_sta"];
            $StaCode = array();
            
            foreach($pmsStaLi as $val){
                if(!empty($val)){
                    $StaCode[] = DB::quote($val);
                }
                
            }
            $StaCode = implode(",", $StaCode);
            $whereDf[] = "(recruits.st1_code in ($StaCode) or
            recruits.st2_code in ($StaCode) or
            recruits.st3_code in ($StaCode) or
            recruits.st4_code in ($StaCode) or
            recruits.st5_code in ($StaCode))";
        }

        //職種
        if(!empty($_["w_cate"])){
            $pmsCatefLi = $_["w_cate"];
            $CateCode = array();
            
            foreach($pmsCatefLi as $val){
                if(!empty($val)){
                    $CateCode[] = DB::quote($val);
                }
                
            }
            $CateWhere = "(";
            foreach($CateCode as $k => $v){
                $CateWhere .= ($k!=0)?" or ":"";
                $CateWhere .= "find_in_set({$v}, recruits.cate_codes)";
            }
            $CateWhere .= ")";
            $whereDf[] = $CateWhere;
        }
        
        //雇用形態
        if(!empty($_["w_type"])){
            $pmsTypeLi = $_["w_type"];
            $TypeCode = array();
            
            foreach($pmsTypeLi as $val){
                if(!empty($val)){
                    $TypeCode[] = DB::quote($val);
                }
                
            }
            $TypeWhere = "(";
            foreach($TypeCode as $k => $v){
                $TypeWhere .= ($k!=0)?" or ":"";
                $TypeWhere .= "find_in_set({$v}, recruits.jobtype_codes)";
            }
            $TypeWhere .= ")";
            $whereDf[] = $TypeWhere;
        }
        
        //サービス種類
        if(!empty($_["w_srv"])){
            $pmsSrvLi = $_["w_srv"];
            $SrvCode = array();
            
            foreach($pmsSrvLi as $val){
                if(!empty($val)){
                    $SrvCode[] = DB::quote($val);
                }
                
            }
            $SrvWhere = "(";
            foreach($SrvCode as $k => $v){
                $SrvWhere .= ($k!=0)?" or ":"";
                $SrvWhere .= "find_in_set({$v}, recruits.service_code)";
            }
            $SrvWhere .= ")";
            $whereDf[] = $SrvWhere;
        }

        //スキル
        if(!empty($_["w_skill"])){

            $pmsSkillLi = $_["w_skill"];
            $SkillCode = array();
            
            foreach($pmsSkillLi as $val){
                if(!empty($val) or $val=='0'){
                    $SkillCode[] = DB::quote($val);
                }
                
            }
            $SkillCode = implode(",", $SkillCode);
            $whereDf[] = "recruits.skill_flg in ($SkillCode)";
        }

        //経験
        if(!empty($_["w_exp"])){

            $pmsExpLi = $_["w_exp"];
            $ExpCode = array();
            
            foreach($pmsExpLi as $val){
                if(!empty($val) or $val=='0'){
                    $ExpCode[] = DB::quote($val);
                }
                
            }
            $ExpCode = implode(",", $ExpCode);
            $whereDf[] = "recruits.exp_flg in ($ExpCode)";
            
        }

        //勤務日数
        if(!empty($_["w_day"])){
            $pmsDayfLi = $_["w_day"];
            $DayCode = array();
            
            foreach($pmsDayfLi as $val){
                if(!empty($val)){
                    $DayCode[] = DB::quote($val);
                }
                
            }
            $DayWhere = "(";
            foreach($DayCode as $k => $v){
                $DayWhere .= ($k!=0)?" or ":"";
                $DayWhere .= "find_in_set({$v}, recruits.jobday_codes)";
            }
            $DayWhere .= ")";
            $whereDf[] = $DayWhere;
        }

        //勤務時間
        if(!empty($_["w_time"])){
            $pmsTimeLi = $_["w_time"];
            $TimeCode = array();
            
            foreach($pmsTimeLi as $val){
                if(!empty($val)){
                    $TimeCode[] = DB::quote($val);
                }
                
            }
            $TimeCode = implode(",", $TimeCode);
            $whereDf[] = "(recruits.jobtime1_code in ({$TimeCode}) or
            recruits.jobtime2_code in ({$TimeCode}) or
            recruits.jobtime3_code in ({$TimeCode}) or
            recruits.jobtime4_code in ({$TimeCode}))";
        }

        //特長
        if(!empty($_["w_fea"])){
            $pmsFeaLi = $_["w_fea"];
            $FeaCode = array();
            
            foreach($pmsFeaLi as $val){
                if(!empty($val)){
                    $FeaCode[] = DB::quote($val);
                }
                
            }
            $FeaWhere = "(";
            foreach($FeaCode as $k => $v){
                $FeaWhere .= ($k!=0)?" or ":"";
                $FeaWhere .= "find_in_set({$v}, recruits.feature_codes)";
            }
            $FeaWhere .= ")";
            $whereDf[] = $FeaWhere;
        }
        
        //フリーワード
        if(!empty($_["w_word"])){
            $pmsWord = urldecode($_["w_word"]);
            $pmsWordLi = srcMix($pmsWord);
            $pmsWord = implode(" ",$pmsWordLi);
            
            $where_nm = array();
            foreach($pmsWordLi as $key => $val){
                if(!empty($val)){
                    $where_nm[] = $val;
                }
                
            }
        
        }
                
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_sort"])){
            $orderby = "recruits.sort {$od},";
        }
        if(!empty($_["o_id"])){
            $orderby = "recruits.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "recruits.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "recruits.created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "recruits.updated {$od},";
        }
                
        $un = array();
        foreach($where_nm as $val){


           $whereDt = $where;
           $whereSationDt = $whereSation;
           $wherePrefDt = $wherePref;
           $whereCateDt = $whereCate;
           $whereServiceDt = $whereService;
           $whereFeatureDt = $whereFeature;
           $whereJobtimeDt = $whereJobtime;
           $whereJobdayDt  = $whereJobday;
           $whereJobweekDt = $whereJobweek;
           $whereJobtypeDt = $whereJobtype;
           
           if(!empty($_["w_word"])){
           
                $whereWord = "(";
                $nm = 0;
                foreach(Data::recruitsColumnLikes() as $key2 => $c){
                    if(preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits.staffname" ||
                    $c == "recruits.tel"
                    )
                    ){
                    
                    } else if(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits.company" ||
                    $c == "recruits.shop" 
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case {$c}_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } else {
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= " {$c} like '".$pmsQt."'";
                        $nm ++;
                    }
                }
                $whereWord .= ")";
                
                $whereWordSation = " concat(_stcompany.company_name,_line.line_name,_station.station_name)  like '".$pmsQt."'";
                $whereWordPref   = " concat(_prefectures.name,_address.city)  like '".$pmsQt."'";
                $whereWordCate   = " jobCategories.name  like '".$pmsQt."'";
                $whereWordService   = " jobServices.name  like '".$pmsQt."'";
                $whereWordFeature   = " jobFeatures.name  like '".$pmsQt."'";
                $whereWordJobtime   = " jobtimes.name  like '".$pmsQt."'";
                $whereWordJobday   = " jobdays.name  like '".$pmsQt."'";
                $whereWordJobweek   = " jobweeks.name  like '".$pmsQt."'";
                $whereWordJobtype   = " jobtypes.name  like '".$pmsQt."'";
                
                $where[] = $whereWord;
                $whereSationDt[] = $whereWordSation;
                $wherePrefDt[] = $whereWordPref;
                $whereCateDt[] = $whereWordCate;
                $whereServiceDt[] = $whereWordService;
                $whereFeatureDt[] = $whereWordFeature;
                $whereJobtimeDt[] = $whereWordJobtime;
                $whereJobdayDt[] =  $whereWordJobday;
                $whereJobweekDt[] = $whereWordJobweek;
                $whereJobtypeDt[] = $whereWordJobtype;
                
            }

            $whereDfStr = implode(" and ", $whereDf);
            $whereDfStr = (!empty($whereDfStr))?"where {$whereDfStr}":"";
            
            $whereStr = implode(" and ", $where);
            $whereStr = (!empty($whereStr))?"where {$whereStr}":"";

            $whereSationStr = implode(" and ", $whereSationDt);
            $whereSationStr = (!empty($whereSationStr))?"where {$whereSationStr}":"";

            $wherePrefStr = implode(" and ", $wherePrefDt);
            $wherePrefStr = (!empty($wherePrefStr))?"where {$wherePrefStr}":"";

            $whereCateStr = implode(" and ", $whereCateDt);
            $whereCateStr = (!empty($whereCateStr))?"where {$whereCateStr}":"";

            $whereServiceStr = implode(" and ", $whereServiceDt);
            $whereServiceStr = (!empty($whereServiceStr))?"where {$whereServiceStr}":"";

            $whereFeatureStr = implode(" and ", $whereFeatureDt);
            $whereFeatureStr = (!empty($whereFeatureStr))?"where {$whereFeatureStr}":"";

            $whereJobtimeStr = implode(" and ", $whereJobtimeDt);
            $whereJobtimeStr = (!empty($whereJobtimeStr))?"where {$whereJobtimeStr}":"";

            $whereJobdayStr = implode(" and ", $whereJobdayDt);
            $whereJobdayStr = (!empty($whereJobdayStr))?"where {$whereJobdayStr}":"";

            $whereJobweekStr = implode(" and ", $whereJobweekDt);
            $whereJobweekStr = (!empty($whereJobweekStr))?"where {$whereJobweekStr}":"";

            $whereJobtypeStr = implode(" and ", $whereJobtypeDt);
            $whereJobtypeStr = (!empty($whereJobtypeStr))?"where {$whereJobtypeStr}":"";
            
            //検索条件
            $un[] = "
            select id from recruits {$whereStr}

            union (
            select id from (
            select recruits.id from recruits inner join _station  on _station.station_cd = recruits.st1_code inner join _line  on _station.line_cd = _line.line_cd inner join _stcompany  on _line.company_cd = _stcompany.company_cd {$whereSationStr}
            union select recruits.id from recruits inner join _station  on _station.station_cd = recruits.st2_code inner join _line  on _station.line_cd = _line.line_cd inner join _stcompany  on _line.company_cd = _stcompany.company_cd {$whereSationStr}
            union select recruits.id from recruits inner join _station  on _station.station_cd = recruits.st3_code inner join _line  on _station.line_cd = _line.line_cd inner join _stcompany  on _line.company_cd = _stcompany.company_cd {$whereSationStr}
            union select recruits.id from recruits inner join _station  on _station.station_cd = recruits.st4_code inner join _line  on _station.line_cd = _line.line_cd inner join _stcompany  on _line.company_cd = _stcompany.company_cd {$whereSationStr}
            union select recruits.id from recruits inner join _station  on _station.station_cd = recruits.st5_code inner join _line  on _station.line_cd = _line.line_cd inner join _stcompany  on _line.company_cd = _stcompany.company_cd {$whereSationStr}
            ) a1 )

            union
            
            select recruits.id from (recruits inner join _prefectures  on _prefectures.id = recruits.pref_code)
            inner join
            _address on _address.id = recruits.city_code
            {$wherePrefStr}

            union

            select recruits.id from recruits
            inner join jobCategories
            on find_in_set(jobCategories.id, recruits.cate_codes)
            {$whereCateStr}

            union

            select recruits.id from recruits
            inner join jobServices
            on jobServices.id = recruits.service_code
            {$whereServiceStr}

            union

            select recruits.id from recruits
            inner join jobFeatures
            on find_in_set(jobFeatures.id, recruits.feature_codes)
            {$whereFeatureStr}

            union

            select recruits.id from recruits
            inner join jobtimes
            on jobtimes.id in (recruits.jobtime1_code,recruits.jobtime2_code,recruits.jobtime3_code,recruits.jobtime4_code)
            {$whereJobtimeStr}
            
            union

            select recruits.id from recruits
            inner join jobdays
            on find_in_set(jobdays.id, recruits.jobday_codes)
            {$whereJobdayStr}

            union

            select recruits.id from recruits
            inner join jobweeks
            on find_in_set(jobweeks.id, recruits.jobweek_codes)
            {$whereJobweekStr}

            union

            select recruits.id from recruits
            inner join jobtypes
            on find_in_set(jobtypes.id, recruits.jobtype_codes)
            {$whereJobtypeStr}
            
            ";

        
        }
        
        
        //複数検索分岐
        if(count($where_nm)==1){
        
            $sql = "
            select
                sql_calc_found_rows
                {$clm}
            from
                recruits inner join
                (
                    select id from
                        (
                            {$un[0]}

                        ) uniontb
                    group by id
                ) other on
                    recruits.id = other.id
            {$whereDfStr}
             order by {$orderby} recruits.startdate desc, recruits.updated desc, recruits.id desc
            {$limit}
            ";
            
        } else {
            
            $nm = count($where_nm);
            $lastnm = $nm-1;
            
            $sql = "
            select
                sql_calc_found_rows
                {$clm}
            from
                recruits inner join
                (

                    select id from
                        (
                            ";

                            foreach($un as $k => $v){
                                $sql .= "
                                select id from
                                (
                                {$v}
                                ) union{$k}
                                ";

                                if($k!=$lastnm){
                                    $sql .="
                                    union all
                                    ";
                                }
                            }

                    $sql .= "
                        ) union{$nm}
                    group by id
                    having count(*) = {$nm}
        
                ) other on
                    recruits.id = other.id
            {$whereDfStr}
             order by {$orderby} id desc
            {$limit}
            ";
        
        
        }
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }


    //求人更新日
    function recruitsUpdate($_=array(
    "w_id"=>""
    )) {

        $clm = "*";

        $where = array();

        if(is_array($_["w_id"])){
            $ids = array();
            foreach($_["w_id"] as $v){
               $ids[] = DB::quote($v);
            }
            if(
            $ids = implode(",", $ids)
            ){
                $where[] = "recruit_id in ({$ids})";
            }
        } elseif(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "recruit_id = {$id}";
        }
        
        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        $sql = "select
        sql_calc_found_rows
        {$clm}
        from recruitsUpdate
        {$where}
        order by id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }
        

    //応募者情報
    function apply($_=array(
    's'=>'',
    'w_siteid'=>'',
    'w_id'=>'',
    'w_recid'=>'',
    'w_section1'=>'',
    'w_section2'=>'',
    'w_except'=>'',
    'w_status'=>'',
    'w_pref'=>'',
    'w_tel'=>'',
    'w_mail'=>'',
    'w_name'=>'',
    'w_type'=>'',
    'w_createdFrom'=>'',
    'w_createdTo'=>'',
    'w_deleted'=>'',
    'o_sort'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_created'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "
            apply.id ,
            apply.family_name,
            apply.first_name,
            apply.family_name_kana,
            apply.first_name_kana,
            apply.tel1,
            apply.tel2,
            apply.tel3,
            apply.tel3,
            apply.prefecture,
            apply.mail,
            apply.created,
            apply.recruit_id,
            apply.status,site_id
            ";
        } else {
            $clm = "
            apply.id ,
            apply.family_name,
            apply.first_name,
            apply.family_name_kana,
            apply.first_name_kana,
            apply.sex,
            apply.birth_year,
            apply.birth_month,
            apply.birth_day,
            apply.prefecture,
            apply.address,
            apply.tel1,
            apply.tel2,
            apply.tel3,
            apply.mail,
            apply.message,
            apply.skill,
            apply.skillother,
            apply.hopesalary,
            apply.hopeprefecture1,
            apply.hopeprefecture2,
            apply.scout,
            apply.pr,
            apply.updated,
            apply.created,
            apply.deleted,
            apply.recruit_id,
            apply.site_id,
            apply.status,
            apply.device
            ";
        }

        $where = array();

        if(empty($_["w_deleted"])){
            $where[] = "apply.deleted = ''";
        }

        if(!empty($_["w_siteid"])){
            $siteid = DB::quote($_["w_siteid"]);
            $where[] = "apply.site_id = {$siteid}";
        }
        
        if(is_array($_["w_id"])){
            $ids = array();
            foreach($_["w_id"] as $v){
               $ids[] = DB::quote($v);
            }
            if(
            $ids = implode(",", $ids)
            ){
                $where[] = "apply.id in ({$ids})";
            }
        } elseif(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "apply.id = {$id}";
        }
        if(!empty($_["w_recid"])){

            if(is_array($_["w_recid"])){
                $ids = array();
                foreach($_["w_recid"] as $v){
                   $ids[] = DB::quote($v);
                }
                $ids = implode(",", $ids);
                $where[] = "apply.recruit_id in ({$ids})";
            
            } else {
                $recid = DB::quote($_["w_recid"]);
                $where[] = "apply.recruit_id = {$recid}";
            }
            
        }
       
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "apply.status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "apply.status = {$status}";
            }
        }
        if(!empty($_["w_pref"])){
            $v = DB::quote($_["w_pref"]);
            $where[] = "apply.prefecture = {$v}";
        }

        if(!empty($_["w_tel"])){
            $v = $_["w_tel"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " concat(apply.tel1, apply.tel2, apply.tel3) like '".$pmsQt."'";
        }

        if(!empty($_["w_mail"])){
            $v = $_["w_mail"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " apply.mail like '".$pmsQt."'";
        }
        
        if(!empty($_["w_name"])){
            $v = $_["w_name"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " (concat(apply.family_name, apply.first_name) like '".$pmsQt."' or concat(apply.family_name_kana, apply.first_name_kana)  like '".$pmsQt."')";
        }
        
        $whereDf = "";
        $whereHn = "";
        $whereCc = "";
        if(!empty($_["w_type"])){
            $pmsTypeLi = $_["w_type"];
            $TypeCode = array();
            
            foreach($pmsTypeLi as $val){
                if(!empty($val)){
                    $TypeCode[] = DB::quote($val);
                }
                
            }
            $TypeWhere = "(";
            $TypeWhere_hn = "(";
            $TypeWhere_cc = "(";
            foreach($TypeCode as $k => $v){
                $TypeWhere .= ($k!=0)?" or ":"";
                $TypeWhere .= "find_in_set({$v}, recruits.jobtype_codes)";

                $TypeWhere_hn .= ($k!=0)?" or ":"";
                $TypeWhere_hn .= "find_in_set({$v}, recruits_HN.jobtype_codes)";

                $TypeWhere_cc .= ($k!=0)?" or ":"";
                $TypeWhere_cc .= "find_in_set({$v}, recruits_CC.jobtype_codes)";
                
            }
            $TypeWhere .= ")";
            $TypeWhere_hn .= ")";
            $TypeWhere_cc .= ")";

            $whereDf = "and ".$TypeWhere;
            $whereHn = "and ".$TypeWhere_hn;
            $whereCc = "and ".$TypeWhere_cc;

        
        }

        if(!empty($_["w_section2"])){
            $whereDf .= " and ";
            $whereHn .= " and ";
            $whereCc .= " and ";
            
            if(is_array($_["w_section2"])){
                $ids = array();
                foreach($_["w_section2"] as $v){
                   $ids[] = DB::quote($v);
                }
                $ids = implode(",", $ids);
                
                $whereDf .= "recruits.section2 in ({$ids})";
                $whereHn .= "recruits_HN.section2 in ({$ids})";
                $whereCc .= "recruits_CC.section2 in ({$ids})";
                

            } else {
                $id = DB::quote($_["w_section2"]);

                $whereDf .= "recruits.section2 = {$id}";
                $whereHn .= "recruits_HN.section2 = {$id}";
                $whereCc .= "recruits_CC.section2 = {$id}";
                

            }
        }
        
        
        if(!empty($_["w_except"])){
            $whereDf .= " and ";
            $whereHn .= " and ";
            $whereCc .= " and ";

            $ids = array();
            foreach($_["w_except"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            
            $whereDf .= "recruits.section2 not in ({$ids})";
            $whereHn .= "recruits_HN.section2 not in ({$ids})";
            $whereCc .= "recruits_CC.section2 not in ({$ids})";
                
        }
        
        if(!empty($_["w_createdFrom"])){
            $v = DB::quote($_["w_createdFrom"]);
            $where[] = "apply.created >= {$v}";
        }
        if(!empty($_["w_createdTo"])){
            $_["w_createdTo"] = $_["w_createdTo"]." 23:59:59";
            $v = DB::quote($_["w_createdTo"]);
            $where[] = "apply.created <= {$v}";
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "apply.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "apply.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "apply.created {$od},";
        }
        
        $sql = "
        select
        sql_calc_found_rows
        {$clm}
        from apply
        inner join (

             select id from
            (
            select
            apply.id
            from apply left outer join recruits on
            (apply.site_id = 1 and apply.recruit_id = recruits.id)
            {$where} {$whereDf}
            
            union
            
            select
            apply.id
            from apply left outer join recruits_HN on
            (apply.site_id = 2 and apply.recruit_id = recruits_HN.id)
            {$where} {$whereHn}

            union
            
            select
            apply.id
            from apply left outer join recruits_CC on
            (apply.site_id = 3 and apply.recruit_id = recruits_CC.id)
            {$where} {$whereCc}
            
            )
            uniontb group by id
        
        ) other on apply.id  = other.id
        order by {$orderby} apply.id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }


    //登録会応募者情報
    function entry($_=array(
    's'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_formid'=>'',
    'w_siteid'=>'',
    'w_pref'=>'',
    'w_tel'=>'',
    'w_mail'=>'',
    'w_name'=>'',
    'w_createdFrom'=>'',
    'w_createdTo'=>'',
    'w_deleted'=>'',
    'o_sort'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_created'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,family_name,first_name,family_name_kana,first_name_kana,tel1,tel2,tel3,tel3,prefecture,mail,created,status,form_id";
        } else {
            $clm = "*";
        }

        $where = array();

        if(empty($_["w_deleted"])){
            $where[] = "deleted = ''";
        }
        
        if(is_array($_["w_id"])){
            $ids = array();
            foreach($_["w_id"] as $v){
               $ids[] = DB::quote($v);
            }
            if(
            $ids = implode(",", $ids)
            ){
                $where[] = "id in ({$ids})";
            }
        } elseif(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        if(!empty($_["w_formid"])){
            $id = DB::quote($_["w_formid"]);
            $where[] = "form_id = {$id}";
        }
        
        if(!empty($_["w_siteid"])){
            if($_["w_siteid"]==1){
                $where[] = "siteid in ('0','1')";
            } else {
                $siteid = DB::quote($_["w_siteid"]);
                $where[] = "siteid = {$siteid}";
            };
        }

        if(!empty($_["w_pref"])){
            $v = DB::quote($_["w_pref"]);
            $where[] = "prefecture = {$v}";
        }

        if(!empty($_["w_tel"])){
            $v = $_["w_tel"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " concat(tel1,tel2,tel3) like '".$pmsQt."'";
        }

        if(!empty($_["w_mail"])){
            $v = $_["w_mail"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " mail like '".$pmsQt."'";
        }

        if(!empty($_["w_name"])){
            $v = $_["w_name"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " (concat(family_name,first_name) like '".$pmsQt."' or concat(family_name_kana,first_name_kana)  like '".$pmsQt."')";
        }
        
        if(!empty($_["w_createdFrom"])){
            $v = DB::quote($_["w_createdFrom"]);
            $where[] = "created >= {$v}";
        }
        if(!empty($_["w_createdTo"])){
            $_["w_createdTo"] = $_["w_createdTo"]." 23:59:59";
            $v = DB::quote($_["w_createdTo"]);
            $where[] = "created <= {$v}";
        }

        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "created {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from entry
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }

    //登録会
    function entryForm($_=array(
    's'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_name'=>'',
    'w_deleted'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_created'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,status,division,siteid";
        } else {
            $clm = "*";
        }

        $where = array();

        if(empty($_["w_deleted"])){
            $where[] = "deleted = ''";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_siteid"])){
            $id = DB::quote($_["w_siteid"]);
            $where[] = "siteid = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }
        if(!empty($_["w_name"])){
            $v = $_["w_name"];
            $pmsQt = "%".dbLikeEsc($v)."%";
            $where[] = " name like '".$pmsQt."'";
        }
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "created {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from entryForm
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }

    //管理者
    function manage($_=array(
    's'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_level'=>'',
    'w_section1'=>'',
    'w_section2'=>'',
    'w_deleted'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_level'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "id,name,status,section1,section2,level,authority";
        } else {
            $clm = "*";
        }

        $where = array();

        
        if(empty($_["w_deleted"])){
            $where[] = "deleted = ''";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "id = {$id}";
        }
        if(!empty($_["w_status"])){
            if(is_array($_["w_status"])){
                $pmsStatusLi = $_["w_status"];
                $StatusCode = array();
                
                foreach($pmsStatusLi as $val){
                    if(isset($val)){
                        $StatusCode[] = DB::quote($val);
                    }
                    
                }
                $StatusWhere = "(";
                foreach($StatusCode as $k => $v){
                    $StatusWhere .= ($k!=0)?" or ":"";
                    $StatusWhere .= "status = {$v}";
                }
                $StatusWhere .= ")";
                $where[] = $StatusWhere;
            } else {
                $status = DB::quote($_["w_status"]);
                $where[] = "status = {$status}";
            }
        }

        if(!empty($_["w_level"])){
            if(is_array($_["w_level"])){
                $pmsLevelLi = $_["w_level"];
                $LevelCode = array();
                
                foreach($pmsLevelLi as $val){
                    if(isset($val)){
                        $LevelCode[] = DB::quote($val);
                    }
                    
                }
                $LevelWhere = "(";
                foreach($LevelCode as $k => $v){
                    $LevelWhere .= ($k!=0)?" or ":"";
                    $LevelWhere .= "level = {$v}";
                }
                $LevelWhere .= ")";
                $where[] = $LevelWhere;
            } else {
                $level = DB::quote($_["w_level"]);
                $where[] = "level = {$level}";
            }
        }
        
        if(!empty($_["w_section1"])){
            $section1 = DB::quote($_["w_section1"]);
            $where[] = "section1 = {$section1}";
        }
        if(!empty($_["w_section2"])){
            $section2 = DB::quote($_["w_section2"]);
            $where[] = "section2 = {$section2}";
        }
        $where = implode(" and ", $where);
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }

        if(!empty($_["os_asc"])){
            $od = "asc";
        } else {
            $od = "desc";
        }
        
        $orderby = "";
        if(!empty($_["o_id"])){
            $orderby = "id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "status {$od},";
        }
        if(!empty($_["o_level"])){
            $orderby = "level {$od},";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from admin
        {$where}
        order by {$orderby} id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }
    
    //サイト設定
    function siteSet($_=array()) {

        $sql = "select
        *
        from site";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d = $r;
            }
        }
        
        return $d;
    }


    //SEOテキスト
    function seo($_=array(
    "w_pref"=>"",
    "w_city"=>""
    )) {

        $where = array();

        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "replace(replace(prefecture,' ',''),'　','') = {$pref}";
        }

        if(!empty($_["w_city"])){
            $city = DB::quote($_["w_city"]);
            $where[] = "replace(replace(city,' ',''),'　','') = {$city}";
        } else {
            $where[] = "city = ''";
        }
        
        $where = implode(" and ", $where);
        $where = (!empty($where))?"where {$where}":"";

        $sql = "select
        sql_calc_found_rows
        *
        from seo
        {$where}
        order by id desc
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }


    //ハローワーク求人
    function recruits_HW($_=array(
    'id'=>'',
    's'=>'',
    'w_id'=>'',
    'w_status'=>'',
    'w_statuses'=>'',
    'w_pref'=>'',
    'w_city'=>'',
    'o_rand'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "hw_id as id,
            hw_status as status,
            hw_code as code,
            hw_title as title,
            hw_category as category,
            hw_pref_code as pref_code,
            hw_city_code as city_code,
            hw_industry as industry,
            hw_contents as contents,
            hw_business as business,
            hw_salary as salary,
            hw_jobtype as jobtype,
            hw_time as time";
        } else {
            $clm = "*";
        }

        $where = array();
        if(!empty($_["id"])){
            $id = DB::quote($_["id"]);
            $where[] = "hw_id = {$id}";
        }
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $where[] = "hw_id = {$id}";
        }
        if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $where[] = " hw_status = {$status}";
        }
        if(!empty($_["w_statuses"])){
            $pmsStatusLi = $_["w_statuses"];
            $StatusCode = array();
            
            foreach($pmsStatusLi as $val){
                if(!empty($val)){
                    $StatusCode[] = DB::quote($val);
                }
                
            }
            $StatusWhere = "(";
            foreach($StatusCode as $k => $v){
                $StatusWhere .= ($k!=0)?" or ":"";
                
                if($v!="'1'"){
                    $StatusWhere .= "hw_status != '1'";
                } else {
                    $StatusWhere .= "hw_status = {$v}";
                }
            }
            $StatusWhere .= ")";
            $where[] = $StatusWhere;
        }
        if(!empty($_["w_pref"])){
            $pref = DB::quote($_["w_pref"]);
            $where[] = "hw_pref_code = {$pref}";
        }

        if(!empty($_["w_city"])){
            $city = DB::quote($_["w_city"]);
            $where[] = "hw_city_code = {$city}";
        }
        
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $where[] = "(hw_deleted >= {$now} or hw_deleted = '' )";
        }
        
        $orderby = "";
        if(!empty($_["o_rand"])){
            $orderby = "rand(),";
        }
        
        
        $where = implode(" and ", $where);
        
        
        $where = (!empty($where))?"where {$where}":"";
        
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from recruits_hellowork
        {$where}
        order by {$orderby} hw_id desc
        {$limit}
        ";
        
        $d = array();
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d[$r["id"]] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            Data::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["hw_id"]])?$d[$_["hw_id"]]:"";
         }
     
        return $d;
    }
    
}

