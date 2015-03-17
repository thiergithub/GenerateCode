<?php

require 'db/dbconhost.php';
require 'functions/securityhost.php';

mysqli_select_db($conn,'u920268772_credi');

if(isset($_POST['register']) && ($_POST['login']) && ($_POST['fname']) && ($_POST['lname']) && ($_POST['email']) &&  ($_POST['passwd']) && ($_POST['passwd2']))
		{ 
			$login = trim($_POST['login']);
			$sql0 = ("SELECT login FROM  users WHERE login='$login'");
			$resultlog = mysqli_query( $conn,$sql0);
			if(mysqli_num_rows($resultlog)==0)
				{
					$fname = trim($_POST['fname']);
					$lname = trim($_POST['lname']);
					$email = trim($_POST['email']);
					$pwd   = trim($_POST['passwd']);
					$pwd2   = trim($_POST['passwd2']);

					if($pwd==$pwd2)
						{
							$pwdh = password_hash($pwd, PASSWORD_BCRYPT, array('cost'=>12));
							$sql = "INSERT INTO users (login, fname, lname, email, password) VALUES ('$login','$fname','$lname','$email','$pwdh')";
							mysqli_query($conn, $sql);
							echo "enregistrer";
						}
							else
								{
									echo "mot de passe non confirmer";
								}
					
				}
				else
					{
						echo "choisissez un autre login";
					}
			
		}
		else
			{echo"";}
		mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Acces</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-syberkash-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
      			</button>
			<a class="navbar-brand" href="#"><img src="">SYBERKASH</a>
			</div>

		
		<div class="collapse navbar-collapse navbar-right" id="bs-syberkash-navbar-collapse-1">

				<ul class="nav nav-pills">
				  <li role="presentation" class="active"><a href="fillcodehost.php" class ="btn btn-primary">VENTE DE CODES</a></li>
				  <li role="presentation"><a href="crediterhost.php" class ="btn btn-success">CREDITER COMPTE</a></li>
				  <li role="presentation"><a href="debiterhost.php" class ="btn btn-danger">DEBITER COMPTE</a></li>
				  <li role="presentation"><a href="verifcodehost.php" class ="btn btn-info">VERIFIER CODE</a></li>
				</ul>

		</div>
		</div>
	</nav></br>
	<form class="form-inline" method="post" action="<?php $_PHP_SELF ?>">
		<div class="container-fluid">
			<div class="navbar-header">
				<div class="collapse navbar-collapse navbar-right" id="bs-syberkash-navbar-collapse-1">
					<ul class="nav nav-pills">
						<li role="presentation" class="active"><strong>ENREGISTREZ VOUS</strong></br></li>
					</ul>
				</div>
			</div >
		</div>
			<div class="form-group container-fluid">
				    <label class="sr-only" for="login">Login</label>
					    <div class="input-group">
					      <input name ="login" type="text" class="form-control" id="login" placeholder="choisissez un Login">
					      <div class="input-group-addon">Login</div>
					    </div><br/><br/>

					<label class="sr-only" for="fname">Prenom</label>
					    <div class="input-group">
					      <input name ="fname" type="text" class="form-control" id="fname" placeholder="Votre Prenom">
					      <div class="input-group-addon">Prenom</div>
					    </div><br/><br/>

					<label class="sr-only" for="lname">Login</label>
					    <div class="input-group">
					      <input name ="lname" type="text" class="form-control" id="lname" placeholder="Votre Nom">
					      <div class="input-group-addon">Login</div>
					    </div><br/><br/>

					<label class="sr-only" for="email">Email</label>
					    <div class="input-group">
					      <input name ="email" type="text" class="form-control" id="email" placeholder="Votre e-Mail">
					      <div class="input-group-addon">Email</div>
					    </div><br/><br/>

				    <label class="sr-only" for="passwd">Password</label>
					    <div class="input-group">
					      <input name ="passwd" type="password" class="form-control" id="passwd" placeholder="Mot de Passe">
					      <div class="input-group-addon">Password</div>
					    </div><br/><br/>

				    <label class="sr-only" for="passwd2">Confirmer Password</label>
					    <div class="input-group"> 
					      <input name ="passwd2" type="password" class="form-control" id="passwd2" placeholder="ressaisissez le mot de passe">
					      <div class="input-group-addon">Confirmer Password</div>
					    </div><br/><br/>
				    <button name ="register" type="submit" class="btn btn-primary" id="register" >S'enregistrer</button>
			</div>
	</form>
	
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>