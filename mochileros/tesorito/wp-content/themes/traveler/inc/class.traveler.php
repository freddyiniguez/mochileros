<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Class code traver
 *
 * Created by ShineTheme
 *
 */
require_once get_template_directory().'/inc/core/class.shinetheme.php';
if(!class_exists('STTraveler'))
{
    class STTraveler extends  STFramework
    {

        //define location of Included Theme's plugins

        static $booking_type=array();

        static $_is_inited=false;

        static $_instance=null;

        public $tour;
        public $car;
        public $hotel;
        public $hotel_room;

        public static function _get_instance()
        {

            if(!self::$_instance)
            {
                self::$_instance=new self();
            }
            return self::$_instance;
        }

        public static function _class_init()
        {
            parent::_class_init();
            $file=array(

                'travel-helper',
                'class/class.cart',
                'admin/class.stadmin',
                'st.customvc',
                'helpers/st-languages',
                'class/class.travelobject',
                'class/class.hotel',
                'class/class.room',
                'class/class.review',
                'class/class.order',
                'st.customvc',
                'helpers/class.validate',

            );
            $file2=array(
                'class/class.payment_gateways',
                'class/class.user',
                'class/class.location',
                'class/class.cars',
                'class/class.tour',
                'class/class.rental',
                'class/class.cruise',
                'class/class.cabin',
                'class/class.activity',
                'class/class.coupon',
                'class/class.featured',
                'class/class.woocommerce',
                'helpers/class.date',
                'helpers/class.social.login',
                'helpers/class.analytics',
                'helpers/class.cool-captcha',
                'plugins/custom-option-tree/custom-option-tree',
                'plugins/custom-option-tree/st-list-item-post-type',
                'plugins/custom-option-tree/st-timepicker-field',
                'plugins/custom-select-post/custom-select-post',
                'helpers/class.iconpicker',
                'helpers/st-car-helpers',
                'plugins/ot-custom/ot-custom',
                'helpers/database.helper',
                'helpers/availability.helper',
                'helpers/hotel.helper',
                'helpers/rental.helper',
                'helpers/tour.helper',
                'helpers/activity.helper',
                'helpers/car.helper',
                'helpers/validate.woo.checkout',
                'helpers/validate.normal.checkout',
                'helpers/price.helper',
                'helpers/partner.booking.helper',
            );

            self::load_libs($file);
            self::load_paypal_libraries();
            self::load_libs($file2);
            self::_load_abstract();
            self::_load_modules();

            self::$booking_type=apply_filters('st_booking_post_type',array(
                'st_hotel',
                'st_activity',
                'st_tours',
                'st_cars',
                'st_rental'
            ));

            if(function_exists('st_reg_post_type') and function_exists('st_reg_taxonomy'))
            {

                add_action( 'init', array(__CLASS__,'st_attribute_to_taxonomy') );
                add_action( 'init', array(__CLASS__,'st_location_init') );
                add_action( 'init', array(__CLASS__,'st_order_init') );
            }

            if(function_exists('st_reg_shortcode')){
                /**
                 * Load widget, shortcodes and vc elements. No need use it from plugins
                 *
                 *
                 * @since 1.0.7
                 * */
                self::loadWidgets();
                add_action('init',array(__CLASS__,'loadShortCodes'),30);

                if(class_exists('Vc_Manager'))
                {
                    add_action('init',array(__CLASS__,'loadVcElements'),30);
                }
            }
        }

        function __construct()
        {

            $this->plugin_name='traveler-code';

            parent::__construct();

            
        }

        static function load_paypal_libraries()
        {
            if (version_compare(phpversion(), '5.3', '<')) {
                // php version isn't high enough
                add_action( 'admin_notices', array(__CLASS__,'add_paypal_admin_notices') );
            }else{
                $file=array(
                    'class/class.paypal',
                );

                self::load_libs($file);
            }
        }

        static function add_paypal_admin_notices() {
            ?>
            <div class="error">
                <p><?php printf(__('You must upgrade your PHP version to at least  5.3. Your current is %s. Please contact your Hosting Provide to know how to upgrade it',ST_TEXTDOMAIN),phpversion()) ?></p>
            </div>
        <?php
        }


        static function check_phpversion()
        {
            if (version_compare(phpversion(), '5.3', '<')) {
                return false;
            }else{
                return true;
            }
        }

        /**
         * Load all shortcodes from folder inc/shortcodes/
         *
         *
         * @since 1.0.7
         *
         * */
        static function loadShortCodes()
        {
            $widgets=glob(self::dir().'/shortcodes/*');
            if(!is_array($widgets) or empty($widgets)) return false;



            $dirs = array_filter($widgets, 'is_dir');

            $exclude=apply_filters('st_exclude_shortcodes',array());

            $hasExclude=false;

            if(is_array($exclude) and !empty($exclude))
            {
                $hasExclude=true;
            }

            if(!empty($dirs))
            {
                foreach($dirs as $key=>$value)
                {
                    $dirname=basename($value);

                    if(!$hasExclude or !in_array($dirname,$exclude))
                    {
                        $file=self::dir_name('shortcodes/'.$dirname.'/'.$dirname);
                        get_template_part($file);
                    }
                }
            }


            return true;
        }


        /**
         * Load all vc-elements from folder inc/vc-elements/
         *
         *
         * @since 1.0.7
         *
         * */
        static function loadVcElements()
        {
            $widgets=glob(self::dir().'/vc-elements/*');
            if(!is_array($widgets) or empty($widgets)) return false;



            $dirs = array_filter($widgets, 'is_dir');

            $exclude=apply_filters('st_exclude_vcelements',array());

            $hasExclude=false;

            if(is_array($exclude) and !empty($exclude))
            {
                $hasExclude=true;
            }

            if(!empty($dirs))
            {
                foreach($dirs as $key=>$value)
                {
                    $dirname=basename($value);

                    if(!$hasExclude or !in_array($dirname,$exclude))
                    {
                        $file=self::dir_name('vc-elements/'.$dirname.'/'.$dirname);
                        get_template_part($file);
                    }
                }
            }


            return true;
        }



        /**
         * Load all widgets from folder inc/widgets/
         *
         *
         * @since 1.0.7
         *
         * */
        static function  loadWidgets()
        {
            $widgets=glob(self::dir().'/widgets/*');
            if(!is_array($widgets) or empty($widgets)) return false;



            $dirs = array_filter($widgets, 'is_dir');

            $exclude=apply_filters('st_exclude_widgets',array());

            $hasExclude=false;

            if(is_array($exclude) and !empty($exclude))
            {
                $hasExclude=true;
            }

            if(!empty($dirs))
            {
                foreach($dirs as $key=>$value)
                {
                    $dirname=basename($value);

                    if(!$hasExclude or !in_array($dirname,$exclude))
                    {
                        $file=self::dir_name('widgets/'.$dirname.'/'.$dirname);
                        get_template_part($file);
                    }
                }
            }


            return true;
        }

        static function _load_abstract()
        {
            $files=array(
                'abstract/class-abstract-controller',
                'abstract/class-abstract-front-controller',
                'abstract/class-abstract-admin-controller',
            );

            self::load_libs($files);
        }

        /**
         * New Module Systems
         *
         * Load all modules from folder inc/modules
         *
         * Module must be
         * -controllers/
         * ----admin.php - Admin Controller
         * ----default.php - Fontend Controller
         * -models -> Access database
         * -views -> Contain parts of templates
         *
         * @since 1.0.5
         *
         * */
        static function _load_modules()
        {
            $folders=glob(get_template_directory().'/inc/modules/*');
            if(!is_array($folders) or empty($folders)) return;

            $modules_dir=array_filter($folders,'is_dir');

            if(!is_array($modules_dir)) return;


            if(!empty($modules_dir))
            {
                foreach($modules_dir as $key=>$value)
                {

                    // Load Front Controller
                    $front_controller_file=$value.'/controllers/default.php';
                    if(!is_admin() and file_exists($front_controller_file))
                    {
                        require_once $front_controller_file;
                    }

                    // Load Admin Controller
                    $admin_controller_file=$value.'/controllers/admin.php';
                    if(is_admin() and file_exists($admin_controller_file))
                    {
                        require_once $admin_controller_file;
                    }


                }
            }
        }




        function booking_post_type()
        {

            return self::$booking_type;
        }

        static function booking_type()
        {
            return self::$booking_type;
        }

        // Hotel ==============================================================

        /**
         *
         *
         * @update 1.1.3
         * */
        static function st_attribute_to_taxonomy()
        {


            $attributes=$attr=get_option('st_attribute_taxonomy');

            if(!empty($attributes) and is_array($attributes))
            {
                foreach($attributes as $key=>$value)
                {
                    $name=$value['name'];
                    $slug=$key;
                    $hierarchical=$value['hierarchical'];

                    $post_type=$value['post_type'];
                    // Add new taxonomy, make it hierarchical (like categories)
                    if(st_check_service_available($post_type))
                    {
                        $labels = array(
                            'name'              => $name ,
                            'singular_name'     => $name,
                            'search_items'      => sprintf(__( 'Search %s' ,ST_TEXTDOMAIN),$name),
                            'all_items'         => sprintf(__( 'All %s' ,ST_TEXTDOMAIN),$name),
                            'parent_item'       => sprintf(__( 'Parent %s' ,ST_TEXTDOMAIN),$name),
                            'parent_item_colon' => sprintf(__( 'Parent %s' ,ST_TEXTDOMAIN),$name),
                            'edit_item'         => sprintf(__( 'Edit %s' ,ST_TEXTDOMAIN),$name),
                            'update_item'       => sprintf(__( 'Update %s' ,ST_TEXTDOMAIN),$name),
                            'add_new_item'      => sprintf(__( 'New %s' ,ST_TEXTDOMAIN),$name),
                            'new_item_name'     => sprintf(__( 'New %s' ,ST_TEXTDOMAIN),$name),
                            'menu_name'         => $name,
                        );

                        $args = array(
                            'hierarchical'      => $hierarchical,
                            'labels'            => $labels,
                            'show_ui'           => true,
                            'show_admin_column' => true,
                            'query_var'         => true,
                        );


                        st_reg_taxonomy($slug ,$post_type, $args );
                    }

                }
            }
        }

//Location ==============================================================



        static function st_location_init() {
            $labels = array(
                'name'               => __( 'Locations', ST_TEXTDOMAIN ),
                'singular_name'      => __( 'Location', ST_TEXTDOMAIN ),
                'menu_name'          => __( 'Locations', ST_TEXTDOMAIN ),
                'name_admin_bar'     => __( 'Location', ST_TEXTDOMAIN ),
                'add_new'            => __( 'Add New', ST_TEXTDOMAIN ),
                'add_new_item'       => __( 'Add New Location', ST_TEXTDOMAIN ),
                'new_item'           => __( 'New Location', ST_TEXTDOMAIN ),
                'edit_item'          => __( 'Edit Location', ST_TEXTDOMAIN ),
                'view_item'          => __( 'View Location', ST_TEXTDOMAIN ),
                'all_items'          => __( 'All Locations', ST_TEXTDOMAIN ),
                'search_items'       => __( 'Search Locations', ST_TEXTDOMAIN ),
                'parent_item_colon'  => __( 'Parent Locations:', ST_TEXTDOMAIN ),
                'not_found'          => __( 'No locations found.', ST_TEXTDOMAIN ),
                'not_found_in_trash' => __( 'No locations found in Trash.', ST_TEXTDOMAIN )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'location' ),
                'has_archive'        => true,
                'hierarchical'       => true,
                //'menu_position'      => null,
                'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ,'page-attributes'),
                'menu_icon'         =>'dashicons-location-alt-bl',
                'exclude_from_search'=>true,

            );

            st_reg_post_type( 'location', $args );
            // Location ==============================================================

            $labels = array(
                'name'                       => __( 'Location Type', ST_TEXTDOMAIN ),
                'singular_name'              => __( 'Location Type',  ST_TEXTDOMAIN ),
                'search_items'               => __( 'Search Location Type' , ST_TEXTDOMAIN),
                'popular_items'              => __( 'Popular Location Type' , ST_TEXTDOMAIN),
                'all_items'                  => __( 'All Location Type', ST_TEXTDOMAIN ),
                'parent_item'                => null,
                'parent_item_colon'          => null,
                'edit_item'                  => __( 'Edit Location Type' , ST_TEXTDOMAIN),
                'update_item'                => __( 'Update Location Type' , ST_TEXTDOMAIN),
                'add_new_item'               => __( 'Add New Location Type', ST_TEXTDOMAIN ),
                'new_item_name'              => __( 'New Location Type Name', ST_TEXTDOMAIN ),
                'separate_items_with_commas' => __( 'Separate Location Type with commas' , ST_TEXTDOMAIN),
                'add_or_remove_items'        => __( 'Add or remove Location Type', ST_TEXTDOMAIN ),
                'choose_from_most_used'      => __( 'Choose from the most used Location Type', ST_TEXTDOMAIN ),
                'not_found'                  => __( 'No Pickup Location Type.', ST_TEXTDOMAIN ),
                'menu_name'                  => __( 'Location Type', ST_TEXTDOMAIN ),
            );

            $args = array(
                'hierarchical'          => true,
                'labels'                => $labels,
                'show_ui'               => true,
                'show_admin_column'     => true,
                'query_var'             => true,
            );

            st_reg_taxonomy( 'st_location_type', 'location', $args );
        }

// Order ==============================================================



        static function st_order_init() {
            $labels = array(
                'name'               => __( 'Order', ST_TEXTDOMAIN ),
                'singular_name'      => __( 'Order', ST_TEXTDOMAIN ),
                'menu_name'          => __( 'Orders', ST_TEXTDOMAIN ),
                'name_admin_bar'     => __( 'Order', ST_TEXTDOMAIN ),
                'add_new'            => __( 'Add New', ST_TEXTDOMAIN ),
                'add_new_item'       => __( 'Add New Order', ST_TEXTDOMAIN ),
                'new_item'           => __( 'New Order', ST_TEXTDOMAIN ),
                'edit_item'          => __( 'Edit Order', ST_TEXTDOMAIN ),
                'view_item'          => __( 'View Order', ST_TEXTDOMAIN ),
                'all_items'          => __( 'All Orders', ST_TEXTDOMAIN ),
                'search_items'       => __( 'Search Orders', ST_TEXTDOMAIN ),
                'parent_item_colon'  => __( 'Parent Orders:', ST_TEXTDOMAIN ),
                'not_found'          => __( 'No Orders found.', ST_TEXTDOMAIN ),
                'not_found_in_trash' => __( 'No Orders found in Trash.', ST_TEXTDOMAIN )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => false,
                'show_in_menu'       => false,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'st_order' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                //'menu_position'      => null,
                'supports'           => array( 'title', 'author' ),
                'exclude_from_search'=>true
            );

            st_reg_post_type( 'st_order', $args );


            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => false,
                'show_in_menu'       => 'edit.php?post_type=st_order',
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'st_order_item' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                //'menu_position'      => null,
                'supports'           => array( 'author' ),
                'exclude_from_search'=>true
            );

            //register_post_type( 'st_order_item', $args );

            // Layout ==============================================================

            $labels = array(
                'name'               => __( 'Layouts ', ST_TEXTDOMAIN ),
                'singular_name'      => __( 'Layout', ST_TEXTDOMAIN ),
                'menu_name'          => __( 'Layouts', ST_TEXTDOMAIN ),
                'name_admin_bar'     => __( 'Layout', ST_TEXTDOMAIN ),
                'add_new'            => __( 'Add New', ST_TEXTDOMAIN ),
                'add_new_item'       => __( 'Add New Layout', ST_TEXTDOMAIN ),
                'new_item'           => __( 'New Layout', ST_TEXTDOMAIN ),
                'edit_item'          => __( 'Edit Layout', ST_TEXTDOMAIN ),
                'view_item'          => __( 'View Layout', ST_TEXTDOMAIN ),
                'all_items'          => __( 'All Layouts', ST_TEXTDOMAIN ),
                'search_items'       => __( 'Search Layout', ST_TEXTDOMAIN ),
                'parent_item_colon'  => __( 'Parent Layout:', ST_TEXTDOMAIN ),
                'not_found'          => __( 'No Layouts found.', ST_TEXTDOMAIN ),
                'not_found_in_trash' => __( 'No Layouts found in Trash.', ST_TEXTDOMAIN )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'st_layouts' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                //'menu_position'      => null,
                'supports'           => array( 'author','title','editor' ),
                'menu_icon'          =>'dashicons-desktop-red',
                'exclude_from_search'=>true,
//                'capabilities' => array(
//                    'publish_posts' => 'manage_options',
//                    'edit_posts' => 'manage_options',
//                    'edit_others_posts' => 'manage_options',
//                    'delete_posts' => 'manage_options',
//                    'delete_others_posts' => 'manage_options',
//                    'read_private_posts' => 'manage_options',
//                    'edit_post' => 'manage_options',
//                    'delete_post' => 'manage_options',
//                    'read_post' => 'manage_options',
//                ),
            );

            st_reg_post_type( 'st_layouts', $args );











            // Coupon Code ==============================================================
            $labels = array(
                'name'               => __( 'Coupon Code', ST_TEXTDOMAIN ),
                'singular_name'      => __( 'Coupon Code', ST_TEXTDOMAIN ),
                'menu_name'          => __( 'Coupon', ST_TEXTDOMAIN ),
                'name_admin_bar'     => __( 'Coupon Code', ST_TEXTDOMAIN ),
                'add_new'            => __( 'Add Coupon Code', ST_TEXTDOMAIN ),
                'add_new_item'       => __( 'Add New Coupon Code', ST_TEXTDOMAIN ),
                'new_item'           => __( 'New Coupon Code', ST_TEXTDOMAIN ),
                'edit_item'          => __( 'Edit Coupon Code', ST_TEXTDOMAIN ),
                'view_item'          => __( 'View Coupon Code', ST_TEXTDOMAIN ),
                'all_items'          => __( 'All Coupon Code', ST_TEXTDOMAIN ),
                'search_items'       => __( 'Search Coupon Code', ST_TEXTDOMAIN ),
                'parent_item_colon'  => __( 'Parent Coupon Code:', ST_TEXTDOMAIN ),
                'not_found'          => __( 'No Coupon Code found.', ST_TEXTDOMAIN ),
                'not_found_in_trash' => __( 'No Coupon Code found in Trash.', ST_TEXTDOMAIN )
            );

            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'coupon_code' ),
                'capability_type'    => '',
                'has_archive'        => false,
                'hierarchical'       => false,
                //'menu_position'      => null,
                'supports'           => array( 'title'),
                'menu_icon'          =>'dashicons-tag-st',
                'exclude_from_search'=>true,
                'capabilities' => array(
                    'publish_posts' => 'manage_options',
                    'edit_posts' => 'manage_options',
                    'edit_others_posts' => 'manage_options',
                    'delete_posts' => 'manage_options',
                    'delete_others_posts' => 'manage_options',
                    'read_private_posts' => 'manage_options',
                    'edit_post' => 'manage_options',
                    'delete_post' => 'manage_options',
                    'read_post' => 'manage_options',
                ),
            );
            st_reg_post_type( 'st_coupon_code', $args );// post type cars

        }



    }

    if(!function_exists('st'))
    {
        function st()
        {
           return STTraveler::_get_instance();
        }
    }

    STTraveler::_class_init();

}
