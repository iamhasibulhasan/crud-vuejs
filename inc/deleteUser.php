<?php

    $id = $_GET['id'];

    $conn = new mysqli("localhost","root","","vue_curd");

    $conn->query("DELETE FROM users WHERE id = '$id'");