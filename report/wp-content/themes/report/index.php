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
  
  <?php // Recent post --------------------------------------------------------------------------------------- ?>
  <div id="index_recent_post">
   <h3 class="headline1"><?php _e("Recent post","tcd-w"); ?></h3>
   <?php
        $odd_or_even = 'odd';
        $args = array('post_type' => 'post', 'posts_per_page' => 6);
        $index_recent_post = get_posts($args);
        if ($index_recent_post) {
   ?>
   <ul class="clearfix">
    <?php foreach ($index_recent_post as $post) : setup_postdata ($post); ?>
    <li class="clearfix <?php echo $odd_or_even; ?>">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
     <div class="info">
      <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
      <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h4>
     </div>
    </li>
    <?php $odd_or_even = ('odd'==$odd_or_even) ? 'even' : 'odd'; endforeach; wp_reset_query(); ?>
   </ul>
   <?php }; ?>
  </div><!-- END #index_recent_post -->


  <?php // PR post --------------------------------------------------------------------------------------- ?>
  <?php if($options['show_pr'] == 1) { ?>
  <div id="index_pr_post">
   <h3 class="headline1"><?php echo $options['pr_headline']; ?></h3>
   <?php $pr_num = $options['index_pr_num']; ?>
   <ul>
    <?php for($i = 1; $i <= $pr_num; $i++): ?>
     <?php if($options['pr_url'.$i]) { ?><li class="clearfix"><a href="<?php echo $options['pr_url'.$i]; ?>"><?php echo $options['pr_name'.$i]; ?></a></li><?php }; ?>
    <?php endfor; ?>
   </ul>
  </div>
  <?php }; ?>


  <?php // Category post1 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category1']) {
       $cat_id1 = $options['index_category1'];
       $cat_info1 = get_category($cat_id1);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id1);
       $index_category_post1 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id1; ?>">
   <h3 class="headline1"><?php echo $cat_info1->name; ?><a href="<?php echo get_category_link($cat_id1); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post1) {
          $i=1;
          foreach ($index_category_post1 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->
   
   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id1); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>


  <?php // Category post2 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category2']) {
       $cat_id2 = $options['index_category2'];
       $cat_info2 = get_category($cat_id2);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id2);
       $index_category_post2 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id2; ?>">
   <h3 class="headline1"><?php echo $cat_info2->name; ?><a href="<?php echo get_category_link($cat_id2); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post2) {
          $i=1;
          foreach ($index_category_post2 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->

   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id2); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>


  <?php // ranking post --------------------------------------------------------------------------------------- ?>
  <?php if($options['show_ranking'] == 1) { ?>
  <div id="index_ranking_post">
   <h3 class="headline1"><?php echo $options['ranking_headline']; ?></h3>
   <?php $ranking_num = $options['index_ranking_num']; ?>
   <ul>
    <?php for($i = 1; $i <= $ranking_num; $i++): ?>
     <?php if($options['ranking_url'.$i]) { ?><li class="clearfix"><span>RANK<?php echo $i; ?></span><a href="<?php echo $options['ranking_url'.$i]; ?>"><?php echo $options['ranking_name'.$i]; ?></a></li><?php }; ?>
    <?php endfor; ?>
   </ul>
  </div>
  <?php }; ?>


  <?php // Category post3 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category3']) {
       $cat_id3 = $options['index_category3'];
       $cat_info3 = get_category($cat_id3);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id3);
       $index_category_post3 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id3; ?>">
   <h3 class="headline1"><?php echo $cat_info3->name; ?><a href="<?php echo get_category_link($cat_id3); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post3) {
          $i=1;
          foreach ($index_category_post3 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->

   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id3); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>


  <?php // Category post4 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category4']) {
       $cat_id4 = $options['index_category4'];
       $cat_info4 = get_category($cat_id4);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id4);
       $index_category_post4 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id4; ?>">
   <h3 class="headline1"><?php echo $cat_info4->name; ?><a href="<?php echo get_category_link($cat_id4); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post4) {
          $i=1;
          foreach ($index_category_post4 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->

   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id4); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>


  <?php // Category post5 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category5']) {
       $cat_id5 = $options['index_category5'];
       $cat_info5 = get_category($cat_id5);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id5);
       $index_category_post5 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id5; ?>">
   <h3 class="headline1"><?php echo $cat_info5->name; ?><a href="<?php echo get_category_link($cat_id5); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post5) {
          $i=1;
          foreach ($index_category_post5 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->

   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id5); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>
  

  <?php // Category post6 --------------------------------------------------------------------------------------- ?>
  <?php
       if($options['index_category6']) {
       $cat_id6 = $options['index_category6'];
       $cat_info6 = get_category($cat_id6);
       $args = array('post_type' => 'post', 'numberposts' => 5, 'category' => $cat_id6);
       $index_category_post6 = get_posts($args);
  ?>
  <div id="index-category-post-<?php echo $cat_id6; ?>">
   <h3 class="headline1"><?php echo $cat_info6->name; ?><a href="<?php echo get_category_link($cat_id6); ?>"><?php _e("Archives","tcd-w"); ?></a></h3>
   <div class="index_category_post">
    <?php
         if ($index_category_post6) {
          $i=1;
          foreach ($index_category_post6 as $post) : setup_postdata ($post);
           if($i==1) {
    ?>
    <div class="post1">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image2.jpg" alt="" title="" />'; }; ?></a>
     <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y/n/j'); ?></p><?php }; ?>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(35); ?></a></h4>
     <div class="excerpt"><?php new_excerpt(45); ?></div>
    </div>
    <ul class="post2">
     <?php } else { ?>
     <li class="clearfix">
      <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { echo the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
      <div class="info">
       <?php if ($options['show_date']) { ?><p class="date"><?php the_time('Y-n-j'); ?></p><?php }; ?>
       <h5 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(40); ?></a></h5>
      </div>
     </li>
     <?php }; $i++; endforeach; wp_reset_query(); ?>
    </ul>
    <?php }; ?>
   </div><!-- END .index_category_post -->

   <p class="com_spbtn"><a href="<?php echo get_category_link($cat_id6); ?>"><span>過去の記事一覧</span></a></p>
   
  </div><!-- END #index-category-post- -->
  <?php }; ?>

  <!-- banner -->
  <?php if(!is_mobile()) { ?>
  <?php if($options['top_banner_type'] == 'type1') { ?>
  <?php if($options['top_large_ad_code1']||$options['top_large_ad_image1']) { ?>
  <ul id="index_bottom_banner" class="clerfix">
   <?php if ($options['top_large_ad_code1']) { ?>
    <li><?php echo $options['top_large_ad_code1']; ?></li>
   <?php } elseif($options['top_large_ad_image1']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_large_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_large_ad_image1'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
   <?php if ($options['top_large_ad_code2']) { ?>
    <li><?php echo $options['top_large_ad_code2']; ?></li>
   <?php } elseif($options['top_large_ad_image2']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_large_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_large_ad_image2'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
  </ul>
  <?php }; ?>
  <?php } else { ?>
  <?php if($options['top_small_ad_code1']||$options['top_small_ad_image1']) { ?>
  <ul id="index_bottom_banner" class="clerfix">
   <?php if ($options['top_small_ad_code1']) { ?>
    <li><?php echo $options['top_small_ad_code1']; ?></li>
   <?php } elseif($options['top_small_ad_image1']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_small_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_small_ad_image1'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
   <?php if ($options['top_small_ad_code2']) { ?>
    <li><?php echo $options['top_small_ad_code2']; ?></li>
   <?php } elseif($options['top_small_ad_image2']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_small_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_small_ad_image2'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
   <?php if ($options['top_small_ad_code3']) { ?>
    <li><?php echo $options['top_small_ad_code3']; ?></li>
   <?php } elseif($options['top_small_ad_image3']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_small_ad_url3'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_small_ad_image3'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
   <?php if ($options['top_small_ad_code4']) { ?>
    <li><?php echo $options['top_small_ad_code4']; ?></li>
   <?php } elseif($options['top_small_ad_image4']) { ?>
    <li><a href="<?php esc_attr_e( $options['top_small_ad_url4'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['top_small_ad_image4'] ); ?>" alt="" title="" /></a></li>
   <?php }; ?>
  </ul>
  <?php }; ?>
  <?php }; ?>
  <?php }; ?>

 </div><!-- END #left_col -->

 <?php get_template_part('sidebar1'); ?>

</div><!-- END #main_col -->

<?php get_template_part('sidebar2'); ?>

</div>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sp_bottom.html'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/footer_column.html'; ?>
</body>
</html>
