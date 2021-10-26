<?php

if (isset($_POST['submit_login'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' ";
        $result = $conn->query($query);
        $user =  $result->fetch_assoc();

        if (mysqli_num_rows($result) === 1) {
            $_SESSION['uid'] = $user['uid'];
            $message = "Sucessfully logged in!";
        } else {
            $message = "please try again email taken";
        }
    } else {
        $message = 'Please fill all fields';
    }
}
