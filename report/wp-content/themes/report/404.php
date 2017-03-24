<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_col">


 <div id="left_col">

  <h2 class="com_tlx"><img src="/callcenter/images/title_column.png" alt="‘ÌŒ±’kEƒRƒ‰ƒ€" ></h2>
  <h2 class="com_spttl"><img src="/callcenter/images/sp_ttl_column.png" alt="‘ÌŒ±’kEƒRƒ‰ƒ€" height="26"></h2>
  
  <h2 class="headline2"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></h2>

  <div class="post clearfix">

   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>

  </div><!-- END .post -->

 </div><!-- END #left_col -->

 <?php get_template_part('sidebar1'); ?>

</div><!-- END #main_col -->

<?php get_template_part('sidebar2'); ?>

</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/sp_bottom.html'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/callcenter/include/footer.html'; ?>