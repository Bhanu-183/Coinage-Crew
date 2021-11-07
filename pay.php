<?php

$amount=$_GET['split'];

?>


<!-- <button id="rzp-button1">Pay</button> -->
<form>


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    var options = {
        "key": "rzp_test_q9HIsFrrbSIn2Z", // Enter the Key ID generated from the Dashboard
        "amount": <?php echo $amount*100?>, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Coinage Crew",
        "description": "Pay your part",
        // "image": "https://example.com/your_logo",
        // "order_id": "order_Ef80WJDPBmAeNt", //Pass the `id` obtained in the previous step
        // "account_id": "acc_Ef7ArAsdU5t0XL",
        "handler": function (response){
            // alert(response.razorpay_payment_id);
            // alert(response.razorpay_order_id);
            // alert(response.razorpay_signature)
            console.log(response);
        }
    };
    var rzp1 = new Razorpay(options);
    // document.getElementById('rzp-button1').onclick = function(e){
        rzp1.open();
        // e.preventDefault();
    // }
    </script>

</form>