<?php 
    include_once '../Login/LoginDB.php';
    $get_sqlStatement = "SELECT * FROM LoginTable ORDER BY HighScore DESC";
    
    $get_query = mysqli_query($loginConnection, $get_sqlStatement);
    $rows_check = $get_sqlStatement = mysqli_num_rows($get_query);

    $myArray = array();

    if ($rows_check > 0) {
        $i = 0;
        while (($row = mysqli_fetch_assoc($get_query)) && ($i < 5)) { //For high score list
            $myArray[$i][0] = $row['Username'];
            $myArray[$i][1] = $row['HighScore'];
            ++$i;
        }
    }
            
?>

<!DOCTYPE html>
<html lang = 'en' dir = 'ltr'>
    <head>
        <title>Project 4</title>
        <link rel= "stylesheet" href = "../styles/MainPage.css">
        <meta charset = "utf-8">
    </head>
    <body>
        <h1>Main Page</h1>
        <h3>Top 5 User Records</h3>
        <ol>
            <li><?php if (isset($myArray[0][0])) {
                            echo($myArray[0][0] . '   $' . $myArray[0][1]);
                        }
                ?>
            </li>
            <li><?php if (isset($myArray[1][0])) {
                            echo($myArray[1][0] . '   $' . $myArray[1][1]);
                        }
                ?>
            </li>
            <li><?php if (isset($myArray[2][0])) {
                            echo($myArray[2][0] . '   $' . $myArray[2][1]);
                        }
                ?>
            </li>
            <li><?php if (isset($myArray[3][0])) {
                            echo($myArray[3][0] . '   $' . $myArray[3][1]);
                        }
                ?>
            </li>
            <li><?php if (isset($myArray[4][0])) {
                            echo($myArray[4][0] . '   $' . $myArray[4][1]);
                        }
                ?>
            </li>
        </ol>
        <form action = "PlayGame.php" method = "post">
            <input type = "submit" class = "designButton" value = "Play Game"><br>
            <a href = "../index.html">Logout</a>
        </form>

    </body>
</html>