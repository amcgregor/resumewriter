<?

$_link          = NULL;

function db_connect() {
  global $_link;
  global $sqlserver;

  $error = '';

  if ( !$_link ) {
    if ( !$_link = mysql_connect ( $sqlserver['server'], $sqlserver['user'], $sqlserver['password'] ) ) {
      $error = 'MYSQL_NO_CON';
      return $error;
    }
    if (!@mysql_select_db($sqlserver['database'], $_link)) $error = 'LOGIN_MySQL_NO_DATAB';
  } else {
    $error = 'MYSQL_CONNECTED';
  }

  return $error;
}

function db_disconnect() {
  global $_link;

  if ( $_link ) {
    mysql_disconnect($_link);
    $_link = '';
  }
}

function db_query ( $query ) {
  global $_link;
  $result = @mysql_query($query, $_link);

  return $result;
}

function db_count($res = FALSE) {
  global $_link;

  if ( !empty($res) ) return (mysql_num_rows($res)); 
}

function db_query_loop($query, $prefix, $suffix, $found_str, $default="") {
  $output = "";
  $result = db_query($query);
  
  while ( list($val, $label) = mysql_fetch_row($result) ) {
    if ( is_array($default) )
      $selected = empty($default[$val]) ? "" : $found_str;
    else
      $selected = ($val == $default ? $found_str : "");

    $output .= "$prefix value='$val'$selected>$label$suffix";
  }

  return $output;
}

function db_listbox($query, $default="", $suffix="\n") {
  return db_query_loop($query, "<option", $suffix, " selected", $default);
}

//Returns a single value for a quick lookup
function OneValue($table, $value, $ident, $param) {    
  $query = "SELECT ".$value." FROM ".$table." WHERE ".$ident." = ".$param;
  $result = db_query($query);    
  $row = db_fetch($result);      
  return $row[$value];
}

//Returns a single value for a quick lookup
function OneCatValue($table, $value1, $value2, $ident, $param) {    
  $query = "SELECT ".$value1.",".$value2." FROM ".$table." WHERE ".$ident." = ".$param;
  $result = db_query($query);    
  $row = db_fetch($result);      
  return $row[$value1]. " " . $row[$value2];
}

function recurse_sections($result) {
  global $userid;
  $sections = array();
 
  while ( $row = mysql_fetch_assoc($result) ) {
    $sql = sprintf("SELECT * FROM sections WHERE user=%d AND subsection=%d ORDER BY `order`", $userid, $row['id']);
    $row['subsections'] = recurse_sections(db_query($sql));
    $sections[] = $row;
  }

  return $sections;
}

?>
