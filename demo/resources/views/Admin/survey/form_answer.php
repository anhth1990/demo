<?php 	
	$j =  rand(10000,999999); 
?>
<div class="row" id="answer_<?php echo $i."_".$j;?>">
	 <label class="col-md-1">
	 </label>
	 <div class="col-md-5">
		<input type="text" class="form-control input-validate"  name="answer_<?php echo $i?>[]" value="">
	 </div>
	<div class="col-md-1"><a onclick="remove_answer(<?php echo $i?>,<?php echo $j?>)"><i class="fa fa-times-circle" style="font-size: 25px;line-height: 33px;"></i></a></div>
</div>