<?php
session_start();

if($_SERVER["HTTP_HOST"]=="test.kaigo-i.jp"){
    define("LIB_ROOT", "/test_libs");
//    define("HB_URL", "http://test.g-career.jp/");
    define("HB_URL", "http://g-career.jp/");
    define("WWW_ROOT", "/kaigo-i/kaigo-i00001/test");
    ini_set( 'display_errors', 1 );
} else {
    define("LIB_ROOT", "/libs");
    define("HB_URL", "http://g-career.jp/");
    define("WWW_ROOT", "/kaigo-i/kaigo-i00001/www");
}

//エラー
//ini_set( 'display_errors', 1 );

/*require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/db.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/data.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/pager.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/fn.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/mail.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']).LIB_ROOT.'/token.php';*/
require_once 'db.php';
require_once 'data.php';
require_once 'pager.php';
require_once 'fn.php';
require_once 'mail.php';
require_once 'token.php';
define("ADMIN_ID", "kaigoi");
define("ADMIN_PASS", "UR3XgxBp26");

//define("ADMIN_EM_FROM", "moribe@kipply.jp");
//define("ADMIN_EM_FROM_NM", "介護iランド");
//define("ADMIN_EM", "moribe@kipply.jp");
//define("ADMIN_BCC", "");

$GLOBALS["PAGETITLE"] = "介護士の求人・転職・派遣の仕事情報なら【介護iランド（アイランド）】";
$GLOBALS["PAGEH1"] = "介護士や福祉士の求人・転職・派遣の紹介サイト";
$GLOBALS["PAGDESCRIPTION"] = "介護の求人なら介護iランド（アイランド）。全国の介護求人を掲載していますので、ご希望の勤務先、介護士・介護福祉士・介護事務など職種別や、転職・派遣・アルバイトなど自分に合った働き方で仕事を探せます。介護iランド（アイランド）はやりがいマッチングNo.1を目指します。";
$GLOBALS["PAGEKEYWORDS"] = "介護,福祉,士,求人,転職,派遣,仕事,iランド,アイランド";

$GLOBALS["PNKZTITLE"] = "介護iランドTOP";
$GLOBALS["PNKZURL"] = "http://kaigo-i.jp";


//デバイス判別
if (
	((strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false)//iphoneか、
	 || ((strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false) && (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false))//またはAndroidMobile端末、
	 || (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') !== false)//またはWindowsPhone、
	 || (strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false))//またはBlackBerryの場合
//判別条件end
 ) {
      $GLOBALS["DEVICE"] = "sp";
} else {
      $GLOBALS["DEVICE"] = "pc";
}


DB::connect();