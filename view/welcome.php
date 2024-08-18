<?php
session_start();
$name = $_SESSION["Name"];
if (!isset($_SESSION["Name"])) {
    echo '<script>window.location.href="../view/login.php";</script>';
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WePlot</title>
</head>
<body>
<h1>holaaaaaaaaaa <?php echo $name
?></h1>
</body>

</html>