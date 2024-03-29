<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 3/6/15
 * Time: 4:04 PM
 */

$main_color =st()->get_option('main_color','#ed8323');


if(isset($_GET['main_color']))
{
    $main_color.='#'.$_GET['main_color'];
}
if(isset($main_color_char))
{
    $main_color=$main_color_char;
}

if(!$main_color) $main_color='#ed8323';

$hex=st_hex2rgb($main_color);
$star_color=st()->get_option('star_color',$main_color);

?>


.map_type .st-map-type{
background-color: <?php echo esc_attr($main_color)?>;
}
#gmap-control{
background-color: <?php echo esc_attr($main_color)?>;
}
.gmapzoomminus , .gmapzoomplus{
background-color: <?php echo esc_attr($main_color)?>;
}

.sort_icon .active,
.woocommerce-ordering .sort_icon a.active{
color:<?php echo esc_attr($main_color)?>;
cursor: default;
}
.package-info-wrapper .icon-group i:not(".fa-star"):not(".fa-star-o"){
   color:<?php echo esc_attr($main_color)?>;
}
a,
a:hover,
.list-category > li > a:hover,
.pagination > li > a,
.top-user-area .top-user-area-list > li > a:hover,
.sidebar-widget.widget_archive ul> li > a:hover,
.sidebar-widget.widget_categories ul> li > a:hover,
.comment-form .add_rating,
.booking-item-reviews > li .booking-item-review-content .booking-item-review-expand span,
.form-group.form-group-focus .input-icon.input-icon-hightlight,
.booking-item-payment .booking-item-rating-stars .fa-star,
.booking-item-raiting-summary-list > li .booking-item-rating-stars,
.woocommerce .woocommerce-breadcrumb .last,
.product-categories li.current-cat:before,
.product-categories li.current-cat-parent:before,
.product-categories li.current-cat>a,
.product-categories li.current-cat>span,
.woocommerce .star-rating span:before,
.woocommerce ul.products li.product .price,
.woocommerce .woocommerce_paging a,
.woocommerce .product_list_widget ins .amount,
#location_header_static i,
.booking-item-reviews > li .booking-item-rating-stars,
.booking-item-payment .booking-item-rating-stars .fa-star-half-o,
#top_toolbar .top_bar_social:hover,
.text-color,
.woocommerce .woocommerce-message:before,.woocommerce .woocommerce-info:before,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a,
.booking-item-rating .booking-item-rating-stars ,
body .box-icon-border.box-icon-white:hover,body  [class^="box-icon-border"].box-icon-white:hover,body  [class*=" box-icon-border"].box-icon-white:hover,body  .box-icon-border.box-icon-to-white:hover:hover,body  [class^="box-icon-border"].box-icon-to-white:hover:hover,body  [class*=" box-icon-border"].box-icon-to-white:hover:hover,
#main-footer .text-color,
.change_same_location:focus
{
color:<?php echo esc_attr($main_color)?>
}
::selection {
background: <?php echo esc_attr($main_color)?>;
color: #fff;
}
.share ul li a:hover{
color:<?php echo esc_attr($main_color)?>!important;
}

    .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
         color: <?php echo esc_attr($main_color)?> !important;
    }


header#main-header,
.btn-primary,
.post .post-header,
.top-user-area .top-user-area-list > li.top-user-area-avatar > a:hover > img,

.booking-item:hover, .booking-item.active,
.booking-item-dates-change:hover,
.btn-group-select-num >.btn.active, .btn-group-select-num >.btn.active:hover,
.btn-primary:hover,
.booking-item-features > li:hover > i,
.form-control:active,
.form-control:focus,
.fotorama__thumb-border,
.sticky-wrapper.is-sticky .main_menu_wrap,
.woocommerce form .form-row.woocommerce-validated .select2-container,
.woocommerce form .form-row.woocommerce-validated input.input-text,
.woocommerce form .form-row.woocommerce-validated select,
.btn-primary:focus
{
border-color:<?php echo esc_attr($main_color)?>;
}
#menu1 {
  border-bottom: 2px solid <?php echo esc_attr($main_color)?>;
}
.woocommerce .woocommerce-message,.woocommerce .woocommerce-info {
  border-top-color:  <?php echo esc_attr($main_color)?>;

}

.pagination > li > a.current, .pagination > li > a.current:hover,
.btn-primary,
ul.slimmenu li.active > a, ul.slimmenu li:hover > a,
.nav-drop > .nav-drop-menu > li > a:hover,
.btn-group-select-num >.btn.active, .btn-group-select-num >.btn.active:hover,
.btn-primary:hover,
.pagination > li.active > a, .pagination > li.active > a:hover,
.box-icon, [class^="box-icon-"], [class*=" box-icon-"]:not(.box-icon-white):not(.box-icon-border-dashed):not(.box-icon-border),
.booking-item-raiting-list > li > div.booking-item-raiting-list-bar > div, .booking-item-raiting-summary-list > li > div.booking-item-raiting-list-bar > div,
.irs-bar,
.nav-pills > li.active > a,
.search-tabs-bg > .tabbable > .nav-tabs > li.active > a,
.search-tabs-bg > .tabbable > .nav-tabs > li > a:hover > .fa,
.irs-slider,
.post .post-header .post-link,
.hover-img .hover-title, .hover-img [class^="hover-title-"], .hover-img [class*=" hover-title-"],
.post .post-header .post-link:hover,
#gotop:hover,
.shop-widget-title,
.woocommerce ul.products li.product .add_to_cart_button,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.sidebar_section_title,
.shop_reset_filter:hover,
.woocommerce .woocommerce_paging a:hover,
.pagination .page-numbers.current,
.pagination .page-numbers.current:hover,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
.chosen-container .chosen-results li.highlighted,
.bgr-main,
#taSignIn,
.grid_hotel_room .grid , 
.grid_hotel_room .grid figure,
figure.effect-layla,
.st-page-sidebar-new .page-sidebar-menu .sub-menu.item .active > a,.st-page-sidebar-new .page-sidebar-menu > li.active > a
{
background:<?php echo esc_attr($main_color)?>
}
.calendar-content .fc-state-default,.calendar-content.fc-unthemed .btn.btn-available:hover , .calendar-content.fc-unthemed .st-active .btn.btn-available, .calendar-content.fc-unthemed .btn.btn-available.selected {
  background-color:<?php echo esc_attr($main_color)?>;
}
.calendar-content.fc-unthemed .btn.btn-available:hover ,.datepicker table tr td.active:hover, .datepicker table tr td.active:hover:hover, .datepicker table tr td.active.disabled:hover, .datepicker table tr td.active.disabled:hover:hover, .datepicker table tr td.active:focus, .datepicker table tr td.active:hover:focus, .datepicker table tr td.active.disabled:focus, .datepicker table tr td.active.disabled:hover:focus, .datepicker table tr td.active:active, .datepicker table tr td.active:hover:active, .datepicker table tr td.active.disabled:active, .datepicker table tr td.active.disabled:hover:active, .datepicker table tr td.active.active, .datepicker table tr td.active:hover.active, .datepicker table tr td.active.disabled.active, .datepicker table tr td.active.disabled:hover.active, .open .dropdown-toggle.datepicker table tr td.active, .open .dropdown-toggle.datepicker table tr td.active:hover, .open .dropdown-toggle.datepicker table tr td.active.disabled, .open .dropdown-toggle.datepicker table tr td.active.disabled:hover
{
  background-color:<?php echo esc_attr($main_color)?>;
  border-color: <?php echo esc_attr($main_color)?>;
}

.datepicker table tr td.today:before, .datepicker table tr td.today:hover:before, .datepicker table tr td.today.disabled:before, .datepicker table tr td.today.disabled:hover:before{
border-bottom-color: <?php echo esc_attr($main_color)?>;
}
<?php if (!empty($hex)) {?>
.box-icon:hover, [class^="box-icon-"]:hover, [class*=" box-icon-"]:hover
{
background:rgba(<?php echo esc_attr($hex[0].','.$hex[1].','.$hex[2].',0.7') ?>);
}

.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover
{
    background:rgba(<?php echo esc_attr($hex[0].','.$hex[1].','.$hex[2].',0.7') ?>);
}
<?php } ;?>
.booking-item-reviews > li .booking-item-review-person-avatar:hover
{
-webkit-box-shadow: 0 0 0 2px <?php echo esc_attr($main_color)?>;
box-shadow: 0 0 0 2px <?php echo esc_attr($main_color)?>;
}
#main-header ul.slimmenu li.current-menu-item > a, #main-header ul.slimmenu li:hover > a,
#main-header .menu .current-menu-ancestor >a,
#main-header .product-info-hide .product-btn:hover
{
background:<?php echo esc_attr($main_color)?>;
color:white;
}

#main-header .menu .current-menu-item > a
{
background:<?php echo esc_attr($main_color)?> !important;
color:white !important;
}


.i-check.checked, .i-radio.checked
{

border-color: <?php echo esc_attr($main_color)?>;
background: <?php echo esc_attr($main_color)?>;
}


.i-check.hover, .i-radio.hover
{
border-color: <?php echo esc_attr($main_color)?>;
}
.owl-controls .owl-buttons div:hover
{

    background: <?php echo esc_attr($main_color)?>;
    -webkit-box-shadow: 0 0 0 1px <?php echo esc_attr($main_color)?>;
    box-shadow: 0 0 0 1px <?php echo esc_attr($main_color)?>;
}

.irs-diapason{

background: <?php echo esc_attr($main_color)?>;
}
ul.slimmenu.slimmenu-collapsed li .slimmenu-sub-collapser {
 background:<?php echo esc_attr($main_color)?>
}

<?php if($star_color):?>
    .booking-item-rating .fa ,
    .booking-item.booking-item-small .booking-item-rating-stars,
    .comment-form .add_rating,
    .booking-item-payment .booking-item-rating-stars .fa-star,
    .st-item-rating .fa,
    li  .fa-star , li  .fa-star-o , li  .fa-star-half-o{
    color:<?php echo esc_attr($star_color)?>
    }
<?php endif;?>





<?php $color_featured = st()->get_option('st_text_featured_color');
      $bg_featured = st()->get_option('st_text_featured_bg');
?>
.st_featured{
 color: <?php echo esc_attr($color_featured) ?>;
 background: <?php echo esc_attr($bg_featured) ?>;
}

.st_featured::before {
   border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent transparent;
}
.st_featured::after {
    border-color: <?php echo esc_attr($bg_featured) ?> transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>;
}
.featured_single .st_featured::before{
   border-color: transparent <?php echo esc_attr($bg_featured) ?> transparent transparent;
}



.item-nearby .st_featured{
   padding: 0 13px 0 0;
}
.item-nearby .st_featured::before {
    right: 0px;
    left: auto;
    border-color: transparent transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>;
    top: -9px;
}
.item-nearby .st_featured::after {
   left: -25px;
   height: 28px;
   right:auto;
   border-width:14px;
   border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent  ;
}
.item-nearby .st_featured{
  font: bold 14px/28px Cambria,Georgia,Times,serif;
}

<?php  if(st()->get_option('right_to_left') == 'on' ){ ?>
    .st_featured{
       padding: 0 13px 0 3px;
    }
    /*
    .st_featured::before {
        border-color: <?php echo esc_attr($bg_featured) ?> transparent transparent <?php echo esc_attr($bg_featured) ?>;
    }
    .st_featured::after {
        border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent;
    }*/
    .featured_single .st_featured::before {
        /*border-color: transparent transparent transparent <?php echo esc_attr($bg_featured) ?> ;
        fix bug css 1*/
        border-color: <?php echo esc_attr($bg_featured) ?> transparent transparent transparent  ;
        right: -26px;
    }
    .item-nearby  .st_featured::before {
    border-color: <?php echo esc_attr($bg_featured) ?> transparent transparent <?php echo esc_attr($bg_featured) ?>;
    }

    .item-nearby .st_featured {
        bottom: 10px;
        left: -10px;
        right: auto;
        top: auto;
        /*
         padding: 0  0 0 13px;
         FIX BUG CSS 2.1
         */

        padding-left:13px!important;
    }
    .item-nearby  .st_featured::before {
        /*left: 0;
        right:auto;

         FIX BUG CSS 2.1
        */

        left: 0;
        right: auto;
        bottom: -10px;
        top: auto;

    }
    .item-nearby .st_featured::before {
          /*border-color: <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?> transparent transparent;
          FIX BUG CSS 2.1
          */
          border-color: transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>  transparent;
    }
    .item-nearby .st_featured::after {
        /*border-color:  <?php echo esc_attr($bg_featured) ?> transparent <?php echo esc_attr($bg_featured) ?> <?php echo esc_attr($bg_featured) ?>;
        border-width: 14px;
        right: -27px;
        Fix but css 2.1
        */

        border-color:   transparent <?php echo esc_attr($bg_featured) ?> transparent transparent;
        border-width: 14px;
        right: -26px;

    }
    .featured_single {
        padding-left: 70px;
        padding-right: 0px;
    }
<?php } ?>
<?php 
  $header_bgr_color = st()->get_option('header_background' );

  $header_bgr_color = $header_bgr_color['background-color'] ;
  if (st()->get_option('menu_style') =='2'):
?>
@media (min-width: 993px) { 
.menu_style2.header_transparent  #st_header_wrap {     
    background: -moz-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%, <?php echo esc_attr($header_bgr_color)?> 27%, rgba(0,0,0,0) 90%, rgba(0,0,0,0) 99%, rgba(0,0,0,0) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo esc_attr($header_bgr_color)?>), color-stop(27%,<?php echo esc_attr($header_bgr_color)?>), color-stop(90%,rgba(0,0,0,0)), color-stop(99%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0)));
    background: -webkit-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    background: -o-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    background: -ms-linear-gradient(top, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%);
    /* background: linear-gradient(to bottom, <?php echo esc_attr($header_bgr_color)?> 0%,<?php echo esc_attr($header_bgr_color)?> 27%,rgba(0,0,0,0) 90%,rgba(0,0,0,0) 99%,rgba(0,0,0,0) 100%); */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6000000', endColorstr='#00000000',GradientType=0 );
  }
}
<?php endif; ?>