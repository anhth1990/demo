<?php
	use App\Http\Controllers\ContactController;
	$contact = new ContactController;
?>
@extends('Admin.Layouts.default')
@section('content')
<style>
.error{
	color:red;
}
</style>
  
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{Asset('/'.$admin_local)}}">{{trans('layout.dashboard')}}</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{Asset('/'.$admin_local.'/user')}}">{{trans('contact.list_contact')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('contact.list_contact')}}
</h3> 
<!--====================================================================================================================================-->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed">
            <div class="portlet box blue ">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="tools">
                        <a title="" data-original-title="" href="javascript:;" class="collapse">
                        </a>
                        <a title="" data-original-title="" href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a title="" data-original-title="" href="javascript:;" class="reload">
                        </a>
                        <a title="" data-original-title="" href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet light">
                    <div class="portlet-body">
                        @if (count($errors) > 0)
                        @include("Admin.Blocks.error")
                        @endif
						<form id="myform" action="" method="post" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
							<div class="form-body">
								<div class="form-group">
                                    <label class="control-label col-md-3">{{trans('contact.title')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control input-validate" id="title" name="title">
                                    </div>												
                                </div>	 
								<div class="form-group">
                                    <label class="control-label col-md-3">{{trans('contact.content')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-9">
                                        <textarea class="inbox-editor inbox-wysihtml5 form-control input-validate" name="content" rows="8"></textarea>	
                                    </div>												
                                </div>	
							</div>	
							<br><span class="caption-subject font-green-sharp bold uppercase">{{trans('survey.list_question')}}</span><br>
							<?php for($i=1;$i<2;$i++){
								$rand = rand(10000,999999); 
								?>
                            <div class="form-body" id="div_question_{{$rand}}">
								<div class="form-group">
                                    <label class="control-label col-md-3">Câu hỏi <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control input-validate" name="title_[{{$rand}}]">
                                    </div>	
									<div class="col-md-1"><a onclick="remove_question({{$rand}})"><i class="fa fa-trash-o" style="font-size: 25px;line-height: 33px;"></i></a></div>									
                                </div>	 		
								<div class="form-group">
                                    <label class="control-label col-md-3">Trả lời<span class="required" aria-required="true"> * </span></label>
									<div class="col-md-9">
										<?php for($j=1;$j<4;$j++){
											$rand2 = rand(10000,999999); 
											?>
										<div class="row" id="answer_{{$rand}}_{{$rand2}}">
											 <label class="col-md-1">
											 </label>
											 <div class="col-md-5 reload">
												<input type="text" class="form-control input-validate"  name="answer_{{$rand}}[{{$rand2}}]" value="" data-id="{{$rand}}">
											 </div>
											<div class="col-md-1"><a onclick="remove_answer({{$rand}},{{$rand2}})"><i class="fa fa-times-circle" style="font-size: 25px;line-height: 33px;"></i></a></div>
										</div>	
										<?php }?>
										<div class="row" id="div_answer_{{$rand}}">
											<label class="col-md-1">
											 </label>
											<div class="col-md-4">
												<a onclick="add_answer({{$rand}})"><i class="fa fa-plus-square-o" style="font-size: 25px;line-height: 33px;"></i></a>
												<hr>
											</div>
										</div>											
                                    </div>											
                                </div>						
                            </div>
							<?php }?>
							<div class="row" id="div_question">
								<label class="col-md-3">
								 </label>
								<div class="col-md-6">
									<hr>
									<a onclick="add_question()"><i class="fa fa-plus-square-o" style="font-size: 25px;line-height: 33px;"></i></a>							
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
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   	
 <script src="{{Asset('public/adpc/plugins/jquery.min.js')}}"></script>
 <script src="{{Asset('public/adpc/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
<script>
	$(document).ready(function () {

    $('#myform').validate({
        submitHandler: function (form) { // for demo
            $('#myform').submit();
        }
    });

    $('.input-validate').each(function() {
        $(this).rules('add', {
            required: true,
            minlength: 5,
            maxlength: 500,
            messages: {
                required: "Required input",
                minlength: "Must be at least {0} characters",
                maxlength: "Must be less than {0} characters"
            }
        });
    });

});
</script>
<script>
		var rowNum = 0;
		function add_answer(i){
			
			var num_id = $("input[data-id*='"+i+"']").length;
			var rowNum = $("input[data-id*='"+i+"']").length;
			alert(rowNum);	
			if(num_id > 5){
				alert("<?php echo trans('survey.alert_max_answer')?>");
				return false;
			}
			else{
				rowNum++;
				link = "<?php echo Asset($admin_local.'/survey/load-form-answer');?>";
				jQuery.ajax({
					url : link,
					data : "id="+i,
					type : "get",
					success:function(data){
						$("#div_answer_"+i).before(data);
						load_js();					
					}
				});	
			}	
		}
		function remove_answer(i,j){
			rowNum--;
			$("#answer_"+i+"_"+j).empty();
		}
		function add_question(){
			id = 1;
			link = "<?php echo Asset($admin_local.'/survey/load-form');?>";
			jQuery.ajax({
				url : link,
				data : "id="+id,
				type : "get",
				success:function(data){
					$("#div_question").before(data);	
					load_js();	
				}
			});
		}
		function remove_question(i){
			$("#div_question_"+i).empty();
		}
		function load_js(){
			$('.input-validate').each(function() {
				$(this).rules('add', {
					required: true,
					minlength: 5,
					maxlength: 500,
					messages: {
						required: "Required input",
						minlength: "Must be at least {0} characters",
						maxlength: "Must be less than {0} characters"
					}
				});
			});
		}

</script>	
@stop