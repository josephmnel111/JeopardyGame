<?php
    include_once '../Login/LoginDB.php';
    $u_val = htmlspecialchars($_POST['username']);
    $p_val = htmlspecialchars($_POST['password']);


    $insert_sqlStatement = "INSERT INTO LoginTable (Username, PasswordValue, HighScore) VALUES ('$u_val', '$p_val', '$0')";
    $get_sqlStatement = "SELECT * FROM LoginTable";

    $get_query = mysqli_query($loginConnection, $get_sqlStatement);
    $rows_check = $get_sqlStatement = mysqli_num_rows($get_query);

    $found_val = 0;

    if ($rows_check > 0) {
        while ($row = mysqli_fetch_assoc($get_query)) {
            if ($row['Username'] == $u_val) {
                $found_val = 1;
            }
        }
    }
    if (($found_val == 0) && ($u_val != "") && ($p_val != "")) {
        $insert_query = mysqli_query($loginConnection, $insert_sqlStatement); //Insert the new account into database
        header("Location: ../index.html");
    } else {
        header("Location: ../ErrorScreens/CreateAccountError.html");
    }


?>