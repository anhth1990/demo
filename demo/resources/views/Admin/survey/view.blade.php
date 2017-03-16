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
                                        <input type="text" class="form-control input-validate" id="title" name="title" value="{{$survey->title}}">
                                    </div>												
                                </div>	 
								<div class="form-group">
                                    <label class="control-label col-md-3">{{trans('contact.content')}} <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-9">
                                        <textarea class="inbox-editor inbox-wysihtml5 form-control input-validate" name="content" rows="8">{{$survey->content}}</textarea>	
                                    </div>												
                                </div>	
							</div>	
							<br><span class="caption-subject font-green-sharp bold uppercase">{{trans('survey.list_question')}}</span><br>
							<?php 
								$arr = json_decode($survey->data_survey);
								for($i=0;$i<count($arr);$i++){
							?>
                            <div class="form-body" id="">
								<div class="form-group">
                                    <label class="control-label col-md-3">Câu hỏi <span class="required" aria-required="true"> * </span></label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control input-validate" name="" value="{{$arr[$i]->title}}">
                                    </div>																
                                </div>	 		
								<div class="form-group">
                                    <label class="control-label col-md-3">Trả lời<span class="required" aria-required="true"> * </span></label>
									<div class="col-md-9">
										<?php 
											$data = get_object_vars($arr[$i]->answer);
											foreach($data as $value){
										?>
										<div class="row" id="">
											 <label class="col-md-1">
											 </label>
											 <div class="col-md-5">
												<input type="text" class="form-control input-validate"  name="" value="{{$value}}">
											 </div>									
										</div>	
										<?php } ?>	
                                    </div>											
                                </div>						
                            </div>
							<?php }?>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">								
                                        <a type="submit" href="{{Asset('/'.$admin_local.'/survey')}}" class="btn grey-cascade">{{trans('survey.back')}}</a>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   	
@stop