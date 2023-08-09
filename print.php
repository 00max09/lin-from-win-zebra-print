<?php
$tmp_file = tmpfile();
$tmp_file_path = stream_get_meta_data($tmp_file)['uri'];
fwrite($tmp_file, $_POST["zpl_input"]);
$print_command = "lpr -P " . $_POST["selected_printer"] . " ". $tmp_file_path;
exec($print_command, $print_output, $print_resturn_code);
fclose($tmp_file);
echo implode($print_output);
?>