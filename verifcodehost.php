<html>
<head>
<title>Verification Code</title>
</head>
<body>
<?php
require 'db/dbconhost.php';
require 'functions/securityhost.php';

mysqli_select_db($conn,'u920268772_credi');

if(isset($_POST['averifier']))
{
	$codeaverifier =trim($_POST['codeaverifier']);
	$sql = ("SELECT code FROM  codes WHERE code='$codeaverifier'");
	$result = mysqli_query( $conn,$sql);
	if(mysqli_num_rows($result)==1)
		{
			$sql1 = ("SELECT code FROM  codeutiliz WHERE code='$codeaverifier'");
			$result = mysqli_query( $conn,$sql1);
			if(mysqli_num_rows($result)==1)
				{
					$sql3 = "SELECT datation FROM codeutiliz WHERE code = '$codeaverifier'";
					$result = mysqli_query($conn,$sql3);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo "Ce code a deja ete utilise le: " . $row["datation"] . "<br />";
				}
				else
					{
						echo "ce code est valide";
					}
		}
		else
		{
		echo "ce code n'est pas valide";
		}
		mysqli_close($conn);
}
		else
			{
?>
			<form method="post" action="<?php $_PHP_SELF ?>">

			Code a verifier: <input name="codeaverifier" type="text" id="codeaverifier"/>

			<input name="averifier" type="submit" id="verif" value="Verifier"/>

			</form>
			<?php
			}
			?>
</body>
</html>