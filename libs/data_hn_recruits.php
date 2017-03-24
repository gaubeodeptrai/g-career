<?php

class DataHnRec{

    public static $dataTotal    = ""; //トータル件数
    
    //求人
    function recruits($_=array(
    'id'=>'',
    'ids'=>'',
    'no_ids'=>'',
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
            $clm = "id,title,pre_id";
        } else if(!empty($_["s"])){
            $clm = "id,title,city_code,pref_code,st1_code,st2_code,st3_code,st4_code,st5_code,industry_code,cate_codes,exp_flg,skill_flg,jobtype_codes,
            jobday_codes,feature_codes,city_code,section1,section2,startdate,salarytime_low";
        } else {
            $clm = "*";
        }

        $where = array();
        if(!empty($_["id"])){
            $id = DB::quote($_["id"]);
            $where[] = "id = {$id}";
        }

        if(!empty($_["no_ids"])){
            $ids = array();
            foreach($_["no_ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $where[] = "id not in ({$ids})";
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
        from recruits_HN
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
            DataHnRec::$dataTotal = $row_ct["ct"];
            
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
       $txt = "recruits_HN.title
recruits_HN.catchcopy
recruits_HN.pic1cap
recruits_HN.pic2cap
recruits_HN.pic3cap
recruits_HN.busetc
recruits_HN.jobway
recruits_HN.jobday
recruits_HN.jobweek
recruits_HN.contents
recruits_HN.exp
recruits_HN.skill
recruits_HN.salarytime_low
recruits_HN.salarytime_high
recruits_HN.salary
recruits_HN.welfare
recruits_HN.holiday
recruits_HN.other
recruits_HN.flow";

       
       //adminだけ、もしくは、フラグ判別
       $txt .= "
recruits_HN.company
recruits_HN.shopname
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
    'w_type'=>'',
    'w_ind'=>'',
    'w_day'=>'',
    'w_fea'=>'',
    'w_word'=>'',
    'w_section1'=>'',
    'w_section2'=>'',
    'w_deleted'=>'',
    'o_sort'=>'',
    'o_id'=>'',
    'o_status'=>'',
    'o_created'=>'',
    'o_updated'=>'',
    'os_desc'=>'',
    'os_asc'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["s"])){
            $clm = "
            recruits_HN.id,
            recruits_HN.title,
            recruits_HN.industry_code,
            recruits_HN.cate_codes,
            recruits_HN.jobtype_codes,
            recruits_HN.pref_code,
            recruits_HN.city_code,
            recruits_HN.st1_code,
            recruits_HN.st2_code,
            recruits_HN.st3_code,
            recruits_HN.st4_code,
            recruits_HN.st5_code,
            recruits_HN.st1out,
            recruits_HN.st1way_code,
            recruits_HN.st1bustime,
            recruits_HN.st1bus,
            recruits_HN.st1walktime,
            recruits_HN.st2out,
            recruits_HN.st2way_code,
            recruits_HN.st2bustime,
            recruits_HN.st2bus,
            recruits_HN.st2walktime,
            recruits_HN.st3out,
            recruits_HN.st3way_code,
            recruits_HN.st3bustime,
            recruits_HN.st3bus,
            recruits_HN.st3walktime,
            recruits_HN.st4out,
            recruits_HN.st4way_code,
            recruits_HN.st4bustime,
            recruits_HN.st4bus,
            recruits_HN.st4walktime,
            recruits_HN.st5out,
            recruits_HN.st5way_code,
            recruits_HN.st5bustime,
            recruits_HN.st5bus,
            recruits_HN.st5walktime,
            recruits_HN.busetc,
            recruits_HN.jobway,
            recruits_HN.salarytime_low,
            recruits_HN.salarytime_high,
            recruits_HN.salary,
            recruits_HN.salary_flg,
            recruits_HN.jobday_codes,
            recruits_HN.jobday,
            recruits_HN.jobweek_codes,
            recruits_HN.feature_codes,
            recruits_HN.pic1_code,
            recruits_HN.pic1_flg,
            recruits_HN.pic2_code,
            recruits_HN.pic2_flg,
            recruits_HN.pic3_code,
            recruits_HN.pic3_flg,
            recruits_HN.startdate
            ";
        } else {
            $clm = "
            recruits_HN.id,
            recruits_HN.status,
            recruits_HN.sort,
            recruits_HN.section1,
            recruits_HN.section2,
            recruits_HN.startdate,
            recruits_HN.industry_code,
            recruits_HN.cate_codes,
            recruits_HN.company_flg,
            recruits_HN.company,
            recruits_HN.address_flg,
            recruits_HN.address,
            recruits_HN.pref_code,
            recruits_HN.city_code,
            recruits_HN.st1_code,
            recruits_HN.st2_code,
            recruits_HN.st3_code,
            recruits_HN.st4_code,
            recruits_HN.st5_code,
            recruits_HN.st1out,
            recruits_HN.st1way_code,
            recruits_HN.st1bustime,
            recruits_HN.st1bus,
            recruits_HN.st1walktime,
            recruits_HN.st2out,
            recruits_HN.st2way_code,
            recruits_HN.st2bustime,
            recruits_HN.st2bus,
            recruits_HN.st2walktime,
            recruits_HN.st3out,
            recruits_HN.st3way_code,
            recruits_HN.st3bustime,
            recruits_HN.st3bus,
            recruits_HN.st3walktime,
            recruits_HN.st4out,
            recruits_HN.st4way_code,
            recruits_HN.st4bustime,
            recruits_HN.st4bus,
            recruits_HN.st4walktime,
            recruits_HN.st5out,
            recruits_HN.st5way_code,
            recruits_HN.st5bustime,
            recruits_HN.st5bus,
            recruits_HN.st5walktime,
            recruits_HN.busetc,
            recruits_HN.jobway,
            recruits_HN.othercond,
            recruits_HN.salarytime_low,
            recruits_HN.salarytime_high,
            recruits_HN.salary,
            recruits_HN.salary_flg,
            recruits_HN.feature_codes,
            recruits_HN.jobday_codes,
            recruits_HN.jobday,
            recruits_HN.jobtime,
            recruits_HN.jobweek_codes,
            recruits_HN.jobweek,
            recruits_HN.jobtype_codes,
            recruits_HN.contents,
            recruits_HN.exp_flg,
            recruits_HN.exp,
            recruits_HN.skill_flg,
            recruits_HN.skill,
            recruits_HN.welfare,
            recruits_HN.holiday,
            recruits_HN.other,
            recruits_HN.flow,
            recruits_HN.title,
            recruits_HN.catchcopy,
            recruits_HN.catchcopy_flg,
            recruits_HN.text,
            recruits_HN.text_flg,
            recruits_HN.pic1_code,
            recruits_HN.pic1cap,
            recruits_HN.pic1_flg,
            recruits_HN.pic1cap_flg,
            recruits_HN.pic2_code,
            recruits_HN.pic2cap,
            recruits_HN.pic2_flg,
            recruits_HN.pic2cap_flg,
            recruits_HN.pic3_code,
            recruits_HN.pic3cap,
            recruits_HN.pic3_flg,
            recruits_HN.pic3cap_flg,
            recruits_HN.jobstatus,
            recruits_HN.tag_title,
            recruits_HN.tag_description,
            recruits_HN.tag_keywords,
            recruits_HN.updated,
            recruits_HN.created,
            recruits_HN.deleted,
            recruits_HN.editor_first,
            recruits_HN.editor_last,
            recruits_HN.shopname,
            recruits_HN.chart1,
            recruits_HN.chart2,
            recruits_HN.chart3,
            recruits_HN.chart4,
            recruits_HN.chart5,
            recruits_HN.ap_shoptype,
            recruits_HN.ap_brand,
            recruits_HN.ap_brand_flg,
            recruits_HN.ap_salary_flg,
            recruits_HN.siteid,
            recruits_HN.pre_id,
            recruits_HN.pre_editor_first,
            recruits_HN.pre_editor_last,
            recruits_HN.pre_effect,
            recruits_HN.pre_name,
            recruits_HN.pre_cate,
            recruits_HN.pre_salarygp,
            recruits_HN.pre_free,
            recruits_HN.pre_comment
            ";
        }

        $where_nm = array("1");
        $where = array();
        $whereDf = array();
        $whereSation = array();
        $wherePref = array();
        $whereCate = array();
        $whereIndustry = array();
        $whereFeature = array();
        $whereJobday = array();
        $whereJobweek = array();
        $whereJobtype = array();

        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $whereDf[] = "recruits_HN.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $whereDf[] = "recruits_HN.id = {$id}";
        }
        if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $whereDf[] = "recruits_HN.status = {$status}";
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
                $StatusWhere .= "recruits_HN.status = {$v}";
            }
            $StatusWhere .= ")";
            $whereDf[] = $StatusWhere;
        }
        
        if(!empty($_["w_startdate"])){
            $startdate = DB::quote($_["w_startdate"]);
            $whereDf[] = "recruits_HN.startdate <= {$startdate}";
        }

        if(!empty($_["w_section1"])){
            $section1 = DB::quote($_["w_section1"]);
            $whereDf[] = "recruits_HN.section1 = {$section1}";
        }
        if(!empty($_["w_section2"])){
            $section2 = DB::quote($_["w_section2"]);
            $whereDf[] = "recruits_HN.section2 = {$section2}";
        }
        
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $whereDf[] = "(recruits_HN.deleted >= {$now} or recruits_HN.deleted = '' )";
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
            $whereDf[] = "recruits_HN.pref_code in ($PrefCode)";
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
            $whereDf[] = "recruits_HN.city_code in ($CityCode)";
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
            $whereDf[] = "(recruits_HN.st1_code in ($StaCode) or
            recruits_HN.st2_code in ($StaCode) or
            recruits_HN.st3_code in ($StaCode) or
            recruits_HN.st4_code in ($StaCode) or
            recruits_HN.st5_code in ($StaCode))";
        }

        //業種
        if(!empty($_["w_ind"])){
            $pmsIndLi = $_["w_ind"];
            $IndCode = array();
            
            foreach($pmsIndLi as $val){
                if(!empty($val)){
                    $IndCode[] = DB::quote($val);
                }
                
            }
            $IndWhere = "(";
            foreach($IndCode as $k => $v){
                $IndWhere .= ($k!=0)?" or ":"";
                $IndWhere .= "find_in_set({$v}, recruits_HN.industry_code)";
            }
            $IndWhere .= ")";
            $whereDf[] = $IndWhere;
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
                $CateWhere .= "find_in_set({$v}, recruits_HN.cate_codes)";
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
                $TypeWhere .= "find_in_set({$v}, recruits_HN.jobtype_codes)";
            }
            $TypeWhere .= ")";
            $whereDf[] = $TypeWhere;
        }

        //給与
        if(!empty($_["w_salary"])){
            $pmsSalaryLi = $_["w_salary"];
            $SalaryCode = array();
            
            foreach($pmsSalaryLi as $val){
                if(!empty($val)){
                    $SalaryCode[] = DB::quote($val);
                }
                
            }
            $SalaryWhere = "(";
            foreach($SalaryCode as $k => $v){
                $SalaryWhere .= ($k!=0)?" or ":"";
                $SalaryWhere .= "({$v} <= recruits_HN.salarytime_low)";
            }
            $SalaryWhere .= ")";
            $whereDf[] = $SalaryWhere;
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
                $DayWhere .= "find_in_set({$v}, recruits_HN.jobday_codes)";
            }
            $DayWhere .= ")";
            $whereDf[] = $DayWhere;
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
                $FeaWhere .= "find_in_set({$v}, recruits_HN.feature_codes)";
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
            if($_["o_sort"]=="new1"){
                $orderby = "recruits_HN.startdate desc,";
            } elseif($_["o_sort"]=="salary1"){
                $orderby = "recruits_HN.salarytime_low desc,";
            } elseif($_["o_sort"]=="way1"){
                $orderby = "recruits_HN.st1walktime asc,";
            } else {
                $orderby = "recruits_HN.sort {$od},";
            }
        }
        if(!empty($_["o_id"])){
            $orderby = "recruits_HN.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "recruits_HN.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "recruits_HN.created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "recruits_HN.updated {$od},";
        }
                
        $un = array();
        
        foreach($where_nm as $val){


           $whereDt = $where;
           $whereSationDt = $whereSation;
           $wherePrefDt = $wherePref;
           $whereCateDt = $whereCate;
           $whereIndustryDt = $whereIndustry;
           $whereFeatureDt = $whereFeature;
           $whereJobdayDt  = $whereJobday;
           $whereJobweekDt = $whereJobweek;
           $whereJobtypeDt = $whereJobtype;
           
           if(!empty($_["w_word"])){
           
                $whereWord = "(";
                $nm = 0;
                foreach(DataHnRec::recruitsColumnLikes() as $key2 => $c){
                    if(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_HN.company"
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case {$c}_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } elseif(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_HN.salary" or
                    $c == "recruits_HN.salarytime_low" or
                    $c == "recruits_HN.salarytime_high"
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case salary_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } else {
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= " {$c} like '".$pmsQt."'";
                        
                        $nm ++;
                    }
                }

                if(preg_match("/円/u", $val, $match)){
                    $whereWord .= ($nm!=0)?" or ":"";
                    $val = substr($val, 0, strcspn($val,'円'));
                    $pmsQt = "%".dbLikeEsc($val)."%";
                    $whereWord .= " recruits_HN.salarytime_low like '".$pmsQt."'";
                }
                        
                $whereWord .= ")";
                
                $whereWordSation = " concat(_stcompany.company_name,_line.line_name,_station.station_name)  like '".$pmsQt."'";
                $whereWordPref   = " concat(_prefectures.name,_address.city)  like '".$pmsQt."'";
                $whereWordCate   = " jobCategories_HN.name  like '".$pmsQt."'";
                $whereWordIndustry   = " jobIndustry_HN.name  like '".$pmsQt."'";
                $whereWordFeature   = " jobFeatures_HN.name  like '".$pmsQt."'";
                $whereWordJobday   = " jobdays.name  like '".$pmsQt."'";
                $whereWordJobweek   = " jobweeks.name  like '".$pmsQt."'";
                $whereWordJobtype   = " jobtypes.name  like '".$pmsQt."'";
                
                $where[] = $whereWord;
                $whereSationDt[] = $whereWordSation;
                $wherePrefDt[] = $whereWordPref;
                $whereCateDt[] = $whereWordCate;
                $whereIndustryDt[] = $whereWordIndustry;
                $whereFeatureDt[] = $whereWordFeature;
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

            $whereIndustryStr = implode(" and ", $whereIndustryDt);
            $whereIndustryStr = (!empty($whereIndustryStr))?"where {$whereIndustryStr}":"";

            $whereFeatureStr = implode(" and ", $whereFeatureDt);
            $whereFeatureStr = (!empty($whereFeatureStr))?"where {$whereFeatureStr}":"";

            $whereJobdayStr = implode(" and ", $whereJobdayDt);
            $whereJobdayStr = (!empty($whereJobdayStr))?"where {$whereJobdayStr}":"";

            $whereJobweekStr = implode(" and ", $whereJobweekDt);
            $whereJobweekStr = (!empty($whereJobweekStr))?"where {$whereJobweekStr}":"";

            $whereJobtypeStr = implode(" and ", $whereJobtypeDt);
            $whereJobtypeStr = (!empty($whereJobtypeStr))?"where {$whereJobtypeStr}":"";
        
            //検索条件
            $un[] = "
            select id from recruits_HN {$whereStr}
/*
            union
            
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on (
             _station.station_cd = recruits_HN.st1_code or
             _station.station_cd = recruits_HN.st2_code or
             _station.station_cd = recruits_HN.st3_code or
             _station.station_cd = recruits_HN.st4_code or
             _station.station_cd = recruits_HN.st5_code
             )
            {$whereSationStr}
*/

            union
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_HN.st1_code
            {$whereSationStr}
            
            union
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_HN.st2_code
            {$whereSationStr}
            
            union
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_HN.st3_code
            {$whereSationStr}
            
            union
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_HN.st4_code
            {$whereSationStr}
            
            union
             select recruits_HN.id from recruits_HN inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_HN.st5_code
            {$whereSationStr}
            
            union
            
            select distinct recruits_HN.id from (recruits_HN inner join _prefectures  on _prefectures.id = recruits_HN.pref_code)
            inner join
            _address on _address.id = recruits_HN.city_code
            {$wherePrefStr}


            union

            select recruits_HN.id from recruits_HN
            inner join jobIndustry_HN
            on jobIndustry_HN.id = recruits_HN.industry_code
            {$whereIndustryStr}
            
            
            union

            select recruits_HN.id from recruits_HN
            inner join jobCategories_HN
            on find_in_set(jobCategories_HN.id, recruits_HN.cate_codes)
            {$whereCateStr}

            union

            select recruits_HN.id from recruits_HN
            inner join jobFeatures_HN
            on find_in_set(jobFeatures_HN.id, recruits_HN.feature_codes)
            {$whereFeatureStr}

            union

            select recruits_HN.id from recruits_HN
            inner join jobdays
            on find_in_set(jobdays.id, recruits_HN.jobday_codes)
            {$whereJobdayStr}

            union

            select recruits_HN.id from recruits_HN
            inner join jobweeks
            on find_in_set(jobweeks.id, recruits_HN.jobweek_codes)
            {$whereJobweekStr}

            union

            select recruits_HN.id from recruits_HN
            inner join jobtypes
            on find_in_set(jobtypes.id, recruits_HN.jobtype_codes)
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
                recruits_HN inner join
                (
                    select id from
                        (
                            {$un[0]}

                        ) uniontb
                    group by id
                ) other on
                    recruits_HN.id = other.id
            {$whereDfStr}
             order by {$orderby} id desc
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
                recruits_HN inner join
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
                    recruits_HN.id = other.id
            {$whereDfStr}
             order by {$orderby} id desc
            {$limit}
            ";
        
        
        }
        
        //echo $sql;
        //exit;
        
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
            DataHnRec::$dataTotal = $row_ct["ct"];
            
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
        from recruitsUpdate_HN
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
            DataHnRec::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }
    


}