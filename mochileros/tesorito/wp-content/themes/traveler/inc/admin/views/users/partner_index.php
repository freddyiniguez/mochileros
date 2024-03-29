<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Admin hotel booking index
 *
 * Created by ShineTheme
 *
 */


/*$query = array(
    'role' => 'Subscriber',
    'meta_key' => 'pending_partner',
    'meta_value' => '1'
);
$user_query = new WP_User_Query( $query );
var_dump($user_query);
$data_user = $user_query->results;*/

//$arg=array(
//    'post_type'=>'st_order_item',
//    'posts_per_page'=>5,
//    'paged'=>isset($_GET['paged'])?$_GET['paged']:1,
//);
//query_posts($arg);
$page=isset($_GET['paged'])?$_GET['paged']:1;
$limit=20;
$offset=($page-1)*$limit;

$data=STUser::get_list_partner('pending_partner',$offset,$limit);
$posts=$data['rows'];
$total=ceil($data['total']/$limit);

global $wp_query;

$paging=array();

$paging['base']=admin_url('users.php?page=st-users-partner-menu%_%');
$paging['format']='&paged=%#%';
$paging['total']=$total;
$paging['current']=$page;
$paging['current']=$page;
echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
echo '<h2>'.__('User Partner',ST_TEXTDOMAIN).'</h2>';

$base_url = admin_url("users.php?page=st-users-partner-menu");

STAdmin::message();
?>
<form id="posts-filter" action="<?php echo admin_url('users.php?page=st-users-partner-menu')?>" method="post">
    <?php wp_nonce_field('shb_action','shb_field')?>
    <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e('Select bulk action',ST_TEXTDOMAIN)?></label>
            <select name="st_action" id="bulk-action-selector-top">
                <option value="-1" selected="selected"><?php _e('Bulk Actions',ST_TEXTDOMAIN)?></option>
                <option value="delete"><?php _e('Delete Permanently',ST_TEXTDOMAIN)?></option>
            </select>
            <input type="submit" name="" id="doaction" class="button action" value="<?php _e('Apply',ST_TEXTDOMAIN)?>">
        </div>
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
            <?php echo paginate_links($paging)?>

        </div>
    </div>
    <table class="wp-list-table widefat fixed striped users">
        <thead>
            <tr>
                <td class="manage-column column-cb check-column" id="cb">
                    <label for="cb-select-all-1" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                    <input type="checkbox" id="cb-select-all-1">
                </td>
                <th class="manage-column column-username column-primary  desc" id="username" scope="col">
                    <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-name  desc" id="name" scope="col">
                    <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-email  desc" id="email" scope="col">
                    <span><?php _e("Email",ST_TEXTDOMAIN) ?></span>
                </th>
                <th class="manage-column column-certificates" id="certificates" scope="col"><?php _e("Certificates",ST_TEXTDOMAIN) ?></th>
            </tr>
        </thead>
        <tbody id="the-list">
        <?php

        $i=0;

        if(!empty($posts)) {
            foreach($posts as $key=>$value) {
                $i++;
                $user_id=$value->ID;
                ?>
                <tr id="user-<?php  echo esc_attr($user_id) ?>">
                    <th class="check-column" scope="row">
                        <label for="user_<?php  echo esc_attr($user_id) ?>" class="screen-reader-text">Select admin</label>
                        <input type="checkbox" value="<?php  echo esc_attr($user_id) ?>" class="administrator" id="user_<?php  echo esc_attr($user_id) ?>" name="users[]">
                    </th>
                    <td class="username column-username has-row-actions column-primary">
                        <?php echo get_avatar( $user_id, 32 ); ?>
                        <strong>
                            <a href="<?php echo admin_url("user-edit.php?user_id=".$user_id."&wp_http_referer=".$base_url) ?>">
                                <?php echo esc_html($value->user_nicename) ?>
                            </a>
                        </strong>
                        <br>
                        <div class="row-actions">
                            <span class="edit">
                                <a href="<?php echo admin_url("users.php?page=st-users-partner-menu&st_action=approve_role&user_id=".$user_id.""); ?>" class="button"><?php _e("Approved",ST_TEXTDOMAIN) ?></a>
                                <a href="<?php echo admin_url("users.php?page=st-users-partner-menu&st_action=cancel_role&user_id=".$user_id.""); ?>" class="button"><?php _e("Cancel",ST_TEXTDOMAIN) ?></a>
                            </span>
                        </div>
                    </td>
                    <td data-colname="Name" class="name column-name"><?php echo esc_html($value->display_name) ?></td>
                    <td data-colname="Email" class="email column-email">
                        <a href="mailto:<?php echo esc_html($value->user_email) ?>"><?php echo esc_html($value->user_email) ?></a>
                    </td>
                    <td data-colname="certificates" class="role column-certificates">
                        <?php $st_certificates = get_user_meta($user_id,'st_certificates',true); ?>
                        <?php if(!empty($st_certificates)){ ?>
                            <?php foreach($st_certificates as $k=>$v){ ?>
                                <?php echo esc_html($v['name']) ?> : <a href="<?php echo esc_url($v['image']) ?>" class="thickbox" ><?php _e("Click Here",ST_TEXTDOMAIN) ?></a> <br>
                            <?php } ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
        }

        ?>

        </tbody>
        <tfoot>
        <tr>
            <td class="manage-column column-cb check-column">
                <label for="cb-select-all-2" class="screen-reader-text"><?php _e("Select All",ST_TEXTDOMAIN) ?></label>
                <input type="checkbox" id="cb-select-all-2">
            </td>
            <th class="manage-column column-username column-primary sortable desc" scope="col">
                <span><?php _e("Username",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-name sortable desc" scope="col">
                <span><?php _e("Name",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-email sortable desc" scope="col">
                <span><?php _e("Email",ST_TEXTDOMAIN) ?></span>
            </th>
            <th class="manage-column column-certificates" scope="col"><?php _e("Certificates",ST_TEXTDOMAIN) ?></th>
        </tr>
        </tfoot>

    </table>


    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo sprintf(_n('%s item','%s items',$data['total']),$data['total'],ST_TEXTDOMAIN)  ?></span>
            <?php echo paginate_links($paging)?>

        </div>
    </div>

    <?php wp_reset_query();?>
</form>
</div>

