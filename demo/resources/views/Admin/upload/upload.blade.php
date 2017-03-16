
<script type="text/javascript" src="{{Asset('/public/scan/js_upload/js/jquery-1.10.2.min.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/scan/js_upload/js/jquery.html.form.js')}}"></script>
<script type="text/javascript" src="{{Asset('/public/scan/js_upload/js/jquery.form.min.js')}}"></script>
<script>

function closeWin() {
	var result = $('#output').text();
	javascript:window.opener.document.getElementById('file_csv').value = result;
	var url = '<?php echo Asset('adpc/upload');?>';
	window.close(url);
}
</script>
<link href="{{Asset('/public/scan/js_upload/style/style.css')}}" rel="stylesheet" type="text/css">
<div id="upload-wrapper">
	<div align="center">
		<form action="{{Asset('adpc/upload')}}" method="post" enctype="multipart/form-data" id="MyUploadForm">
			<input type="hidden" name="_token" value="<?php echo csrf_token();?>">
			<input name="FileInput" id="FileInput" type="file" />
			<input type="submit"  id="submit_btn" value="Upload" />
			<img src="{{Asset('/public/scan/img/loading-spinner-blue.gif')}}" id="loading-img" style="display:none;" alt="Please Wait"/>
		</form>
		<div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
                <div id="output" style="display: none;"></div>
		<br>
		<input type="hidden" id="url_images" value="">
		<button onclick="closeWin()" id="add_images" style="display:none;">Add Email</button>
	</div>
</div>
