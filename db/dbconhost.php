<?php

// code de connexion au server herbergeant la base de donnees "generationcode"

$dbhost = 'mysql.hostinger.co.uk';
$dbuser = 'u920268772_thier';
$dbpass = 'allesecond7518';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysqli_error());
}

?>