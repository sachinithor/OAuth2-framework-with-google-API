<?php 
    include_once("header.php");
?>

<!-- Signup Form -->
<form method="post" action="upload.php" enctype="multipart/form-data">
    <input type="file" class="form-control-file" name="uploadfile">
	<input type="submit" value="UPLOAD" />
</form>

<?php
    include_once("footer.php");
?>
