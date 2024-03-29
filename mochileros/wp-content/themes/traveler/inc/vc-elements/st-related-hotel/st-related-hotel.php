<?php
if(!st_check_service_available( 'st_hotel' )) {
    return;
}
if(function_exists( 'vc_map' )) {
    $list_taxonomy = st_list_taxonomy( 'st_hotel' );
    //$list_taxonomy = array_merge( array( "---Select---" => "" ) , $list_taxonomy );

    $params  = array(
        array(
            "type"             => "textfield" ,
            "holder"           => "div" ,
            "heading"          => __( "Title" , ST_TEXTDOMAIN ) ,
            "param_name"       => "title" ,
            "description"      => "" ,
            "value"            => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
        array(
            "type"        => "textfield" ,
            "holder"      => "div" ,
            "heading"     => __( "List ID in Tour" , ST_TEXTDOMAIN ) ,
            "param_name"  => "st_ids" ,
            "description" => __( "Ids separated by commas" , ST_TEXTDOMAIN ) ,
            'value'       => "" ,
        ) ,
        array(
            "type"             => "textfield" ,
            "holder"           => "div" ,
            "heading"          => __( "Number of Posts" , ST_TEXTDOMAIN ) ,
            "param_name"       => "posts_per_page" ,
            "description"      => "" ,
            "value"            => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,       
        array(
            "type"        => "dropdown" ,
            "holder"      => "div" ,
            "heading"     => __( "Sort By Taxonomy" , ST_TEXTDOMAIN ) ,
            "param_name"  => "sort_taxonomy" ,
            "description" => "" ,
            "value"       => $list_taxonomy ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order By" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_orderby" ,
            "description"      => "" ,
            'edit_field_class' => 'vc_col-sm-6' ,
            'value'            => function_exists( 'st_get_list_order_by' ) ? st_get_list_order_by() : array() ,
        ) ,
        array(
            "type"             => "dropdown" ,
            "holder"           => "div" ,
            "heading"          => __( "Order" , ST_TEXTDOMAIN ) ,
            "param_name"       => "st_order" ,
            'value'            => array(
                __('--Select--',ST_TEXTDOMAIN)=>'',
                __( 'Asc' , ST_TEXTDOMAIN )  => 'asc' ,
                __( 'Desc' , ST_TEXTDOMAIN ) => 'desc'
            ) ,
            'edit_field_class' => 'vc_col-sm-6' ,
        ) ,
    );
    $data_vc = STHotel::get_taxonomy_and_id_term_tour();
    $params  = array_merge( $params , $data_vc[ 'list_vc' ] );
    vc_map( array(
        "name"            => __( "ST List hotel related" , ST_TEXTDOMAIN ) ,
        "base"            => "st_list_hotel_related" ,
        "content_element" => true ,
        "icon"            => "icon-st" ,
        "category"        => "Shinetheme" ,
        "params"          => $params
    ) );
}
if(!function_exists( 'st_list_hotel_related' )) {
    function st_list_hotel_related( $attr , $content = false )
    {

        $data_vc = STHotel::get_taxonomy_and_id_term_tour();   
        $param = array(
                'title'=>'',
                'st_ids'                 => '' ,
                'sort_taxonomy'=>'',
                'posts_per_page'  => 3,
                'st_orderby' =>'ID' ,
                'st_order'=>'DESC',
                'font_size' => '3' ,
                'number_of_row'=>1
                );
        $param   = array_merge( $param , $data_vc[ 'list_id_vc' ] );
        $data = shortcode_atts(
            $param , $attr , 'st_list_hotel_related');
        extract($data);
        $page = STInput::request( 'paged' );
        if(!$page) {
            $page = get_query_var( 'paged' );
        }
        $query = array(
            'post_type' =>'st_hotel',
            'posts_per_page'=>$posts_per_page,
            'post_status'=>'publish',
            'paged'     =>$page,
            'order'          =>  $st_order,
            'orderby'        => $st_orderby,
            'post__not_in' => array(get_the_ID())
            );
        if(!empty( $st_ids )) {
            $query[ 'post__in' ] = explode( ',' , $st_ids );
            $query['orderby'] = 'post__in';
        }
        if(!empty( $sort_taxonomy )) {
            if(isset( $attr[ "id_term_" . $sort_taxonomy ] )) {
                $terms_post = (wp_get_post_terms(get_the_ID() , $sort_taxonomy , array('fields'=>'ids')));
                $id_term              = $attr[ "id_term_" . $sort_taxonomy ];
                $id_term = explode( ',' , $id_term )  ;
                $terms = array();
                foreach ($id_term as $key => $value) {
                    if (in_array($value, $terms_post)){
                        $terms[] = $value;
                    }
                }

                if ($terms){
                    $query[ 'tax_query' ] = array(
                        array(
                            'taxonomy' => $sort_taxonomy ,
                            'field'    => 'id' ,
                            'terms'    => $terms
                        ) ,
                    );
                }
                }            
            };


        $hotel_helper = new HotelHelper();
        add_filter( 'posts_where' , array( $hotel_helper , '_get_query_where_validate' ) );
        $rs = new Wp_Query($query);
        remove_filter( 'posts_where' , array( $hotel_helper , '_get_query_where_validate' ) );

        $r = "<div class='list_hotel_related'>" . st()->load_template( 'vc-elements/st-list-hotel/loop-hot' , 'deals' , array(
            'query'=>$rs)) . "</div>";

        wp_reset_query();  

        if(!empty( $title ) and !empty( $r )) {
            $r = '<h' . $font_size . '>' . $title . '</h' . $font_size . '>' . $r;
        }

        return $r;      

    }
}
if(st_check_service_available( 'st_hotel' )) {
    st_reg_shortcode( 'st_list_hotel_related' , 'st_list_hotel_related' );
}