<?php 

    // connection paramters
    $db = [
        'hostname' => 'localhost',
        'username' => 'root',
        'password' => '',
        'name'     => 'cloudify'
    ];

    $conn = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['name']);

    if(!$conn){
        mysqli_error($conn);
    }

?>