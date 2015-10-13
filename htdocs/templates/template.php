<?

  function find_files($base, $needle, $function, $userdata = NULL, $depth = 1) {
    // Do not set $depth by hand!  It is used for internal depth checking only!

    $dir = dir($base);

    while ( $file = $dir->read() ) {
      if ( $file != "." && $file != ".." ) {
        $path = sprintf("%s/%s", $base, $file);
        if ( is_dir($path) ) find_files($path, $needle, $function, $userdata, $depth + 1);
        else if ( preg_match($needle, $file) ) {
          if ( empty($userdata) ) $function($path, $file);
          else $function($path, $file, $userdata);
        }
      }
    }

    $dir->close();
  }

  function include_description ($path, $file) {
    global $template;

    include_once($file);
  }

  $template = array();

  find_files("./", "/description\..*/", "include_description");

?>
