@extends('Admin.Views.layouts.default')
@section('js')

@stop
@section('content')
<!-- BEGIN PAGE CONTAINER -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{url('/')}}">{{trans('user.home')}}</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{url('/user')}}">{{trans('user.acc_list_user')}}</a>
                        <i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="">{{trans('user.history')}}</a>
		</li>
	</ul>
</div>
<?php
    if(isset($_GET['mess']) && $_GET['mess']=="success"){
?>
<div class="alert alert-success">
    <strong>{{trans('user.form_success')}}</strong>
</div>
<?php } if(isset($_GET['mess']) && $_GET['mess']=="error"){?>
<div class="alert alert-danger">
    <strong>{{trans('user.form_error')}}</strong> 
</div>
<?php } ?>
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet box blue-madison ">
	<div class="portlet-title">
                <div class="caption">
			<i class="fa fa-gift"></i> {{trans('user.acc_user').": ".$username}}
		</div>
		<div class="tools">                       
			<a href="" class="collapse">
			</a>
			<a href="" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body">
            <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                            <th>
                                    #
                            </th>
                            <th>
                                    {{trans('user.time_login')}}
                            </th>
                            <th>
                                    {{trans('user.ip')}}
                            </th>                              
                            <th>
                                    {{trans('user.browser')}}
                            </th>                              
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($data) && count($data)>0){
                            foreach ($data as $key => $value) {$key++;
                                    ?>
                    <tr  class="position_<?php echo $value->id; ?>">
                            <td>
                                    <?php echo $key?>
                            </td>
                            <td>
                                    <?php echo date('H:i:s d-m-Y',$value->time_log)?>
                            </td>
                            <td>
                                    <?php echo $value->ip?>
                            </td>
                            <td>
                                    <?php echo $value->browser?>
                            </td>                           			                     
                    </tr>
                    <tbody class="main-id-<?php echo $value->id;?>" style="display:none;"></tbody>
                    <?php }}?>	
                    </tbody>
                    </table>
            </div>
            <?php 				 
            if(isset($_GET['search_name'])) {
                    echo $data->appends(['search_name' => isset($_GET['search_name'])?$_GET['search_name']:'','search_cat'=>isset($_GET['search_cat'])?$_GET['search_cat']:''])->render();
            }
            else {
                    echo $data->render();
            }?>
	</div>
</div>
<script>
    	function changeAccept(status, id){
            link = "{{Asset('/report/account/update')}}";
            jQuery.ajax({
              url : link,
              data : "id="+id+"&status="+status,
              type : "get",
              success:function(data){
                if(data == "error"){
                    alert("<?php echo trans('user.form_error');?>");
                }else{
                    if(status == 1) new_active  = 0;
                    else new_active  = 1;
                    if(status == 0){
                            $('#approve_'+id).removeClass();
                            $('#approve_'+id).attr("onclick","changeAccept("+new_active+","+id+")");
                            $('#approve_'+id).addClass('fa fa-check cus-btn');
                    }
                    else {
                            $('#approve_'+id).removeClass();
                            $('#approve_'+id).attr("onclick","changeAccept("+new_active+","+id+")");
                            $('#approve_'+id).addClass('fa fa-minus-circle cus-btn');
                    }                  
                }
              }
            });
	}
</script>
<script src="{{Asset('/public/admin/js/components-dropdowns.js')}}" type="text/javascript"></script>
<!-- END SAMPLE FORM PORTLET-->
<!-- END PAGE CONTAINER -->
@stop