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
            <a href="{{Asset('/'.$admin_local.'/survey')}}">{{trans('survey.list_survey')}}</a>
			<i class="fa fa-angle-right"></i>
        </li>        
		<li>
            <a href="">{{trans('survey.user_notifi')}}</a>
        </li>
    </ul>
</div>
<h3 class="page-title">
    {{trans('survey.user_notifi')}}
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
                                    <label class="control-label col-md-2">{{trans('contact.title')}} </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control input-validate" id="title" name="title" value="{{$survey['title']}}">
                                    </div>												
                                </div>	 
								<div class="form-group">
                                    <label class="control-label col-md-2">{{trans('contact.content')}} </label>
                                    <div class="col-md-10">
                                        <textarea class="inbox-editor inbox-wysihtml5 form-control input-validate" name="content" rows="8">{{$survey['content']}}</textarea>	
                                    </div>												
                                </div>	
							</div>	
							<div class="form-group">
								<label class="control-label col-md-2">Khách hàng </label>
								<div class="col-md-10">
									<?php echo Form::select('opt_name', $arr_name, $selected_id, ['class' => 'form-control select2me', 'id' => 'opt_name','onchange' => 'choseUser(this);']); ?>
								</div>								
							</div>
							<br><span class="caption-subject font-green-sharp bold uppercase">{{trans('survey.list_question')}}</span><br>
							<div id="user_answer" style="text-align: center;">
								<?php if($view == null){ ?>
							<?php foreach(json_decode($survey['data_survey']) as $key=>$survey){$key++;
								$survey = get_object_vars($survey);
								?>
                            <div class="form-body" >						
								<div class="form-group">
                                    <label class="control-label col-md-2">Câu hỏi <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control input-validate" value="{{$survey['title']}}">
                                    </div>							
                                </div>	 		
								<div class="form-group">
                                    <label class="control-label col-md-2">Trả lời<span class="required" aria-required="true"> * </span></label>
									<div class="col-md-8">
										<?php foreach($survey['answer'] as $key_a=>$answer){
											?>
										<div class="row">
											 <label class="col-md-1">
											 </label>
											 <div class="col-md-5">
												<input type="text" class="form-control input-validate"  value="{{$answer}}">
											 </div>		
											 <label class="col-md-6" >
												<?php											
												if($arr_survey[$key][$key_a] >0 && array_sum($arr_survey[$key]) > 0){?>
												<div style="background: #45b6af;min-height: 10px;width: <?php echo (($arr_survey[$key][$key_a]/array_sum($arr_survey[$key]))*100);?>%;max-height: 30px;height: 30px;line-height: 30px;background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-size: 40px 40px;"><?php echo (($arr_survey[$key][$key_a]/array_sum($arr_survey[$key]))*100);?>%</div>
												<?php }?>
											</label>	
										</div>	
										<?php }?>										
                                    </div>											
                                </div>						
                            </div>
							<?php }
							} else echo $view;?>
                            </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   	
<script>
	function choseUser(sel){
		$("#user_answer").empty();
		$("#user_answer").html("<img src='<?php echo Asset('public/adpc/img/loading-spinner-blue.gif');?>'>");	
		var id = sel.value;
            link = "<?php echo Asset($admin_local.'/nguoi-dung-tra-loi-khao-sat/load-form');?>";
            jQuery.ajax({
                url : link,
                data : "id="+id+"&code=<?php echo $hashcode?>&_token=<?php echo csrf_token();?>",
                type : "post",
                success:function(data){
                   $("#user_answer").empty();
                   $("#user_answer").html(data);
                }
            });
    }
</script>
@stop