<?php
//echo 'register page works!';
if (isset($_POST['submit_registration'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $check_query = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($check_query);
        $user = mysqli_fetch_assoc($result);

        if ($result->num_rows > 0) {
            $message = 'username taken already';
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();

            $message = 'Thank you, you are now registered!';
        }
    } else {
        $message = 'Please fill all fields';
    }
}
