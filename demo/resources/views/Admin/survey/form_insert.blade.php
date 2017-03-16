<?php
	$i =  rand(10000,999999); 
?>
<div class="form-body" id="div_question_{{$i}}">
	<div class="form-group">
		<label class="control-label col-md-3">Câu hỏi<span class="required" aria-required="true"> * </span></label>
		<div class="col-md-6">
			<input type="text" class="form-control input-validate" name="title_[{{$i}}]">
		</div>	
		<div class="col-md-1"><a onclick="remove_question({{$i}})"><i class="fa fa-trash-o" style="font-size: 25px;line-height: 33px;"></i></a></div>									
	</div>	 		
	<div class="form-group">
		<label class="control-label col-md-3">Trả lời<span class="required" aria-required="true"> * </span></label>
		<div class="col-md-9">
			<?php for($j=1;$j<4;$j++){ $rand2 = rand(10000,999999); ?>
			<div class="row" id="answer_{{$i}}_{{$rand2}}">
				 <label class="col-md-1">
				 </label>
				 <div class="col-md-5">
					<input type="text" class="form-control input-validate"  name="answer_{{$i}}[{{$rand2}}]" value="">
				 </div>
				<div class="col-md-1"><a onclick="remove_answer({{$i}},{{$rand2}})"><i class="fa fa-times-circle" style="font-size: 25px;line-height: 33px;"></i></a></div>
			</div>	
			<?php }?>
			<div class="row" id="div_answer_{{$i}}">
				<label class="col-md-1">
				 </label>
				<div class="col-md-4">
					<a onclick="add_answer({{$i}})"><i class="fa fa-plus-square-o"></i></a>
					<hr>
				</div>
			</div>											
		</div>											
	</div>						
</div>
