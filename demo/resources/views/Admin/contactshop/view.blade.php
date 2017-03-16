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

                        <form action="{{Asset('/'.$admin_local.'/tao-moi-thong-bao')}}" method="post" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">{{trans('contact.title')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $notice->title?>">
                                    </div>												
                                </div>	                                
								<div class="form-group">
                                    <label class="control-label col-md-3">{{trans('contact.content')}}<span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-9">
										<textarea class="inbox-editor inbox-wysihtml5 form-control"  id="content" name="content"  rows="8"><?php echo $notice->content?></textarea>	
                                    </div>												
                                </div>	
								<div class="form-group">
									<div class="col-md-3">
									</div>
									<label class="control-label col-md-4" style="text-align: left;">
										<?php echo trans('contact.count_sended').' '.$report['sended'].' '.trans('contact.user_sended'); ?>
									</label>
                                </div>	
								<div class="form-group">
									<div class="col-md-3">
									</div>
									<label class="control-label col-md-4" style="text-align: left;">
										<?php echo trans('contact.user_readed').' '.$report['readed'].' '.trans('contact.user_sended').' '.trans('contact.readed')?>
									</label>
                                </div>	
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <a href="{{Asset('/'.$admin_local.'/thong-bao-da-tao')}}" class="btn grey-cascade"><i class="fa fa-check"></i> Back</a>
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