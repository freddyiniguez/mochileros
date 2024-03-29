<div class="row row-wrap st-list-hotel">
   <?php
   while($query->have_posts()):
       $query->the_post();
       $col = 12 / $st_ht_of_row
   ?>
       <div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12">
           <div class="thumb">
               <header class="thumb-header">
                   <a href="<?php the_permalink() ?>" class="hover-img">
                       <?php
                       $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>true)) ;
                       if(!empty($img)){
                           echo balanceTags($img);
                       }else{
                           echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.bfi_thumb(get_template_directory_uri().'/img/no-image.png',array('width'=>800,'height'=>600)) .'">';
                       }
                       ?>
                       <h5 class="hover-title-center"><?php _e('Book Now',ST_TEXTDOMAIN) ?></h5>
                   </a>
               </header>
               <div class="thumb-caption">
                  <?php 
                            $view_star_review = st()->get_option('view_star_review', 'review');
                            if($view_star_review == 'review') :
                        ?>
                   <ul class="icon-group text-tiny text-color">
                       <?php echo  TravelHelper::rate_to_string(STReview::get_avg_rate()); ?>
                   </ul>
                 <?php elseif($view_star_review == 'star'): ?>
                    <ul class="icon-group text-tiny text-color">
                          <?php
                          $star = STHotel::getStar();
                          echo  TravelHelper::rate_to_string($star);
                          ?>
                      </ul>
                  <?php endif; ?>
                   <h5 class="thumb-title">
                       <a href="<?php the_permalink() ?>" class="text-darken"><?php the_title() ?></a>
                   </h5>
                   <?php if($address= TravelHelper::locationHtml(get_the_ID())){ ?>
                   <p class="mb0">
                       <small><i class="fa fa-map-marker"></i>
                           <?php
                              echo ($address);
                           ?>
                       </small>
                   </p>
                   <?php } ?>
                   <p class="mb0 text-darken">
                <span class="text-lg lh1em text-color">
                    <?php echo TravelHelper::format_money(STHotel::get_avg_price())?>
                </span>
                       <small> <?php _e('price avg',ST_TEXTDOMAIN) ?>/<?php _e('night',ST_TEXTDOMAIN) ?></small>
                   </p>
               </div>
           </div>
       </div>

   <?php
   endwhile;
   ?>

</div>
<style>
    .st-list-hotel >.col-md-4:nth-child(3n+1)
    {
        clear: both;
    }
    .st-list-hotel >.col-md-3:nth-child(4n+1)
    {
        clear: both;
    }
</style>