<? ob_start("ob_gzhandler"); ?>
<?

include "../includes/structure.php";

$userid = 6;

// Read some database information about the current user... cookies anyone?
db_connect();
$sql = sprintf("SELECT * FROM users WHERE id=%d LIMIT 1", $userid);
$user = mysql_fetch_assoc(db_query($sql));

$sections = array();

function scansections () {
  global $sections;
  global $userid;
  $sql = sprintf("SELECT * FROM sections WHERE user=%d AND subsection=0 ORDER BY `order`", $userid);
  $sections = recurse_sections(db_query($sql));
}

scansections();

$stagenames = array("Welcome", "Personal Information", "Sections", "R&eacute;sum&eacute; Look", "Print");
$maxstage = 4;
$stage = ( !isset($_POST['stage']) ? 1 : $_POST['stage'] );

include "stages/" . $stage . ".php";


$sql = sprintf("SELECT * FROM users WHERE id=%d LIMIT 1", $userid);
$user = mysql_fetch_assoc(db_query($sql));

if ( isset($_POST['btnprev']) ) $stage--;
if ( isset($_POST['btnnext']) ) $stage++;
if ( isset($_POST['btndone']) ) $stage = $maxstage;
if ( $stage < 1 ) $stage = 1;
if ( $stage > $maxstage ) $stage = $maxstage;

$disp = true;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="default.css">
<style>
td { font-size: 8pt; }
input { font-size: 8pt; }
select { font-size: 8pt; }
</style>
</head>
<body bgcolor="white" text="black" style="border-right: 1px solid black; padding: 0; magin: 0.5em; margin-top: 0.5em;" onLoad="parent.preview.location.href = 'preview.php';"><a name="top"></a>

<h3><?=$stagenames[$stage-1];?></h3>

<table border="0" cellpadding="2" cellspacing="0" width="100%">
<form method="post" name="form">

  <input type="hidden" name="stage" value="<?= $stage; ?>" />

<? include "stages/" . $stage . ".php"; ?>

  <tr>
    <td colspan="2" align="right">
      <input type="submit" name="btnprev" value="&lt; Previous"<?= ($stage == 1 ? " disabled" : ""); ?>>
      <input type="submit" name="btnnext" value="Next &gt;" style="width: 25%;"<?= ($stage == $maxstage ? " disabled" : ""); ?>>
      <input type="submit" name="btndone" value="Finish" style="margin-left: 0.5em; width: 25%;"<?= ($stage == $maxstage ? " disabled" : ""); ?>>
    </td>
  </tr>

</form>
</table>

</body>
</html>
