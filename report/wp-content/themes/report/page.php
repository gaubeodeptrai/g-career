<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_col">

 <div id="left_col">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <h2 class="headline2"><?php the_title(); ?></h2>

  <div class="post clearfix">

   <?php the_content(__('Read more', 'tcd-w')); ?>
   <?php custom_wp_link_pages(); ?>

  </div><!-- END .post -->

  <?php endwhile; endif; ?>

 </div><!-- END #left_col -->

 <?php get_template_part('sidebar1'); ?>

</div><!-- END #main_col -->

<?php get_template_part('sidebar2'); ?>

<?php get_footer(); ?>