<?php
    include_once 'LoginDB.php';
    $u_val = htmlspecialchars($_POST['username']);
    $p_val = htmlspecialchars($_POST['password']);

    $get_sqlStatement = "SELECT * FROM LoginTable";
    $update_sqlStatement = "UPDATE LoginTable SET LoggedIn = 1 WHERE Username = '$u_val'";

    $get_query = mysqli_query($loginConnection, $get_sqlStatement);
    $rows_check = $get_sqlStatement = mysqli_num_rows($get_query);

    $found_val = 0;
    if ($rows_check > 0) {
        $update_query = mysqli_query($loginConnection, "UPDATE LoginTable SET LoggedIn = 0"); //Set login values to 0 when new person is about to login.
        while ($row = mysqli_fetch_assoc($get_query)) {
            if (($row['Username'] == $u_val) && ($row['PasswordValue'] == $p_val)) {
                $update_query = mysqli_query($loginConnection, $update_sqlStatement); //Set their value to 1.
                $found_val = 1;
            }
        }
    }
    if ($found_val == 1) {
      header("Location: ../HandleGame/MainPage.php");
    } else {
       header("Location: ../ErrorScreens/LoginError.html");
    }


?>