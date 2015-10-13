<? ob_start("ob_gzhandler"); ?>
<?

include "../includes/structure.php";

db_connect();

$error = "";
$login = false;

if ( isset($_POST['email']) ) {
  // DO NOT DO THIS - LEARN FROM MY MISTAKES ;)
  $sql = sprintf("SELECT * FROM users WHERE username='%s' AND password='%s' LIMIT 1", $_POST['email'], md5($_POST['password']));
  $result = db_query($sql);
  if ( mysql_num_rows($result) != 1 ) {
    // There was an error...
    $error = "I'm sorry, that username (e-mail address) and/or password are incorrect.  Please check your spelling and try again.";
  } else {
    $user = mysql_fetch_assoc($result);
    $login = true;
  }
}

if ( $login ) {
  //setcookie ("replace_me", $query_string);
  header("Location: demo.php");
  //$message = "Click <a href=\"demo.php\">this link</a> to continue.";
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Resume Writer Online - Margin Software</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="default.css">

<script language="JavaScript">
<!-- begin
function newWindow ( page, name, w, h, scroll, toolbar, menubar, location, resizable, statusbar ) {
  var l = (screen.width / 2) - (w / 2);
  var t = (screen.height / 2) - (h / 2);
  winprops = 'top='+t+',left='+l+',height='+h+',width='+w+',scrollbars='+scroll+',toolbar='+toolbar+',menubar='+menubar+',location='+location+',resizable='+resizable+',statusbar='+statusbar
  newwinwin = window.open ( page, name, winprops )
}

function firstFocus() {
  if (document.forms.length > 0) {
    var TForm = document.forms[0];
    for ( i = 0; i < TForm.length; i++) {
       if ((TForm.elements[i].type=="text")||
           (TForm.elements[i].type=="textarea")||
           (TForm.elements[i].type.toString().charAt(0)=="s"))
       {
          document.forms[0].elements[i].focus();
          break;
       }
    }
  }
}

// end -->
</script>

<meta http-equiv="Page-Enter" content="fadeTrans(Duration=1.0)" />
<meta http-equiv="Page-Exit" content="fadeTrans(Duration=1.0)" />

</head>
<body onLoad="firstFocus();" bgcolor="#EEEEEE" text="black" style="margin: 0px;" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><a name="top"></a>

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr height="50%"><td style="">&nbsp;</td></tr>

<tr height="400">
  <td valign="top" style="padding: 2em; padding-right: 365px; border-top: 1px solid black; border-bottom: 1px solid black; background-color: white; background-image: url(images/bg-<?= rand(5,5); ?>.png); background-repeat: no-repeat; background-position: top right;">

    <h2>R&eacute;sum&eacute; Writer Online</h2>
    <h3>Sign In</h3>

<? if ( !isset($message) ) { ?>
    <p>Please enter the e-mail address and password you registered with.</p>
<? if ( !empty($error) ) { ?>
    <p style="margin-right: 80px;"><?= $error; ?></p><? } ?>

	  <table border="0" cellpadding="4" cellspacing="0" width="340">
    <form name="flogin" id="flogin" method="post">
	  <tr>
	    <th class="form" nowrap>E-Mail Address:</td>
		  <td class="form" width="100%"><input type="text" name="email" value="<?= $_POST['email']; ?>" style="width: 100%; border: 1px solid black;" /></td>
	  </tr>
	  <tr>
	    <th class="form" nowrap>Password:</td>
  		<td class="form"><input type="password" name="password" value="" style="width: 50%; border: 1px solid black;" /></td>
	  </tr>
	  <tr>
	    <th class="form" nowrap>&nbsp;</td>
	  	<td class="form"><input type="submit" name="button" value="Sign In" style="width: 100px; border: 1px solid black; background-color: #eee;" /></td>
	  </tr>
	  <tr>
	    <th class="form" nowrap>&nbsp;</td>
	  	<td class="form"><a href="lostpassword.php" onMouseOver="window.status=''; return true;" title="Click here to have a temporary password set to you.">Lost your password?</a></td>
	  </tr>
	  </form>
    </table>
<? } else { ?>
    <p><?= $message; ?></p>
<? } ?>

  </td>
</tr>

<tr height="50%"><td valign="top" align="right" style="font-size: 7pt; color: #666;">Copyright (c) 2003, Margin Software &mdash; All Rights Reserved.</td></tr>
</table>

</body>
</html>