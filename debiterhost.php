<html>
<head>
<title>Debiter mon Compte</title>
</head>
<body>
<?php
require 'db/dbconhost.php';
require 'functions/securityhost.php';

mysqli_select_db($conn,'u920268772_credi');

if(isset($_POST['debiter']))
{
	if(isset($_POST['login']))
	{
		$login= $_POST['login'];
		$sql0 = ("SELECT login FROM  users WHERE login='$login'");
		$resultlog = mysqli_query( $conn,$sql0);
		if(mysqli_num_rows($resultlog)==1)
			{
				$montantadebiter =trim($_POST['montantadebiter']);
				$sql = ("SELECT solde FROM  users WHERE name ='$login'");
				$result = mysqli_query( $conn,$sql);
				$row = mysqli_fetch_assoc($result);
				//echo $row['solde'];
				
				if($row['solde'] > $montantadebiter)
					{
						$sql1 ="UPDATE users SET solde =solde - '$montantadebiter' WHERE login = '$login';";
						$sql1 .="INSERT INTO transactions (datation, user_name, montant, type) 
								VALUES (NOW(),'$login','$montantadebiter', 'debit')";
						$resultcredit = mysqli_multi_query( $conn,$sql1);
						
						echo "correct";
					}
					else
						{
						echo "solde insuffisant ";
						}
			}
			else
				{
					echo "mauvais login";
				}
			}
	mysqli_close($conn);
	}
		else
			{
?>
			<form method="post" action="<?php $_PHP_SELF ?>">

			Login: <input name="login" type="text" id="login"/><br/><br/>
			Montant: <input name="montantadebiter" type="text" id="montantadebiter"/>

			<input name="debiter" type="submit" id="debiter" value="Debiter Mon compte"/>

			</form>
			<?php
			}
			?>
</body>
</html>