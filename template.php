<?php
include_once 'user.php';

function wrap_full_template($content) {

if(user_is_authenticated()) {
  $login_logout_link = '<li class="li_Nav"><a href="Logout.php">Logout</a></li>';
  $login_modal = '';

} else {
  $login_logout_link = '<li class="li_Nav" data-toggle="modal" data-target="#myModal"><a href="#">Login</a></li>';

  if(isset($_GET['login']) && strtolower($_GET['login']) == 'true') {
    $pop_login = <<<EOPOP
    <script type="text/javascript">
        $(window).load(function(){
            $('#myModal').modal('show');
        });
    </script>
EOPOP;
  } else {
    $pop_login = '';
  }

  $login_modal = <<<EOMODAL
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Please Log in or Register Below...</h4>
      </div>
      <div class="modal-body">
        <div id="div_login">
          <form class="login" id="login_form" autocomplete="off">
            <p>
              <label for="user">Username:</label>
              <input type="text" name="user" id="user" value="">
            </p>

            <p>
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" value="">
            </p>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="register" class="btn btn-primary">Register</button>
        <button type="button" id="login_user" class="btn btn-primary">Login</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
{$pop_login}
EOMODAL;

}

$pageContents = <<< EOPAGE
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coder's Haven</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main-custom.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/main-custom.js"></script>
</head>

<body>
	<div id="head">
		<span id="header">Coder's Haven</span>
		<span id="slogan">Catchy Slogan will live here</span>
		<div id="head_nav">
			<ul id="nav">
				<li class="li_Nav"><a href="#">Home</a></li>
				<li class="li_Nav"><a href="#">About</a></li>
				<li class="li_Nav"><a href="#">Contact</a></li>
				<li class="li_Nav"><a href="#">Browse</a></li>
        {$login_logout_link}
			</ul>
		</div>
	</div>

	<div id="content">
  {$content}
	</div>

	<footer class="footer">
		<div class="container">
			<p class="text-muted">Product of Steel City Codefest 2015.</p>
		</div>
	</footer>

  {$login_modal}
</body>
</html>
EOPAGE;

return $pageContents;
}
?>
