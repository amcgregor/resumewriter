<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$user['fullname'];?>'s R&eacute;sum&eacute;</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
  body { font-family: Garamond; font-size: 12pt; }
  .head { font-size: 22pt; padding-bottom: 1em; text-transform: uppercase; text-align: center; }
  .title { font-size: 14pt; text-transform: uppercase; padding-top: 1em; border-bottom: 1px solid black; }
ul, ol { margin-left: 1em; }
</style>
</head>
<body bgcolor="white"<?=$_body;?> text="black" style="margin: 0px;" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><a name="top"></a>

<div style="padding: 1em;">

<div class="head"><?= $user['fullname']; ?></div>

<?

function render_section($section) {
  $subsectionsdone = false;

  // If this is a main section, display a big title like thing.
  if ( $section['subsection'] == 0 ) {
?>
<a name="section<?= $section['id']; ?>"></a><p><div class="title"><?= $section['name']; ?></div>
<div style="margin-left: 25%;"><?
  }

  switch ( $section['type'] ) {
    case 'text': // simply display the text...
      printf("%s", $section['text']);
      break;

    case 'list': // display a bulleted list (or numbered... etc.)
      printf("<%s>\n  <li>%s\n%s", $section['listtype'], str_replace("\n", "\n  <li>", $section['text']), ($section['listtype'][0]=='u'?"</ul>":"</ol>"));
      break;

    case 'references': // references makes heavy use of subsections... great.
      if ( $section['subsection'] == 0 ) printf ("<ul>");
      else printf("  <li>%s<br />%s</li>\n", $section['name'], str_replace("\n", "<br />", $section['text']));
      break;

    case 'experience':
      if ( $section['subsection'] != 0 ) {
        printf("<div style=\"float: left;\">%s%s%s</div>\n", $section['startdate'], !empty($section['enddate']) ? "&mdash;" : "", $section['enddate']);
        printf("<div style=\"float: right;\">%s, %s</div>\n", $section['placecity'], $section['placeprovince']);
        printf("<div>%s</div>", $section['placename']);
        if ( !empty($section['position']) ) printf("<div><i>%s</i></div>", $section['position']);
        printf("<div>%s\n  <li>%s\n%s</div>", $section['listtype'], str_replace("\n", "\n  <li>", $section['text']), str_replace('<', '</', $section['listtype']));
      }
      break;

    case 'education':
      if ( $section['subsection'] != 0 ) {
        printf("<div><b>%s%s%s &mdash; %s, %s,&nbsp;%s</b></div>\n", $section['startdate'], !empty($section['enddate']) ? " - " : "", $section['enddate'], $section['placename'], str_replace(" ", "&nbsp;", $section['placecity']), $section['placeprovince']);
        printf("<div style=\"margin-left: 2em;\">%s\n  <li>%s\n%s</div>", $section['listtype'], str_replace("\n", "\n  <li>", $section['text']), str_replace('<', '</', $section['listtype']));
      }
      break;

    default: // do nothing (most likely 'empty', usually containing subsections.
      break;
  }

  // Now, render subsections.  Here's an idea - render subsections above or below the main section? ... below.
  if ( !empty($section['subsections']) && !$subsectionsdone )
    foreach ( $section['subsections'] as $subsection ) render_section($subsection);

  // Some items require extra stuff after the subsections...
  switch ( $section['type'] ) {
    case 'references':
      if ( $section['subsection'] == 0 ) printf("</ul>");
      break;
   
    default: // do nothing
      break;
  }

  if ( $section['subsection'] == 0 ) printf("</div>");

}

?>

<? foreach ( $sections as $section ) render_section($section); ?>

</div>

</body>
</html>
