<?php require_once dirname($_SERVER['DOCUMENT_ROOT']). '/libs/inc.php'; ?>
<?php if(isset($h1)){$GLOBALS["PAGEH1"] = $h1;}else{$GLOBALS["PAGEH1"] = $pagename."のコールセンター求人ならセントメディアのコールセンター求人ナビ";} ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">

<meta name="description" content="<?php echo h($GLOBALS["PAGDESCRIPTION"]);?>">
<meta name="keywords" content="<?php echo h($GLOBALS["PAGEKEYWORDS"]);?>">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/head.html'; ?>
<link rel="stylesheet" href="/callcenter/topics/css/import.css" type="text/css" media="all" />
<link rel="stylesheet" href="/callcenter/topics/css/mod.css" type="text/css" media="all" />
<link rel="stylesheet" href="/callcenter/topics/css/add.css" type="text/css" media="all" />
<title><?php echo $title; ?></title>
<script type="text/javascript" src="/callcenter/topics/js/content.js"></script>
<script type="text/javascript" src="/callcenter/topics/js/headjs.js"></script>


<script type="text/javascript" src="/callcenter/topics/js/flatheights.js"></script>
<script type="text/javascript" src="/callcenter/topics/js/rollover.js"></script>
<script type="text/javascript" src="/callcenter/topics/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="/callcenter/topics/js/response.min.js"></script>
<script type="text/javascript">
$(function flathts(){
	$('#demand_section dl dt').flatHeights();
});
$(function slidemap(){
	$('.slider_map').bxSlider({
		auto:false,
		speed:700,
		captions: true,
		pagerCustom:'.nvmap'
	});
});
$(function slidetxt(){
	$('.slider_tx').bxSlider({
		auto:false,
		speed:700,
		captions: true,
		pagerCustom:'.nvtx'
	});
});
</script>
<script type="text/javascript" src="/callcenter/topics/js/Chart.js"></script>
<style>
canvas {
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
}
</style>
<script>
function DrawChart(id,name1,data1,name2,data2,name3,data3,name4,data4,name5,data5,name6,data6,name7,data7,name8,data8,name9,data9,name10,data10){
	var name_array = [];
	var data_array = [];
	var leg = id + "leg";
	var legend = document.getElementById(leg);
	var color_array = ["#48AAD5","#F2B30C","#EE6F85","#A3BF13","#0D8C8C","#D048D5","#4863D5","#9E6F76","#AA8C71","#C6C6C6"];

	for(var i = 1; i<=10; i++){
		if(eval("name"+ i) != null){
			name_array.push(eval("name"+ i));
			if(legend != null){
				var leg_item = document.createElement("div");
				var leg_bar = document.createElement("span");
				var leg_contentA = document.createTextNode(eval("name"+ i));
				leg_item.appendChild(leg_bar);
				leg_item.appendChild(leg_contentA);
				legend.appendChild(leg_item);
				leg_bar.style.display = "inline-block";
				leg_bar.style.width = "40px";
				leg_bar.style.height = "12px";
				leg_bar.style.marginRight = "10px";
				leg_bar.style.backgroundColor= color_array[i-1];
				leg_item.style.fontSize= "12px";
				leg_item.style.color= "#666";
			}
		}
		if(eval("data"+ i) != null){
			data_array.push(eval("data"+ i))
		}
	}

	var ctx = document.getElementById(id);
	var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
					labels: name_array,
					datasets: [{
							label: '# of Votes',
							data: data_array,
							backgroundColor: color_array
					}]
			},
			options: {
				animation: {
					animateRotate: false
				},
				legend:{
					onClick: {
					},
					labels:{
						generateLabels: function(chart) {
							return [];
						}
					}
				}
			}
	});
}
</script>
<script>
function DrawChartB(id,name1,data1,name2,data2,name3,data3,name4,data4,name5,data5,name6,data6,name7,data7,name8,data8,name9,data9,name10,data10){
	var name_array = [];
	var data_array = [];
	var leg = id + "leg";
	var legend = document.getElementById(leg);
	var color_array = ["#48AAD5","#F2B30C","#EE6F85","#A3BF13","#0D8C8C","#D048D5","#4863D5","#9E6F76","#AA8C71","#C6C6C6"];

	for(var i = 1; i<=10; i++){
		if(eval("name"+ i) != null){
			name_array.push(eval("name"+ i));
			if(legend != null){
				var leg_item = document.createElement("div");
				var leg_bar = document.createElement("span");
				var leg_contentA = document.createTextNode(eval("name"+ i));
				leg_item.appendChild(leg_bar);
				leg_item.appendChild(leg_contentA);
				legend.appendChild(leg_item);
				leg_bar.style.display = "inline-block";
				leg_bar.style.width = "40px";
				leg_bar.style.height = "12px";
				leg_bar.style.marginRight = "10px";
				leg_bar.style.backgroundColor= color_array[i-1];
				leg_item.style.fontSize= "12px";
				leg_item.style.color= "#666";
			}
		}
		if(eval("data"+ i) != null){
			data_array.push(eval("data"+ i))
		}
	}

	var ctx = document.getElementById(id);
	var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
					labels: name_array,
					datasets: [{
							label: '# of Votes',
							data: data_array,
							backgroundColor: color_array,
							borderColor:"#F1EFE3"
					}]
			},
			options: {
				animation: {
					animateRotate: false
				},
				legend:{
					onClick: {
					},
					labels:{
						generateLabels: function(chart) {
							return [];
						}
					}
				}
			}
	});
}
</script>
<script>
function DrawChartBar(id,name1,data1,name2,data2,name3,data3,name4,data4,name5,data5,name6,data6,name7,data7){
	var name_array = [];
	var data_array = [];
	var color_array = ["#48AAD5","#F2B30C","#EE6F85","#A3BF13","#0D8C8C","#D048D5","#4863D5","#9E6F76","#AA8C71","#C6C6C6"];

	for(var i = 1; i<=7; i++){
		if(eval("name"+ i) != null){
			name_array.push(eval("name"+ i))
		}
		if(eval("data"+ i) != null){
			data_array.push(eval("data"+ i))
		}
	}

	var ctx = document.getElementById(id);
	var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
					labels: name_array,
					datasets: [{
							label: '条件比率',
							data: data_array,
							backgroundColor:color_array
					}]
			},
			options: {
				animation: {
					animateRotate: false
				},
				legend:{
					onClick: {
					},
					labels:{
					}
				}
			}
	});
}
</script>

</head>
<body data-responsejs='{ 
  "create": [{ 
    "prop": "width",
    "prefix": "min-width- r src",
    "breakpoints": [0, 701]
  }]
}'>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/header.html'; ?>
<article id="Contents">
	<section class="com_pnkzbox m_b10">
		<ul class="clearfix" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<li><a href="<?php echo h($GLOBALS["PNKZURL"]);?>" itemprop="url"><span itemprop="title"><?php echo h($GLOBALS["PNKZTITLE"]);?></span></a></li>
			<li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo $title;?></li>
		</ul>
	</section>
	<section id="FAQBX">
		<section id="Clmbox" class="com_wid clearfix">


            <section id="Mainbox">

	<!--[content]-->
	<div id="content">
		<div id="lps_inner">
			<div class="kv">
				<h2><img src="<?php echo $h2UrlSp; ?>" data-min-width-0="<?php echo $h2UrlSp; ?>" data-min-width-701="<?php echo $h2Url; ?>" alt="<?php echo $h2; ?>" /></h2>
				<p class="kv_txt"><?php echo $kvTxt; ?></p>
			</div>
			<div id="con1" class="bg1">
				<h3 class="headline">業界から<?php echo $pagename; ?>の求人を探す</h3>
				<div class="list_box clearfix">
					<ul class="link_list list2">
						<?php echo $gyoushuList; ?>
					</ul>
				</div>
				<h3 class="headline">人気条件から<?php echo $pagename; ?>の求人を探す</h3>
				<div class="list_box clearfix">
					<ul class="link_list list5">
						<?php echo $joukenList; ?>
					</ul>
				</div>
				<div class="btn_entry fix">
					<a href="https://g-career.jp/callcenter/entry/"><img src="/callcenter/topics/images/addimages/topics/entry_btn_off.png" alt="スタッフ登録する！（無料）" /></a>
				</div>
			</div>

			<div id="con9" class="block_center mt40">
				<h3 class="headline">コールセンターで身につく3つのスキル</h3>
				<div class="center">
				<p class="mb20 p_bg">コールセンターで派遣として勤務することで、<br />下記のようなスキルを身につけることが期待できます。</p>
				</div>
				<div class="column3 clearfix">
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_a_1.png" alt="話す" />
						<p class="headline_s2 num1">丁寧で分かりやすい<br />言葉遣いが身につく</p>
					</div>
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_b_1.png" alt="聴く" />
						<p class="headline_s2 num2">電話相手の悩みや状況を<br />聴く力が向上する</p>
					</div>
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_c_1.png" alt="知識" />
						<p class="headline_s2 num3">業界知識や商品知識、<br />パソコンスキルが身につく</p>
					</div>
				</div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_1.png" class="merit_num" alt="1" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">丁寧で分かりやすい言葉遣いが身につく</p><?php echo $skillATxt; ?></div></div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_2.png" class="merit_num" alt="2" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">電話相手の悩みや状況を聴く力が向上する</p><?php echo $skillBTxt; ?></div></div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_3.png" class="merit_num" alt="3" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">業界知識や商品知識、パソコンスキルが身につく</p><?php echo $skillCTxt; ?></div></div>
			</div>

			<div id="con10" class="block_center">
				<h3 class="headline">コールセンター求人の3つの特長</h3>
				<div class="center">
					<p class="mb20 p_bg">コールセンターの求人には、スキルを身につけられる以外にも<br />次のようなメリットがあります。</p>
				</div>
				<div class="column3 clearfix">
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_a_2.png" alt="シフト" />
						<p class="headline_s2 num1">曜日や短時間での勤務などシフトの融通が利きやすい</p>
					</div>
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_b_2.png" alt="研修" />
						<p class="headline_s2 num2">研修体制が整っているので未経験でも安心</p>
					</div>
					<div>
						<img src="/callcenter/topics/images/addimages/topics/ch_l_c_2.png" alt="高時給" />
						<p class="headline_s2 num3">高時給の求人が多い</p>
					</div>
				</div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_1.png" class="merit_num" alt="1" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">曜日や短時間での勤務などシフトの融通が利きやすい</p><?php echo $featureATxt; ?></div></div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_2.png" class="merit_num" alt="2" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">研修体制が整っているので未経験でも安心</p><?php echo $featureBTxt; ?></div></div>
				<div class="mnl_merit_box clearfix"><img src="/callcenter/topics/images/guide/manual/mnl_merit_3.png" class="merit_num" alt="3" /><div class="mnl_merit_boxR"><p class="mnl_merit_txt1">高時給の求人が多い</p><?php echo $featureCTxt; ?></div></div>
				<div class="btn_entry fix">
					<a href="https://g-career.jp/callcenter/entry/"><img src="/callcenter/topics/images/addimages/topics/entry_btn_off.png" alt="スタッフ登録する！（無料）" /></a>
				</div>
			</div>

			<div id="con3" class="block_center">
				<h3 class="headline">コールセンターのお仕事内容</h3>
				<div class="w640">
					<p class="mb20">コールセンターのお仕事は、受信と発信の二つに分けることができます。それぞれの内容は下記となります。</p>
					<dl class="top-qa-box">
					<dt class="w_free">受信（インバウンド）</dt>
					<dd>受信の仕事内容</dd>
					</dl>
					<?php echo $inboundTxt; ?>
					<dl class="top-qa-box">
					<dt class="w_free">発信（アウトバウンド）</dt>
					<dd>発信の仕事内容</dd>
					</dl>
					<?php echo $outboundTxt; ?>
				</div>
			</div>

			<div id="con6" class="block_center">
				<h3 class="headline">どんな求人があるの？</h3>
				<div class="clearfix w640 mb30">
					<div class="cc_dataL mb20">
						<h4 class="headline_s">人気条件の求人比率</h4>
						<div class="cc_data_txt"><?php echo $chart1Txt; ?></div>
					</div>
					<div class="cc_dataR">
						<div class="barchart">
							<canvas id="Chart1" width="100" height="80"></canvas>
							<script>DrawChartBar(<?php echo $chart1Data; ?>);</script>
						</div>
					</div>
				</div>
				<div class="clearfix w640">
					<div class="clearfix relative">
						<div class="cc_data_txt c3txt">
							<h4 class="headline_s">業界別の求人比率</h4>
							<?php echo $chart2Txt; ?>
						</div>
						<div id="Chart2leg" class="legend c3leg"></div>
						<div class="c3canvas chartfix">
							<canvas id="Chart2" width="100" height="50"></canvas>
						</div>
						<script>DrawChart(<?php echo $chart2Data; ?>);</script>
					</div>
				</div>
			</div>

			<div id="con8" class="block_center bg1 mt40">
				<h3 class="headline"><?php echo $con8H3A; ?></h3>
				<div class="sep_line w640">
					<div class="clearfix w640">
						<div class="clearfix">
							<div class="cc_data_txt c3txt">
								<h4 class="headline_s"><?php echo $chart3H4; ?></h4>
								<?php echo $chart3Txt; ?>
							</div>
							<div id="Chart3leg" class="legend c3leg"></div>
							<div class="c3canvas">
								<canvas id="Chart3" width="100" height="100"></canvas>
							</div>
							<script>DrawChartB(<?php echo $chart3Data; ?>);</script>
						</div>
					</div>
				</div>
				<div class="w640">
					<div class="clearfix w640">
						<div class="clearfix">
							<div class="cc_data_txt c3txt">
								<h4 class="headline_s"><?php echo $chart4H4; ?></h4>
								<?php echo $chart4Txt; ?>
							</div>
							<div id="Chart4leg" class="legend c3leg" style="margin-top:0;"></div>
							<div class="c3canvas">
								<canvas id="Chart4" width="100" height="100"></canvas>
							</div>
							<script>DrawChartB(<?php echo $chart4Data; ?>);</script>
						</div>
					</div>
				</div>
				<h3 class="headline hl8h3b"><?php echo $con8H3B; ?></h3>
				<div class="sep_line w640">
					<div class="clearfix w640">
						<div class="cc_dataL cc_chartfix_b" style="padding-right:0px;">
						<h4 class="headline_s">総合的な満足度</h4>
							<canvas id="Chart5" width="100" height="56.25"></canvas>
							<div style="text-align:left;">
								<div id="Chart5leg" class="legend"></div>
								<script>DrawChartB(<?php echo $chart5Data; ?>);</script>
							</div>
						</div>
						<div class="cc_dataR cc_chartfix_b" style="">
						<h4 class="headline_s">仕事内容の満足度</h4>
							<canvas id="Chart6" width="100" height="56.25"></canvas>
							<div style="text-align:left;">
								<div id="Chart6leg" class="legend"></div>
								<script>DrawChartB(<?php echo $chart6Data; ?>);</script>
							</div>
						</div>
					</div>
				</div>
				<div class="sep_line w640">
					<div class="clearfix w640">
						<div class="cc_dataL cc_chartfix_b" style="padding-right:0px;">
							<h4 class="headline_s">職場環境の満足度</h4>
							<canvas id="Chart7" width="100" height="56.25"></canvas>
							<div style="text-align:left;">
								<div id="Chart7leg" class="legend"></div>
								<script>DrawChartB(<?php echo $chart7Data; ?>);</script>
							</div>
						</div>
						<div class="cc_dataR cc_chartfix_b" style="">
							<h4 class="headline_s">職場の人間関係の満足度</h4>
							<canvas id="Chart8" width="100" height="56.25"></canvas>
							<div style="text-align:left;">
								<div id="Chart8leg" class="legend"></div>
								<script>DrawChartB(<?php echo $chart8Data; ?>);</script>
							</div>
						</div>
					</div>
				</div>
				<div class="sep_line w640">
					<h4 class="headline_s sub_c">コールセンターで働くことに決めた理由は？</h4>
					<div class="clearfix">
						<img src="/callcenter/topics/images/addimages/topics/ch_a_2.png" />
						<div class="anxiousR">
							<ul class="buzz_list">
								<?php echo $riyuList; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="sep_line w640">
					<h4 class="headline_s sub_c">コールセンターで働く前に不安だったこと</h4>
					<div class="clearfix">
						<img class="f_right" src="/callcenter/topics/images/addimages/topics/ch_a_1rm.png" />
						<div class="anxiousL">
							<ul class="buzz_list">
								<?php echo $huanList; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="sep_line w640">
					<h4 class="headline_s sub_c">スキルアップできた？</h4>
						<div class="clearfix">
							<img src="/callcenter/topics/images/addimages/topics/ch_b_2m.png" />
							<div class="anxiousR">
								<ul class="buzz_list">
									<?php echo $skillupList; ?>
								</ul>
							</div>
						</div>
				</div>
				<div class="w640">
					<h4 class="headline_s sub_c">これから働く人にアドバイス</h4>
					<div class="clearfix">
						<img class="f_right" src="/callcenter/topics/images/addimages/topics/ch_b_1r.png" />
						<div class="anxiousL">
							<ul class="buzz_list">
								<?php echo $adviceList; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="btn_entry fix">
					<a href="https://g-career.jp/callcenter/entry/"><img src="/callcenter/topics/images/addimages/topics/entry_btn_off.png" alt="スタッフ登録する！（無料）" /></a>
				</div>
			</div>
			<?php if(isset($taikendan1Txt) || isset($taikendan2Txt) || isset($taikendan3Txt)): ?>
			<div id="con4" class="block_center mt40">
				<h3 class="headline"><?php echo $con4H3; ?></h3>
				<?php if(isset($taikendan1Txt)): ?>
				<div class="taikendan">
					<h4 class="taikendan_hl"><?php echo $taikendan1H4; ?></h4>
					<div class="clearfix">
						<div class="taikendan_l">
							<table class="taikendan_plf">
							<tr>
								<th colspan="2" class="t_head"><?php echo $taikendan1Biz; ?></th>
							</tr>
							<tr>
								<th>年齢</th>
								<td><?php echo $taikendan1Age; ?></td>
							</tr>
							<tr>
								<th>業務経験</th>
								<td><?php echo $taikendan1Exp; ?></td>
							</tr>
							</table>
						</div>
						<div class="taikendan_r">
							<h5 class="taikendan_hls"><?php echo $taikendan1H5; ?></h5>
							<div><img style="float:right;" src="<?php echo $taikendan1IconUrl; ?>" width="100" />
								<?php echo $taikendan1Txt; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if(isset($taikendan2Txt)): ?>
				<div class="taikendan">
					<h4 class="taikendan_hl"><?php echo $taikendan2H4; ?></h4>
					<div class="clearfix">
						<div class="taikendan_l">
							<table class="taikendan_plf">
							<tr>
								<th colspan="2" class="t_head"><?php echo $taikendan2Biz; ?></th>
							</tr>
							<tr>
								<th>年齢</th>
								<td><?php echo $taikendan2Age; ?></td>
							</tr>
							<tr>
								<th>業務経験</th>
								<td><?php echo $taikendan2Exp; ?></td>
							</tr>
							</table>
						</div>
						<div class="taikendan_r">
							<h5 class="taikendan_hls"><?php echo $taikendan2H5; ?></h5>
							<div><img style="float:right;" src="<?php echo $taikendan2IconUrl; ?>" width="100" />
								<?php echo $taikendan2Txt; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if(isset($taikendan3Txt)): ?>
				<div class="taikendan last">
					<h4 class="taikendan_hl"><?php echo $taikendan3H4; ?></h4>
					<div class="clearfix">
						<div class="taikendan_l">
							<table class="taikendan_plf">
							<tr>
								<th colspan="2" class="t_head"><?php echo $taikendan3Biz; ?></th>
							</tr>
							<tr>
								<th>年齢</th>
								<td><?php echo $taikendan3Age; ?></td>
							</tr>
							<tr>
								<th>業務経験</th>
								<td><?php echo $taikendan3Exp; ?></td>
							</tr>
							</table>
						</div>
						<div class="taikendan_r">
							<h5 class="taikendan_hls"><?php echo $taikendan3H5; ?></h5>
							<div><img style="float:right;" src="<?php echo $taikendan3IconUrl; ?>" width="100" />
								<?php echo $taikendan3Txt; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<div id="con12" class="block_center bg3">
				<h3 class="headline">応募までの流れ</h3>
				<div class="detail_flow_box">
					<div class="detail_flow_boxL">
						<img class="fl1" src="/callcenter/topics/images/detail_flow_ttl01.png" alt="ご応募申し込み" />
						<p>パソコンまたはお電話からご応募ください。パソコンから応募の場合、応募後当社よりお電話がありますので、その際に登録会の参加日をお伝えください。</p>
					</div>
					<div class="detail_flow_boxR"> <img src="/callcenter/topics/images/detail_flow_img01.png" alt="ご応募申し込み" /> </div>
					<img class="flow_bar" src="/callcenter/topics/images/detail_flow_bar.png" alt="" />
				</div>
				<div class="detail_flow_box">
					<div class="detail_flow_boxL">
						<img class="fl2" src="/callcenter/topics/images/detail_flow_ttl02.png" alt="スタッフ登録会へ参加" />
						<p>スタッフ登録会は日本全国9ヶ所の会場で行っています。ご予約頂いた参加日と登録会場でスタッフ登録を行ってください。</p>
					</div>
					<div class="detail_flow_boxR"> <img src="/callcenter/topics/images/detail_flow_img02.png" alt="スタッフ登録会へ参加" /> </div>
					<img class="flow_bar" src="/callcenter/topics/images/detail_flow_bar.png" alt="" />
				</div>
				<div class="detail_flow_box">
					<div class="detail_flow_boxL">
						<img class="fl3" src="/callcenter/topics/images/detail_flow_ttl03.png" alt="お仕事紹介" />
						<p>スタッフ登録が済みましたら、お聞きしたご希望に合わせてお仕事をご紹介していきます。</p>
					</div>
					<div class="detail_flow_boxR"> <img src="/callcenter/topics/images/detail_flow_img03.png" alt="お仕事紹介" /> </div>
					<img class="flow_bar" src="/callcenter/topics/images/detail_flow_bar.png" alt="" />
				</div>
				<div class="detail_flow_box">
					<div class="detail_flow_boxL">
						<img class="fl4" src="/callcenter/topics/images/detail_flow_ttl04.png" alt="研修でスキルアップ" />
						<p>コールセンターで働くために必要な敬語やマナーなど基本的なことを学びます。</p>
					</div>
					<div class="detail_flow_boxR"> <img src="/callcenter/topics/images/detail_flow_img04.png" alt="研修でスキルアップ" /> </div>
					<img class="flow_bar" src="/callcenter/topics/images/detail_flow_bar.png" alt="" />
				</div>
				<div class="detail_flow_box">
					<div class="detail_flow_boxLB">
						<img class="fl5" src="/callcenter/topics/images/detail_flow_ttl05.png" alt="お仕事スタート" />
						<p>お仕事開始後も継続的にコーディネーターがスタッフさんをサポートします。わからないこと不安なことはいつでもご相談してくださいね！</p>
					</div>
					<div class="detail_flow_boxR"> <img src="/callcenter/topics/images/detail_flow_img05.png" alt="お仕事スタート" /> </div>
					<img class="flow_bar" src="/callcenter/topics/images/detail_flow_bar.png" alt="" />
				</div>
			</div>

			<div id="con13" class="block_center mt40">
				<h3 class="headline">セントメディアのサービスの特徴</h3>
				<div class="clearfix w640">
					<div id="cc_training01"><h4 class="feature">日本全国対応！</h4>
						<p>セントメディアは全国の拠点をフル活用してコールセンターのお仕事を紹介しています。はじめての方でも安心してお仕事を始められるように当社スタッフが手取り足取りサポートを行います。</p>
					</div>
					<div id="cc_training02"><h4 class="feature">国内最大級の求人数！</h4>
						<p>セントメディアでは、全国で数千件以上のコールセンター求人を公開しています。雇用形態・時給・実務経験・職場環境・働き方・こだわり条件などから、ご希望の求人を検索することができます。</p>
					</div>

					<div id="cc_training03"><h4 class="feature">福利厚生が充実！</h4>
						<p>セントメディアへスタッフ登録をしているすべての方が、国内20,000軒のホテル・旅館が最大80%OFF、大手旅行会社企画のパッケージツアーが最大10％OFFといったお得な福利厚生をご利用可能です。</p>
					</div>

					<table class="plf_table">
						<tr>
							<th colspan="2" class="center th2">会社概要</th>
						</tr>
						<tr>
							<th>社名</th>
							<td>株式会社セントメディア<br />※東証一部上場『株式会社ウィルグループ』のグループ企業です</td>
						</tr>
						<tr>
							<th>本社住所</th>
							<td>〒160-0022<br />東京都新宿区新宿三丁目1番24号　京王新宿三丁目ビル3階</td>
						</tr>
						<tr>
							<th>資本金</th>
							<td>9,900万円</td>
						</tr>
						<tr>
							<th>設立</th>
							<td>平成9年1月29日</td>
						</tr>
					</table>

					<div class="btn_entry fix">
						<a href="https://g-career.jp/callcenter/entry/"><img src="/callcenter/topics/images/addimages/topics/entry_btn_off.png" alt="スタッフ登録する！（無料）" /></a>
					</div>
				</div>
			</div>
		</div><!--[/lps_inner]-->
	</div><!--[/content]-->
			</section>
            <section id="Sidebox">
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sidebox.html'; ?>
			</section>


		</section>
		<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sp_bottom.html'; ?>
	</section>
</article>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/footer.html'; ?>

</body>
</html>
