<?php
//$info = STUser_f::st_get_data_reports_partner(array('st_cars','st_hotel'),'10-9-2015','20-9-2015');
$_custom_date = STUser_f::get_custom_date_reports_partner();
$request_custom_date = STUser_f::get_request_custom_date_partner();
$custom_layout = st()->get_option('partner_custom_layout','off');
$custom_layout_total_earning = st()->get_option('partner_custom_layout_total_earning','on');
$custom_layout_service = st()->get_option('partner_custom_layout_service_earning','on');
$custom_layout_chart_info = st()->get_option('partner_custom_layout_chart_info','on');
if($custom_layout == "off"){
    $custom_layout_total_earning = $custom_layout_service = $custom_layout_chart_info = "on";
}

$total_earning = STUser_f::st_get_data_reports_total_all_time_partner();
?>
<?php if($custom_layout_total_earning == "on"){ ?>
    <div class="row div-partner-page-title">
        <div class="col-md-7">
            <h3 class="partner-page-title">
                <?php _e("Dashboard",ST_TEXTDOMAIN) ?> <small><?php _e("reports &amp; statistics",ST_TEXTDOMAIN) ?></small>
            </h3>
        </div>
        <div class="col-md-5">
            <div  class="btn btn-sm btn-default pull-right btn_show_custom_date">
                <i class="fa fa-calendar"></i>
                &nbsp;
            <span class="thin uppercase">
                <?php
                if($request_custom_date['type'] == 'all_time'){
                    _e("All Time",ST_TEXTDOMAIN);
                }else{?>
                    <span class="hidden-sm hidden-md hidden-lg">
                        <?php echo date_i18n( 'd/m/Y', strtotime( $request_custom_date['start'] ) ); ?>
                    </span>
                    <span class="hidden-xs">
                        <?php echo date_i18n( 'F j, Y', strtotime( $request_custom_date['start'] ) ); ?>
                    </span>
                    -
                    <span class="hidden-sm hidden-md hidden-lg">
                        <?php echo date_i18n( 'd/m/Y', strtotime( $request_custom_date['end'] ) ); ?>
                    </span>
                    <span class="hidden-xs">
                        <?php echo date_i18n( 'F j, Y', strtotime( $request_custom_date['end'] ) ); ?>
                    </span>
                <?php } ?>
            </span>
                &nbsp;
                <i class="fa fa-angle-down"></i>
            </div>
            <div class="div-custom-date st-calendar">
                <div class="row">
                    <div class="col-md-12">
                        <form action="<?php the_permalink() ?>">
                            <input type="hidden" name="sc" value="dashboard">
                            <div class="form-group form-group-icon-left">

                                <label for="custom_select_date"><?php _e("Select Date",ST_TEXTDOMAIN) ?></label>
                                <i class="fa fa-cogs input-icon input-icon-highlight"></i>
                                <select class="form-control custom_select_date" name="custom_select_date">
                                    <option <?php if($request_custom_date['type'] == 'this_week') echo "selected"; ?> value="this_week|<?php echo esc_html($_custom_date['the_week']['this_week']['start']) ?>|<?php echo esc_html($_custom_date['the_week']['this_week']['end']) ?>"><?php _e("This week",ST_TEXTDOMAIN) ?></option>
                                    <option <?php if($request_custom_date['type'] == 'this_month') echo "selected"; ?> value="this_month|<?php echo date('Y-m-01') ?>|<?php echo date('Y-m-t') ?>"><?php _e("This month",ST_TEXTDOMAIN) ?></option>
                                    <option <?php if($request_custom_date['type'] == 'this_year') echo "selected"; ?> value="this_year|<?php echo date('Y-01-01')  ?>|<?php echo date('Y-12-31')  ?>"><?php _e("This year",ST_TEXTDOMAIN) ?></option>
                                    <option <?php if($request_custom_date['type'] == 'all_time') echo "selected"; ?> value="all_time||"><?php _e("All Time",ST_TEXTDOMAIN) ?></option>
                                    <option <?php if($request_custom_date['type'] == 'custom_date') echo "selected"; ?> value="custom_date||"><?php _e("Custom Date",ST_TEXTDOMAIN) ?></option>
                                </select>
                            </div>
                            <div class="data_custom_date">
                                <div class="form-group form-group-icon-left">

                                    <label for="date_start"><?php _e("From",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                    <?php
                                    $date_start=$request_custom_date['start'];
                                    $date_end=$request_custom_date['end'];
                                    ?>
                                    <input id="date_start" class="form-control input-date-start" data-format-php="<?php echo esc_html(TravelHelper::getDateFormat()) ?>" data-value="<?php echo esc_html($request_custom_date['start']) ?>" data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" placeholder="<?php echo TravelHelper::getDateFormatJs(); ?>" type="text" name="date_start" value="<?php echo date_i18n(TravelHelper::getDateFormat(),strtotime($date_start)) ?>" required="" readonly>
                                </div>
                                <div class="form-group form-group-icon-left">

                                    <label for="date_end"><?php _e("To",ST_TEXTDOMAIN) ?></label>
                                    <i class="fa fa-calendar input-icon input-icon-highlight"></i>
                                    <input id="date_end" class="form-control input-date-end"  data-date-format="<?php echo TravelHelper::getDateFormatJs(); ?>" type="text" name="date_end" value="<?php echo date_i18n(TravelHelper::getDateFormat(),strtotime($date_end)) ?>" required="" readonly>
                                </div>
                            </div>
                            <div class="form-group form-group-icon-left">
                                <button type="submit" class="btn btn-primary btn-sm"><?php _e("Apply",ST_TEXTDOMAIN) ?></button>
                                <button type="button" class="btn btn-default btn-sm pull-right btn_cancel"><?php _e("Cancel",ST_TEXTDOMAIN) ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-4">
            <?php
            $start  = $_custom_date['y'].'-'.$_custom_date['m'].'-1';
            $end  = $_custom_date['y'].'-'.$_custom_date['m'].'-31';
            $this_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
            ?>
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-1">
                <div class="visual">
                    <i class="fa fa fa-bar-chart"></i>
                </div>
                <div class="title">
                    <?php _e("Earning This Month",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php
                        if($this_month['average_total'] > 0){
                            echo TravelHelper::format_money($this_month['average_total']);
                        }else{
                            echo "0";
                        }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-2">
                <div class="visual">
                    <i class="fa fa-calculator"></i>
                </div>
                <div class="title">
                    <?php _e("Your Balance",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php
                        if(!empty($total_earning['average_total']) and $total_earning['average_total'] > 0){
                            echo TravelHelper::format_money($total_earning['average_total']) ;
                        }else{
                            echo "0";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <?php
            //$total_earning = STUser_f::st_get_data_reports_total_earning_partner();
            ?>
            <div class="st-dashboard-stat st-month-madison st-dashboard-new st-month-3">
                <div class="visual">
                    <i class="fa fa-cogs"></i>
                </div>
                <div class="title">
                    <?php _e("Total Earning",ST_TEXTDOMAIN) ?>
                </div>
                <div class="details">
                    <div class="number">
                        <?php
                        if(!empty($total_earning['total']) and $total_earning['total'] > 0){
                            echo TravelHelper::format_money($total_earning['total']) ;
                        }else{
                            echo "0";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }?>
<?php if($custom_layout_service == "on"){ ?>
    <div class="head_reports bg-warning">
        <div class="head_control">
            <div class="head_time">
                <span><?php
                    echo sprintf( "Sales Earning %s for each service" ,$request_custom_date['title'])
                    ?></span>
            </div>
        </div>
    </div>
    <?php
    if($request_custom_date['type'] == 'all_time'){
        $this_data_custom = $total_earning;
    }else{
        $this_data_custom = STUser_f::st_get_data_reports_partner('all','custom_date',$request_custom_date['start'],$request_custom_date['end']);
    }
    ?>
    <div class="row">
        <?php if (STUser_f::_check_service_available_partner('st_hotel')):?>
            <div class="col-md-4">
                <div class="panel panel-primary panel-st_hotel panel-single">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa <?php echo apply_filters('st_post_type_st_hotel_icon','') ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $price = $this_data_custom['post_type']['st_hotel']['average_total'];
                                    if(empty($price)){
                                        echo esc_html($price);
                                    }else{
                                        echo TravelHelper::format_money($price);
                                    }?>
                                </div>
                                <div class="title"><?php _e("Hotel",ST_TEXTDOMAIN) ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_hotel') , get_the_permalink() ) ) ?>">
                        <div class="panel-footer">
                            <span class="pull-left"><?php _e("View Details",ST_TEXTDOMAIN) ?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
        <?php if (STUser_f::_check_service_available_partner('st_rental')):?>
            <div class="col-md-4">
                <div class="panel panel-primary panel-st_rental panel-single">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa <?php echo apply_filters('st_post_type_st_rental_icon','') ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $price = $this_data_custom['post_type']['st_rental']['average_total'];
                                    if(empty($price)){
                                        echo esc_html($price);
                                    }else{
                                        echo TravelHelper::format_money($price);
                                    }?>
                                </div>
                                <div class="title"><?php _e("Rental",ST_TEXTDOMAIN) ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_rental') , get_the_permalink() ) ) ?>">
                        <div class="panel-footer">
                            <span class="pull-left"><?php _e("View Details",ST_TEXTDOMAIN) ?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
        <?php if (STUser_f::_check_service_available_partner('st_cars')):?>
            <div class="col-md-4">
                <div class="panel panel-primary panel-st_cars panel-single">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa <?php echo apply_filters('st_post_type_st_cars_icon','') ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $price = $this_data_custom['post_type']['st_cars']['average_total'];
                                    if(empty($price)){
                                        echo esc_html($price);
                                    }else{
                                        echo TravelHelper::format_money($price);
                                    }?>
                                </div>
                                <div class="title"><?php _e("Car",ST_TEXTDOMAIN) ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_cars') , get_the_permalink() ) ) ?>">
                        <div class="panel-footer">
                            <span class="pull-left"><?php _e("View Details",ST_TEXTDOMAIN) ?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
        <?php if (STUser_f::_check_service_available_partner('st_tours')):?>
            <div class="col-md-4">
                <div class="panel panel-primary panel-st_tours panel-single">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa <?php echo apply_filters('st_post_type_st_tours_icon','') ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $price = $this_data_custom['post_type']['st_tours']['average_total'];
                                    if(empty($price)){
                                        echo esc_html($price);
                                    }else{
                                        echo TravelHelper::format_money($price);
                                    }?>
                                </div>
                                <div class="title"><?php _e("Tour",ST_TEXTDOMAIN) ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_tours') , get_the_permalink() ) ) ?>">
                        <div class="panel-footer">
                            <span class="pull-left"><?php _e("View Details",ST_TEXTDOMAIN) ?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
        <?php if (STUser_f::_check_service_available_partner('st_activity')):?>
            <div class="col-md-4">
                <div class="panel panel-primary panel-st_activity panel-single">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa <?php echo apply_filters('st_post_type_st_activity_icon','') ?> fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    <?php
                                    $price = $this_data_custom['post_type']['st_activity']['average_total'];
                                    if(empty($price)){
                                        echo esc_html($price);
                                    }else{
                                        echo TravelHelper::format_money($price);
                                    }?>
                                </div>
                                <div class="title"><?php _e("Activity",ST_TEXTDOMAIN) ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo  esc_url( add_query_arg( array('sc'=>'dashboard-info','type'=>'st_activity') , get_the_permalink() ) ) ?>">
                        <div class="panel-footer">
                            <span class="pull-left"><?php _e("View Details",ST_TEXTDOMAIN) ?></span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;?>
    </div>
<?php } ?>
<?php if($custom_layout_chart_info == "on"){ ?>
    <?php if($request_custom_date['type'] == 'all_time'){ ?>
        <?php $data_year_js = STUser_f::_conver_array_to_data_js_reports($total_earning['date'],'all','year');?>
        <div class="div_all_time_year" style="display: block">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time">
                            <?php _e("All Time",ST_TEXTDOMAIN) ?>
                        </div>
                    </div>
                </div>
                <div class="st_div_item_canvas_year"><canvas id="canvas_year"></canvas></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php _e("Year",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                                <!--<th style="width: 85px;" class="text-center"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;foreach($total_earning['date'] as $k=>$v): ?>
                                <tr>
                                    <td><?php echo esc_html($i) ?></td>
                                    <td>
                                    <span class="btn_all_time_show_month_by_year text-color" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>"  data-year="<?php echo esc_html($k) ?>" href="javascript:;">
                                        <?php echo esc_html($k) ?>
                                    </span>
                                    </td>
                                    <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($v['average_total'] > 0){
                                            echo TravelHelper::format_money($v['average_total']);
                                        }else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                    <!--<td class="text-center">
                                    <a class="btn default btn-xs green-stripe btn_all_time_show_month_by_year" data-title="<?php /*_e("View",ST_TEXTDOMAIN) */?>" data-loading="<?php /*_e("Loading...",ST_TEXTDOMAIN) */?>" data-year="<?php /*echo esc_html($k) */?>" href="javascript:;">
                                        <?php /*_e("View",ST_TEXTDOMAIN) */?>
                                    </a>
                                </td>-->
                                </tr>
                                <?php $i++; endforeach;?>
                            <tr class="bg-white">
                                <th colspan="2">
                                    <?php _e("Total",ST_TEXTDOMAIN) ?>
                                </th>
                                <td class="text-center">
                                    <?php echo esc_html($total_earning['number_orders']); ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if($total_earning['average_total'] > 0){
                                        echo TravelHelper::format_money($total_earning['average_total']);
                                    }else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="div_all_time_month">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time"></div>
                    </div>
                </div>
                <div class="st_div_item_all_time_canvas_month"></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details Month",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                                <!-- <th style="width: 85px;" class="text-center"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                            </tr>
                            </thead>
                            <tbody class="data_all_time_month"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="div_all_time_day">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time"></div>
                    </div>
                </div>
                <div class="st_div_item_all_time_canvas_day"></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details Days",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                            </tr>
                            </thead>
                            <tbody class="data_all_time_day"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var data_lable_year = <?php echo balanceTags($data_year_js['lable']) ?>;
            var data_sets_year = <?php echo balanceTags($data_year_js['data']) ?>;
            var lineChartData_total_year = {labels : data_lable_year,
                datasets : [{fillColor : "rgba(87, 142, 190, 0.5)", strokeColor : "rgba(87, 142, 190, 0.8)", pointColor : "rgba(87, 142, 190, 0.75)", pointStrokeColor : "#fff", pointHighlightFill : "#fff", pointHighlightStroke : "rgba(87, 142, 190, 1)", data : data_sets_year}]
            }
            jQuery(function(){
                var ctx_year = document.getElementById("canvas_year").getContext("2d");
                new Chart(ctx_year).Line(lineChartData_total_year, {
                    responsive: true,
                    animationEasing: "easeOutBounce"
                });
            })
        </script>
    <?php }elseif($request_custom_date['type']=="this_month" or $request_custom_date['type']=="this_year" ){ ?>

        <?php
        $start = $request_custom_date['start'];
        $end = $request_custom_date['end'];
        $this_data_info_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
        $data_js = STUser_f::_conver_array_to_data_js_reports($this_data_info_month['date'],'all',$request_custom_date['type']);

        ?>
        <div class="st_div_canvas div_custom_month">
            <div class="head_reports bg-green">
                <div class="head_control">
                    <div class="head_time">
                        <span class="btn_all_time"><?php _e("All Time",ST_TEXTDOMAIN) ?></span> /
                        <span class="btn_all_time_show_month_by_year" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN)?>"  data-year="<?php echo date_i18n( 'Y', strtotime( $start ) ); ?>"><?php echo date_i18n( 'Y', strtotime( $start ) ); ?></span> /
                        <span class="active"><?php echo date_i18n( 'F', strtotime( $start ) ); ?></span>
                    </div>
                </div>
            </div>
            <div class="st_div_item_canvas"><canvas id="canvas_month"></canvas></div>
            <div class="st_bortlet box st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"><?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data_js['data_array_php'] as $k=>$v): ?>
                                <tr>
                                    <td><?php echo esc_html($v['title']) ?></td>
                                    <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                                    <td class="text-center"><?php
                                        if($v['average_total'] > 0 ){
                                            echo TravelHelper::format_money($v['average_total']);
                                        }else{
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <tr class="bg-white">
                                <th>
                                    <?php _e("Total",ST_TEXTDOMAIN) ?>
                                </th>
                                <td class="text-center">
                                    <?php echo esc_html($data_js['info_total']['number_orders']); ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if($data_js['info_total']['average_total'] > 0){
                                        echo TravelHelper::format_money($data_js['info_total']['average_total']);
                                    }else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var data_lable = <?php echo balanceTags($data_js['lable']) ?>;
            var data_sets = <?php echo balanceTags($data_js['data']) ?>;
            var lineChartData_total = {labels : data_lable,
                datasets :[{fillColor : "rgba(87, 142, 190, 0.5)", strokeColor : "rgba(87, 142, 190, 0.8)", pointColor : "rgba(87, 142, 190, 0.75)", pointStrokeColor : "#fff", pointHighlightFill : "#fff", pointHighlightStroke : "rgba(87, 142, 190, 1)", data : data_sets}]
            };
            jQuery(function(){
                var ctx = document.getElementById("canvas_month").getContext("2d");
                new Chart(ctx).Line(lineChartData_total, {
                    responsive: true,
                    animationEasing: "easeOutBounce"
                });
            })
        </script>
        <?php $data_year_js = STUser_f::_conver_array_to_data_js_reports($total_earning['date'],'all','year');?>
        <div class="div_all_time_year">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time">
                            <?php _e("All Time",ST_TEXTDOMAIN) ?>
                        </div>
                    </div>
                </div>
                <div class="st_div_item_canvas_year"><canvas id="canvas_year"></canvas></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php _e("Year",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                                <!--<th style="width: 85px;" class="text-center"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;foreach($total_earning['date'] as $k=>$v): ?>
                                <tr>
                                    <td><?php echo esc_html($i) ?></td>
                                    <td>
                                    <span class="btn_all_time_show_month_by_year text-color" data-title="<?php _e("View",ST_TEXTDOMAIN) ?>" data-loading="<?php _e("Loading...",ST_TEXTDOMAIN) ?>"  data-year="<?php echo esc_html($k) ?>" href="javascript:;">
                                        <?php echo esc_html($k) ?>
                                    </span>
                                    </td>
                                    <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($v['average_total'] > 0){
                                            echo TravelHelper::format_money($v['average_total']);
                                        }else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                    <!--<td class="text-center">
                                    <a class="btn default btn-xs green-stripe btn_all_time_show_month_by_year" data-title="<?php /*_e("View",ST_TEXTDOMAIN) */?>" data-loading="<?php /*_e("Loading...",ST_TEXTDOMAIN) */?>" data-year="<?php /*echo esc_html($k) */?>" href="javascript:;">
                                        <?php /*_e("View",ST_TEXTDOMAIN) */?>
                                    </a>
                                </td>-->
                                </tr>
                                <?php $i++; endforeach;?>
                            </tbody>
                            <tr class="bg-white">
                                <th colspan="2">
                                    <?php _e("Total",ST_TEXTDOMAIN) ?>
                                </th>
                                <td class="text-center">
                                    <?php echo esc_html($data_year_js['info_total']['number_orders']); ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if($data_year_js['info_total']['average_total'] > 0){
                                        echo TravelHelper::format_money($data_js['info_total']['average_total']);
                                    }else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="div_all_time_month">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time"></div>
                    </div>
                </div>
                <div class="st_div_item_all_time_canvas_month"></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details Month",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                                <!--<th style="width: 85px;"><?php /*_e("Action",ST_TEXTDOMAIN) */?></th>-->
                            </tr>
                            </thead>
                            <tbody class="data_all_time_month"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="div_all_time_day">
            <div class="st_div_canvas">
                <div class="head_reports bg-green">
                    <div class="head_control">
                        <div class="head_time bc_all_time"></div>
                    </div>
                </div>
                <div class="st_div_item_all_time_canvas_day"></div>
            </div>
            <div class="st_bortlet box st_hotel " data-type="st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"> <?php _e("Details Days",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                            </tr>
                            </thead>
                            <tbody class="data_all_time_day"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var data_lable_year = <?php echo balanceTags($data_year_js['lable']) ?>;
            var data_sets_year = <?php echo balanceTags($data_year_js['data']) ?>;
            var lineChartData_total_year = {labels : data_lable_year,
                datasets : [{fillColor : "rgba(87, 142, 190, 0.5)", strokeColor : "rgba(87, 142, 190, 0.8)", pointColor : "rgba(87, 142, 190, 0.75)", pointStrokeColor : "#fff", pointHighlightFill : "#fff", pointHighlightStroke : "rgba(87, 142, 190, 1)", data : data_sets_year}]
            }
            jQuery(function($){
                /* var ctx_year = document.getElementById("canvas_year").getContext("2d");
                 new Chart(ctx_year).Line(lineChartData_total_year, {
                 responsive: true,
                 animationEasing: "easeOutBounce"
                 });*/
                $(document).on('click', '.btn_all_time', function () {
                    setTimeout(function(){
                        var ctx_year = document.getElementById("canvas_year").getContext("2d");
                        var $my_char = new Chart(ctx_year).Line(lineChartData_total_year, {
                            responsive: true,
                            animationEasing: "easeOutBounce"
                        });
                    },500);
                    $('.div_custom_month').hide();
                });
            })
        </script>



    <?php }else{ ?>
        <?php
        $start = $request_custom_date['start'];
        $end = $request_custom_date['end'];
        $this_data_info_month = STUser_f::st_get_data_reports_partner('all','custom_date',$start,$end);
        $data_js = STUser_f::_conver_array_to_data_js_reports($this_data_info_month['date'],'all',$request_custom_date['type']);
        ?>
        <div class="st_div_canvas">
            <div class="head_reports bg-green">
                <div class="head_control">
                    <div class="head_time">
                        <span><?php _e("Info Month",ST_TEXTDOMAIN) ?>:<?php echo date_i18n( 'F j, Y', strtotime( $start ) ); ?> - <?php echo date_i18n( 'F j, Y', strtotime( $end ) ); ?></span>
                    </div>
                </div>
            </div>
            <div class="st_div_item_canvas"><canvas id="canvas_month"></canvas></div>
            <div class="st_bortlet box st_hotel">
                <div class="st_bortlet-title">
                    <div class="caption"><?php _e("Details",ST_TEXTDOMAIN) ?> </div>
                </div>
                <div class="st_bortlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover st_table_partner">
                            <thead>
                            <tr>
                                <th><?php _e("Date",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Item Sales Count",ST_TEXTDOMAIN) ?></th>
                                <th><?php _e("Total Income",ST_TEXTDOMAIN) ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data_js['data_array_php'] as $k=>$v): ?>
                                <tr>
                                    <td><?php echo esc_html($v['title']) ?></td>
                                    <td class="text-center"><?php echo esc_html($v['number_orders']); ?></td>
                                    <td class="text-center"><?php
                                        if($v['average_total'] > 0 ){
                                            echo TravelHelper::format_money($v['average_total']);
                                        }else{
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                            <tr class="bg-white">
                                <th>
                                    <?php _e("Total",ST_TEXTDOMAIN) ?>
                                </th>
                                <td class="text-center">
                                    <?php echo esc_html($data_js['info_total']['number_orders']); ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if($data_js['info_total']['average_total'] > 0){
                                        echo TravelHelper::format_money($data_js['info_total']['average_total']);
                                    }else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var data_lable = <?php echo balanceTags($data_js['lable']) ?>;
            var data_sets = <?php echo balanceTags($data_js['data']) ?>;
            var lineChartData_total = {labels : data_lable,
                datasets :[{fillColor : "rgba(87, 142, 190, 0.5)", strokeColor : "rgba(87, 142, 190, 0.8)", pointColor : "rgba(87, 142, 190, 0.75)", pointStrokeColor : "#fff", pointHighlightFill : "#fff", pointHighlightStroke : "rgba(87, 142, 190, 1)", data : data_sets}]
            };
            jQuery(function(){
                var ctx = document.getElementById("canvas_month").getContext("2d");
                new Chart(ctx).Line(lineChartData_total, {
                    responsive: true,
                    animationEasing: "easeOutBounce"
                });
            })
        </script>
    <?php } ?>
<?php } ?>

