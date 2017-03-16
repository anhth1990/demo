@extends('Admin.Views.layouts.default')
@section('js')

@stop
@section('content')
<!-- BEGIN PAGE CONTAINER -->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{url('/'.trans('layout.local_admin').'/')}}">{{trans('layout.dashboard')}}</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{url('')}}">{{trans('layout.list_user')}}</a>
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
<div class="portlet box grey-cascade ">
	<div class="portlet-title">
		<div class="tools">
			<a href="" class="collapse">
			</a>
			<a href="" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body">
            <div>
                    <?php echo Form::model(Null, ['url' => ['/user'],'class'=>'form-horizontal','method'=>'get','id'=>'form_validate','role'=>'form'  ]);?>
                            <div class="input-icon  col-xs-9 col-sm-4" style="padding-left : 0px">
                                    <i class="fa fa-search" ></i>
                                    <input type="text" class="form-control" value="<?php echo isset($_GET['search_name'])?$_GET['search_name']:'';?>" id="search_name" name="search_name" placeholder="{{trans('user.form_seach_by_name')}}">
                            </div>
                            <button type="submit" class="btn grey-cascade">{{trans('user.form_seach')}}</button>
                            <a class="btn default" href="{{url('/report/account')}}">{{trans('user.form_remove_seach')}}</a>
                    </form>
            </div>            
            <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                    <tr>
                            <th>
                                    {{trans('user.acc_user')}}
                            </th>
                            <th>
                                    {{trans('user.acc_fullname')}}
                            </th>
                            <th>
                                    {{trans('user.acc_email')}}
                            </th>
                            <th>
                                    {{trans('user.acc_type_user')}}
                            </th>                            
                            <th>
                                    {{trans('user.acc_created')}}
                            </th>                            
							<th>
                                    {{trans('user.last_time_login')}}
                            </th>
                            <th>
                                    {{trans('user.acc_status')}}
                            </th>                                                                               
                            <th>
                                    {{trans('user.acc_action')}}
                            </th>                          
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($list_account) && count($list_account)>0){
                            foreach ($list_account as $key => $value) {
                                    ?>
                    <tr  class="position_<?php echo $value->id; ?>">
                            <td>
                                    <?php echo $value->username?>
                            </td>
                            <td>
                                    <?php echo $value->fullname?>
                            </td>
                            <td>
                                    <?php echo $value->email?>
                            </td>
                            <td>
                                    <?php if($value->role_id == 1) echo "Holder"; else echo "User"; ?>
                            </td>
                            <td>
                                    <?php echo $value->created_at?>
                            </td>                           
                            <td>
                                    <?php //echo date( 'Y-m-d H:m:i',$value->last_login)?>
                            </td>
                            <td>
                                <i id="approve_<?php echo $value->id; ?>" data-value="<?php echo $value->status; ?>" class="fa <?php if($value->status ==1)echo 'fa-check';else echo 'fa-minus-circle'; ?> cus-btn" title="Kiểm duyệt" onclick="changeAccept(<?php echo $value->status.",".$value->id; ?>)"></i>
                            </td>
                            <td>
                                    <a class="btn default btn-xs purple" href="<?php echo url('/edit-account/'.base64_encode($value->id).''); ?>"><i class="fa fa-edit"></i> {{trans('user.acc_changepass')}} </a>
									<a href="<?php echo url('/user-view-log/'.base64_encode($value->username).''); ?>" class="btn btn-xs grey-cascade">
										{{trans('user.view_log')}} <i class="fa fa-link"></i>
									</a>                                    
                            </td>
                         
                    </tr>
                    <tbody class="main-id-<?php echo $value->id;?>" style="display:none;"></tbody>
                    <?php }}?>	
                    </tbody>
                    </table>
            </div>
            <?php 				 
            //echo $fills_data->setPath('custom/url');
            if(isset($_GET['search_name'])) {
                    echo $list_account->appends(['search_name' => isset($_GET['search_name'])?$_GET['search_name']:'','search_cat'=>isset($_GET['search_cat'])?$_GET['search_cat']:''])->render();
            }
            else {
                    echo $list_account->render();
            }?>
	</div>
</div>
<script>
    	function changeAccept(status, id){
            link = "{{Asset('/account/update')}}";
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