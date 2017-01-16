<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payments using Stripe</title>
	
</head>
<body>
<p>Price: 15.00$</p>

<form action="charge.php" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_Itt0cBUS6KDevOP6buYYKUX3"
    data-image="http://www.yoohcan.tv/img/Front/logo.png"
    data-name="yoohcan.tv"
    data-description="Yoohcan Payment($15.00)"
    data-amount="1500">
  </script>

</form>



</body>
</html>


