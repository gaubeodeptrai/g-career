<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_col" class="clearfix">

 <div id="left_col">

  <?php
  /*
  if(
  preg_match ("/^\/callcenter\/report\/category\/experiences\/.+$/u", $_SERVER["REQUEST_URI"]) or
  preg_match ("/^\/callcenter\/report\/category\/experiences\/$/u", $_SERVER["REQUEST_URI"])
  ){
  ?>
  <h2 class="com_tlx"><img src="/callcenter/images/title_report.png" alt="お仕事体験談" /></h2>
  <h2 class="com_spttl"><img src="/callcenter/images/sp_title_report.png" alt="お仕事体験談" height="26" /></h2>
  <?php
  } else {
  ?>
  <h2 class="com_tlx"><img src="/callcenter/images/title_column.png" alt="コラム" ></h2>
  <h2 class="com_spttl"><img src="/callcenter/images/sp_ttl_column.png" alt="コラム" height="26"></h2>
  <?php
  }
  */
  ?>
  <h2 class="com_tlx"><img src="/callcenter/images/title_column.png" alt="体験談・コラム" ></h2>
  <h2 class="com_spttl"><img src="/callcenter/images/sp_ttl_column.png" alt="体験談・コラム" height="26"></h2>
  
  
 <?php if ( have_posts() ) : ?>

 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 <?php if (is_category()) { ?>
 <h2 class="headline1 brno"><?php
 echo single_cat_title('', false);
 ?></h2>

 <?php } elseif( is_tag() ) { ?>
 <h2 class="headline1 brno"><?php
 echo single_tag_title('', false);
 ?></h2>

 <?php } elseif (is_month()) { ?>
 <h2 class="headline1 brno"><?php
 echo get_the_time(__('F, Y', 'tcd-w'))
 ?></h2>

 <?php }; ?>

 <ul id="post_list" class="clearfix">
  <?php while ( have_posts() ) : the_post(); ?>
  <li class="clearfix">
   <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
   <div class="info">
    <?php if ($options['show_date']) { ?>
    <ul class="meta clearfix">
     <?php if ($options['show_date']) { ?><li class="post_date"><?php the_time('Y/n/j'); ?></li><?php }; ?>
     <li class="post_category"><?php the_category(', '); ?></li>
    </ul>
    <?php }; ?>
    <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
    <div class="excerpt"><?php if (has_excerpt()) { the_excerpt(); } else { new_excerpt(110);}; ?></div>
    <?php if($options['show_bookmark']) { include('bookmark.php'); };?>
   </div>
  </li><!-- END .post_list -->
  <?php endwhile; else: ?>
  <li class="no_post"><?php _e("There is no registered post.","tcd-w"); ?></li>
  <?php endif; ?>
 </ul>

 <?php include('navigation.php'); ?>

 </div><!-- END #left_col -->

 <?php get_template_part('sidebar1'); ?>

</div><!-- END #main_col -->

<?php get_template_part('sidebar2'); ?>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sp_bottom.html'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/footer_column.html'; ?>

</body>
</html>

