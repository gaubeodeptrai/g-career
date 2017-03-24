<?php

class DataCcRec{

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
    'o_updated'=>'',
    'w_new'=>'',
    'limitStart'=>'',
    'limitEnd'=>'')) {

        if(!empty($_["ss"])){
            $clm = "id,title,pre_id";
        } else if(!empty($_["s"])){
            $clm = "id,title,city_code,pref_code,st1_code,st2_code,st3_code,st4_code,st5_code,industry_code,cate_codes,exp_flg,skill_flg,jobtype_codes,
            jobday_codes,feature_codes,city_code,section1,section2,startdate,salarytime_low,company_code";
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
        if(!empty($_["o_updated"])){
            $orderby = "updated desc,";
        }
        if(!empty($_["o_rand"])){
            $orderby = "rand(),";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from recruits_CC
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
            DataCcRec::$dataTotal = $row_ct["ct"];
            
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
       $txt = "recruits_CC.title
recruits_CC.catchcopy
recruits_CC.pic1cap
recruits_CC.pic2cap
recruits_CC.pic3cap
recruits_CC.busetc
recruits_CC.jobway
recruits_CC.jobday
recruits_CC.jobweek
recruits_CC.contents
recruits_CC.exp
recruits_CC.skill
recruits_CC.salarytime_low
recruits_CC.salarytime_high
recruits_CC.salary
recruits_CC.welfare
recruits_CC.holiday
recruits_CC.other
recruits_CC.flow";

       
       //adminだけ、もしくは、フラグ判別
       $txt .= "
recruits_CC.company_code
recruits_CC.center_code
recruits_CC.shopname
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
            recruits_CC.id,
            recruits_CC.title,
            recruits_CC.industry_code,
            recruits_CC.cate_codes,
            recruits_CC.jobtype_codes,
            recruits_CC.pref_code,
            recruits_CC.city_code,
            recruits_CC.st1_code,
            recruits_CC.st2_code,
            recruits_CC.st3_code,
            recruits_CC.st4_code,
            recruits_CC.st5_code,
            recruits_CC.st1out,
            recruits_CC.st1way_code,
            recruits_CC.st1bustime,
            recruits_CC.st1bus,
            recruits_CC.st1walktime,
            recruits_CC.st2out,
            recruits_CC.st2way_code,
            recruits_CC.st2bustime,
            recruits_CC.st2bus,
            recruits_CC.st2walktime,
            recruits_CC.st3out,
            recruits_CC.st3way_code,
            recruits_CC.st3bustime,
            recruits_CC.st3bus,
            recruits_CC.st3walktime,
            recruits_CC.st4out,
            recruits_CC.st4way_code,
            recruits_CC.st4bustime,
            recruits_CC.st4bus,
            recruits_CC.st4walktime,
            recruits_CC.st5out,
            recruits_CC.st5way_code,
            recruits_CC.st5bustime,
            recruits_CC.st5bus,
            recruits_CC.st5walktime,
            recruits_CC.busetc,
            recruits_CC.jobway,
            recruits_CC.salarytime_low,
            recruits_CC.salarytime_high,
            recruits_CC.salary,
            recruits_CC.salary_flg,
            recruits_CC.jobday_codes,
            recruits_CC.jobday,
            recruits_CC.jobweek_codes,
            recruits_CC.feature_codes,
            recruits_CC.pic1_code,
            recruits_CC.pic1_flg,
            recruits_CC.pic2_code,
            recruits_CC.pic2_flg,
            recruits_CC.pic3_code,
            recruits_CC.pic3_flg,
            recruits_CC.startdate
            ";
        } else {
            $clm = "
            recruits_CC.id,
            recruits_CC.status,
            recruits_CC.sort,
            recruits_CC.section1,
            recruits_CC.section2,
            recruits_CC.startdate,
            recruits_CC.industry_code,
            recruits_CC.cate_codes,
            recruits_CC.company_flg,
            recruits_CC.company_code,
            recruits_CC.center_flg,
            recruits_CC.center_code,
            recruits_CC.address_flg,
            recruits_CC.address,
            recruits_CC.pref_code,
            recruits_CC.city_code,
            recruits_CC.st1_code,
            recruits_CC.st2_code,
            recruits_CC.st3_code,
            recruits_CC.st4_code,
            recruits_CC.st5_code,
            recruits_CC.st1out,
            recruits_CC.st1way_code,
            recruits_CC.st1bustime,
            recruits_CC.st1bus,
            recruits_CC.st1walktime,
            recruits_CC.st2out,
            recruits_CC.st2way_code,
            recruits_CC.st2bustime,
            recruits_CC.st2bus,
            recruits_CC.st2walktime,
            recruits_CC.st3out,
            recruits_CC.st3way_code,
            recruits_CC.st3bustime,
            recruits_CC.st3bus,
            recruits_CC.st3walktime,
            recruits_CC.st4out,
            recruits_CC.st4way_code,
            recruits_CC.st4bustime,
            recruits_CC.st4bus,
            recruits_CC.st4walktime,
            recruits_CC.st5out,
            recruits_CC.st5way_code,
            recruits_CC.st5bustime,
            recruits_CC.st5bus,
            recruits_CC.st5walktime,
            recruits_CC.busetc,
            recruits_CC.jobway,
            recruits_CC.othercond,
            recruits_CC.salarytime_low,
            recruits_CC.salarytime_high,
            recruits_CC.salary,
            recruits_CC.salary_flg,
            recruits_CC.feature_codes,
            recruits_CC.jobday_codes,
            recruits_CC.jobday,
            recruits_CC.jobtime,
            recruits_CC.jobweek_codes,
            recruits_CC.jobweek,
            recruits_CC.jobtype_codes,
            recruits_CC.contents,
            recruits_CC.exp_flg,
            recruits_CC.exp,
            recruits_CC.skill_flg,
            recruits_CC.skill,
            recruits_CC.welfare,
            recruits_CC.holiday,
            recruits_CC.other,
            recruits_CC.flow,
            recruits_CC.title,
            recruits_CC.catchcopy,
            recruits_CC.catchcopy_flg,
            recruits_CC.text,
            recruits_CC.text_flg,
            recruits_CC.pic1_code,
            recruits_CC.pic1cap,
            recruits_CC.pic1_flg,
            recruits_CC.pic1cap_flg,
            recruits_CC.pic2_code,
            recruits_CC.pic2cap,
            recruits_CC.pic2_flg,
            recruits_CC.pic2cap_flg,
            recruits_CC.pic3_code,
            recruits_CC.pic3cap,
            recruits_CC.pic3_flg,
            recruits_CC.pic3cap_flg,
            recruits_CC.jobstatus,
            recruits_CC.tag_title,
            recruits_CC.tag_description,
            recruits_CC.tag_keywords,
            recruits_CC.updated,
            recruits_CC.created,
            recruits_CC.deleted,
            recruits_CC.editor_first,
            recruits_CC.editor_last,
            recruits_CC.shopname,
            recruits_CC.chart1,
            recruits_CC.chart2,
            recruits_CC.chart3,
            recruits_CC.chart4,
            recruits_CC.chart5,
            recruits_CC.ap_shoptype,
            recruits_CC.ap_brand,
            recruits_CC.ap_brand_flg,
            recruits_CC.ap_salary_flg,
            recruits_CC.siteid,
            recruits_CC.pre_id,
            recruits_CC.pre_editor_first,
            recruits_CC.pre_editor_last,
            recruits_CC.pre_effect,
            recruits_CC.pre_name,
            recruits_CC.pre_cate,
            recruits_CC.pre_salarygp,
            recruits_CC.pre_free,
            recruits_CC.pre_comment
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
        $wherecompany = array();
        $wherecenter = array();
        
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $whereDf[] = "recruits_CC.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $whereDf[] = "recruits_CC.id = {$id}";
        }
        if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $whereDf[] = "recruits_CC.status = {$status}";
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
                $StatusWhere .= "recruits_CC.status = {$v}";
            }
            $StatusWhere .= ")";
            $whereDf[] = $StatusWhere;
        }
        
        if(!empty($_["w_startdate"])){
            $startdate = DB::quote($_["w_startdate"]);
            $whereDf[] = "recruits_CC.startdate <= {$startdate}";
        }

        if(!empty($_["w_section1"])){
            $section1 = DB::quote($_["w_section1"]);
            $whereDf[] = "recruits_CC.section1 = {$section1}";
        }
        if(!empty($_["w_section2"])){
            $section2 = DB::quote($_["w_section2"]);
            $whereDf[] = "recruits_CC.section2 = {$section2}";
        }
        
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $whereDf[] = "(recruits_CC.deleted >= {$now} or recruits_CC.deleted = '' )";
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
            $whereDf[] = "recruits_CC.pref_code in ($PrefCode)";
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
            $whereDf[] = "recruits_CC.city_code in ($CityCode)";
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
            $whereDf[] = "(recruits_CC.st1_code in ($StaCode) or
            recruits_CC.st2_code in ($StaCode) or
            recruits_CC.st3_code in ($StaCode) or
            recruits_CC.st4_code in ($StaCode) or
            recruits_CC.st5_code in ($StaCode))";
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
                $IndWhere .= "find_in_set({$v}, recruits_CC.industry_code)";
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
                $CateWhere .= "find_in_set({$v}, recruits_CC.cate_codes)";
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
                $TypeWhere .= "find_in_set({$v}, recruits_CC.jobtype_codes)";
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
                $SalaryWhere .= "({$v} <= recruits_CC.salarytime_low)";
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
                $DayWhere .= "find_in_set({$v}, recruits_CC.jobday_codes)";
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
                $FeaWhere .= "find_in_set({$v}, recruits_CC.feature_codes)";
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
                $orderby = "recruits_CC.startdate desc,";
            } elseif($_["o_sort"]=="salary1"){
                $orderby = "recruits_CC.salarytime_low desc,";
            } elseif($_["o_sort"]=="way1"){
                $orderby = "(recruits_CC.st1walktime = '') asc,recruits_CC.st1walktime asc,";
            } else {
                $orderby = "recruits_CC.sort {$od},";
            }
        }
        if(!empty($_["o_id"])){
            $orderby = "recruits_CC.id {$od},";
        }
        if(!empty($_["o_status"])){
            $orderby = "recruits_CC.status {$od},";
        }
        if(!empty($_["o_created"])){
            $orderby = "recruits_CC.created {$od},";
        }
        if(!empty($_["o_updated"])){
            $orderby = "recruits_CC.updated {$od},";
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
           $whereWordcompanyDt = $wherecompany;
           $whereWordcenterDt = $wherecenter;
           
           if(!empty($_["w_word"])){
           
                $whereWord = "(";
                $nm = 0;
                foreach(DataCcRec::recruitsColumnLikes() as $key2 => $c){
                    if(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_CC.company_code" 
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case recruits_CC.company_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } elseif(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_CC.center_code"
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case recruits_CC.center_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } elseif(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_CC.salary" or
                    $c == "recruits_CC.salarytime_low" or
                    $c == "recruits_CC.salarytime_high"
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case recruits_CC.salary_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
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
                    $whereWord .= " recruits_CC.salarytime_low like '".$pmsQt."'";
                }
                        
                $whereWord .= ")";
                
                $whereWordSation = " concat(_stcompany.company_name,_line.line_name,_station.station_name)  like '".$pmsQt."'";
                $whereWordPref   = " concat(_prefectures.name,_address.city)  like '".$pmsQt."'";
                $whereWordCate   = " jobCategories_CC.name  like '".$pmsQt."'";
                $whereWordIndustry   = " jobIndustry_CC.name  like '".$pmsQt."'";
                $whereWordFeature   = " jobFeatures_CC.name  like '".$pmsQt."'";
                $whereWordJobday   = " jobdays.name  like '".$pmsQt."'";
                $whereWordJobweek   = " jobweeks.name  like '".$pmsQt."'";
                $whereWordJobtype   = " jobtypes.name  like '".$pmsQt."'";
                $whereWordcompany   = " case recruits_CC.company_flg when 1 then concat(company.name,company.feature,company.business,company.industry,company.namekana) like '".$pmsQt."' else 0 end";
                $whereWordcenter   = " case recruits_CC.center_flg when 1 then concat(center.name,center.introduction,center.feature) like '".$pmsQt."' else 0 end";
                
                $where[] = $whereWord;
                $whereSationDt[] = $whereWordSation;
                $wherePrefDt[] = $whereWordPref;
                $whereCateDt[] = $whereWordCate;
                $whereIndustryDt[] = $whereWordIndustry;
                $whereFeatureDt[] = $whereWordFeature;
                $whereJobdayDt[] =  $whereWordJobday;
                $whereJobweekDt[] = $whereWordJobweek;
                $whereJobtypeDt[] = $whereWordJobtype;
                $whereWordcompanyDt[] = $whereWordcompany;
                $whereWordcenterDt[] = $whereWordcenter;
                
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

            $whereWordcompanyStr = implode(" and ", $whereWordcompanyDt);
            $whereWordcompanyStr = (!empty($whereWordcompanyStr))?"where {$whereWordcompanyStr}":"";

            $whereWordcenterStr = implode(" and ", $whereWordcenterDt);
            $whereWordcenterStr = (!empty($whereWordcenterStr))?"where {$whereWordcenterStr}":"";
            //検索条件
            $un[] = "
            select id from recruits_CC {$whereStr}
/*
            union
            
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on (
             _station.station_cd = recruits_CC.st1_code or
             _station.station_cd = recruits_CC.st2_code or
             _station.station_cd = recruits_CC.st3_code or
             _station.station_cd = recruits_CC.st4_code or
             _station.station_cd = recruits_CC.st5_code
             )
            {$whereSationStr}
*/

            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st1_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st2_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st3_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st4_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st5_code
            {$whereSationStr}
            
            union
            
            select distinct recruits_CC.id from (recruits_CC inner join _prefectures  on _prefectures.id = recruits_CC.pref_code)
            inner join
            _address on _address.id = recruits_CC.city_code
            {$wherePrefStr}


            union

            select recruits_CC.id from recruits_CC
            inner join jobIndustry_CC
            on jobIndustry_CC.id = recruits_CC.industry_code
            {$whereIndustryStr}
            
            
            union

            select recruits_CC.id from recruits_CC
            inner join jobCategories_CC
            on find_in_set(jobCategories_CC.id, recruits_CC.cate_codes)
            {$whereCateStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobFeatures_CC
            on find_in_set(jobFeatures_CC.id, recruits_CC.feature_codes)
            {$whereFeatureStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobdays
            on find_in_set(jobdays.id, recruits_CC.jobday_codes)
            {$whereJobdayStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobweeks
            on find_in_set(jobweeks.id, recruits_CC.jobweek_codes)
            {$whereJobweekStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobtypes
            on find_in_set(jobtypes.id, recruits_CC.jobtype_codes)
            {$whereJobtypeStr}

            union

            select recruits_CC.id from recruits_CC
            inner join company
            on find_in_set(company.id, recruits_CC.company_code)
            {$whereWordcompanyStr}

            union

            select recruits_CC.id from recruits_CC
            inner join center
            on find_in_set(center.id, recruits_CC.center_code)
            {$whereWordcenterStr}
            
            ";

        
        }
        
        
        //複数検索分岐
        if(count($where_nm)==1){
        
            $sql = "
            select
                sql_calc_found_rows
                {$clm}
            from
                recruits_CC inner join
                (
                    select id from
                        (
                            {$un[0]}

                        ) uniontb
                    group by id
                ) other on
                    recruits_CC.id = other.id
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
                recruits_CC inner join
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
                    recruits_CC.id = other.id
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
            DataCcRec::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["id"]])?$d[$_["id"]]:"";
         }
     
        return $d;
    }



    //求人
    function recruitsSearch_HW($_=array(
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
            recruits_CC.id,
            recruits_CC.title,
            recruits_CC.industry_code,
            recruits_CC.cate_codes,
            recruits_CC.jobtype_codes,
            recruits_CC.pref_code,
            recruits_CC.city_code,
            recruits_CC.st1_code,
            recruits_CC.st2_code,
            recruits_CC.st3_code,
            recruits_CC.st4_code,
            recruits_CC.st5_code,
            recruits_CC.st1out,
            recruits_CC.st1way_code,
            recruits_CC.st1bustime,
            recruits_CC.st1bus,
            recruits_CC.st1walktime,
            recruits_CC.st2out,
            recruits_CC.st2way_code,
            recruits_CC.st2bustime,
            recruits_CC.st2bus,
            recruits_CC.st2walktime,
            recruits_CC.st3out,
            recruits_CC.st3way_code,
            recruits_CC.st3bustime,
            recruits_CC.st3bus,
            recruits_CC.st3walktime,
            recruits_CC.st4out,
            recruits_CC.st4way_code,
            recruits_CC.st4bustime,
            recruits_CC.st4bus,
            recruits_CC.st4walktime,
            recruits_CC.st5out,
            recruits_CC.st5way_code,
            recruits_CC.st5bustime,
            recruits_CC.st5bus,
            recruits_CC.st5walktime,
            recruits_CC.busetc,
            recruits_CC.jobway,
            recruits_CC.salarytime_low,
            recruits_CC.salarytime_high,
            recruits_CC.salary,
            recruits_CC.salary_flg,
            recruits_CC.jobday_codes,
            recruits_CC.jobday,
            recruits_CC.jobweek_codes,
            recruits_CC.feature_codes,
            recruits_CC.pic1_code,
            recruits_CC.pic1_flg,
            recruits_CC.pic2_code,
            recruits_CC.pic2_flg,
            recruits_CC.pic3_code,
            recruits_CC.pic3_flg,
            recruits_CC.startdate,
            
            recruits_hellowork.hw_id,
            recruits_hellowork.hw_title,
            recruits_hellowork.hw_jobtype,
            recruits_hellowork.hw_jobtype,
            recruits_hellowork.hw_place,
            recruits_hellowork.hw_line,
            recruits_hellowork.hw_line,
            recruits_hellowork.hw_salary,
            recruits_hellowork.hw_category
            
            ";
        } else {
            $clm = "
            recruits_CC.id,
            recruits_CC.status,
            recruits_CC.sort,
            recruits_CC.section1,
            recruits_CC.section2,
            recruits_CC.startdate,
            recruits_CC.industry_code,
            recruits_CC.cate_codes,
            recruits_CC.company_flg,
            recruits_CC.company_code,
            recruits_CC.center_flg,
            recruits_CC.center_code,
            recruits_CC.address_flg,
            recruits_CC.address,
            recruits_CC.pref_code,
            recruits_CC.city_code,
            recruits_CC.st1_code,
            recruits_CC.st2_code,
            recruits_CC.st3_code,
            recruits_CC.st4_code,
            recruits_CC.st5_code,
            recruits_CC.st1out,
            recruits_CC.st1way_code,
            recruits_CC.st1bustime,
            recruits_CC.st1bus,
            recruits_CC.st1walktime,
            recruits_CC.st2out,
            recruits_CC.st2way_code,
            recruits_CC.st2bustime,
            recruits_CC.st2bus,
            recruits_CC.st2walktime,
            recruits_CC.st3out,
            recruits_CC.st3way_code,
            recruits_CC.st3bustime,
            recruits_CC.st3bus,
            recruits_CC.st3walktime,
            recruits_CC.st4out,
            recruits_CC.st4way_code,
            recruits_CC.st4bustime,
            recruits_CC.st4bus,
            recruits_CC.st4walktime,
            recruits_CC.st5out,
            recruits_CC.st5way_code,
            recruits_CC.st5bustime,
            recruits_CC.st5bus,
            recruits_CC.st5walktime,
            recruits_CC.busetc,
            recruits_CC.jobway,
            recruits_CC.othercond,
            recruits_CC.salarytime_low,
            recruits_CC.salarytime_high,
            recruits_CC.salary,
            recruits_CC.salary_flg,
            recruits_CC.feature_codes,
            recruits_CC.jobday_codes,
            recruits_CC.jobday,
            recruits_CC.jobtime,
            recruits_CC.jobweek_codes,
            recruits_CC.jobweek,
            recruits_CC.jobtype_codes,
            recruits_CC.contents,
            recruits_CC.exp_flg,
            recruits_CC.exp,
            recruits_CC.skill_flg,
            recruits_CC.skill,
            recruits_CC.welfare,
            recruits_CC.holiday,
            recruits_CC.other,
            recruits_CC.flow,
            recruits_CC.title,
            recruits_CC.catchcopy,
            recruits_CC.catchcopy_flg,
            recruits_CC.text,
            recruits_CC.text_flg,
            recruits_CC.pic1_code,
            recruits_CC.pic1cap,
            recruits_CC.pic1_flg,
            recruits_CC.pic1cap_flg,
            recruits_CC.pic2_code,
            recruits_CC.pic2cap,
            recruits_CC.pic2_flg,
            recruits_CC.pic2cap_flg,
            recruits_CC.pic3_code,
            recruits_CC.pic3cap,
            recruits_CC.pic3_flg,
            recruits_CC.pic3cap_flg,
            recruits_CC.jobstatus,
            recruits_CC.tag_title,
            recruits_CC.tag_description,
            recruits_CC.tag_keywords,
            recruits_CC.updated,
            recruits_CC.created,
            recruits_CC.deleted,
            recruits_CC.editor_first,
            recruits_CC.editor_last,
            recruits_CC.shopname,
            recruits_CC.chart1,
            recruits_CC.chart2,
            recruits_CC.chart3,
            recruits_CC.chart4,
            recruits_CC.chart5,
            recruits_CC.ap_shoptype,
            recruits_CC.ap_brand,
            recruits_CC.ap_brand_flg,
            recruits_CC.ap_salary_flg,
            recruits_CC.siteid,
            recruits_CC.pre_id,
            recruits_CC.pre_editor_first,
            recruits_CC.pre_editor_last,
            recruits_CC.pre_effect,
            recruits_CC.pre_name,
            recruits_CC.pre_cate,
            recruits_CC.pre_salarygp,
            recruits_CC.pre_free,
            recruits_CC.pre_comment
            
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

        $whereHwDf = array();
        
        if(!empty($_["ids"])){
            $ids = array();
            foreach($_["ids"] as $v){
               $ids[] = DB::quote($v);
            }
            $ids = implode(",", $ids);
            $whereDf[] = "recruits_CC.id in ({$ids})";
        }
        
        if(!empty($_["w_id"])){
            $id = DB::quote($_["w_id"]);
            $whereDf[] = "recruits_CC.id = {$id}";
        }
        if(!empty($_["w_status"])){
            $status = DB::quote($_["w_status"]);
            $whereDf[] = "recruits_CC.status = {$status}";
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
                $StatusWhere .= "recruits_CC.status = {$v}";
            }
            $StatusWhere .= ")";
            $whereDf[] = $StatusWhere;
        }
        
        if(!empty($_["w_startdate"])){
            $startdate = DB::quote($_["w_startdate"]);
            $whereDf[] = "recruits_CC.startdate <= {$startdate}";
        }

        if(!empty($_["w_section1"])){
            $section1 = DB::quote($_["w_section1"]);
            $whereDf[] = "recruits_CC.section1 = {$section1}";
        }
        if(!empty($_["w_section2"])){
            $section2 = DB::quote($_["w_section2"]);
            $whereDf[] = "recruits_CC.section2 = {$section2}";
        }
        
        if(empty($_["w_deleted"])){
            $now = date("Y-m-d H:i:s");
            $now = DB::quote($now);
            $whereDf[] = "(recruits_CC.deleted >= {$now} or recruits_CC.deleted = '' )";
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
            $whereDf[] = "recruits_CC.pref_code in ($PrefCode)";

            $whereHwDf[] = "recruits_hellowork.hw_pref_code in ($PrefCode)";
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
            $whereDf[] = "recruits_CC.city_code in ($CityCode)";

            $whereHwDf[] = "recruits_hellowork.hw_city_code in ($CityCode)";
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
            $whereDf[] = "(recruits_CC.st1_code in ($StaCode) or
            recruits_CC.st2_code in ($StaCode) or
            recruits_CC.st3_code in ($StaCode) or
            recruits_CC.st4_code in ($StaCode) or
            recruits_CC.st5_code in ($StaCode))";
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
                $IndWhere .= "find_in_set({$v}, recruits_CC.industry_code)";
            }
            $IndWhere .= ")";
            $whereDf[] = $IndWhere;

            $whereHwDf[] = str_replace("recruits_CC.industry_code","recruits_hellowork.hw_industry_code",$IndWhere);
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
                $CateWhere .= "find_in_set({$v}, recruits_CC.cate_codes)";
            }
            $CateWhere .= ")";
            $whereDf[] = $CateWhere;

            $whereHwDf[] = str_replace("recruits_CC.cate_codes","recruits_hellowork.hw_cate_code",$CateWhere);
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
                $TypeWhere .= "find_in_set({$v}, recruits_CC.jobtype_codes)";
            }
            $TypeWhere .= ")";
            $whereDf[] = $TypeWhere;
            
            $whereHwDf[] = str_replace("recruits_CC.jobtype_codes","recruits_hellowork.hw_jobtype_code",$TypeWhere);
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
                $SalaryWhere .= "({$v} <= recruits_CC.salarytime_low)";
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
                $DayWhere .= "find_in_set({$v}, recruits_CC.jobday_codes)";
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
                $FeaWhere .= "find_in_set({$v}, recruits_CC.feature_codes)";
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
                $orderby = "startdate desc,";
            } elseif($_["o_sort"]=="salary1"){
                $orderby = "salarytime_low desc,";
            } elseif($_["o_sort"]=="way1"){
                $orderby = "st1walktime asc,";
            }
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
                foreach(DataCcRec::recruitsColumnLikes() as $key2 => $c){
                    if(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_CC.company_code" 
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case recruits_CC.company_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
                        $nm ++;
                    } elseif(!preg_match ("/^\/admin\/.+$/u", $_SERVER["REQUEST_URI"]) &&
                    (
                    $c == "recruits_CC.center_code"
                    )
                    ){
                        $whereWord .= ($nm!=0)?" or ":"";
                        $pmsQt = "%".dbLikeEsc($val)."%";
                        $whereWord .= "case recruits_CC.center_flg when 1 then {$c} like '".$pmsQt."' else 0 end";
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
                    $whereWord .= " recruits_CC.salarytime_low like '".$pmsQt."'";
                }
                        
                $whereWord .= ")";
                
                $whereWordSation = " concat(_stcompany.company_name,_line.line_name,_station.station_name)  like '".$pmsQt."'";
                $whereWordPref   = " concat(_prefectures.name,_address.city)  like '".$pmsQt."'";
                $whereWordCate   = " jobCategories_CC.name  like '".$pmsQt."'";
                $whereWordIndustry   = " jobIndustry_CC.name  like '".$pmsQt."'";
                $whereWordFeature   = " jobFeatures_CC.name  like '".$pmsQt."'";
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
            
            //ハローワーク求人
            $hw_status = DB::quote("1");
            $whereHwDf[] = "recruits_hellowork.hw_status = {$hw_status}";
            $whereHwDf[] = "recruits_hellowork.hw_deleted = ''";
            
            $whereDfStr = implode(" and ", $whereDf);
            $whereHwDfStr = implode(" and ", $whereHwDf);

            $whereDfStr = (!empty($whereDfStr))?"where (recruits_hellowork.hw_id <> '' and ({$whereHwDfStr})) or (recruits_CC.id <> '' and ({$whereDfStr}))":"";
            
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
            select id from recruits_CC {$whereStr}

            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st1_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st2_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st3_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st4_code
            {$whereSationStr}
            
            union
             select recruits_CC.id from recruits_CC inner join 
             (_station inner join _line on _station.line_cd = _line.line_cd inner join _stcompany on _line.company_cd = _stcompany.company_cd)
             on _station.station_cd = recruits_CC.st5_code
            {$whereSationStr}
            
            union
            
            select distinct recruits_CC.id from (recruits_CC inner join _prefectures  on _prefectures.id = recruits_CC.pref_code)
            inner join
            _address on _address.id = recruits_CC.city_code
            {$wherePrefStr}


            union

            select recruits_CC.id from recruits_CC
            inner join jobIndustry_CC
            on jobIndustry_CC.id = recruits_CC.industry_code
            {$whereIndustryStr}
            
            
            union

            select recruits_CC.id from recruits_CC
            inner join jobCategories_CC
            on find_in_set(jobCategories_CC.id, recruits_CC.cate_codes)
            {$whereCateStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobFeatures_CC
            on find_in_set(jobFeatures_CC.id, recruits_CC.feature_codes)
            {$whereFeatureStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobdays
            on find_in_set(jobdays.id, recruits_CC.jobday_codes)
            {$whereJobdayStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobweeks
            on find_in_set(jobweeks.id, recruits_CC.jobweek_codes)
            {$whereJobweekStr}

            union

            select recruits_CC.id from recruits_CC
            inner join jobtypes
            on find_in_set(jobtypes.id, recruits_CC.jobtype_codes)
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
                (
                recruits_CC inner join
                (
                    select id from
                        (
                            {$un[0]}

                        ) uniontb
                    group by id
                ) other on
                    recruits_CC.id = other.id
                
                ) left outer join recruits_hellowork on recruits_CC.id = recruits_hellowork.hw_code
                
                {$whereDfStr}

                union
                
                select {$clm} from
                
                (
                recruits_CC inner join
                (
                    select id from
                        (
                            {$un[0]}

                        ) uniontb
                    group by id
                ) other on
                    recruits_CC.id = other.id
                
                ) right outer join recruits_hellowork on recruits_CC.id = recruits_hellowork.hw_code
                
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
                recruits_CC inner join
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
                    recruits_CC.id = other.id
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
                $d[] = $r;
            }
            
            $sql_ct = "select found_rows() as ct";
            $res_ct = DB::query($sql_ct);
            $row_ct = DB::fetch($res_ct);
            
            DB::fetchClose();
            DataCcRec::$dataTotal = $row_ct["ct"];
            
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
        from recruitsUpdate_CC
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
            DataCcRec::$dataTotal = $row_ct["ct"];
            
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

        
        $where = implode(" and ", $where);
        
        
        $where = (!empty($where))?"where {$where}":"";
        
        $limit = "";
        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        }
        
        $sql = "select
        sql_calc_found_rows
        {$clm}
        from recruits_CC_hellowork
        {$where}
        order by hw_id desc
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
            DataCcRec::$dataTotal = $row_ct["ct"];
            
        }

        if(
        !empty($_["id"])
        ){
            return isset($d[$_["hw_id"]])?$d[$_["hw_id"]]:"";
         }
     
        return $d;
    }
    

    //アクセス登録
    function recruitsAccess($_=array('id'=>'','pref'=>'')) {
    
        $id = DB::quote($_["id"]);
        $pref = DB::quote($_["pref"]);
        $now = DB::quote(date("Y-m-d H:i:s"));
        $date = DB::quote(date("Y-m-d"));
        
        $sql = "select
        num
        from recruits_CC_access
        where  recruit_id = {$id}
        ";
        
        $d = "";
        
        if(
        DB::query($sql)
        ){
            while($r = DB::fetch()){
                $d = $r["num"];
            }
        }
        
        if(empty($d)){
             $sql = "insert into recruits_CC_access (recruit_id,num,pref_code,created,updated) values ({$id},'1',{$pref},{$now},{$now})";
        } else {
             $num=$d+1;
             $num=DB::quote($num);
             $sql = "update recruits_CC_access set num={$num},pref_code={$pref},updated={$now}  where recruit_id = {$id}";
        }
        
        DB::query($sql);
        
     
    }

    //アクセス取得
    function recruitsAccessGet($_=array('id'=>'','pref'=>'','limitStart'=>'','limitEnd'=>'')) {
    
        $now = DB::quote(date("Y-m-d H:i:s"));
        $date = DB::quote(date("Y-m-d"));
        
        $where = "";
        if(!empty($_["id"])){
            $id = DB::quote($_["id"]);
            $where .= " recruits_CC.id != {$id} and";
        }
                
        if(!empty($_["pref"])){
            $pref = DB::quote($_["pref"]);
            $where .= " recruits_CC_access.pref_code = {$pref} and";
        }

        if(!empty($_["limitEnd"])){
            $limit = "limit {$_["limitStart"]},{$_["limitEnd"]}";
        } else {
            $limit = "limit 0,5";
        }
        
        $sql = "select
        sql_calc_found_rows
        recruits_CC.title,
        recruits_CC.jobtype_codes,
        recruits_CC.id,
        recruits_CC.pref_code,
        recruits_CC.city_code,
        recruits_CC.salarytime_high,
        recruits_CC.salarytime_low,
        recruits_CC.salary,
        recruits_CC.jobday_codes,
        recruits_CC.jobday,
        recruits_CC.cate_codes,
        recruits_CC_access.num
        from recruits_CC_access left join recruits_CC  on recruits_CC.id = recruits_CC_access.recruit_id
        where 
        {$where}
        recruits_CC.status = 'OPEN' and
        recruits_CC.startdate <= {$date} and
        (recruits_CC.deleted >= {$now} or recruits_CC.deleted = '' )
        order by recruits_CC_access.num desc, recruits_CC_access.updated desc
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
            DataCcRec::$dataTotal = $row_ct["ct"];
                        
            return $d;
        }
        
        return $d;
     
    }
    


}