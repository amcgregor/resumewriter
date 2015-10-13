<? ob_start("ob_gzhandler"); ?>
<?

include "../includes/structure.php";

$userid = 5;

// Read some database information about the current user... cookies anyone?
db_connect();
$sql = sprintf("SELECT * FROM users WHERE id=%d LIMIT 1", $userid);
$result = db_query($sql);
$user = mysql_fetch_assoc($result);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="http://www.marginsoftware.com/default.css">
</head>
<body bgcolor="white" text="black" style="margin: 0px;" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><a name="top"></a>

<table border=0 cellpadding=0 cellspacing=0 width="100%" height="100%">
<tr><td valign="middle" style="border-bottom: 1px solid black; background-image: url(images/bg-3-sm.png); background-repeat: no-repeat; background-position: top right;"><span style="font-size: 18pt; font-weight: bold;">&nbsp;R&eacute;sum&eacute; Writer Online (Demonstration)</span></td></table>

</body>
</html>
