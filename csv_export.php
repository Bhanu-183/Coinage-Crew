<?php 
 
include('db_conn.php'); 
$grp_id=$_GET['grp_id'];
$query = $conn->query("SELECT * FROM `members`,`users` WHERE grp='$grp_id' AND user_id=id"); 
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "members-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
      
    $fields = array('Group Name','NAME','Group _ID','STATUS'); 
    fputcsv($f, $fields, $delimiter); 
     $res2=$conn->query("SELECT * FROM `groups` WHERE grp_id='$grp_id'");
     $row2=$res2->fetch_assoc();
     $grp_name=$row2['grp_name'];
    while($row = $query->fetch_assoc()){ 
        $status = ($row['paid'] == 1)?'Paid':'Unpaid'; 
        $lineData = array($grp_name,$row['name'], $row['grp'], $status); 
        fputcsv($f, $lineData, $delimiter); 
    } 
    fseek($f, 0); 
     
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
    fpassthru($f); 
} 
exit; 
 
?>