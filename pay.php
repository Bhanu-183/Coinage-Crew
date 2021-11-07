<?php

$amount=$_GET['split'];
$grp_id=$_GET['grp_id'];
?>


<!-- <button id="rzp-button1">Pay</button> -->
<form action="./sucess.php?grp_id=<?php echo $grp_id?>" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var options = {
        "key": "rzp_test_q9HIsFrrbSIn2Z", // Enter the Key ID generated from the Dashboard
        "amount": <?php echo $amount*100?>, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Coinage Crew",
        "description": "Pay your part",
        
        "handler": function (response){
            console.log(response);
        }
    };
    var rzp1 = new Razorpay(options);
    // document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        // e.preventDefault();
    // }
    </script>
<input type="hidden" name="grp_id" value="<?php echo $grp_id?>">
</form>