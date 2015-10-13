<?

setcookie ("replace_me", $query_string);

include "../includes/structure.php";

$userid = 6;

// Read some database information about the current user... cookies anyone?
db_connect();
$sql = sprintf("SELECT * FROM users WHERE id=%d LIMIT 1", $userid);
$result = db_query($sql);
$user = mysql_fetch_assoc($result);

?>
<html>
<head>
<title><?=$user['fullname'];?> - Resume Writer Online - Margin Software</title>
<frameset rows="45, *, 20">
  <frame name="header" src="header.php" noresize scrolling="no" frameborder=0 marginheight=1 marginwidth=1 />
  <frameset cols="300, *" name="fbody" id="fbody">
    <frame id="fpanel" name="fpanel" src="panel.php" noresize scrolling="yes" frameborder=0 />
    <frame name="preview" src="preview.php" noresize scrolling="yes" frameborder=0 />
  </frameset>
  <frame name="footer" src="footer.php" noresize scrolling="no" frameborder=0 />
</frameset>
</head>
<body>
</body>
</html>
