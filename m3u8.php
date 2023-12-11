<?php
session_start();
/* DECLARE VARIABLES */
$username = 'admin';
$password = 'admin';
$random1 = 'secret_key1';
$random2 = 'secret_key2';
$hash = md5($random1 . $password . $random2);
$self = $_SERVER['REQUEST_URI'];
/* USER LOGOUT */
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
}
/* USER IS LOGGED IN */
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash)
{
	logged_in_msg($username);
}
/* FORM HAS BEEN SUBMITTED */
else if (isset($_POST['submit']))
{
	if ($_POST['username'] == $username && $_POST['password'] == $password)
	{
		//IF USERNAME AND PASSWORD ARE CORRECT SET THE LOGIN SESSION
		$_SESSION["login"] = $hash;
		header("Location: $_SERVER[PHP_SELF]");
	}
	else
	{
		// DISPLAY FORM WITH ERROR
		display_login_form();
		display_error_msg();
	}
}
/* SHOW THE LOGIN FORM */
else
{
	display_login_form();
}
/* TEMPLATES */
function display_login_form()
{
?>
 <!DOCTYPE html>
	<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Panel</title>
	<link rel="stylesheet" href="https://cdn.rawgit.com/ufilestorage/b/master/bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdn.rawgit.com/ufilestorage/b/master/bootstrap/css/main.css" type="text/css"/>
        </head>
		<body>
			<div class="trail">
				<canvas id="world"></canvas>
			</div>
	<div class="container" style="opacity:1;">
			<div class="row col-md-offset-2 col-md-8 login-error">
			<div class="alert alert-danger" role="alert">
				<strong>
					<font size="3">The following errors were found</font>	
				</strong>
				<font color="black" size="3">
					<ul type="square">
					</ul>
				</font>
			</div>
		</div>
		
	  	<div class="row-fluid">
	  		<div class="col-sm-offset-2 col-md-offset-4 col-sm-8 col-md-4 col-xs-12 login-form">
	  			<div class="row-fluid">
	  				<div class="col-sm-12 logo-login-form">
	  				<h2 style="text-align:center">Embed</h2>
	  				</div>
	  			</div>
	  			<div class="row-fluid">
	  				<div class="col-sm-12">
	<?php echo '<form action="' . isset($self) . '" method="post">' .
			 '<label for="username">username:</label>' .
			 '<input type="text" name="username" id="username">' .
			 '<label for="password">password:</label>' .
			 '<input type="password" name="password" id="password">' .
			 '<input type="submit" name="submit" value="login" class="btn btn-default primary sub">' .
		 '</form>';
}
function logged_in_msg($username)
{
?>
  </div>
	  			      </div>
	  			   <div>
	  			</div>
	  		</div>
	  	</div>
	</div>
</body>
</html> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moviekh.net</title>
    
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
	
  </head>

  <body>
	
    <div class="container" style="margin: 60px auto">
      <div class="row">
        <div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
				  <h3 class="panel-title">Moviekh embed</h3>
				</div>
				<div class="panel-body">
				    <?php if (isset($msg)): ?>
				    <div class="alert alert-info alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Peligro!</strong> <?php echo $msg ?>
                    </div>
                    <?php endif ?>
					<form method="post" class="form-horizontal">
						<div class="page-header">
<center><a href="><img src="" alt="youtube_certified" border="0"></a></center></br></br></br>
						</div>
						<div class="form-group">
							<label for="360p" class="col-md-3 control-label">Link</label>
							<div class="col-md-6">
								<input type="url" class="form-control" id="360p" name="360p" value="<?php echo isset($_POST['360p']) ? $_POST['360p'] : '' ?>">
							</div>
						</div>
						
						<?php if(isset($_POST['subtitle'])): 
							foreach($_POST['subtitle'] as $c => $subtitle):
						?> 
						<div class="subtitle">
							<div class="form-group">
								<label for="subtitle" class="col-md-3 control-label">Subtitulos</label>
								<div class="col-md-4">
									<input type="url" class="form-control" placeholder="Subtitulo Link (.srt, .vtt)" name="subtitle[]" value="<?php echo $subtitle ?>">
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" placeholder="Subtitle Label" name="subtitle-label[]" value="<?php echo $_POST['subtitle-label'][$c] ?>">
								</div>
								<div class="col-md-1">
									<?php if ($c == 0): ?>
										<button class="btn btn-sm btn-info add-subtitle" type="button">+</button>
									<?php else: ?>
										<button class="btn btn-sm btn-danger remove-subtitle" type="button">x</button>
									<?php endif ?>
								</div>
							</div>							
						</div>
						<?php endforeach;
							else:
						?>
						<div class="subtitle">
							<div class="form-group">
								<label for="subtitle" class="col-md-3 control-label">Subtitulo</label>
								<div class="col-md-4">
									<input type="url" class="form-control" placeholder="Subtitulo Link (.srt, .vtt)" name="subtitle[]">
								</div>
								<div class="col-md-2">
									<input type="text" class="form-control" placeholder="Subtitulo Label" name="subtitle-label[]">
								</div>
								<div class="col-md-1">
									<button class="btn btn-sm btn-info add-subtitle" type="button">+</button>
								</div>
							</div>							
						</div>
						<?php endif ?>
						
						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button type="submit" class="btn btn-primary" id="btn-create">Encriptar</button>
							</div>
						</div>
					</form>
					<?php
					if (!empty($_POST))
					{
						require_once 'includes/Base64WithKey.php';
						$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/d.php?l=" . Base64WithKey::encode(json_encode($_POST));
					?>
					<div class="page-header">
						<h4>Encriptacion Completada</h4>
					</div>
					<textarea class="form-control" rows="4"><iframe width="100%" height="100%" src="<?php echo $url ?>" frameborder="0" scrolling="no" allowfullscreen></iframe></textarea><BR>
					<textarea class="form-control" rows="4"><?php echo $url ?></textarea>
					<?php } ?>
				</div>
			</div>
		</div>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<script>
		$(function() {
		    var c = 1;
			$(document).on('click', '.add-subtitle', function() {
			    if (c < 5)
			    {
    				var subtitle = $(this).closest('.subtitle');
    				
    				var clone = subtitle.clone();
    				
    				clone.find('button.add-subtitle').removeClass('add-subtitle btn-info').addClass('remove-subtitle btn-danger').text('x');
    				
    				subtitle.after(clone);
    				c++;
			    }
			});
			
			$(document).on('click', '.remove-subtitle', function() {
				$(this).closest('.subtitle').remove();
				c--;
			});
		});
	</script>
  </body>
  	<?php
	}
function display_error_msg()
{
	echo '<p>Username or password is invalid</p>';
}
?>
</html>