<?php
    include_once '../Login/LoginDB.php';
    $high_score = htmlspecialchars($_POST['money_tracker_send']);
    $high_score_copy = substr($high_score, 1);
    $get_sqlStatement = "SELECT * FROM LoginTable";
    $get_query = mysqli_query($loginConnection, $get_sqlStatement);


    $rows_check = $get_sqlStatement = mysqli_num_rows($get_query);

    $update_sqlStatement = "UPDATE LoginTable SET HighScore = '$high_score_copy' WHERE LoggedIn = 1";

    if ($rows_check > 0) {
        while ($row = mysqli_fetch_assoc($get_query)) {
            if ($row['LoggedIn'] == 1) {
                if ($high_score_copy> $row['HighScore']) {
                    $update_query = mysqli_query($loginConnection, $update_sqlStatement); //Update the high score if it is higher.
                }
            }
        }
    }
    header("Location: MainPage.php");
?>