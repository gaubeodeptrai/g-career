<?php
require_once './libs/inc.php';


$_ = array();
foreach(array(
"today"                  => date("Y-m-d"),
"prefRec"                => array(),
"cityRec"                => array(),
"cateRec"                => array(),
"indRec"                 => array(),
"typeRec"                => array(),
"feaRec"                 => array(),
"dayRec"                 => array(),
"salaryRec"                 => array(),
"nm"                     => "0",

"areas"                  => array(),
"prefectures"            => array(),
"prefGroups"             => array(),
"prefCities"             => array(),
"groupsPref"             => array(),
"groupsOn"               => "",

"jobCategories"          => array(),
"jobIndustries"          => array(),
"jobTypes"               => array(),
"jobFeatures"            => array(),
"jobdays"                => array(),
"salaries"               => array(),

//パラメータ
"pmsPref"                => "",
"pmsCity"                => "",
"pmsLine"                => "",
"pmsSta"                 => "",
"pmsCate"                => "",
"pmsInd"                 => "",
"pmsType"                => "",
"pmsDay"                 => "",
"pmsFea"                 => "",
"pmsSalary"              => "",
"pmsWord"                => "",
"pmsPage"                => "",

"pmsPrefs"               => array(),
"pmsCities"              => array(),
"pmsLines"               => array(),
"pmsStas"                => array(),
"pmsCates"               => array(),
"pmsInds"                => array(),
"pmsTypes"               => array(),
"pmsDays"                => array(),
"pmsFeas"                => array(),

//パラメータ表示
"pmsPrefStr"             => "",

"randdata" => array(),
"randdata1" => array(),
"randdata2" => array(),
"randdata3" => array(),
"randdata4" => array(),

) as $k => $v){
    $_[$k] = $v;
}


if(!empty($_SESSION["kaigoi"]["pms"])){
    foreach($_SESSION["kaigoi"]["pms"] as $k => $v){
        $_[$k] = $v;
    }
}

if(!empty($_["pmsPrefs"])){
    foreach($_["pmsPrefs"] as $v){
        $_["pmsPref"] = $v;
    }
    $_["pmsPrefs"] = array();
}
if(!empty($_["pmsCities"])){
    foreach($_["pmsCities"] as $v){
        $_["pmsCity"] = $v;
    }
    $_["pmsCities"] = array();
}



//都道府県
foreach(Data::prefectures(array('w_status'=>'1','o_select'=>'1')) as $v){
    $_["areas"][$v["id"]] = $v;
    $_["prefectures"][$v["gp_id"]][$v["id"]] = $v;
    $_["prefGroups"][$v["gp_id"]] = $v;
    $_["groupsPref"][$v["id"]] = $v["gp_id"];
}

foreach(Data::cities(array('w_pref'=>$_["pmsPrefStr"])) as $v){
    $_["cities"][$v["id"]] = $v;
}
        
if(!empty($_REQUEST["pref"]) || !empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){

    if(!empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){
        $_["groupsOn"] = $_["groupsPref"][$_SESSION["kaigoi"]["pms"]["pmsPrefs"][0]];
        $_["pmsPref"] = $_SESSION["kaigoi"]["pms"]["pmsPrefs"][0];
    }
    if(!empty($_REQUEST["pref"])){
        $_["pmsPref"] = $_REQUEST["pref"];
    }
    $_["pmsPrefStr"] = $_["areas"][$_["pmsPref"]]["name"];
    
   //市区町村
    foreach(Data::cities(array('w_pref'=>$_["pmsPrefStr"])) as $v){
        $_["prefCities"][$_["pmsPref"]][$v["id"]] = $v;

    }
    if(!empty($_REQUEST["city"])){
        $_["pmsCity"] = $_REQUEST["city"];
    } else {
        $_["pmsCity"] = "";
    }

}


//募集職種
$_["jobCategories"] = Data::jobCategories_CC(array('s'=>'1','w_status'=>'1'));

//業種
$_["jobIndustries"] = Data::jobIndustry_CC(array('s'=>'1','w_status'=>'1'));

//雇用形態
$_["jobTypes"] = Data::jobtypes(array('s'=>'1','w_status'=>'1'));

//雇用形態略文言
$_["jobTypesSS"] = Data::jobtypes_SS();
//給与
$_["salaries"] = Data::salarytime();

//特色フラグ
$_["jobFeatures"] = Data::jobFeatures_CC(array('s'=>'1','w_status'=>'1'));

//勤務日数
$_["jobdays"] = Data::jobdays(array('s'=>'1','w_status'=>'1'));


//求人
foreach(DataCcRec::recruits(array('s'=> '1','w_status'=> 'OPEN','w_startdate'=> $_["today"])) as $v){
    $_["prefRec"][$v["pref_code"]][] = $v["id"];
    $_["cityRec"][$v["city_code"]][] = $v["id"];

    if(!empty($_["pmsPref"]) and $v["pref_code"]!=$_["pmsPref"]){
        continue;
    }
    if(!empty($_["pmsCity"]) and $v["city_code"]!=$_["pmsCity"]){
        continue;
    }
        
    $v["cate_codes"] =  explode(",", $v["cate_codes"]);
    foreach($v["cate_codes"] as $r){
        $_["cateRec"][$r][] = $v["id"];
    }
    $v["industry_code"] =  explode(",", $v["industry_code"]);
    foreach($v["industry_code"] as $r){
        $_["indRec"][$r][] = $v["id"];
    }

    $v["jobtype_codes"] =  explode(",", $v["jobtype_codes"]);
    foreach($v["jobtype_codes"] as $r){
        $_["typeRec"][$r][] = $v["id"];
    }

    $_["salaryRec"][$v["salarytime_low"]][] = $v["salarytime_low"];
    
    $v["feature_codes"] =  explode(",", $v["feature_codes"]);
    foreach($v["feature_codes"] as $r){
        $_["feaRec"][$r][] = $v["id"];
    }

    $v["jobday_codes"] =  explode(",", $v["jobday_codes"]);
    foreach($v["jobday_codes"] as $r){
        $_["dayRec"][$r][] = $v["id"];
    }

    
}


if(!empty($_REQUEST["ajax"]) and !empty($_REQUEST["ajax_type"]) and $_REQUEST["ajax_type"]==1){
    require_once './include/searchbox.html';
    exit;
}
if(!empty($_REQUEST["ajax"]) and !empty($_REQUEST["ajax_type"]) and $_REQUEST["ajax_type"]==2){

    //都道府県変更
    if(!empty($_REQUEST["cityflg"])){
        unset($_SESSION["kaigoi"]["pms"]["pmsLines"]);
        unset($_SESSION["kaigoi"]["pms"]["pmsStas"]);
        unset($_["pmsLines"]);
        unset($_["pmsStas"]);
    }
    require_once './include/searchbox_sp.html';
    exit;
}

//オススメ求人
for($i=1;$i<=4;$i++){
    if($i==1){
        $file = file_get_contents('template/recommend/shutoken.html', true);
        $pref = '13';
    } elseif($i==2){
        $file = file_get_contents('template/recommend/osaka.html', true);
        $pref = '27';
    } elseif($i==3){
        $file = file_get_contents('template/recommend/nagoya.html', true);
        $pref = '23';
    } elseif($i==4){
        $file = file_get_contents('template/recommend/fukuoka.html', true);
        $pref = '40';
    }
    $file = explode("\n",$file);
    $idList = array();
    foreach($file as $v){
        $id = strstr($v, "details/");
        $id = str_replace("details/", "", $id);
        $idList[] = str_replace("/", "", $id);
    }
    $_["randdata"] = DataCcRec::recruits(array('w_status'=> 'OPEN','w_startdate'=> $_["today"],'ids'=>$idList,'limitStart'=>'0','limitEnd'=>'4',));


    if(count($_["randdata"])<4){
        $nm = 4-count($_["randdata"]);
        $randdadd = DataCcRec::recruits(array('w_status'=> 'OPEN','w_startdate'=> $_["today"],'no_ids'=>$idList,'w_pref'=> $pref,'o_rand'=>1,'limitStart'=>'0','limitEnd'=>$nm,));
        $_["randdata"] = array_merge($_["randdata"],$randdadd);
    }
    foreach($_["randdata"] as $v){
        $_["randdata{$i}"][] = $v;
    }
}


//条件変更遷移フラグ
unset($_SESSION["kaigoi"]["sp_select"]);

?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>セントメディア｜コールセンター求人ならセントメディアのコールセンター求人ナビ</title>
<meta name="description" content="コールセンター求人を探すなら、セントメディアのコールセンター求人ナビ！オペレーター・SV・テレアポ等の様々な求人情報が求人情報が満載です。">
<meta name="keywords" content="コールセンター求人,コールセンター派遣,SV,オペレーター">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require_once './include/head.html'; ?>
<script type="text/javascript" src="common/js/jquery.flatheights.js"></script>
<link rel="stylesheet" type="text/css" href="common/css/jquery.bxslider.css" media="all" />
<script type="text/javascript" src="common/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="common/js/top.js"></script>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
<link rel="icon" type="image/png" href="images/favicon.png">
<link rel="apple-touch-icon" href="images/webclip.png">
</head>
<body>
<?php require_once './include/header.html'; ?>
<article id="Contents" class="top">
    <!--holiday info-->
    <!--
    <style type="text/css">
      .sp_info {
        display: none;
      }

      .pc_info p,
      .sp_info p{
        margin: -20px 0 0px 0;
      }
      @media screen and (max-width: 600px) {
      .sp_info {
        display: block;
      }
      .pc_info {
        display: none;
      }
    }
    </style>
    <div class="pc_info clearfix" style="width:auto; box-sizing:border-box; padding:0 1em 15px; text-align:left; line-height:1.8; background:#fff; font-size:12px; width: 980px; margin: 0 auto;">
      <span style="font-size: 16px; font-weight: bold;">年末年始のご応募対応についてのお知らせ</span><br>
      12/28・12/29・12/30・1/3につきましては、お電話の受付時間を10〜19時に変更させていただきます。<br>
      12/31・1/1・1/2につきましては、お電話の受付を休業させていただきます。<br>
      休業中に応募フォームよりご応募いただいた場合、1/3以降順次対応させていただきます。<br>
      何かとご不便をおかけすることと存じますが、ご理解を賜りますようお願い申し上げます。
    </div>
    <div class="sp_info clearfix" style="width:auto; box-sizing:border-box; margin:0; padding: 10px 1em 1em 1em; text-align:left; border:solid #ccc; border-width:1px 0; line-height:1.8; background:#fff; font-size:12px;">
      <span style="font-size: 16px; font-weight: bold;">年末年始のご応募対応についてのお知らせ</span><br>
      12/28・12/29・12/30・1/3につきましては、お電話の受付時間を10  〜19時に変更させていただきます。<br>
      12/31・1/1・1/2につきましては、お電話の受付を休業させていただきます。<br>
      休業中に応募フォームよりご応募いただいた場合、1/3以降順次対応させていただきます。<br>
      何かとご不便をおかけすることと存じますが、ご理解を賜りますようお願い申し上げます。
    </div>
	-->
 	<!--/holiday info-->
	<section id="TOPBX">
		<section id="Clmbox" class="com_wid top clearfix">
			<section id="Mainbox" class="top">
				<div class="contentbox">
					<div class="ttlbox area">
						<h2 class="com_pc"><img src="images/top_ttl_area.png" alt="エリアから求人を探す"></h2>
						<h2 class="com_sp">エリアから求人を探す</h2>
					</div>
					<!--//spソース-->
					<div class="sp_srcbox area">
						<dl>
						<?php
						foreach($_["prefGroups"] as $t){
						    echo '<dt><a href="#"><span>'.h($t["gp_name"]).'</span></a></dt>';
						    echo '<dd><ul>';
							foreach($_["prefectures"][$t["gp_id"]] as $v){
							    if(!empty($_["prefRec"][$v["id"]])){
							        echo '<li><a href="area';
							        echo '/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
							    }
							}
						    echo '</ul></dd>';
						}
						?>
						</dl>
					</div>
					<div class="ttlbox stn com_sp">
						<h2>駅・路線から求人を探す</h2>
					</div>
					<div class="sp_srcbox">
						<form method="post" action="">
							<div class="srcin">
								<div class="slctbx">
									<select name="area">
									<?php
									foreach($_["prefGroups"] as $v){
									    echo '<option value="'.h($v["gp_id"]).'"';
									    if(empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){
									        echo ($v["gp_id"]=="2")?" selected":"";
									    } else {
									        echo ($_["groupsOn"]==$v["gp_id"])?" selected":"";
									    }
									    echo '>'.h($v["gp_name"]).'</option>';
									}
									?>
									</select>
								</div>
								<p class="btn"><a href="#" class="formSubmitBtnPref2"><span>検索</span></a></p>
							</div>
						</form>
					</div>
					<!--spソース//-->
					<div class="com_box searchbox">
						<div class="searchin">
							<div class="tabbx">
								<ul class="clearfix">
									<li id="area1"<?php
									if($_["groupsOn"]==1){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==1){
									    echo ' src="images/tp_area1_act.png" class="active"';
									} else {
									    echo ' src="images/tp_area1_off.png"';
									}
									?> alt="北海道・東北"></a></li>
									<li id="area2"<?php
									if($_["groupsOn"]==2 or
									empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==2 or
									empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){
									    echo ' src="images/tp_area2_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area2_off.png"';
									}
									?> alt="関東"></a></li>
									<li id="area3"<?php
									if($_["groupsOn"]==3){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==3){
									    echo ' src="images/tp_area3_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area3_off.png"';
									}
									?> alt="甲信越・北陸"></a></li>
									<li id="area4"<?php
									if($_["groupsOn"]==4){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==4){
									    echo ' src="images/tp_area4_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area4_off.png"';
									}
									?> alt="東海"></a></li>
									<li id="area5"<?php
									if($_["groupsOn"]==5){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==5){
									    echo ' src="images/tp_area5_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area5_off.png"';
									}
									?> alt="関西"></a></li>
									<li id="area6"<?php
									if($_["groupsOn"]==6){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==6){
									    echo ' src="images/tp_area6_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area6_off.png"';
									}
									?> alt="中国・四国"></a></li>
									<li id="area7"<?php
									if($_["groupsOn"]==7){
									    echo ' class="on"';
									}
									?>><a href="#"><img <?php
									if($_["groupsOn"]==7){
									    echo ' src="images/tp_area7_act.png"  class="active"';
									} else {
									    echo ' src="images/tp_area7_off.png"';
									}
									?> alt="九州・沖縄"></a></li>
								</ul>
							</div>
							<div class="areabox">
								<div class="areain clearfix area1<?php
									if($_["groupsOn"]==1){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map1.png" alt="北海道・東北"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
													<?php
													$_["nm"]=0;
													foreach($_["prefectures"][1] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="ht'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][1] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area2<?php
									if($_["groupsOn"]==2 or
									empty($_SESSION["kaigoi"]["pms"]["pmsPrefs"])){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/kanto_map.png" alt="関東"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
													<?php
													$_["nm"]=0;
													foreach($_["prefectures"][2] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="kt'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
                                                                                                                                                                                                        
												foreach($_["prefectures"][2] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area3<?php
									if($_["groupsOn"]==3){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map3.png" alt="甲信越・北陸"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
												<?php
													$_["nm"]=0;
													foreach($_["prefectures"][3] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="kk'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][3] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
                                            </ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area4<?php
									if($_["groupsOn"]==4){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map4.png" alt="東海"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
												<?php
													$_["nm"]=0;
													foreach($_["prefectures"][4] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="tok'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][4] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area5<?php
									if($_["groupsOn"]==5){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map5.png" alt="関西"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
												<?php
													$_["nm"]=0;
													foreach($_["prefectures"][5] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="ks'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][5] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area6<?php
									if($_["groupsOn"]==6){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map6.png" alt="中国・四国"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
												<?php
													$_["nm"]=0;
													foreach($_["prefectures"][6] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="cs'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][6] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="areain clearfix area7<?php
									if($_["groupsOn"]==7){
									    echo ' on';
									}
									?>">
									<div class="selectbox">
										<p class="map"><img src="images/top_map7.png" alt="九州・沖縄"></p>
										<div class="selectin">
											<dl>
												<dt><img src="images/area_search_title.png" alt="勤務地から求人を探す"></dt>
											</dl>
											<div class="mapbox">
												<ul>
												<?php
													$_["nm"]=0;
													foreach($_["prefectures"][7] as $k => $v){
													    $_["nm"]++;
													    echo '<li class="ko'.h($_["nm"]).'"><a href="area/'.h($v["id"]).'/">'.h($v["name"]);
													    echo '<span>('.h(count($_["prefRec"][$v["id"]])).')</span>';
													    echo '</a></li>';
													}
													?>
												</ul>
											</div>
										</div>
									</div>
									<div class="trainbox">
										<div class="ttlbx">
											<h4><img src="images/route_search_title.png" alt="路線・駅から求人を探す"></h4>
										</div>
										<div class="ltbx">
											<ul class="clearfix">
												<?php
												foreach($_["prefectures"][7] as $k => $v){
												    echo '<li><a href="line/'.h($v["id"]).'/"><span>'.h($v["name"]).'</span></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="contentbox">
					<div class="ttlbox free">
						<h2 class="com_pc"><img src="images/top_ttl_freeword.png" alt="フリーワード求人検索"></h2>
					<!--//spソース-->
						<h2 class="com_sp">フリーワード求人検索</h2>
					<!--spソース//-->
					</div>
					<div class="com_box freebox">
						<form method="post" action="/search/">
							<div class="freein clearfix">
								<p class="inp"><input name="word" type="text" placeholder="路線名・地域・時給など"></p>
								<p class="btn"><a href="#" class="formSubmitBtnWord"><img src="images/btn_top_serach_off.png" alt="検索"></a></p>
								<p class="nbtn"><a href="#" class="formSubmitBtnWord"><span>検索</span></a></p>
						<!--//spソース-->
						<!--spソース//-->
							</div>
						</form>
					</div>
				</div>
				<div class="contentbox contentbox_select">
					<div class="ttlbox src">
						<h2 class="com_pc"><img src="images/top_ttl_mixsrc.png" alt="条件を指定して求人を探す"></h2>
					<!--//spソース-->
						<h2 class="com_sp">条件を指定して求人を探す</h2>
					<!--spソース//-->
					</div>
					<div class="sp_srcbox">
						<div class="srcin onl">
							<p class="btn"><a href="searchdet/"><span>検索</span></a></p>
						</div>
					</div>
					<form method="post" action="/search/">
						<div class="com_box" id="searchbox">
						<?php require_once './include/searchbox.html'; ?>
						</div>
					</form>
				</div>
			</section>
			<section id="Sidebox">
        <?php 
            //require_once $_SERVER['DOCUMENT_ROOT'].'include/sidebox.html'; 
            require_once './include/sidebox.html';
        ?>
        
        
        <!--
        <div class="merit cntbox">
          <h2><img src="images/side_merit_ttl.png" alt="コールセンター求人ナビのお勧めポイント"></h2>
          <dl class="tp">
            <dt><img src="images/side_merit_ttl1.png" alt="国内最大級の求人数"></dt>
            <dd>コールセンター求人に特化した専門サイトなので、質の高い求人情報が多数揃っています。</dd>
          </dl>
          <dl>
            <dt><img src="images/side_merit_ttl2.png" alt="未経験向けの研修充実"></dt>
            <dd>コールセンターでのお仕事経験が無い方でも安心。基本からしっかり教える研修もあるので不安なくスタート。</dd>
          </dl>
          <dl>
            <dt><img src="images/side_merit_ttl3.png" alt="安心のフォロー体制"></dt>
            <dd>お仕事開始後も、担当のコーディネーターがサポートします。お仕事のお悩みはいつでもご相談ください。</dd>
          </dl>
        </div>
        <div class="flow cntbox">
          <h2><img src="images/side_flow_ttl.png" alt="就業までの流れ"></h2>
          <ul>
            <li class="tp">
              <img src="images/side_flow_ttl1.png" alt="スタッフ登録会の予約をする">
              <span><img src="images/side_flow_gra1.jpg" alt="スタッフ登録会の予約をする"></span>
            </li>
            <li>
              <img src="images/side_flow_ttl2.png" alt="スタッフ登録会でお仕事ご紹介">
              <span><img src="images/side_flow_gra2.jpg" alt="スタッフ登録会でお仕事ご紹介"></span>
            </li>
            <li>
              <img src="images/side_flow_ttl3.png" alt="お仕事スタート">
              <span><img src="images/side_flow_gra3.jpg" alt="お仕事スタート"></span>
            </li>
          </ul>
        </div>
        -->
        
			</section>
		</section>
        
        <?php
        /*
        
        <!--feabox-->
		<div class="feabox">
			<section class="fealtbx">
			    <div class="ttlbx clearfix">
			        <h2 class="com_pc"><img src="images/top_fea_ttl_ct.png" alt="人気の職種・業界特集"></h2>
					<h2 class="com_sp">人気の職種・業界特集</h2>
			        <p class="lnk"><a href="#">一覧へ</a></p>
			    </div>
		        <div class="area">
		        人気の職種・業界特集エリア
		        </div>
		        <p class="com_sp_btn"><a href="#"><span>一覧を見る</span></a></p>
			</section>
			<section class="fealtbx">
			    <div class="ttlbx clearfix">
			        <h2 class="com_pc"><img src="images/top_fea_ttl_area.png" alt="人気のエリア特集"></h2>
					<h2 class="com_sp">人気のエリア特集</h2>
			        <p class="lnk"><a href="#">一覧へ</a></p>
			    </div>
		        <div class="area">
		        人気のエリア特集エリア
		        </div>
		        <p class="com_sp_btn"><a href="#"><span>一覧を見る</span></a></p>
			</section>
			<section class="fealtbx">
			    <div class="ttlbx clearfix">
			        <h2 class="com_pc"><img src="images/top_fea_ttl_word.png" alt="人気の検索ワード特集"></h2>
					<h2 class="com_sp">人気の検索ワード特集</h2>
			        <p class="lnk"><a href="#">一覧へ</a></p>
			    </div>
		        <div class="area">
		        人気の検索ワード特集エリア
		        </div>
		        <p class="com_sp_btn"><a href="#"><span>一覧を見る</span></a></p>
			</section>
		</div>
		<!--feabox-->
        
        */
        ?>
        
        
		<section id="Slidebox" class="com_wid">
			<div class="recobox">
				<div class="slidebox com_pc">
			        <h2><img src="images/top_reco_ttl.png" alt="おすすめ求人"></h2>
					<ul id="reco_slider" class="clearfix">
						<?php
						for($i=0;$i<=3;$i++){
						for($v=1;$v<=4;$v++){
						if(!empty($_["randdata{$v}"][$i])){
						?>
						<li>
							<div class="detbox">
								<div class="detin">
								<p class="ct">[<?php
							    $jobtypeCodesLi = explode(",", $_["randdata{$v}"][$i]["jobtype_codes"]);
							    foreach($jobtypeCodesLi as $k => $t){
							        if(!empty($_["jobTypes"][$t]["name"])){
							            $jobTypesName = $_["jobTypes"][$t]["name"];
							        }
							    }
							    echo h($_["jobTypesSS"][$jobTypesName],"0");
							    ?>]<?php
							    echo h($_["jobIndustries"][$_["randdata{$v}"][$i]["industry_code"]]["name"]);

								if(!empty($_["randdata{$v}"][$i]["cate_codes"])){
								    $cate_codesLi = explode(",", $_["randdata{$v}"][$i]["cate_codes"]);
								    foreach($cate_codesLi as $k => $r){
								        if(!empty($_["jobCategories"][$r]["name"])){
								            echo " / ";
								            echo h($_["jobCategories"][$r]["name"]);
								        }
								    }
								}
							    ?></p>
								<p class="tl"><span><a href="details/<?php echo h($_["randdata{$v}"][$i]["id"]);?>/"><?php echo (!empty($_["randdata{$v}"][$i]["title"]))? h($_["randdata{$v}"][$i]["title"]) :""; ?></a></span></p>
								<dl class="area">
									<dt>[勤務地]</dt>
									<dd><?php
									echo (!empty($_["areas"][$_["randdata{$v}"][$i]["pref_code"]]["name"]))? h($_["areas"][$_["randdata{$v}"][$i]["pref_code"]]["name"]):"";
									echo (!empty($_["cities"][$_["randdata{$v}"][$i]["city_code"]]["city"]))? h($_["cities"][$_["randdata{$v}"][$i]["city_code"]]["city"]):"";
									?></dd>
								</dl>
								<?php
								if(!empty($_["randdata{$v}"][$i]["salary_flg"])){
								?><dl class="yen">
									<dt>[給与]</dt>
									<dd><?php
									echo (!empty($_["randdata{$v}"][$i]["salarytime_low"]) or !empty($_["randdata{$v}"][$i]["salarytime_high"]))? '時給':"";
									echo (!empty($_["randdata{$v}"][$i]["salarytime_low"]))? h($_["randdata{$v}"][$i]["salarytime_low"])."円":"";
									echo (!empty($_["randdata{$v}"][$i]["salarytime_low"]) or !empty($_["randdata{$v}"][$i]["salarytime_high"]))? '～':"";
									echo (!empty($_["randdata{$v}"][$i]["salarytime_high"]))? h($_["randdata{$v}"][$i]["salarytime_high"])."円":"";
									if(!empty($_["randdata{$v}"][$i]["salary"])){
									    echo (!empty($_["randdata{$v}"][$i]["salarytime_low"]) or !empty($_["randdata{$v}"][$i]["salarytime_high"]))? '<br>':"";
									    echo nl2br(h($_["randdata{$v}"][$i]["salary"]));
									}
									?></dd>
								</dl>
								<?php
								}
								?>
								<dl class="day">
									<dt>[勤務日]</dt>
									<dd><?php
									    if(!empty($_["randdata{$v}"][$i]["jobday_codes"])){
									    $_["randdata{$v}"][$i]["jobday_codes"] = explode(",", $_["randdata{$v}"][$i]["jobday_codes"]);
									    $nm = 1;
									    foreach($_["jobdays"] as $r){
									        if(in_array($r["id"],$_["randdata{$v}"][$i]["jobday_codes"])){
										        echo ($nm!=1)?" / ":"";
									            echo h($r["name"]);
										        $nm++;
									        }
									    }
								    }
									if(!empty($_["randdata{$v}"][$i]["jobday"])){
									    echo (!empty($_["randdata{$v}"][$i]["jobday_codes"]))? '<br>':"";
	    								echo nl2br(h($_["randdata{$v}"][$i]["jobday"]));
									}
									?></dd>
								</dl>
								</div>
								<p class="btn"><a href="details/<?php echo h($_["randdata{$v}"][$i]["id"]);?>/">詳しく見る</a></p>
							</div>
						</li>
						<?php
						}
						}
						}
						?>
					</ul>
				</div>
				<div class="reportbx">
				    <div class="ttlbx clearfix">
				        <h2><img src="images/top_ttl_report.png" alt="コールセンターコラム"><span>コールセンターコラム</span></h2>
						<p class="tx">セントメディアがコールセンター情報をお届け</p>
				        <p class="lnk"><a href="report/">コラムをもっと見る</a></p>
				    </div>
				    <ul class="reportin">
<?php
//$rss = simplexml_load_file("http://kaigoi:T6XtpLb5@g-career.jpreport/feed/");
//$rss = simplexml_load_file("https://kaigoi:T6XtpLb5@g-career.jpreport/feed/");
$rss = simplexml_load_file('https://g-career.jp/callcenter/report/feed/');
$i = 0;
foreach ($rss->channel->item as $item) {
    if( $i++ == 5 ) { break; }
    $link = $item->link;
    $title = $item->title;
    $date = date('Y.m.d', strtotime($item->pubDate));
    $desc =$item->description;
    $text = $item->children('content',true)->encoded;;
    
    $img = "";
    if(preg_match('/<img(.*?) \/>/s',$text, $match)){
        $img = $match[0];
    }
    echo '<li><a class="clearfix" href="' . $link . '">';
    echo '<div class="img">'.$img.'</div>';
    echo '<p class="dy">' . $date . '</p>';
    echo '<p class="tl">' . $title . '</p>';
    echo '</a></li>';
}
?>
					</ul>
			        <p class="com_sp_btn"><a href="report/"><span>もっと見る</span></a></p>
				</div>
				<div class="slidebox com_sp">
				    <h2>おすすめ求人</h2>
					<ul>
						<?php
						for($i=1;$i<=4;$i++){
						if(!empty($_["randdata{$i}"])){
						foreach($_["randdata{$i}"] as $v){
						
						?>
						<li>
							<div class="detbox">
								<p class="tl"><a href="details/<?php echo h($v["id"]);?>/"><span><?php echo (!empty($v["title"]))? h($v["title"]) :""; ?></span></a>[<?php
                    								    $jobtypeCodesLi = explode(",", $v["jobtype_codes"]);
                    								    foreach($jobtypeCodesLi as $k => $t){
                    								        if(!empty($_["jobTypes"][$t]["name"])){
                    								            $jobTypesName = $_["jobTypes"][$t]["name"];
                    								        }
                    								    }
                    								    echo h($_["jobTypesSS"][$jobTypesName],"0");
													    ?>]<?php
                    								    echo h($_["jobIndustries"][$v["industry_code"]]["name"]);

														if(!empty($v["cate_codes"])){
														    $v["cate_codes"] = explode(",", $v["cate_codes"]);
														    foreach($v["cate_codes"] as $k => $r){
														        if(!empty($_["jobCategories"][$r]["name"])){
														            echo " / ";
														            echo h($_["jobCategories"][$r]["name"]);
														        }
														    }
														}
                    								    ?></p>
								<dl class="area">
									<dt><span>勤務地</span></dt>
									<dd><?php
									echo (!empty($_["areas"][$v["pref_code"]]["name"]))? h($_["areas"][$v["pref_code"]]["name"]):"";
									echo (!empty($_["cities"][$v["city_code"]]["city"]))? h($_["cities"][$v["city_code"]]["city"]):"";
									?></dd>
								</dl>
								<?php
								if(!empty($v["salary_flg"])){
								?><dl class="yen">
									<dt><span>給 与</span></dt>
									<dd><?php
									echo (!empty($v["salarytime_low"]) or !empty($v["salarytime_high"]))? '時給':"";
									echo (!empty($v["salarytime_low"]))? h($v["salarytime_low"])."円":"";
									echo (!empty($v["salarytime_low"]) or !empty($v["salarytime_high"]))? '～':"";
									echo (!empty($v["salarytime_high"]))? h($v["salarytime_high"])."円":"";
									if(!empty($v["salary"])){
									    echo (!empty($v["salarytime_low"]) or !empty($v["salarytime_high"]))? '<br>':"";
									    echo nl2br(h($v["salary"]));
									}
									?></dd>
								</dl>
								<?php
								}
								?>
								<p class="com_sp_btn mr0"><a href="details/<?php echo h($v["id"]);?>/"><span>詳しく見る</span></a></p>
							</div>
						</li>
						<?php
						break;
						}
						}
						}
						?>
						
					</ul>
				</div>
				<!--[トピックページリンク-PC]-->
				<div id="cc-top-feature-pc">

				<p>
				コールセンターのお仕事特集
				</p>
				<div class="cc-top-feature-wrap">
					<div id="top-topicsSubTitle">
					業界
					</div>
					｜<a href="https://g-career.jptopics/ec.html">通販</a>｜
					<a href="https://g-career.jptopics/securities.html">証券</a>｜
					<a href="https://g-career.jptopics/english.html">英語</a>｜
					<a href="https://g-career.jptopics/it.html">IT</a>｜
					<a href="https://g-career.jptopics/finance.html">金融</a>｜
					<a href="https://g-career.jptopics/bank.html">銀行</a>｜
					<a href="https://g-career.jptopics/creditcard.html">クレジットカード</a>｜
					<a href="https://g-career.jptopics/insurance.html">保険</a>｜
					<a href="https://g-career.jptopics/realestate.html">不動産</a>｜
					<a href="https://g-career.jptopics/companies.html">大手</a>｜
					<a href="https://g-career.jptopics/medical.html">医療</a>｜
					<a href="https://g-career.jptopics/cosmetics.html">化粧品</a>｜
					<a href="https://g-career.jptopics/travel.html">旅行会社</a>｜
					<a href="https://g-career.jptopics/pc.html">パソコン</a>｜


					<div id="top-topicsSubTitle">
					職種
					</div>
					｜<a href="https://g-career.jptopics/tel_apo.html">テレアポ</a>｜
					<a href="https://g-career.jptopics/operator.html">オペレーター</a>｜
					<a href="https://g-career.jptopics/customer.html">カスタマーサポート</a>｜
					<a href="https://g-career.jptopics/technical.html">テクサポ</a>｜
					<a href="https://g-career.jptopics/outbound.html">発信</a>｜
					<a href="https://g-career.jptopics/inbound.html">受信</a>｜
					<a href="https://g-career.jptopics/manager.html">コールセンター管理</a>｜
					<a href="https://g-career.jptopics/sv.html">コールセンターSV</a>｜
					<a href="https://g-career.jptopics/sales.html">営業</a>｜
					<a href="https://g-career.jptopics/clerical.html">事務</a>｜

					<div id="top-topicsSubTitle">
					雇用形態
					</div>
					｜<a href="https://g-career.jptopics/arbeit.html">バイト</a>｜
					<a href="https://g-career.jptopics/haken.html">派遣</a>｜
					<a href="https://g-career.jptopics/seishain.html">正社員</a>｜
					<a href="https://g-career.jptopics/parttime.html">パート</a>｜
					<a href="https://g-career.jptopics/keiyaku.html">契約社員</a>｜
					<a href="https://g-career.jptopics/yakin.html">夜勤</a>｜

					<div id="top-topicsSubTitle">
					エリア
					</div>
					｜<a href="https://g-career.jptopics/kansai.html">関西</a>｜
					<a href="https://g-career.jptopics/kanto.html">関東</a>｜
					<a href="hhttps://g-career.jptopics/osaka.html">大阪府</a>｜
					<a href="https://g-career.jptopics/fukuoka.html">福岡県</a>｜
					<a href="https://g-career.jptopics/tokyo.html">東京都</a>｜
					<a href="https://g-career.jptopics/okinawa.html">沖縄県</a>｜
					<a href="https://g-career.jptopics/saitama.html">埼玉県</a>｜
					<a href="https://g-career.jptopics/kyoto.html">京都府</a>｜
					<a href="https://g-career.jptopics/hiroshima.html">広島県</a>｜
					<a href="https://g-career.jptopics/kanagawa.html">神奈川県</a>｜
					<a href="https://g-career.jptopics/chiba.html">千葉県</a>｜
					<a href="https://g-career.jptopics/kumamoto.html">熊本県</a>｜
					<a href="https://g-career.jptopics/nigata.html">新潟県</a>｜
					<a href="https://g-career.jptopics/miyagi.html">宮城県</a>｜
					<a href="https://g-career.jptopics/aichi.html">愛知県</a>｜
					<a href="https://g-career.jptopics/hyogo.html">兵庫県</a>｜
					<a href="https://g-career.jptopics/kochi.html">高知県</a>｜
					<a href="https://g-career.jptopics/area_kita.html">北区</a>｜
					<a href="https://g-career.jptopics/area_toshima.html">豊島区</a>｜
					<a href="https://g-career.jptopics/area_shinjuku.html">新宿区</a>｜
					<a href="https://g-career.jptopics/area_meguro.html">目黒区</a>｜
					<a href="https://g-career.jptopics/area_shinagawa.html">品川区</a>｜
					<a href="https://g-career.jptopics/area_shibuya.html">渋谷区</a>｜
					<a href="https://g-career.jptopics/area_minato.html">港区</a>｜
					<a href="https://g-career.jptopics/area_chuo.html">中央区</a>｜
					<a href="https://g-career.jptopics/area_itabashi.html">板橋区</a>｜
					<a href="https://g-career.jptopics/area_ota.html">大田区</a>｜
					<a href="https://g-career.jptopics/area_koto.html">江東区</a>｜
					<a href="https://g-career.jptopics/area_edogawa.html">江戸川区</a>｜
					<a href="https://g-career.jptopics/area_setagaya.html">世田谷区</a>｜
					<a href="https://g-career.jptopics/area_bunkyo.html">文京区</a>｜
					<a href="https://g-career.jptopics/area_nakano.html">中野区</a>｜
					<a href="https://g-career.jptopics/area_arakawa.html">荒川区</a>｜
					<a href="https://g-career.jptopics/area_sumida.html">墨田区</a>｜
					<a href="https://g-career.jptopics/area_sapporo.html">札幌市</a>｜
					<a href="https://g-career.jptopics/area_seidai.html">仙台市</a>｜
					<a href="https://g-career.jptopics/area_ikebukuro.html">池袋</a>｜
					<a href="https://g-career.jptopics/area_akihabara.html">秋葉原</a>｜
					<a href="https://g-career.jptopics/area_chofu.html">調布市</a>｜
					<a href="https://g-career.jptopics/area_tama.html">多摩市</a>｜
					<a href="https://g-career.jptopics/area_tachikawa.html">立川市</a>｜
					<a href="https://g-career.jptopics/area_yokohama.html">横浜</a>｜
					<a href="https://g-career.jptopics/area_shinyokohama.html">新横浜</a>｜
					<a href="https://g-career.jptopics/area_urayasu.html">浦安</a>｜
					<a href="https://g-career.jptopics/area_kawasaki.html">川崎</a>｜
					<a href="https://g-career.jptopics/area_fujisawa.html">藤沢</a>｜
					<a href="https://g-career.jptopics/area_makuhari.html">幕張</a>｜
					<a href="https://g-career.jptopics/area_saitama.html">さいたま市</a>｜
					<a href="https://g-career.jptopics/area_urawa.html">浦和</a>｜
					<a href="https://g-career.jptopics/area_omiya.html">大宮</a>｜
					<a href="https://g-career.jptopics/area_chiba.html">千葉市</a>｜
					<a href="https://g-career.jptopics/area_nagoya.html">名古屋</a>｜
					<a href="https://g-career.jptopics/area_kobe.html">神戸</a>｜
					<a href="https://g-career.jptopics/area_osaka.html">大阪市</a>｜
					<a href="https://g-career.jptopics/area_nishi.html">西区</a>｜
					<a href="https://g-career.jptopics/area_fukushimaku.html">福島区</a>｜
					<a href="https://g-career.jptopics/area_yodogawa.html">淀川区</a>｜
					<a href="https://g-career.jptopics/area_suita.html">吹田</a>｜
					<a href="https://g-career.jptopics/area_tennoji.html">天王寺</a>｜
					<a href="https://g-career.jptopics/area_umeda.html">梅田</a>｜
					<a href="https://g-career.jptopics/area_toyonaka.html">豊中市</a>｜
					<a href="https://g-career.jptopics/area_nanba.html">難波</a>｜
					<a href="https://g-career.jptopics/area_fukuoka.html">福岡市</a>｜
					<a href="https://g-career.jptopics/area_hakata.html">博多</a>｜
					<a href="https://g-career.jptopics/area_kitakyusyu.html">北九州市</a>｜
					<a href="https://g-career.jptopics/area_naha.html">那覇</a>｜

					<div id="top-topicsSubTitle">その他</div>
					｜<a href="https://g-career.jptopics/mikeiken.html">未経験</a>｜
					<a href="https://g-career.jptopics/male.html">男性</a>｜
					</div>
				</div>
				<!--[/トピックページリンク-PC]-->
				<!--[トピックページリンク-SP]-->
				<div id="cc-top-feature-sp">
					<div class="sp_footer">
						<div class="footin">
							<div class="tgl_bx">
									<p class="tgl_ttl"><span>コールセンターのお仕事特集</span></p>
									<p class="tgl_in wkbx">

										<span id="top-topicsSubTitle">
										業界
										</span>
										｜<a href="https://g-career.jptopics/ec.html">通販</a>｜
										<a href="https://g-career.jptopics/securities.html">証券</a>｜
										<a href="https://g-career.jptopics/english.html">英語</a>｜
										<a href="https://g-career.jptopics/it.html">IT</a>｜
										<a href="https://g-career.jptopics/finance.html">金融</a>｜
										<a href="https://g-career.jptopics/bank.html">銀行</a>｜
										<a href="https://g-career.jptopics/creditcard.html">クレジットカード</a>｜
										<a href="https://g-career.jptopics/insurance.html">保険</a>｜
										<a href="https://g-career.jptopics/realestate.html">不動産</a>｜
										<a href="https://g-career.jptopics/companies.html">大手</a>｜
										<a href="https://g-career.jptopics/medical.html">医療</a>｜
										<a href="https://g-career.jptopics/cosmetics.html">化粧品</a>｜
										<a href="https://g-career.jptopics/travel.html">旅行会社</a>｜
										<a href="https://g-career.jptopics/pc.html">パソコン</a>｜


										<span id="top-topicsSubTitle">
										職種
										</span>
										｜<a href="https://g-career.jptopics/tel_apo.html">テレアポ</a>｜
										<a href="https://g-career.jptopics/operator.html">オペレーター</a>｜
										<a href="https://g-career.jptopics/customer.html">カスタマーサポート</a>｜
										<a href="https://g-career.jptopics/technical.html">テクサポ</a>｜
										<a href="https://g-career.jptopics/outbound.html">発信</a>｜
										<a href="https://g-career.jptopics/inbound.html">受信</a>｜
										<a href="https://g-career.jptopics/manager.html">コールセンター管理</a>｜
										<a href="https://g-career.jptopics/sv.html">コールセンターSV</a>｜
										<a href="https://g-career.jptopics/sales.html">営業</a>｜
										<a href="https://g-career.jptopics/clerical.html">事務</a>｜

										<span id="top-topicsSubTitle">
										雇用形態
										</span>
										｜<a href="https://g-career.jptopics/arbeit.html">バイト</a>｜
										<a href="https://g-career.jptopics/haken.html">派遣</a>｜
										<a href="https://g-career.jptopics/seishain.html">正社員</a>｜
										<a href="https://g-career.jptopics/parttime.html">パート</a>｜
										<a href="https://g-career.jptopics/keiyaku.html">契約社員</a>｜
										<a href="https://g-career.jptopics/yakin.html">夜勤</a>｜

										<span id="top-topicsSubTitle">
										エリア
										</span>
										｜<a href="https://g-career.jptopics/kansai.html">関西</a>｜
										<a href="https://g-career.jptopics/kanto.html">関東</a>｜
										<a href="hhttps://g-career.jptopics/osaka.html">大阪府</a>｜
										<a href="https://g-career.jptopics/fukuoka.html">福岡県</a>｜
										<a href="https://g-career.jptopics/tokyo.html">東京都</a>｜
										<a href="https://g-career.jptopics/okinawa.html">沖縄県</a>｜
										<a href="https://g-career.jptopics/saitama.html">埼玉県</a>｜
										<a href="https://g-career.jptopics/kyoto.html">京都府</a>｜
										<a href="https://g-career.jptopics/hiroshima.html">広島県</a>｜
										<a href="https://g-career.jptopics/kanagawa.html">神奈川県</a>｜
										<a href="https://g-career.jptopics/chiba.html">千葉県</a>｜
										<a href="https://g-career.jptopics/kumamoto.html">熊本県</a>｜
										<a href="https://g-career.jptopics/nigata.html">新潟県</a>｜
										<a href="https://g-career.jptopics/miyagi.html">宮城県</a>｜
										<a href="https://g-career.jptopics/aichi.html">愛知県</a>｜
										<a href="https://g-career.jptopics/hyogo.html">兵庫県</a>｜
										<a href="https://g-career.jptopics/kochi.html">高知県</a>｜
										<a href="https://g-career.jptopics/area_kita.html">北区</a>｜
										<a href="https://g-career.jptopics/area_toshima.html">豊島区</a>｜
										<a href="https://g-career.jptopics/area_shinjuku.html">新宿区</a>｜
										<a href="https://g-career.jptopics/area_meguro.html">目黒区</a>｜
										<a href="https://g-career.jptopics/area_shinagawa.html">品川区</a>｜
										<a href="https://g-career.jptopics/area_shibuya.html">渋谷区</a>｜
										<a href="https://g-career.jptopics/area_minato.html">港区</a>｜
										<a href="https://g-career.jptopics/area_chuo.html">中央区</a>｜
										<a href="https://g-career.jptopics/area_itabashi.html">板橋区</a>｜
										<a href="https://g-career.jptopics/area_ota.html">大田区</a>｜
										<a href="https://g-career.jptopics/area_koto.html">江東区</a>｜
										<a href="https://g-career.jptopics/area_edogawa.html">江戸川区</a>｜
										<a href="https://g-career.jptopics/area_setagaya.html">世田谷区</a>｜
										<a href="https://g-career.jptopics/area_bunkyo.html">文京区</a>｜
										<a href="https://g-career.jptopics/area_nakano.html">中野区</a>｜
										<a href="https://g-career.jptopics/area_arakawa.html">荒川区</a>｜
										<a href="https://g-career.jptopics/area_sumida.html">墨田区</a>｜
										<a href="https://g-career.jptopics/area_sapporo.html">札幌市</a>｜
										<a href="https://g-career.jptopics/area_seidai.html">仙台市</a>｜
										<a href="https://g-career.jptopics/area_ikebukuro.html">池袋</a>｜
										<a href="https://g-career.jptopics/area_akihabara.html">秋葉原</a>｜
										<a href="https://g-career.jptopics/area_chofu.html">調布市</a>｜
										<a href="https://g-career.jptopics/area_tama.html">多摩市</a>｜
										<a href="https://g-career.jptopics/area_tachikawa.html">立川市</a>｜
										<a href="https://g-career.jptopics/area_yokohama.html">横浜</a>｜
										<a href="https://g-career.jptopics/area_shinyokohama.html">新横浜</a>｜
										<a href="https://g-career.jptopics/area_urayasu.html">浦安</a>｜
										<a href="https://g-career.jptopics/area_kawasaki.html">川崎</a>｜
										<a href="https://g-career.jptopics/area_fujisawa.html">藤沢</a>｜
										<a href="https://g-career.jptopics/area_makuhari.html">幕張</a>｜
										<a href="https://g-career.jptopics/area_saitama.html">さいたま市</a>｜
										<a href="https://g-career.jptopics/area_urawa.html">浦和</a>｜
										<a href="https://g-career.jptopics/area_omiya.html">大宮</a>｜
										<a href="https://g-career.jptopics/area_chiba.html">千葉市</a>｜
										<a href="https://g-career.jptopics/area_nagoya.html">名古屋</a>｜
										<a href="https://g-career.jptopics/area_kobe.html">神戸</a>｜
										<a href="https://g-career.jptopics/area_osaka.html">大阪市</a>｜
										<a href="https://g-career.jptopics/area_nishi.html">西区</a>｜
										<a href="https://g-career.jptopics/area_fukushimaku.html">福島区</a>｜
										<a href="https://g-career.jptopics/area_yodogawa.html">淀川区</a>｜
										<a href="https://g-career.jptopics/area_suita.html">吹田</a>｜
										<a href="https://g-career.jptopics/area_tennoji.html">天王寺</a>｜
										<a href="https://g-career.jptopics/area_umeda.html">梅田</a>｜
										<a href="https://g-career.jptopics/area_toyonaka.html">豊中市</a>｜
										<a href="https://g-career.jptopics/area_nanba.html">難波</a>｜
										<a href="https://g-career.jptopics/area_fukuoka.html">福岡市</a>｜
										<a href="https://g-career.jptopics/area_hakata.html">博多</a>｜
										<a href="https://g-career.jptopics/area_kitakyusyu.html">北九州市</a>｜
										<a href="https://g-career.jptopics/area_naha.html">那覇</a>｜

										<span id="top-topicsSubTitle">その他</span>
										<a href="https://g-career.jptopics/mikeiken.html">未経験</a>｜
										<a href="https://g-career.jptopics/male.html">男性</a>｜

									</p>
							</div>
						</div>
					</div>
				</div>
				<!--[/トピックページリンク-SP]-->
			</div>
		</section>
		<?php require_once './include/sp_bottom.html'; ?>
	</section>
</article>
<?php require_once './include/footer.html'; ?>
</body>
</html>
