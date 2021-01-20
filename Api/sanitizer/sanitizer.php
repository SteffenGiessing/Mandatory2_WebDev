<?php
// trim spaces, remove slashes, replace < > with &lt; etc...
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

// sanitize the output from the database
    function sanitizeDB_output($data) {
        $data = htmlentities($data);
        return $data;
    }
?>