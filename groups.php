<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Groups</title>
        <link rel="stylesheet" href="styles/welcome.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <ul>
            <li><a href="welcome.php">Home</a></li>
            <li><a href="groups.php">Groups</a></li>
            <li>Logged in as: <?php echo htmlentities($_SESSION['username']);?> | <a href="includes/logout.php">Log out</a></li>
        </ul>
            <p class="groups"><?php 
            
            $query = "SELECT link_user_group.user_id, link_user_group.group_id, groups.id, groups.group_name FROM link_user_group
            JOIN groups ON  link_user_group.group_id=groups.id 
            WHERE link_user_group.user_id = " . $_SESSION["user_id"];
            $groups = $mysqli->query($query);
            
            if ($groups->num_rows > 0) {
                while ($row = $groups->fetch_assoc()) {
                    echo $row["group_name"] . "<br><br>";
                }
            } else {
                echo "No results"; 
            }?></p>
        
        
        
        
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>