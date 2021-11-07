<?php 
    session_start();
    include('./db_conn.php');
    $grp_id=$_GET['grp_id'];
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
    <link rel="stylesheet" href="./Assets/styles/grp_style.css">
    <title>Coinage Crew | Group</title>
</head>
<div class="container mt-4">
    <div>
            <a href="./logout.php" class="logout-btn btn">Logout</a>
        </div>
    <div>
        <a href="./dashboard.php" class="back-btn btn">Back</a>
    </div>
    <?php 
        $q="SELECT * FROM `groups`,`users` WHERE `grp_id`='$grp_id' AND user_id=owner";
        $res=$conn->query($q);
        $row=$res->fetch_assoc();
        $grp_name=$row['grp_name'];
        $owner=$row['name'];
        $owner_id=$row['owner'];
        $category=$row['category'];
        $total=$row['total'];
        $split=$row['split'];
    ?>
    <h1 class="display-4 text-center" data-aos="fade-up"><u><?php echo $grp_name?></u></h1>
    <p class="text-center"><?php echo $owner?> created this group</p>
    <div class="row mt-4 table_row">
        <table class="table">
            <tbody>
                <tr>
                    <td><b>Category</b></td>
                    <td><?php echo $category?></td>
                </tr>
                <tr>
                    <td><b>Total Amount</b></td>
                    <td><?php echo $total?></td>
                </tr>
                <tr>
                    <td><b>Split Amount</b></td>
                    <td><?php echo $split?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row table_row mt-5 mb-5">
        <h3 class="text-center"><u>Group Members</u></h3>
        <ul class="list-group">
            
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $owner?>
                <?php if($user_id!=$owner_id)
                        {?>
                <a href="./phpmailer.php?owner_id=<?php
                echo $owner_id;
                ?>" class="badge badge-primary badge-pill">IOU</a>
                <?php }?>
            </li>
            <?php 
                $q1="SELECT * FROM `members`,`users` WHERE grp='$grp_id' AND user_id=id";
                $res1=$conn->query($q1);
                if($res1->num_rows>0)
                {
                    while($row1=$res1->fetch_assoc())
                    {
                        $name=$row1['name'];
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                                '.$name;
                        
                        $id=$row1['user_id'];
                        if($row1['paid']==1)
                        {
                            echo '<span class="badge badge-success badge-pill">Paid</span>
                            </li>';
                        }
                        elseif($user_id==$owner_id)
                        {
                            echo '<a href="#" style="color:white" class="badge badge-warning badge-pill">Remind</a>
                                </li>';
                        }
                        elseif($id==$user_id)
                        {
                            echo '<a href="#" class="btn pay_btn">PAY</a>
                            </li>';
                        }
                    }
                }
            ?>
        </ul>
    </div>
</div>

</html>
<script>
    AOS.init({
        duration: 1600,
    });
</script>