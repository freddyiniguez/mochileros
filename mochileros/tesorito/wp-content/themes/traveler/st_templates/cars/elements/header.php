<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/23/2015
 * Time: 4:01 PM
 */
$theme_option=st()->get_option('partner_show_contact_info');
$metabox=get_post_meta(get_the_ID(),'show_agent_contact_info',true);

$use_agent_info=FALSE;

if($theme_option=='on') $use_agent_info=true;
if($metabox=='user_agent_info') $use_agent_info=true;
if($metabox=='user_item_info') $use_agent_info=FALSE;

$user_id=get_the_author_meta('ID');

?>
<h2 class="lh1em featured_single" itemprop="name"><?php the_title() ?><?php echo STFeatured::get_featured(); ?></h2>
<ul class="list list-inline text-small">
	<?php if($use_agent_info){?>
		<?php
		$email = get_the_author_meta('user_email');
		if(!empty($email))
			echo '<li><a href="mailto:'.$email.'"><i class="fa fa-envelope"></i> '.__('Agent E-mail',ST_TEXTDOMAIN).'</a> </li>';
		?>
		<?php if($website=get_the_author_meta('user_url')):?>
			<li><a target="_blank" href="<?php echo esc_url( $website );?>"> <i class="fa fa-home"></i> <?php _e('Agent Website',ST_TEXTDOMAIN);?></a>
			</li>
		<?php endif;?>
		<?php
		$phone = get_user_meta($user_id,'st_phone',true);
		if(!empty($phone))
			echo '<li><a href="tel:'.str_replace(" ","",trim($phone)).'"><i class="fa fa-phone"></i> '.$phone.'</a></li>';
		?>

		<?php
		$fax = get_user_meta($user_id,'st_fax',true);
		if(!empty($fax))
			echo '<li><a href="tel:'.str_replace(' ','',trim($fax)).'"> <i class="fa fa-fax"></i> '.esc_html( $fax).'</a></li>';
		?>
	<?php }else {?>
		<?php
		$email = get_post_meta(get_the_ID(),'cars_email',true);
		if(!empty($email))
			echo '<li><a href="mailto:'.$email.'"><i class="fa fa-envelope"></i> '.__('Agent E-mail',ST_TEXTDOMAIN).'</a> </li>';
		?>
		<?php if($website=get_post_meta(get_the_ID(),'cars_website',true)):?>
			<li><a target="_blank" href="<?php echo esc_url( $website );?>"> <i class="fa fa-home"></i> <?php _e('Agent Website',ST_TEXTDOMAIN);?></a>
			</li>
		<?php endif;?>
		<?php
		$phone = get_post_meta(get_the_ID(),'cars_phone',true);
		if(!empty($phone))
			echo '<li><a href="tel:'.str_replace(" ","",trim($phone)).'"><i class="fa fa-phone"></i> '.$phone.'</a></li>';
		?>
		<?php
		$fax = get_post_meta(get_the_ID(),'cars_fax',true);
		if(!empty($fax))
			echo '<li><a href="tel:'.str_replace(' ','',trim($fax)).'"> <i class="fa fa-fax"></i> '.esc_html( $fax).'</a></li>';
		?>

	<?php  }?>
</ul>
