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

        // $name = $data->name;
        // $email = $data->email;
        // $cell = $data->cell;

        $photo_name = $_FILES['photo']['name'];
        $photo_tmp_name = $_FILES['photo']['tmp_name'];

        // Upload profile photo
        move_uploaded_file($photo_tmp_name, '../media/users/'. $photo_name);


        $name = $_POST['name'];
        $email = $_POST['email'];
        $cell = $_POST['cell'];
        $photo = $photo_name;

        $conn->query("INSERT INTO users (name, email, cell, photo) VALUES ('$name', '$email', '$cell', '$photo')");

    }

    // Delete user action
    if($action == 'delete'){

        $id = $_GET['id'];

        $conn->query("DELETE FROM users WHERE id = '$id'");

    }

    // Single user view action
    if($action == 'singleUser'){

        $id = $_GET['id'];

        $data = $conn->query("SELECT * FROM users WHERE id = '$id'");
        $single_user = $data->fetch_assoc();

        echo json_encode($single_user);


    }
    // Search user by name action
    if($action == 'search'){

        $txt = $_GET['s'];
        $data = $conn->query("SELECT * FROM users WHERE name LIKE '%$txt%'");
        

        $result = [];
        while($search_data = $data->fetch_assoc()){
            array_push($result, $search_data);
        }

        echo json_encode($result);


    }
