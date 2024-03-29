<?php
/**
 * Template Name: Rental Search Result
 */
if(!st_check_service_available('st_rental'))
{
    wp_redirect(home_url());
    die;
}
global $wp_query, $st_search_query,$st_search_page_id;
$old_page_content = '';
while (have_posts()) {
    the_post();
    $st_search_page_id=get_the_ID();
    $old_page_content = get_the_content();
}
get_header();
$rental = STRental::inst();
add_action('pre_get_posts', array($rental, 'change_search_arg'));
query_posts(
    array(
        'post_type' => 'st_rental',
        's'         => '',
        'paged'     => get_query_var('paged')
    )
);
$st_search_query = $wp_query;
//echo $st_search_query->request;
remove_action('pre_get_posts', array($rental, 'change_search_arg'));
echo st()->load_template('search-loading');
get_template_part('breadcrumb');
$result_string = '';

?>
    <div class="mfp-with-anim mfp-dialog mfp-search-dialog mfp-hide" id="search-dialog">
        <?php echo st()->load_template('rental/search-form-2'); ?>
    </div>
    <div class="container mb20">
        <?php echo apply_filters('the_content', $old_page_content); ?>
    </div>
<?php
wp_reset_query();
get_footer();
?>