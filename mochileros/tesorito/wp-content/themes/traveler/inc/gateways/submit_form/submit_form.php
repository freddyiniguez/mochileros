<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class STGatewaySubmitform
 *
 * Created by ShineTheme
 *
 */
if(!class_exists('STGatewaySubmitform'))
{
    class STGatewaySubmitform extends STAbstactPaymentGateway
	{

		private $_gateway_id='st_submit_form';

		function __construct()
		{
			add_filter('st_payment_gateway_st_submit_form_name', array($this, 'get_name'));

		}

		function html()
		{
			echo st()->load_template('gateways/submit_form');
		}

		/**
		 *
		 *
		 * @update 1.1.1
		 * */
		function do_checkout($order_id)
		{
			update_post_meta($order_id, 'status', 'pending');
			do_action('st_booking_change_status', 'pending', $order_id, 'normal_booking');
			$order_token = get_post_meta($order_id, 'order_token_code', TRUE);

			//Destroy cart on success
			STCart::destroy_cart();
			STCart::send_email_confirm($order_id);

			if ($order_token) {
				$array = array(
					'order_token_code' => $order_token
				);
			} else {
				$array = array(
					'order_code' => $order_id,

				);
			}

			return array(
				'status'   => TRUE,
			);

		}

		function check_complete_purchase($order_id){

		}

		/**
		 *
		 * @return bool
		 */
		function stop_change_order_status()
		{
			return true;
		}


		function get_name()
		{
			return __('Submit Form', ST_TEXTDOMAIN);
		}

		/**
		 * Check payment method for all items or specific is enable
		 *
		 *
		 * @update 1.1.7
		 * @param bool $item_id
		 * @return bool
		 */
		function is_available($item_id = FALSE)
		{
			$result = FALSE;
			if (st()->get_option('pm_gway_st_submit_form_enable') == 'on') {
				$result = TRUE;
			}
			if ($item_id) {
				$meta = get_post_meta($item_id, 'is_meta_payment_gateway_st_submit_form', TRUE);
				if ($meta == 'off') {
					$result = FALSE;
				}
			}

			return $result;
		}

		function _pre_checkout_validate()
		{
			return TRUE;
		}

		function get_option_fields()
		{
			return array();
		}

		function get_default_status()
		{
			return TRUE;
		}

		function get_logo()
		{
			return get_template_directory_uri() . '/img/gateway/nm-logo.png';
		}

		function is_check_complete_required(){
			return false;
		}

		function getGatewayId()
		{
			return $this->_gateway_id;
		}
    }
}
