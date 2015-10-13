<? ob_start("ob_gzhandler"); ?>
<? include "../includes/structure.php"; ?>
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

</head>
<body onLoad="firstFocus();" bgcolor="#EEEEEE" text="black" style="margin: 0px;" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><a name="top"></a>

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr height="50%"><td style="">&nbsp;</td></tr>

<tr height="400">
  <td valign="top" style="padding: 2em; padding-right: 365px; border-top: 1px solid black; border-bottom: 1px solid black; background-color: white; background-image: url(images/bg-<?= rand(2,2); ?>.png); background-repeat: no-repeat; background-position: top right;">

    <h2>R&eacute;sum&eacute; Writer Online</h2>
    <h3>Personal Registration</h3>

<? if ( !isset($_POST['form']) ) { ?>
    <p>Fill in the fields below to get started creating your r&eacute;sum&eacute; online.  You must supply a valid e-mail address.</p>

    <table border="0" cellpadding="4" cellspacing="0" width="340">
    <form name="flogin" id="flogin" method="post">
    <input type="hidden" name="form" value="signup" />
    <tr>
      <th class="form" nowrap>E-Mail Address:</td>
      <td class="form" width="100%"><input type="text" name="email" value="" style="width: 100%; border: 1px solid black;" /></td>
    </tr>
    <tr>
      <th class="form" nowrap>Password:</td>
      <td class="form"><input type="password" name="password" value="" style="width: 50%; border: 1px solid black;" /></td>
    </tr>
    <tr>
      <th class="form" nowrap>&nbsp;</td>
      <td class="form">Minimum 4 characters, must include one symbol.</td>
    </tr>
    <tr>
      <th class="form" nowrap>&nbsp;</td>
      <td class="form"><input type="submit" name="button" value="Register" style="width: 100px; border: 1px solid black; background-color: #eee;" /></td>
    </tr>
    </form>
    </table>
<? } else {

  db_connect();
  $sql = sprintf("INSERT INTO users (id,username,password) VALUES (0,'%s','%s')", mysql_escape_string($_POST['email']), md5($_POST['password']));
  $result = db_query($sql);
  echo mysql_error();

  $error = "";

  header("Location: demo.php");

?>

<? } ?>

  </td>
</tr>

<tr height="50%"><td valign="top" align="right" style="font-size: 7pt; color: #666;">Copyright (c) 2003, Margin Software &mdash; All Rights Reserved.</td></tr>
</table>

</body>
</html>