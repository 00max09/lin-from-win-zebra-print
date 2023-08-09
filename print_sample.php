<?php
$get_printers_command = "lpstat -e";
exec($get_printers_command, $printer_names, $get_printers_return_code);
?>

<html>

<head>
    <script>
        function urlencodeFormData(fd) {
            var params = new URLSearchParams();
            for (var pair of fd.entries()) {
                typeof pair[1] == 'string' && params.append(pair[0], pair[1]);
            }
            return params.toString();
        }

        function print_success() {
            window.alert("Printed");
        }

        function print_error(error) {
            window.alert("Error occured : " + error);
        }

        function send_to_printer(formData) {
            var XHR = new XMLHttpRequest(),
                FD = new FormData(formData);

            // Define what happens on successful data submission
            XHR.onload = function() {
                if (XHR.responseText == "") {
                    print_success();
                } else {
                    print_error(XHR.responseText);
                }
            }

            // Define what happens in case of error
            XHR.addEventListener('error', print_error, false);

            // Set up our request
            XHR.open('POST', "print.php");
            XHR.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            // Send our FormData object; HTTP headers are set automatically
            XHR.send(urlencodeFormData(FD));
        }
    </script>
</head>

<body>

    <form onsubmit="send_to_printer(this); return false;">
        <label for="zpl_input">Zpl Input</label>
        <input type="text" id="zpl_input" name="zpl_input"><br><br>

        <select name="selected_printer" id="selected_printer">
            <?php
            foreach ($printer_names as &$printer_name) {
                echo "<option value=\"" . $printer_name . "\">" . $printer_name . "</option>\n";
            }
            ?>
        </select>
        <input type="submit" value="PRINT" />
    </form>

</body>

</html>