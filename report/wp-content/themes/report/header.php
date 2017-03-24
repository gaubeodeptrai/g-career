<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']). '/libs/inc.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
     $options = get_desing_plus_option();
     if($options['use_ogp']) {
?>
<!--[if lt IE 9]><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" class="ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#"><!--<![endif]-->
<?php } else { ?>
<!--[if lt IE 9]><html xmlns="http://www.w3.org/1999/xhtml" class="ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]-->
<?php }; ?>
<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<?php
if(
preg_match ("/^\/g-career\/report\/category\/experiences\/.+$/u", $_SERVER["REQUEST_URI"]) or
preg_match ("/^\/g-career\/report\/category\/experiences\/$/u", $_SERVER["REQUEST_URI"])
){
?>
<meta name="description" content="コールセンター求人ナビのお仕事体験談のページです。<?php echo h($GLOBALS["PAGDESCRIPTION"]);?>">
<?php
} else {
?>
<meta name="description" content="コールセンター求人ナビのコラムのページです。<?php echo h($GLOBALS["PAGDESCRIPTION"]);?>">
<?php
}
?>
<meta name="keywords" content="<?php echo h($GLOBALS["PAGEKEYWORDS"]);?>">

<!-- 20161129 Tagページへの追加 -->
<?php if( is_date() or is_tag()){ ?>
<meta name="robots" content="noindex">
<?php } ?>
<!-- 20161129 Tagページへの追加 End -->

<?php if( is_home() ) { ?>
<title>体験談・コラム｜<?php echo h($GLOBALS["PAGETITLE"]);?></title>


<?php } else if( is_category() ){ ?>
<title><?php echo get_meta_description_from_category(); ?>｜<?php echo h($GLOBALS["PAGETITLE"]);?></title>

<?php } else if( is_single() ){ ?>
<title><?php echo get_the_title(); ?>｜<?php echo h($GLOBALS["PAGETITLE"]);?></title>

<?php } else if( is_tag() ){ ?>
<title><?php single_cat_title(); ?>タグの記事一覧です。|<?php echo h($GLOBALS["PAGETITLE"]);?></title>

<?php } ?>

<?php if($options['use_ogp']) { ogp(); }; ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<link rel="stylesheet" type="text/css" href="/g-career/common/css/common.css" media="all" />
<link rel="stylesheet" type="text/css" href="/g-career/common/css/sp.css" media="all" />
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/style.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/comment-style.css<?php version_num(); ?>" type="text/css" />

<link rel="stylesheet" media="screen and (min-width:701px)" href="/g-career/report/wp-content/themes/report/style_pc.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" media="screen and (max-width:700px)" href="/g-career/report/wp-content/themes/report/style_sp.css<?php version_num(); ?>" type="text/css" />

<?php if (strtoupper(get_locale()) == 'JA') ://to fix the font-size for japanese font ?>
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/japanese.css<?php version_num(); ?>" type="text/css" />
<?php endif; ?>

<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/common-customize.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/sp-customize.css<?php version_num(); ?>" type="text/css" />

<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/jscript.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/scroll.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/comment.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/rollover.js<?php version_num(); ?>"></script>
<!--[if lt IE 9]>
<link id="stylesheet" rel="stylesheet" href="/g-career/report/wp-content/themes/report/style_pc.css<?php version_num(); ?>" type="text/css" />
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/ie.js<?php version_num(); ?>"></script>
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/ie.css" type="text/css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" href="/g-career/report/wp-content/themes/report/ie7.css" type="text/css" />
<![endif]-->
<?php if(is_home()) { ?>
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
jQuery(window).on('load',function() {
 jQuery('.flexslider').flexslider({
   slideshowSpeed: 4000,
   directionNav: false,
   manualControls: ".flex-control-nav li"
 });
});
</script>
<?php }; ?>
<script type="text/javascript" src="/g-career/report/wp-content/themes/report/js/script.js<?php version_num(); ?>"></script>
<?php if (is_category() or is_single()) { ?>
<script type="text/javascript">
jQuery(function ($) {
     if($(".cat-post-widget h3").size()){
         var txt = $(".cat-post-widget h3").html();
         txt = txt.replace(/：/g,'：<br />');
         $(".cat-post-widget h3").html(txt);
     }
});
</script>
<?php }; ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NT7996Z');</script>
<!-- End Google Tag Manager -->

</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NT7996Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php  require_once $_SERVER['DOCUMENT_ROOT'].'/g-career/include/header.html'; ?>


  </div><!-- END #header -->

 </div><!-- END #header_wrap -->
 

<?php
/*
 <!-- global menu -->
 <?php if (has_nav_menu('global-menu')) { ?>
 <div id="global_menu" class="clearfix">
  <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'depth' => '1', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
 </div>
 <?php }; ?>
*/
?>


 <div id="contentainer" >
 <div id="contents" class="clearfix">


 	<?php get_template_part('breadcrumb'); ?>
 
	