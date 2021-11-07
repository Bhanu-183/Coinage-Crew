<?php
    session_start();
    include('./db_conn.php'); 
    $user_id=$_SESSION['user_id'];
    $grp_id=$_GET['grp_id'];
    $sql="UPDATE `members` SET paid=1 WHERE grp='$grp_id' AND id='$user_id'";
    $conn->query($sql);
    echo $conn->error;
    ?>
    <script>
        alert('Payement Successful');
        location.replace('./dashboard.php');
    </script>
    <?php
?>