<?php
//echo 'register page works!';
if (isset($_POST['submit_registration'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (!empty($username) && !empty($password)) {

        if (strlen($email) > 6 && strlen($username) > 6 && strlen($password) > 6) {

            $check_query = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($check_query);
            $user = mysqli_fetch_assoc($result);

            if ($result->num_rows > 0) {
                $message = 'username taken already';
            } else {
                $stmt = $conn->prepare("INSERT INTO users (email,username, password) VALUES (?,?, ?)");
                $stmt->bind_param("sss", $email, $username, $password);
                $stmt->execute();

                $message = 'Thank you, you are now registered!';
            }
        } else {
            $message = 'Username and Password  must be at least 6 characters long, Please try again.';
        }
    } else {
        $message = 'Please fill all fields';
    }
}




//preg_match('/^[a-z0-9]{5,15}$/', $str);   check that the string contains both letters and numbers. 