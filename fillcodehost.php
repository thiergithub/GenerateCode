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
require 'functions/fctgenerecodehost.php';

mysqli_select_db($conn,'u920268772_credi');
if(isset($_POST['genere']) and ($_POST['valeur']>=10000))
{

	$codeGenere = fctGenereCode(); // appel la fonction fctgenerecode() qui genere un code de 15 chiffres

	$valeur =trim($_POST['valeur']);
	$etat = false;
	
	$sql = ("SELECT code FROM  codes WHERE code='$codeGenere'");
	$result = mysqli_query( $conn,$sql) or die(mysqli_error($conn));
	if(mysqli_num_rows($result)==0)
	{
		$sql = "INSERT INTO codes ".
	       "(date, code, valeur,etat) ".
	       "VALUES(NOW(),'$codeGenere','$valeur',true);";
		$retval = mysqli_query( $conn,$sql);
		if(! $retval )
			{
			  die('Could not enter data: ' . mysqli_error());
			}
			echo '<div class="container-fluid">
					<button type="button" class="btn btn-info">
						<font size="5">Votre Code est :</font>
					</button>  
					<button name ="votrecode" type="button" class="btn btn-success" id="votrecode" >
						<font size="5">' .'<span id="lecode">'.$codeGenere. '</span></font>
					</button>
					<div class="zero-clipboard">
						<span class="btn-clipboard"><button onClick="ClipBoard();"">Copier</button></span>
					</div>
				</div></br>';

	}
	else
		{
			echo 'bon codegenere';
		}
	mysqli_close($conn);	
}


		else
			{
?>
	<form class="form-inline" method="post" action="<?php $_PHP_SELF ?>">
		<div class="form-group container-fluid">
		    <label class="sr-only" for="valeur">Montant (en francs guineens)</label>
		    <strong>Veuillez saisir un montant a partir de 10 000 GNF</strong><br/><br/>
		    <div class="input-group">
		      <input name ="valeur" type="text" class="form-control" id="valeur" placeholder="Montant">
		      <div class="input-group-addon">GNF</div>
		    </div><br/><br/>
		    <button name ="genere" type="submit" class="btn btn-primary" id="genere" >Generer Code</button></br>
		    <div class="input-group">
		 </div>
		  
	</form>
	
	<?php
	}
	?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>