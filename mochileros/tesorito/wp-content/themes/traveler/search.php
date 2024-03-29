<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Search custom
 *
 * Created by ShineTheme
 *
 */
get_header();
?>
    <div class="container">
        <h1 class="page-title"><?php st_the_language('search_blog')?></h1>
    </div>
    <div class="container">
        <div class="row">
            <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
            if($sidebar_pos=="left"){
                get_sidebar('blog');
            }
            ?>
            <div class="<?php echo apply_filters('st_blog_sidebar','right')=='no'?'col-sm-12':'col-sm-9 col-xs-12'; ?>">
                <?php
                global $wp_query;
                //var_dump($wp_query);
                if(have_posts()):
                    while(have_posts())
                    {
                        the_post();
                        get_template_part('content','loop');
                    }
                    TravelHelper::paging();
                else:
                    get_template_part('content','none');
                endif;
                ?>
            </div>
            <?php $sidebar_pos=apply_filters('st_blog_sidebar','right');
            if($sidebar_pos=="right"){
                get_sidebar('blog');
            }
            ?>
        </div>
    </div>
<?php
get_footer();?>