<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Group</title>
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
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";            
            $urlID = parse_url($url, PHP_URL_QUERY);
            
            $query = "SELECT group_name from groups where " . $urlID;
            $groups = $mysqli->query($query);
            
            if ($groups->num_rows > 0) {
                while ($row = $groups->fetch_assoc()) {
                    echo $row["group_name"];
                }
            } else {
                echo "Group not found"; 
            }?></p>
        
        
        
        
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>