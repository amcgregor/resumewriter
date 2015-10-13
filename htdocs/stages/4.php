<? include_once "templates/template.php"; ?>

<? if ( $disp ) { ?>
  <td colspan="2" style="padding-bottom: 1em;">
    <p>Finally, you pick a look for your r&eacute;sum&eacute;.  Depending on the job you may want it to be elegant, other times functional or simple.  Try them all on for size and see what you like best.</p>
  </td>

  <tr>
    <td style="padding-bottom: 1em;" align="right" nowrap>Template:</td>
    <td style="padding-bottom: 1em;" width="90%"><select name="templatetype" style="width: 100%;" onChange="form.submit(); return true;">
<? foreach ( $template as $name=>$item ) printf("      <option value=\"%s\"%s>%s</option>", $name, $user['template'] == $name ? " selected" : "", $item['name']); ?>
    </select></td>
  </tr>

<? } else {

      // User has switched to another tab - update data.
      $sql = sprintf("UPDATE users SET `template`='%s' WHERE id=%d LIMIT 1", $_POST['templatetype'], $user['id']);
      $update = db_query($sql);

   } ?>
