<?php
$file = fopen("tmp.zpl", "w");
fwrite($file, $_POST["zpl_input"]);
$print_command = "lpr -P " + $_POST["selected_printer"] + " tmp.zpl";
exec($print_command, $print_output, $print_resturn_code);
echo $print_output;
?>