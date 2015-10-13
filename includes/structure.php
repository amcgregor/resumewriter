<?

// Generally, keep this file git-crypted.

include_once "mysql.php";

$sqlset     = "local";
$sqloptions = array(
    "local" => array(
      "server"        => "localhost",
      "user"          => "",
      "password"      => "",
      "database"      => "resume",
      "prefix"        => ""
 ), "remote" => array(
      "server"        => "localhost",
      "user"          => "",
      "password"      => "",
      "database"      => "resume",
      "prefix"        => ""
 ) );
$sqlserver = $sqloptions[$sqlset];

?>
