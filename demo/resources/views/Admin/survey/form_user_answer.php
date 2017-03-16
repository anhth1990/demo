<?php
	$user_survey = get_object_vars($user_survey);
	foreach($data_survey as $key=>$survey){$key++;
		$survey = get_object_vars($survey);
		$user_rep = get_object_vars($user_survey[$key]);
	?>
<div class="form-body" >						
	<div class="form-group">
		<label class="control-label col-md-3">Câu hỏi </label>
		<div class="col-md-6">
			<input type="text" class="form-control input-validate" value="<?php echo $survey['title']?>">
		</div>							
	</div>	 		
	<div class="form-group">
		<label class="control-label col-md-3">Trả lời</label>
		<div class="col-md-9">
			<?php foreach($survey['answer'] as $key_a=>$answer){
				?>
			<div class="row">
				 <label class="col-md-1">
				 </label>
				 <?php
					if($user_rep[$key_a] == 1){
				?>
				 <div class="col-md-5 input-icon right">		
					<input class="form-control" type="text" value="<?php echo $answer?>" style="background: #0027ff80;">
				 </div>
				<div class="col-md-1"><a><i class="fa fa-check" style="font-size: 25px;line-height: 33px;"></i></a></div>
				<?php } else {?>
				<div class="col-md-5 input-icon right">		
					<input class="form-control" type="text" value="<?php echo $answer?>" readonly="true">
				 </div>
				<?php }?>				
			</div>	
			<?php }?>										
		</div>											
	</div>						
</div>
<?php }?>
<div class="form-body" >						
	<div class="form-group">
		<label class="control-label col-md-3">Feedback</label>
		<div class="col-md-6" style='text-align: left;'>
			<textarea class="inbox-editor inbox-wysihtml5 form-control input-validate" name="content" rows="8"><?php echo $feedback?></textarea>
		</div>							
	</div>	
</div>	