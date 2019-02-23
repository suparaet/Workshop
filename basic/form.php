<?php
    $name = $_POST['fName'];
    $lastName = $_POST['lName'];

    echo $name.' '.$lastName;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form page</title>
</head>
<body>
    <form action="page2.php" method="post">
        Name: <input type="text" name="fName">
        Last name: <input type="text" name="lName">
        <input type="submit" value="OK">
    </form>
</body>
</html>