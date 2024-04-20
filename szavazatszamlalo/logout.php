<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
?>

</body>
</html>