<?php

$conn = new mysqli("localhost","root","","vue_curd");

$data = $conn->query("SELECT * FROM users ORDER By id ASC");

$all_users = [];

while( $users = $data->fetch_assoc() ){
    array_push($all_users, $users);
}

echo json_encode($all_users);
