<?php
require_once 'includes/config.php';
require_once 'includes/header.php';
?>
<div class="container-fluid">
<div class="row">
<div class="col-md-4 text-center pt-4 mx-auto">
<div class="card bg-inverse">
<div class="card-block">
<h4 class="card-title display-4 text-white">Qlogin!</h4>
<form action="includes/authenticate.php" method="POST">
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" name="username" id="username" placeholder="Username">
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" name="password" id="password" placeholder="Password">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
</div>
</div>
</div>
<?php
require_once 'includes/footer.php';
?>