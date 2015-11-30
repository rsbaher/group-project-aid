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
            $ID = explode("=", $urlID);
            
            $query = "SELECT link_user_group.user_id, link_user_group.group_id, groups.id
            FROM link_user_group
            JOIN groups ON link_user_group.group_id=" .  $ID[1] . " 
            WHERE link_user_group.user_id = " . $_SESSION["user_id"];
            $groups = $mysqli->query($query);
            
            if ($groups->num_rows > 0) {
                $row = $groups->fetch_assoc(); 
                if ($row["group_id"] == $ID[1]) {
                    $query = "SELECT group_name from groups where " . $urlID;
                    $group = $mysqli->query($query);
                
                    $row = $group->fetch_assoc();
                    echo "This is the group page for " . $row["group_name"];
                }
            } else {
                echo '<p class="error">You are not authorized to access this page.</p>';
            }?></p>
               
        
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>