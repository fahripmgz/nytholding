<?php
require("../../config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Images Upload Ajax</title>
<link rel="stylesheet" href="<?php echo $base_url."css2/css/style.default.css"; ?>" type="text/css" />
<script src="<?php echo $base_url."js/jquery-1.9.1.js"; ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $base_url."js/jquery.form.js"; ?>"></script>
<script type="text/javascript" >
 $(document).ready(function() { 
            $('#photoimg').change(function(){ 
				$("#preview").html('');
				$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
	});
}); 
</script>
</head>
<body>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaxupload.php'>
<span id="pimg">Pilih Browse untuk cari photo
<input type="file" id="photoimg" name="photoimg" class="btn btn-medium btn-primary"  /></span>
</form>
<div id='preview' align="center" >
</div>
</body>
</html>
