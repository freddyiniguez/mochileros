<?php
    /**
     * @package WordPress
     * @subpackage Traveler
     * @since 1.0
     *
     * Search custom activity
     *
     * Created by ShineTheme
     *
     */
    if(!st_check_service_available('st_activity'))
    {
        wp_redirect(home_url());
        die;
    }
    get_header();
    global $wp_query,$st_search_query;
    $activity=new STActivity();
    add_action('pre_get_posts',array($activity,'change_search_activity_arg'));
    query_posts(
        array(
            'post_type'=>'st_activity',
            's'=>get_query_var('s'),
            'paged'     => get_query_var('paged')
        )
    );
    $st_search_query=$wp_query;
    remove_action('pre_get_posts',array($activity,'change_search_activity_arg'));    
    //$result_string='';
    echo st()->load_template('search-loading');
?>
<?php 
    $layout=st()->get_option('activity_search_layout');            
    if(!empty($_REQUEST['layout_id'])){
        $layout = $_REQUEST['layout_id'];
    }
    $layout_class = get_post_meta($layout , 'layout_size' , true);
    if (!$layout_class) $layout_class = "container";
?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template('activity/search-form');?>
    </div>
    <?php 
        if(get_post_meta($layout , 'is_breadcrumb' , true) !=='off'){
            get_template_part('breadcrumb');
        }
    ?>
    <div class="<?php echo balanceTags($layout_class) ; ?>">    
        <?php    
            if($layout and is_string( get_post_status( $layout ) ))
            {
                echo  STTemplate::get_vc_pagecontent($layout);
            }else{ ?>
                <h3 class="booking-title"><?php echo balanceTags($activity->get_result_string())?>
                    <small><a class="popup-text" href="#search-dialog" data-effect="mfp-zoom-out"><?php echo __('Change search',ST_TEXTDOMAIN)?></a></small>
                </h3>
                <div class="row">
                    <?php $sidebar_pos=apply_filters('st_activity_sidebar','left');
                        if($sidebar_pos=="left"){
                            get_sidebar('activity');
                        }
                    ?>
                    <div class="<?php echo apply_filters('st_activity_sidebar','left')=='no'?'col-md-12':'col-md-9'; ?> col-sm-7 col-xs-12">
                        <?php echo st()->load_template('activity/content-activity')?>
                    </div>
                    <?php
                        $sidebar_pos=apply_filters('st_activity_sidebar','left');
                        if($sidebar_pos=="right"){
                            get_sidebar('activity');
                        }
                    ?>
                </div>
            <?php }
        ?>
    </div>
<?php

    get_footer();
?>