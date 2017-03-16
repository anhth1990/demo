<?php foreach(json_decode($survey['data_survey']) as $key=>$survey){$key++;
	$survey = get_object_vars($survey);
	?>
<div class="form-body" >						
	<div class="form-group">
		<label class="control-label col-md-2">Câu hỏi <span class="required" aria-required="true"> * </span></label>
		<div class="col-md-10">
			<input type="text" class="form-control input-validate" value="<?php echo $survey['title'];?>">
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
					<input type="text" class="form-control input-validate"  value="<?php echo $answer;?>">
				 </div>		
				 <label class="col-md-6" >
					<div style="background: #45b6af;min-height: 10px;width: <?php echo (($arr_survey[$key][$key_a]/array_sum($arr_survey[$key]))*100);?>%;max-height: 30px;height: 30px;line-height: 30px;background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-size: 40px 40px;"><?php echo (($arr_survey[$key][$key_a]/array_sum($arr_survey[$key]))*100);?>%</div>
					
				</label>	
			</div>	
			<?php }?>										
		</div>											
	</div>						
</div>
<?php }?>