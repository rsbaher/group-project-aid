<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/welcome.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <p class="login">Logged in as: <?php echo htmlentities($_SESSION['username']);?> | <a href="includes/logout.php">Log out</a></p>
            
            <p class="notes"><?php 
            
            $query = "SELECT id, note, user_id FROM notes WHERE user_id = " . $_SESSION["user_id"];
            $notes = $mysqli->query($query);
            
            if ($notes->num_rows > 0) {
                while ($row = $notes->fetch_assoc()) {
                    echo $_SESSION["username"] . "<br>" . $row["note"] . "<br><br>";
                }
            } else {
                echo "No results"; 
            }?></p>
            <p>Return to <a href="index.php">login page</a></p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>