<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * User my tours
 *
 * Created by ShineTheme
 *
 */
?>
<div class="st-create">
    <h2  class="pull-left"><?php st_the_language('my_tours') ?></h2>
    <a class="btn btn-default pull-right" href="<?php echo esc_url( add_query_arg( 'sc' , 'create-tours' , get_permalink() ) ) ?>">
        <?php _e("Add New Tour",ST_TEXTDOMAIN) ?>
    </a>
</div>
<div class="msg">
    <?php echo STUser_f::get_msg(); ?>
</div>
<ul id="" class="booking-list booking-list-wishlist ">
<?php
    $paged  = (get_query_var('paged' ) ? get_query_var('paged' ) : 1) ; 
    $args = array(
        'post_type' => 'st_tours',
        'post_status'=>'publish , draft , trash',
        'author'=>$data->ID,
        'posts_per_page'=>10,
        'paged'=>$paged
    );
    $query=new WP_Query($args);
    if ( $query->have_posts() ) {
        while ($query->have_posts()) {
            $query->the_post();
            echo st()->load_template('user/loop/loop', 'tour' ,get_object_vars($data));
        }
    }else{
        echo '<h5>'.st_get_language('no_tours').'</h5>';
    };
?>
</ul>
<div class="pull-left">
    <?php st_paging_nav(null,$query) ?>
</div>
<div class="pull-right">
    <a class="btn btn-default pull-right" href="<?php echo esc_url( add_query_arg( 'sc' , 'create-tours' , get_permalink() ) ) ?>">
        <?php _e("Add New Tour",ST_TEXTDOMAIN) ?>
    </a>
</div>
<?php  wp_reset_query(); ?>






























