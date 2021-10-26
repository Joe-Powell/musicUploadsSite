<?php session_start();
require('DB/DB_CONN.php');
require('reg_login_submissions/login.php');
require('reg_login_submissions/register.php');
require('reg_login_submissions/logout.php');

if (isset($_POST['publish_post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $session_uid = $conn->real_escape_string($_POST['session_uid']);
    if ($_FILES['music_file_upload']['size'] > 0) {

        $file = $_FILES['music_file_upload'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];


        echo $fileName . '<br>' . $fileTmpName . '<br>';

        var_dump($file);



        // $fileExt = explode('.', $fileName);
        // $fileActualExt = strtolower(end($fileExt));

        $allowed = array('audio/mpeg', 'audio/mp4', 'video/mp4');

        if (in_array($fileType, $allowed)) {
            echo 'file meets expecations ' . $fileType;

            $fileNameNew = rand() . $fileName;
            $fileDestination = 'uploads/' . $fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);


            $sql = "INSERT INTO posts(title,url,session_uid) VALUES('$title', '$fileNameNew', '$session_uid')";
            $conn->query($sql);
        } else {
            echo 'wrong file type ' . $fileType;
        }
    }
}










?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpLoad</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/871b467013.js" crossorigin="anonymous"></script>

</head>

<body>


    <nav>
        <h2>U<span>p</span>l<span>o</span>a<span>d</span>e<span>d</span></h2>
        <ul>
            <li>Home</li>
            <li class='login_nav_btn'>Login</li>
            <li class='register_nav_btn'>Sign-up</li>


            <!--Logout button if logged in to destroy session-->
            <?php if (isset($_SESSION['uid'])) { ?>
                <li>
                    <form class='logoutForm' method='post' action='./'>
                        <button type='submit' class='logOutBtn' name='logout_submission'> Logout</button>
                    </form>
                </li>
            <?php  } ?>


        </ul>
    </nav>

    <!-- LOGIN/REGISTER MODALS POP UPS -->
    <div class="modal_background"></div>

    <section class="login_modal">
        <h2>Login</h2>
        <form action='index.php' method='post'>
            <input type='text' name='username' placeholder='Username'>
            <input type='text' name='password' placeholder='password'>
            <input type='submit' name='submit_login' value='Login'>
        </form>
    </section>

    <section class="register_modal">
        <h2>Register here</h2>
        <form action='index.php' method='post'>
            <input type='text' name='username' placeholder='Username'>
            <input type='text' name='password' placeholder='password'>
            <input type='submit' name='submit_registration'>


        </form>
    </section>




    <!-- Main page -->
    <section class="main_page">


        <!-- Must be logged in for the upload option and top row-->
        <?php if (isset($_SESSION['uid'])) { ?>

            <section class="top-row">
                <form action='index.php' method='post' enctype="multipart/form-data">
                    <input type='file' class='music_file_upload' name='music_file_upload' value='upload file' hidden='hidden'>
                    <button type='button' class='button_for_upload'>Upload</button>
                    <input type='text' name='title' placeholder='title'>
                    <input type='hidden' name='session_uid' value='<?php echo $_SESSION['uid'] ?>'>
                    <input type='submit' name='publish_post'>
                </form>


            </section>

        <?php  } ?>



        <!-- messages from login/register -->
        <?php if (isset($message)) {  ?>
            <h3 class='messages'><?php echo $message ?></h3>
        <?php } ?>


        <?php
        $sql2 = "SELECT * FROM posts";
        $result = $conn->query($sql2);
        while ($row = $result->fetch_assoc()) {
            echo
            "
            <div class='parent'>
                <div class='contain-buttons'>
                    <i class='fas fa-play'></i>
                    <i class='far fa-pause-circle'></i>
                    <i class='fas fa-stop'></i>
                </div>
                <div class='contain-title-src'>
                    <h2 class='title'>" . $row['title'] . "</h2>
                    <span class='timestamp'>Published: " . date('m/d/Y h:i A', strtotime($row['time_stamp'])) . "</span>
                    
                    <audio src='uploads/" . $row['url'] . " ' class='audio'> </audio>
                      
                </div>";   #Close echo here so can make an if statement for an edit button, and delete btn. The closing div is at the bottom before closing while loop

            if (isset($_SESSION['uid']) && $_SESSION['uid'] == $row['session_uid']) {
                echo  " <button class='edit-btn'>Edit</button>
                <button class='delete-btn'>Delete</button>
                ";
                # These forms below will be display:none in css innitially the button will make them pop up using javaScript to loop through them
                echo "
                <form action='/' method='post' class='update_title_form' enctype='multipart/form-data'>
                    <input type='text' name='id_to_update' value='" . $row['id'] . "'>  
                    <input type='text' name='title_to_update' value='" . $row['title'] . "'>
                    <input type='submit' name='update_submission' value='Publish'>
               </form>
                <form action='/' method='post' class='delete_form'>
                    <input type='text' name='id_to_delete' value='" . $row['id'] . "'>
                    <input type='submit' name='delete_submission' value='Delete Item'>
               </form>
               
                ";
            }
            echo "</div>"; # Closing div of parent
        }



        ?>




        <div class="main-audio-div">
            <h3></h3>
            <audio class='main-audio' controls>
                <source src="#" type="audio/mp3">
            </audio>
        </div>

    </section>



































    <script src='JS/main.js'></script>

</body>

</html>