<?php 
    session_start();
    include('./db_conn.php'); 

    if(isset($_POST['submit']))
    {
        $pass = $_POST['password'];
        $email = $_POST['email'];

        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $res=$conn->query($sql);
        if($res->num_rows>0)
        {
            while($row = $res->fetch_assoc())
            {
                if(password_verify($pass,$row['password']))
                {
                    $_SESSION['user_id']=$row['user_id'];
                    header("location:dashboard.php");
                }
                else
                {
                    echo "<script>alert('Incorrect email id or password!!!Please try again');</script>";
                }    
            }
        }
    }
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
    <title>Coinage Crew | Sign In</title>
</head>

<body>
    <div class="contaier">
        <div class="row">
            <div class="col-md-6">
                <img src="./Assets/images/login.svg" class="img-fluid" alt="" srcset="">
            </div>
            <div class="col-md-6 mt-5 p-4">
                <h1 class="display-3 text-center mt-4">Sign In</h1>
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                            placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <button type="submit" name="submit" class="btn mt-4 submit_btn btn-lg">Sign In</button>
                </form>
                <p class="text-center" style="font-weight:bold">New User? <a href="sign_up.php">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>

</html>