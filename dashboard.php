<?php
    session_start();
    include('./db_conn.php'); 
    $user_id=$_SESSION['user_id'];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Icons CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <link rel="stylesheet" href="./Assets/styles/index_style.css">
    <link rel="stylesheet" href="./Assets/styles/dashboard_style.css">
    <title>Coinage Crew | Dashboard</title>
</head>

<body>
    
    <div class="container mt-4">
        <div>
            <a href="./logout.php" class="logout-btn btn">Logout</a>
        </div>
        <h1 class="text-center heading"><u>Coinage Crew</u></h1>
        <p class="text-center">Access all your groups from here</p>
    </div>

    <?php 
        $flag=0;
        $q="SELECT * FROM `groups`,`users` WHERE owner='$user_id' AND user_id=owner";
        $res=$conn->query($q);
        if($res->num_rows > 0)
        {
            $flag=1;
            while($row=$res->fetch_assoc())
            {
                $grp_name=$row['grp_name'];
                $category=$row['category'];
                $owner=$row['name'];
                $date=substr($row['date'],0,10);
                $grp_id=$row['grp_id'];
                echo '<div class="row mt-4 mb-2" data-aos="fade-right">
                        <a href="./group.php?grp_id='.$grp_id.'" class="card p-2">
                        <div class="card-body">
                            <h2 class="card-title">'.$grp_name.'</h2>
                            <h5 class="card-subtitle mb-2 text-muted">'.$category.' Bill Split</h5>
                            <p class="card-text">'.$owner.' created this group on '.$date.'</p>
                        </div>
                        </a>
                    </div>';
            }
        }

        $q1="SELECT * FROM `members`,`groups`,`users` WHERE (grp=grp_id AND id='$user_id' AND user_id=owner)";
        $res1=$conn->query($q1);
        if($res1->num_rows>0)
        {
            $flag=1;
            while ($row=$res1->fetch_assoc())
            {
                $grp_name=$row['grp_name'];
                $category=$row['category'];
                $owner=$row['name'];
                $date=substr($row['date'],0,10);
                $grp_id=$row['grp_id'];
                echo '<div class="row mt-4" data-aos="fade-right">
                        <a href="./group.php?grp_id='.$grp_id.'" class="card p-2">
                        <div class="card-body">
                            <h2 class="card-title">'.$grp_name.'</h2>
                            <h5 class="card-subtitle mb-2 text-muted">'.$category.' Bill Split</h5>
                            <p class="card-text">'.$owner.' created this group on '.$date.'</p>
                        </div>
                        </a>
                    </div>';
            }
        }

        if($flag==0)
        {
            echo "<h1 class='display-3 text-center'>You have no groups</h1>";
        }
        
    ?>


    
    
    <div style="height:130px"></div>
    <div class="add">
        <a href="./search_members/index.php" class="btn add_btn p-4">
            <i class="fa fa-plus"></i>
        </a>
    </div>
</body>

</html>
<script>
    AOS.init({
        duration: 1600,
    });
</script>