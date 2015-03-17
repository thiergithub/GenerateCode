<html>
<head>
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Achat code recharge</title>
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
			<a class="navbar-brand" href="#"></a>
			</div>

		
		<div class="collapse navbar-collapse" id="bs-syberkash-navbar-collapse-1">

				<ul class="nav nav-pills">
				  <li role="presentation" class="active"><a href="index.php" class ="btn btn-primary">RETOUR</a></li>
				</ul>

		</div>
		</div>
	</nav>
<?php
require 'db/dbconhost.php';
require 'functions/securityhost.php';

mysqli_select_db($conn,'u920268772_credi');

if(isset($_POST['crediter']))
	{
	if(isset($_POST['login']))
		{
			$login= $_POST['login'];
			$sql0 = ("SELECT login FROM  users WHERE login='$login'");
			$resultlog = mysqli_query( $conn,$sql0);
			if(mysqli_num_rows($resultlog)==1)
				{
					$login= $_POST['login'];
					$pwd = trim($_POST['passwd']);
					$sql = "SELECT password FROM  users WHERE login='$login'";
					$result = mysqli_query( $conn,$sql);
					$row = mysqli_fetch_array($result);
					$stored_password = $row['password'];
					
					if(password_verify($pwd, $stored_password))
						{
							$codeacrediter =trim($_POST['codeacrediter']);
							$sql = ("SELECT code FROM  codes WHERE code='$codeacrediter'");
							$result = mysqli_query( $conn,$sql);
							if(mysqli_num_rows($result)==1)
								{
								$sql1 = ("SELECT code FROM  codeutiliz WHERE code='$codeacrediter'");
								$result = mysqli_query( $conn,$sql1);
								if(mysqli_num_rows($result)==0){$sql2 = "UPDATE codes SET etat=false WHERE code='$codeacrediter';";
										$sql2 .="INSERT INTO codeutiliz(code, valeur) 
												SELECT code, valeur FROM codes WHERE code='$codeacrediter';";
										$sql2 .="UPDATE codeutiliz SET users_id ='$login' WHERE code='$codeacrediter';";
										$sql2 .="UPDATE users 
												SET solde =solde + 
													(SELECT valeur FROM codes WHERE code = '$codeacrediter') 
												WHERE name = '$login';";
										$sql2 .="INSERT INTO transactions (datation, user_name, montant, type) 
												VALUES (NOW(),'$login',(SELECT valeur FROM codes WHERE code = '$codeacrediter'), 'credit')";
										$resultcredit = mysqli_multi_query( $conn,$sql2);
										echo "Votre compte a ete recharger!";}
										else{
										$sql3 = "SELECT datation FROM codeutiliz WHERE code = '$codeacrediter'";
										$result = mysqli_query($conn,$sql3);
										$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
										echo "Ce code a deja ete utilise le: " . $row["datation"] . "<br />";}
									}else{echo "Ce code n'est pas valide: ";}
							
						}else{echo "mauvais password";}

							
				}else{echo "mauvais login";}
				
		}else{echo "saisissez votre login";}
	mysqli_close($conn);
	} else
			{
?>
			<!--<form method="post" action="<?php $_PHP_SELF ?>">

			Login: <input name="login" type="text" id="login"/><br/><br/>
			Code: <input name="codeacrediter" type="text" id="codeacrediter"/>

			<input name="crediter" type="submit" id="crediter" value="Crediter Mon compte"/>

			</form> -->

		<form class="form-inline" method="post" action="<?php $_PHP_SELF ?>">
			<div class="form-group container-fluid">
			    <label class="sr-only" for="login">Login</label>
			    <div class="input-group">
			      <input name ="login" type="text" class="form-control" id="login" placeholder="login">
			      <div class="input-group-addon"><strong>Login</strong></div>
			    </div><br/><br/>
			    <label class="sr-only" for="monpass">Password</label>
			    <div class="input-group">
			      <input name ="passwd" type="password" class="form-control" id="monpass" placeholder="monpass">
			      <div class="input-group-addon"><strong>Password</strong></div>
			    </div><br/><br/>
			    <label class="sr-only" for="login">Code</label>
			    <div class="input-group"> 
			      <input name ="codeacrediter" type="text" class="form-control" id="codeacrediter" placeholder="Saisissez le code">
			      <div class="input-group-addon"><strong>Code</strong></div>
			    </div>
			    <br/><br/>
			    <button name ="crediter" type="submit" class="btn btn-primary" id="crediter" >Crediter mon Compte</button>
			 </div>
		  
		</form>


			<?php
			}
			?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>