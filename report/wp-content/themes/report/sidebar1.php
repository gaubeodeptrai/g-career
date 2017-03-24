<div id="right_col">

 <div class="side_widget clearfix menu">
 <h3 class="side_headline">カテゴリ一覧</h3>
 <ul class="lnkbx">
 <?php
 $cat = get_categories(array('orderby' => 'id'));
 if(!empty($cat)){
 foreach($cat as $v){
     $ptflg = $v->category_parent;
     $slug = $v->slug;
     $name = $v->name;
     if($ptflg==0 and !preg_match("/ct/u", $slug)){
         echo '<li><a href="/callcenter/report/category/'.$slug.'/">'.$name.'</a></li>';
     }
     $n++;
 }
 }
 ?>
 </ul>
 </div>
 
 <?php if(!is_page()&&is_home()) { ?>

   <?php if(!is_mobile()) { ?>
     <?php if(is_active_sidebar('index_side_widget')) { ?>
      <?php dynamic_sidebar('index_side_widget'); ?>
     <?php }; ?>
   <?php } else { ?>
     <?php if(is_active_sidebar('mobile_widget_index')) { ?>
      <?php dynamic_sidebar('mobile_widget_index'); ?>
     <?php }; ?>
   <?php }; ?>

 <?php } elseif(is_single()) { ?>

   <?php if(!is_mobile()) { ?>
     <?php if(is_active_sidebar('single_side_widget')) { ?>
      <?php dynamic_sidebar('single_side_widget'); ?>
     <?php }; ?>
   <?php } else { ?>
     <?php if(is_active_sidebar('mobile_widget_single')) { ?>
      <?php dynamic_sidebar('mobile_widget_single'); ?>
     <?php }; ?>
   <?php }; ?>

 <?php } else { ?>

   <?php if(!is_mobile()) { ?>
     <?php if(is_active_sidebar('archive_side_widget')) { ?>
      <?php dynamic_sidebar('archive_side_widget'); ?>
     <?php }; ?>
   <?php } else { ?>
     <?php if(is_active_sidebar('mobile_widget_archive')) { ?>
      <?php dynamic_sidebar('mobile_widget_archive'); ?>
     <?php }; ?>
   <?php }; ?>

 <?php }; ?>

</div>