<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$user['fullname'];?>'s R&eacute;sum&eacute;</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="templates/template.basic.css">
<style>
ul, ol { margin-left: 1em; }
</style>
</head>
<body bgcolor="white"<? /*= $_body; */?> text="black" style="margin: 0px;" topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"><a name="top"></a>

<div style="padding: 1em;">

<div style="text-align: center; font-size: 22pt;"><?=$user['fullname'];?></div>
<div style="text-align: center;"><?=$user['address'];?> &mdash; <?=$user['city'];?>, <?=$user['province'];?> &mdash; <?=$user['zip'];?><br>Phone: <?=$user['phone'];?> &mdash; Fax: <?=$user['fax'];?></div>
<? if ( ( !empty($user['vemail']) ) || ( !empty($user['website']) ) ) { ?>
<div style="text-align: center;"><a href="mailto:<?=$user['vemail'];?>"><?=$user['vemail'];?></a><? if ( !empty($user['vemail']) && !empty($user['website']) ) { ?> &mdash; <? } ?><a href="<?=$user['website'];?>"><?=$user['website'];?></a></div>
<? } ?>

<?

function render_section($section) {
  $subsectionsdone = false;

  // If this is a main section, display a big title like thing.
  if ( $section['subsection'] == 0 ) {
?>
<a name="section<?= $section['id']; ?>"></a><p><div style="font-size: 14pt; margin: 15px; margin-left: 0px; text-decoration: underline;"><?= $section['name']; ?></div>
<div style="margin-left: 2em; page-break-inside: avoid; page-break-before: avoid;">
<?
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
        printf("<div class=\"noafter\"><b>%s%s%s &mdash; %s, %s, %s,&nbsp;%s</b></div>\n", $section['startdate'], !empty($section['enddate']) ? " - " : "", $section['enddate'], $section['position'], $section['placename'], str_replace(" ", "&nbsp;", $section['placecity']), $section['placeprovince']);
        printf("<div class=\"nobefore\" style=\"margin-left: 2em;\"><%s>\n  <li>%s\n</%s></div>", $section['listtype'], str_replace("\n", "\n  <li>", $section['text']), $section['listtype'][0] == 'u' ? "ul" : "ol");
      }
      break;

    case 'education':
      if ( $section['subsection'] != 0 ) {
        printf("<div><b>%s%s%s &mdash; %s, %s,&nbsp;%s</b></div>\n", $section['startdate'], !empty($section['enddate']) ? " - " : "", $section['enddate'], $section['placename'], str_replace(" ", "&nbsp;", $section['placecity']), $section['placeprovince']);
        if ( !empty($section['text']) )
          printf("<div style=\"margin-left: 2em;\"><%s>\n  <li>%s\n</%s></div>", $section['listtype'], str_replace("\n", "\n  <li>", $section['text']), $section['listtype'][0] == 'u' ? "ul" : "ol");
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

  if ( $section['subsection'] == 0 ) printf("</div>\n");

}

?>

<? foreach ( $sections as $section ) render_section($section); ?>

</div>

</body>
</html>
