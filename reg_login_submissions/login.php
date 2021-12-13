<?php

if (isset($_POST['submit_login'])) {
    $unameEmail = $conn->real_escape_string($_POST['unameEmail']);
    $password = $conn->real_escape_string($_POST['password']);
    if (!empty($unameEmail) && !empty($password)) {
        $query = "SELECT * FROM users WHERE email='$unameEmail' OR username='$unameEmail' AND password='$password' ";
        $result = $conn->query($query);
        $user =  $result->fetch_assoc();

        if (mysqli_num_rows($result) === 1) {
            $_SESSION['uid'] = $user['uid'];
            // $message = "Sucessfully logged in!";

            // header("Location: ./?user=" . $user['username'] . " ");
        } else {
            $message = "please try again email taken";
        }
    } else {
        $message = 'Please fill all fields';
    }
}
