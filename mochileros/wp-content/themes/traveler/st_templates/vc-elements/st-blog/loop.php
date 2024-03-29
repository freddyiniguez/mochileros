<?php
if (!$st_blog_style){ $st_blog_style = 4; }
 $col = 12 / $st_blog_style;
?>
<div class="col-md-<?php echo esc_attr($col) ?> col-sm-6 col-xs-12">
    <div class="thumb text-center">
        <header class="thumb-header">
            <a class="hover-img curved" href="<?php the_permalink() ?>">
                <?php
                $img = get_the_post_thumbnail( get_the_ID() , array(800,600,'bfi_thumb'=>true)) ;
                if(!empty($img)){
                    echo balanceTags($img);
                }else{
                    echo '<img width="800" height="600" alt="no-image" class="wp-post-image" src="'.get_template_directory_uri().'/img/no-image.png">';
                }
                ?>
                <h5 class="hover-title-top-left hover-hold"><?php the_title() ?></h5>
            </a>
        </header>
        <div class="thumb-caption text-center">
            <p class="thumb-desc"><?php the_excerpt() ?></p>
            <a class="btn btn-default btn-ghost mt10" href="<?php the_permalink() ?>">
                <?php STLanguage::st_the_language('read_more') ?>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>