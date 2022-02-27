<?php
session_start();
require_once 'includes/config.php';
require_once 'includes/Database.php';
if(!isset($_SESSION['qadmin']) && $_SESSION['qadmin'] !== "qappctrl"){
	$redir = $BASE_URL . 'index.php?err=3';
	header('Location:'.$redir);
	exit();
}
else{
	require_once 'includes/header.php';
?>
<div class="container-fluid">
<div class="row">
<div class="col-md-4 text-center pt-4 mx-auto">
<div class="card bg-inverse">
<div class="card-block">
<h4 class="card-title display-4 text-white">Qadd a Quote!</h4>
<form action="includes/quote.php" method="POST">
<div class="form-group">
<label for="quote">Quote!</label>
<textarea class="form-control" name="quote" id="quote" rows="3"></textarea>
</div>
<div class="form-group">
<label for="author">Who quoted?</label>
<input type="text" class="form-control" name="author" id="author" placeholder="Author of quote">
</div>
<button type="submit" class="btn btn-primary">Add Quote!</button>
</div>
</div>
</form>
</div>
</div>
<!-- Sign Off! -->
<div class="row">
<div class="col-md-4 text-center mx-auto pt-4">
<form action="includes/terminus.php">
<button type="submit" class="btn btn-primary"><i class="fa fa-power-off pr-2"></i>Sign off!</button>
</form>
</div>
</div>
</div>
<?php
	require_once 'includes/footer.php';
}
?>