<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_col">

 <div id="left_col">

  <?php
  /*
  $category = get_the_category();
  $cat_id   = $category[0]->slug;
  if(
  $cat_id == "experiences"
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
  
  
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <div class="singlebx">
  <div id="single_title">
  
   <div class="infbx clearfix tp">
   <ul id="single_meta" class="clearfix">
    <?php if ($options['show_date']) : ?><li class="date"><?php the_time('Y/n/j'); ?></li><?php endif; ?>
    <li class="post_category"><?php the_category(', '); ?></li>
    <?php if ($options['show_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
   </ul>
   <?php if($options['show_bookmark']) { include('bookmark.php'); };?>
   </div>
   
   <h2><?php the_title(); ?></h2>
  
  </div>

  <div class="post clearfix">

   <?php if(!is_mobile()) { ?>
   <?php if($options['single_ad_code1']||$options['single_ad_image1']) { ?>
   <div id="single_banner1">
    <?php if ($options['single_ad_code1']) { ?>
     <?php echo $options['single_ad_code1']; ?>
    <?php } else { ?>
     <a href="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div>
   <?php };?>
   <?php };?>
   
   <?php
   /*
   <?php if ( has_post_thumbnail() and $page=='1') { if ($options['show_thumbnail']) : ?><div class="post_image"><?php the_post_thumbnail('large'); ?></div><?php endif; }; ?>
   */
   ?>

   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>




   <?php if(!is_mobile()) { ?>
   <?php if($options['single_ad_code2']||$options['single_ad_image2']) { ?>
   <div id="single_banner2">
    <?php if ($options['single_ad_code2']) { ?>
     <?php echo $options['single_ad_code2']; ?>
    <?php } else { ?>
     <a href="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div>
   <?php };?>
   <?php }; ?>

  </div><!-- END .post -->
  
  

  <!-- author info -->
  <?php
       $author_id = get_the_author_meta('ID'); $user_data = get_userdata($author_id);
       if($user_data->show_author == true) {
        if($page==$numpages) {
          $user_site_link = $user_data->user_url;
  ?>
  <div id="single_author" class="clearfix">
   <a id="single_author_avatar" href="<?php echo get_author_posts_url($author_id); ?>"><?php echo get_avatar(get_the_author_meta('ID'), 70); ?></a>
   <div id="single_author_meta" class="clearfix">
    <h4 id="single_author_name"><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo $user_data->display_name; ?></a><?php if($user_data->post_name) { ?><span id="single_author_name2"><?php echo $user_data->post_name; ?></span><?php }; ?></h4>
    <a id="single_author_link" href="<?php echo get_author_posts_url($author_id); ?>"><?php _e("Author profile","tcd-w"); ?></a>
    <?php if($user_data->profile2) { ?>
    <div id="single_author_desc">
     <?php echo wpautop($user_data->profile2); ?>
    </div>
    <?php }; ?>
    <?php if($user_data->author_twitter or $user_data->author_facebook) { ?>
    <ul class="author_social_link clearfix">
     <?php if($user_site_link) { ?><li class="author_link"><a href="<?php echo esc_html($user_site_link); ?>" target="_blank">WEB</a></li><?php }; ?>
     <?php if($user_data->author_twitter) { ?><li class="twitter"><a href="<?php echo esc_html($user_data->author_twitter); ?>" target="_blank">Twitter</a></li><?php }; ?>
     <?php if($user_data->author_facebook) { ?><li class="facebook"><a href="<?php echo esc_html($user_data->author_facebook); ?>" target="_blank">Facebook</a></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div><!-- END author_meta -->
  </div><!-- END #post_author -->
  <div id="single_author_post">
   <?php
         $args=array(
                     'author' => $author_id,
                     'post__not_in' => array($post->ID),
                     'showposts'=>6
                   );
         $my_query = new wp_query($args);
         $odd_or_even = 'odd';
         if($my_query->have_posts()) {
   ?>
   <h3 class="headline2"><?php _e("Author recent post","tcd-w"); ?></h3>
   <ul class="clearfix">
    <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
    <li class="clearfix <?php echo $odd_or_even; ?>">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
     <div class="info">
      <ul class="meta clearfix">
       <?php if ($options['show_date']) { ?><li class="date"><?php the_time('Y/n/j'); ?></li><?php }; ?>
       <li class="category"><?php the_category(', '); ?></li>
      </ul>
      <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(36); ?></a></h4>
     </div>
    </li>
    <?php $odd_or_even = ('odd'==$odd_or_even) ? 'even' : 'odd'; }; ?>
   </ul>
   <?php }; wp_reset_query(); ?>
  </div><!-- END #author_post -->
  <?php }; }; ?>

  <?php endwhile; endif; ?>


   <div class="infbx clearfix">
   <ul id="single_meta" class="clearfix">
    <?php if ($options['show_date']) : ?><li class="date"><?php the_time('Y/n/j'); ?></li><?php endif; ?>
    <li class="post_category"><?php the_category(', '); ?></li>
    <?php if ($options['show_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
   </ul>
   <?php if($options['show_bookmark']) { include('bookmark.php'); };?>
   
   </div>

   <p class="entrybtn"><a href="/callcenter/entry/"><img src="/callcenter/images/rp_entry_off.png" alt="スタッフ登録会に応募"  /><span><img src="/callcenter/images/sp_rp_entry.png" alt="スタッフ登録会に応募" width="290"  /></span></a></p>
   
  </div>

<?php
$li = array();
$val1 = get_post_meta( $post->ID , 'reclist' , true );
if(!empty($val1)){
    $li[] = $val1;
}
$val2 = get_post_meta( $post->ID , 'reclist2' , true );
if(!empty($val2)){
    $li[] = $val2;
}
$val3 = get_post_meta( $post->ID , 'reclist3' , true );
if(!empty($val3)){
    $li[] = $val3;
}
$val4 = get_post_meta( $post->ID , 'reclist4' , true );
if(!empty($val4)){
    $li[] = $val4;
}
$val5 = get_post_meta( $post->ID , 'reclist5' , true );
if(!empty($val5)){
    $li[] = $val5;
}
$_["recLi"] = array();
if(!empty($li)){
    $_["recLi"] = DataCcRec::recruits(array('s'=> '1','ids'=>$li));
}

if(!empty($_["recLi"])){
?>
  <div class="relaterecbx">
   <h3 class="headline1">関連求人</h3>
   <ul class="clearfix">
    <?php
    foreach($_["recLi"] as $v){
    ?>
    <li>
     <a href="/callcenter/details/<?php echo h($v["id"]);?>/"><?php echo h($v["title"]);?></a>
    </li>
    <?php
    }
    ?>
   </ul>
  </div>
<?php
}
?>
  
  
  <?php // related post
       if ($options['show_related_post']) :
       $categories = get_the_category($post->ID);
       if ($categories) {
       $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
         $args=array(
                     'category__in' => $category_ids,
                     'post__not_in' => array($post->ID),
                     'showposts'=>5,
                     'orderby' => 'rand'
                   );
        $my_query = new wp_query($args);
        $i = 1;
        if($my_query->have_posts()) {
  ?>
  
  <div id="related_post">
   <h3 class="headline1"><?php _e("Related post","tcd-w"); ?></h3>
   <ul class="clearfix">
    <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
    <li class="num<?php echo $i; ?> clearfix">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { the_post_thumbnail('size3'); } else { echo '<img src="'; bloginfo('template_url'); echo '/img/common/no_image3.jpg" alt="" title="" />'; }; ?></a>
     <h4 class="title"><a href="<?php the_permalink() ?>"><?php trim_title(32); ?></a></h4>
    </li>
    <?php $i++; }; ?>
   </ul>
  </div>
  <?php }; }; wp_reset_query(); ?>
  <?php endif; ?>
  
  
  <?php if ($options['show_comment']) : if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); }; endif; ?>

  <?php if ($options['show_next_post']) : ?>
  <div id="previous_next_post" class="clearfix">
   <p id="previous_post"><?php previous_post_link('%link') ?></p>
   <p id="next_post"><?php next_post_link('%link') ?></p>
  </div>
  <?php endif; ?>

 <?php include('navigation.php'); ?>
 
 <p class="btntpbx"><a href="/callcenter/report/">コラムトップに戻る</a></p>
 

 </div><!-- END #left_col -->

 <?php get_template_part('sidebar1'); ?>

</div><!-- END #main_col -->

<?php get_template_part('sidebar2'); ?>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sp_bottom.html'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/footer_column.html'; ?>

</body>
</html>

