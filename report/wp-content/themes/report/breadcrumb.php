
 	<section class="com_pnkzbox">
		<ul class="clearfix" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<li><a href="<?php echo h($GLOBALS["PNKZURL"]);?>" itemprop="url"><span itemprop="title"><?php echo h($GLOBALS["PNKZTITLE"]);?></span></a></li>
<?php if(is_home()) { ?>
			<li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;体験談・コラム</li>
<?php }  else { ?>
			<li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<a href="/callcenter/report/">体験談・コラム</a></li>
<?php } ?>
<?php if(is_paged()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php _e('Blog Archives', 'tcd-w'); ?></li>

<?php } elseif (is_category()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo single_cat_title('', false); ?></li>

<?php } elseif(is_tag()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo single_tag_title('', false); ?></li>

<?php } elseif(is_day()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo get_the_time(__('F jS, Y', 'tcd-w')); ?></li>

<?php } elseif(is_month()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo get_the_time(__('F, Y', 'tcd-w')); ?></li>

<?php } elseif(is_year()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo get_the_time(__('Y', 'tcd-w')); ?></li>

<?php } elseif(is_author()) { global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php echo $curauth->display_name; ?></li>

<?php } elseif(is_search()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php _e("Search Result","tcd-w"); ?></li>

<?php } elseif(is_single()) { ?>
 <li itemprop="title" class="fnts"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php the_category(''); ?></li>
 <li itemprop="title" class="fnts"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php the_title(); ?></li>

<?php } elseif(is_page()) { ?>
 <li itemprop="title"><span class="clr_gr">&gt;</span>&nbsp;&nbsp;<?php the_title(); ?></li>

<?php }; ?>

		</ul>
	</section>
