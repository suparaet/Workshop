<?php

    $host = 'localhost';
    $user = 'root';
    $pwd = '12345678';
    $dbName = 'webboard';

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbName" ,
                                        $user, $pwd);

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
?>