<?php

    // Server Connection
    $conn = new mysqli("localhost","root","","vue_curd");

    // Bind value axios
    $data = json_decode(file_get_contents('php://input'));

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    // Read all user data action
    if($action == 'read'){

        $data = $conn->query("SELECT * FROM users ORDER By id ASC");

        $all_users = [];

        while( $users = $data->fetch_assoc() ){
            array_push($all_users, $users);
        }

        echo json_encode($all_users);

    }

    // Add new user action
    if($action == 'add'){

        $name = $data->name;
        $email = $data->email;
        $cell = $data->cell;

        $conn->query("INSERT INTO users (name, email, cell) VALUES ('$name', '$email', '$cell')");

    }

    // Delete user action
    if($action == 'delete'){

        $id = $_GET['id'];
        
        $conn->query("DELETE FROM users WHERE id = '$id'");

    }
