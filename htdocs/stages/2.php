<? if ( $disp ) { ?>
  <td colspan="2" style="padding-bottom: 1em;">
    <p>First, a little personal information.  This is where you can customize the basic details, usually displayed at the top of your resume.  Don't worry if it looks bare right now - we'll flesh out the details later.</p>
  </td>

  <tr>
    <td align="right" nowrap>Full Name:</td>
    <td width="90%"><?= $user['fullname']; ?></td>
  </tr>

  <tr>
    <td align="right" nowrap>Address:</td>
    <td><input name="address" value="<?= $user['address']; ?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td align="right" nowrap>City:</td>
    <td><input name="city" value="<?=$user['city'];?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td align="right" nowrap>Province:</td>
    <td colspan="2"><select name="province" style="width: 100%;">
      <?= db_listbox("SELECT * FROM `provinces` ORDER BY `long`", $user['province'], "\n    "); ?>
    </select></td>
  </tr>

  <tr>
    <td nowrap align="right">Postal Code:</td>
    <td><input name="zip" value="<?=$user['zip'];?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.">Phone:</span></td>
    <td><input name="phone" value="<?=$user['phone'];?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.">Fax:</span></td>
    <td><input name="fax" value="<?=$user['fax'];?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.">Mobile:</span></td>
    <td><input name="mobile" value="<?=$user['mobile'];?>" style="width: 100%;" /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.">Pager:</span></td>
    <td><input name="pager" value="<?=$user['pager'];?>" style="width: 100%;" title="Optional: Leave blank if you do not want this item included." /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.  Note: This can differ from the e-mail address you signed up with.">E-Mail:</span></td>
    <td><input name="email" value="<?=$user['vemail'];?>" style="color: blue; text-decoration: underline; width: 100%;" /></td>
  </tr>

  <tr>
    <td nowrap align="right"><span title="Optional: Leave blank if you do not want this item included.  Please include the leading 'http://' and 'www'.">Website:</span></td>
    <td><input name="website" value="<?=$user['website'];?>" size="2" style="color: blue; text-decoration: underline; width: 100%;" /></td>
  </tr>
<? } else {

      // User has switched to another tab - update data.
      $sql = sprintf("UPDATE users SET address='%s',city='%s',province='%s',zip='%s',phone='%s',fax='%s',pager='%s',mobile='%s', vemail='%s',website='%s' WHERE id=%d LIMIT 1", $_POST['address'], $_POST['city'], $_POST['province'], $_POST['zip'], $_POST['phone'], $_POST['fax'], $_POST['pager'], $_POST['mobile'], $_POST['email'], $_POST['website'], $user['id']);
      $update = db_query($sql);

   } ?>