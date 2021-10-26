
<?php
if (isset($_POST['logout_submission'])) {
    session_unset();
    session_destroy();
}
