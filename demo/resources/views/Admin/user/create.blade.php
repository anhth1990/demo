@extends('Admin.Layouts.default')
@section('content')
  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('user.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('user.list_user')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/ban-hang/them-moi')}}">{{trans('user.create_user')}}</a>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                Actions <i class="fa fa-angle-down"></i>
            </button>
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                    <a href="#">Action</a>
                </li>
                <li>
                    <a href="#">Another action</a>
                </li>
                <li>
                    <a href="#">Something else here</a>
                </li>
                <li class="divider">
                </li>
                <li>
                    <a href="#">Separated link</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<h3 class="page-title">
    {{trans('user.user')}} <small>{{trans('user.create_user')}}</small>
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus-square"></i>{{trans('user.create_user')}}
                    </div>
                </div>

                <div class="portlet light">
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif

                        <form action="{{Asset('/'.$admin_local.'/ban-hang/them-moi')}}" method="post" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('user.search_mobile')}}</label>
                                    <div class="col-md-2">
                                        <?php echo Form::select('mobile_search', $arr_mobile, null, ['class' => 'form-control select2me', 'id' => 'mobile_search','onchange' => 'choseType(this);']); ?>
                                    </div>	
                                    <label class="control-label col-md-2">{{trans('user.fullname')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-2">
                                        <input type="text" value="{!! old('fullname') !!}" class="form-control" id="fullname" name="fullname">
                                    </div>
                                    <label class="control-label col-md-2">{{trans('user.email')}}</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="email" name="email" value="{!! old('email') !!}">
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('user.mobile')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{!! old('mobile') !!}" onblur="getInfoUser()">
                                    </div>	
                                    <label class="control-label col-md-2">{{trans('user.birthday')}}</label>
                                    <div class="col-md-2">
                                        <!--input type="text" class="form-control" id="age" name="age" value="{!! old('age') !!}"-->
										<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" >
                                            <input type="text" class="form-control" readonly id="age" name="age" value="{!! old('age') !!}">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>												
                                    <label class="control-label col-md-2">{{trans('user.address')}}</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="address" name="address" value="{!! old('address') !!}">
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('user.type_point')}}</label>
                                    <div class="col-md-2">
                                        <?php echo Form::select('scoring', $arr_point, null, ['class' => 'form-control select2me', 'id' => 'scoring']); ?>
                                    </div>	
                                    <?php if ($text_sl != '') { ?>
                                        <label class="control-label col-md-2"><?php echo $text_sl; ?></label>
                                        <div class="col-md-2">
                                            <input type="text" value="1" class="form-control" id="count_product" name="count_product" value="{!! old('count_product') !!}">
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('user.price')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="price_f" name="price_f" value="{!! old('price_f') !!}" onblur="getPrice()">
                                    </div>
                                    <label class="control-label col-md-2">{{trans('user.pay')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="price" name="price" value="{!! old('price') !!}">
                                    </div>
                                    <label class="control-label col-md-2">{{trans('user.profit')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="profit" name="profit" value="{!! old('profit') !!}">
                                    </div>
                                </div>	
                                <div class="form-group">
                                    <label class="control-label col-md-2">{{trans('user.code')}}</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="promotion" name="promotion" value="{!! old('promotion') !!}">
                                    </div> 
                                    <div class="col-md-1">
                                        <a onclick="getPromotion()" class="btn default">
                                            {{trans('user.apply')}} <i class="fa fa-plus"></i>
                                        </a>
                                    </div> 
                                    <div class="col-md-1">
                                        <a onclick="removePromotion()" class="btn default">
                                            {{trans('user.remove')}} <i class="fa fa-times"></i>
                                        </a>
                                    </div> 
                                    <div class="col-md-2">
                                    </div>
                                    <label class="control-label col-md-2">{{trans('user.price_code')}}</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="price_code" name="price_code" readonly="true" value="0">
                                    </div>
                                    <input name="_isPromotion" id="_isPromotion" type="hidden" value="0">
                                </div>
                                <div class="form-group">   
                                    <label class="control-label col-md-2">{{trans('user.address_shop')}}</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" id="address_shop" name="address_shop" value="{!! old('address_shop') !!}">
                                    </div> 
                                    <label class="control-label col-md-2">{{trans('user.date_buys')}} </label>
                                    <div class="col-md-2">
                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" >
                                            <input type="text" class="form-control" readonly id="date_buy" name="date_buy" value="{!! old('date_buy') !!}">
                                            <span class="input-group-btn">
                                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn grey-cascade"><i class="fa fa-check"></i> Ok</button>
                                        <button type="reset" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   
<script>
	function getInfoUser(){
		var mobile = $('#mobile').val();
		link = "<?php echo Asset($admin_local.'/get-info-user');?>";
            jQuery.ajax({
                url : link,
                data : "mobile="+mobile+"&_token=<?php echo csrf_token();?>",
                type : "post",
                success:function(data){
                    var parsed = JSON.parse(data);
                    var arr = [];
                    for(var x in parsed){
                      arr.push(parsed[x]);
                    }
                    //.prop('disabled', true);
                    $("#mobile").val(mobile);        
                    $("#fullname").val(arr[1]);        
                    $("#email").val(arr[0]);        
                    $("#age").val(arr[2]);        
                    $("#address").val(arr[3]);        
                }
            });
	}
    function getPrice(){
        var price_f = $('#price_f').val();
        var price_code = $('#price_code').val();
        var new_price = price_f;
        if (price_code != 0){
            new_price = price_f - price_code;
        }
        $("#price").val(new_price);
    }
    function getPromotion(){
        var promotion = $('#promotion').val();
        var price_f = $('#price_f').val();
        link = "<?php echo Asset($admin_local.'/check-code');?>";
        jQuery.ajax({
            url : link,
            data : "_token=<?php echo csrf_token();?>&promotion="+promotion,
            type : "post",
            success:function(data){
               if(data == 'fails'){
                   alert('<?php echo trans('user.code_error');?>');
               }else{
                   $("#price_code").val(data);
                   var new_price = price_f - data;
                   $("#price").val(new_price);
                   $("#_isPromotion").val('1');
               }
            }
        });
    }
    function removePromotion(){
        var price_f = $('#price_f').val();
        $("#price").val(price_f);
        $("#_isPromotion").val('0');
        $("#price_code").val('');
        $("#promotion").val('');
    }
    function choseType(sel) {
        var mobile = sel.value;
        if(mobile == '0'){
            $("#mobile").val('');
            $("#fullname").val('');
            $("#email").val('');
            $("#age").val('');
            $("#address").val('');
        }else {
            link = "<?php echo Asset($admin_local.'/get-info-user');?>";
            jQuery.ajax({
                url : link,
                data : "mobile="+mobile+"&_token=<?php echo csrf_token();?>",
                type : "post",
                success:function(data){
                    var parsed = JSON.parse(data);
                    var arr = [];
                    for(var x in parsed){
                      arr.push(parsed[x]);
                    }
                    //.prop('disabled', true);
                    $("#mobile").val(mobile);        
                    $("#fullname").val(arr[1]);        
                    $("#email").val(arr[0]);        
                    $("#age").val(arr[2]);        
                    $("#address").val(arr[3]);        
                }
            });
        }
    }
</script>
@stop