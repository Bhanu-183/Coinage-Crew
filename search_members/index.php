<?php 
    session_start();
    include('../db_conn.php'); 
    $user_id=$_SESSION['user_id'];

    if(isset($_POST['submit']))
    {
        $values=$_POST['ids'];
        $arr = explode (",", $values); 
        unset($arr[count($arr)-1]);
        if(count($arr)==0)
        {
          ?>
            <script>
                alert('Group can not be empty!!!');
                location.replace('./index.php');
            </script>
            <?php
        }
        $grp_name=$_POST['grp_name'];
        $category=$_POST['category'];
        $total=$_POST['total'];
        $split=$total/(count($arr)+1);
        
        $sql="INSERT INTO `groups`(grp_name,owner,category,total,split) VALUES('$grp_name','$user_id','$category','$total','$split')";
        $conn->query($sql);
        
        $q="SELECT * FROM `groups` ORDER BY date DESC LIMIT 1";
        $res=$conn->query($q);
        $row=$res->fetch_assoc();
        $grp_id=$row['grp_id'];
        foreach($arr as $id)
        {
            $sql="INSERT INTO `members`(grp,id) VALUES('$grp_id','$id')";
            $conn->query($sql);
            echo $conn->error;
        }
        ?>
        <script>location.replace('../dashboard.php');</script>
      <?php
      }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
      integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
      crossorigin="anonymous"
    ></script>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="./style.css" />
      <link rel="stylesheet" href="../Assets/styles/index_style.css">
    <script type="text/javascript" src="./script.js"></script>
  </head>
  <body>
      <div class="container mt-5">
        <div>
            <a href="../logout.php" class="logout-btn btn">Logout</a>
        </div>
    <div>
        <a href="../dashboard.php" class="back-btn btn">Back</a>
    </div>
      <h1 class="display-5 text-center" style="color:#1e5128;font-weight:500">CREATE YOUR GROUP</h1>
      
        <ul class="list-group" id="selected">

        </ul>
      
      <input
      class="mt-3"
      type="text"
      id="myInput"
      onkeyup="myFunction()"
      placeholder=" Search for names.."
      title="Type in a name"
    />

    <ul id="myUL">
      <?php 
        $q="SELECT * FROM `users` WHERE user_id <> '$user_id'";
        $res=$conn->query($q);
        if($res->num_rows>0){
          while($row=$res->fetch_assoc()){
            $name=$row['name'];
            $id=$row['user_id'];
            echo '<li>
        <a>'.$name.'<button class="small_btn" onclick="validate(this,'.$id.')"><i class="fas fa-user-plus"></i></button
        ></a>
      </li>';
          }
        }
      ?>
      
      
    </ul>
    <!-- <button class="btn modal">Show</button> -->
    <!-- Button trigger modal -->
<button type="button" style="margin-left:auto;margin-right:auto;display:block;" class="btn btn-primary modalbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Create the group
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-users"></i> Create the group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">
      
      <form method="POST">
          <input type="hidden" name="ids" id="hidden_input">
        <div class="mb-3">
          <label for="grp_name" name="grp_name" class="form-label"
            >Group name</label>
          <input
            type="text"
            class="form-control"
            id="grp_name"
            name="grp_name"
            aria-describedby="grp_name"
            placeholder="Enter name of your group"
            required
          />
        </div>


        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <input
            type="text"
            class="form-control"
            id="category"
            name="category"
            aria-describedby="owner"
            placeholder="Enter the category of your expense"
            required
          />
        </div>
        <div class="mb-3">
          <label for="total" class="form-label">Total expense</label>
          <input
            type="number"
            class="form-control"
            id="total"
            name="total"
            aria-describedby="total"
            placeholder="Enter the category of your bill expense"
            required
          />
        </div>

        <label for="split" class="form-label">**Split is calculated by taking the average</label>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
      </div>
      
    </div>
  </div>
</div>
    </div>



      </div>
   
  </body>
</html>
