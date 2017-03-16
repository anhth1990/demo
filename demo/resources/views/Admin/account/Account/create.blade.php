@extends('Admin.Views.layouts.default')
@section('content')



<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{url('/dashboard')}}">{{trans('default.dashboard')}}</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="{{url('/user')}}">{{trans('default.list-user')}}</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="">{{trans('default.create-user')}}</a>
		</li>
	</ul>
</div>

<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet box grey-cascade ">
	<div class="portlet-title">
		<!--div class="caption">
			<i class="fa fa-gift"></i> {{trans('menu.form_create')}}
		</div-->
		<div class="tools">
			<a href="" class="collapse">
			</a>
			<a href="" class="remove">
			</a>
		</div>
	</div>
	<div class="portlet-body form">
		<?php echo Form::model($account, ['url' => null,'class'=>'form-horizontal','method'=>'post','id'=>'form_validate','role'=>'form'  ]);?>
			<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
			<div class="form-body">
				<div class="form-group" id="">
					<label class="col-md-3 control-label">{{trans('user.acc_type_user')}}</label>
					<div class="col-md-9 icheck-inline">
						<?php 
							echo Form::radio('type', 'user', false)." ".trans('user.acc_type_user');
							echo Form::radio('type', 'holder', true) ." ".trans('user.acc_type_holder');                                              
						?>
					</div>
				</div>
			        
				<div class="form-group" id="form_username">
					<label class="col-md-3 control-label">{{trans('user.acc_user')}}</label>
					<div class="col-md-9">
						<?php echo Form::text('username',null, ['class' => 'form-control','id'=>'username','onblur'=>'checkUser()','placeholder'=>trans('user.acc_user_pleca')]);?>
						<span class="help-block" id="err_username" style="display:none">Please correct the error </span>
						<span class="help-block" id="err_username_2" style="display:none">{{trans('user.acc_user_dupl')}} </span>
					</div>
				</div>				        
				<div class="form-group" id="form_fullname">
					<label class="col-md-3 control-label">{{trans('user.acc_fullname')}}</label>
					<div class="col-md-9">
						<?php echo Form::text('fullname',null, ['class' => 'form-control','id'=>'fullname','placeholder'=>trans('user.acc_fullname_pleca')]);?>
						<span class="help-block" id="err_fullname" style="display:none">Please correct the error </span>
					</div>
				</div>				        
				<div class="form-group" id="form_email">
					<label class="col-md-3 control-label">{{trans('user.acc_email')}}</label>
					<div class="col-md-9">
						<?php echo Form::text('email',null, ['class' => 'form-control','id'=>'email','onblur'=>'checkEmail()','placeholder'=>trans('user.acc_email_pleca')]);?>
						<span class="help-block" id="err_email" style="display:none">Please correct the error </span>
						<span class="help-block" id="err_email_2" style="display:none">{{trans('user.acc_email_dupl')}}</span>
					</div>
				</div>				        
				<div class="form-group" id="form_password">
					<label class="col-md-3 control-label">{{trans('user.acc_pass')}}</label>
					<div class="col-md-9">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="{{trans('user.acc_pass_pleca')}}">
						<span class="help-block" id="err_password" style="display:none">Please correct the error </span>
					</div>
				</div>								
			</div>							
			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-3 col-md-9">
						<a onclick="submitForm()" class="btn grey-cascade">{{trans('user.ok')}}</a>
						<a href="{{url('')}}" class="btn default">{{trans('user.cancel')}}</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
        function checkUser(){
            var username = $('#username').val();
            var link = "{{Asset('account/checkUser')}}";
                jQuery.ajax({
                    url : link,
                    data : "username="+username,
                    type : "get",
                    success:function(data){
                        if(data == 1){//trùng
                            $("#err_username_2").slideDown('slow').delay(3000).slideUp('slow');
                            $("#username").focus();
                        }
                    }
                });
        }
        function checkEmail(){
            var email = $('#email').val();
            var link = "{{Asset('account/checkEmail')}}";
                jQuery.ajax({
                    url : link,
                    data : "email="+email,
                    type : "get",
                    success:function(data){
                        if(data == 1){//trùng
                            $("#err_email_2").slideDown('slow').delay(3000).slideUp('slow');
                            $("#email").focus();
                        }
                    }
                });
        }
	function submitForm(){
		var username = $('#username').val();
		var fullname = $('#fullname').val();
		var email = $('#email').val();
		var password = $('#password').val();
                var email_regex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
                var check_alert = true;
                
		var check_form = true;
		if(username == ""){
			$("#err_username").slideDown('slow').delay(3000).slideUp('slow');
			$("#form_username").addClass('form-group has-error');
			$("#username").focus();
			check_form = false;
		}		
		if(fullname == ""){
			$("#err_fullname").slideDown('slow').delay(3000).slideUp('slow');
			$("#form_fullname").addClass('form-group has-error');
			$("#fullname").focus();
			check_form = false;
		}		
		if(!email_regex.test(email) || email == ""){
			$("#err_email").slideDown('slow').delay(3000).slideUp('slow');
			$("#form_email").addClass('form-group has-error');
			$("#email").focus();
			check_form = false;
		}		
		if(password == ""){
			$("#err_password").slideDown('slow').delay(3000).slideUp('slow');
			$("#form_password").addClass('form-group has-error');
			$("#password").focus();
			check_form = false;
		}		
                setInterval(function () {
                    if(check_alert == true){
                        $("#form_username").removeClass('has-error');
                        $("#form_fullname").removeClass('has-error');
                        $("#form_email").removeClass('has-error');
                        $("#form_password").removeClass('has-error');                       
                    }
                    check_alert = false;
                }, 2500);
		if(check_form == true){
			$("#form_validate").submit();;
		}
		
	}
</script>
<!-- END SAMPLE FORM PORTLET-->
<!-- END PAGE CONTAINER -->
@stop