<?php 

//let's say each article costs 15.00 bucks

try {

	require_once('Stripe/lib/Stripe.php');
	Stripe::setApiKey("sk_test_MN0ReYaJ3RhgALRM1QglZ5Wn ");
	$token = $_POST['stripeToken'];
	$customer = Stripe_Customer::create(array(
		'email' => 'manish.shrm1@gmail.com',
		'card' => $token
	
	));
	$dd = get_class_methods($customer);
	// echo'<pre>';print_r($dd);die;
	
	
	$charge = Stripe_Charge::create(array(
	"customer" => $customer->id,
	"amount" => 1500,
	"currency" => "usd",
	//"card" => $_POST['stripeToken'],
	//"description" => "Charge for Facebook Login code."
	));
	
/* 	$input = @file_get_contents("php://input");
	$event_json = json_decode($input);
	 */
/* 	$data = Stripe_Invoice::all();						
	echo'<pre>';print_r($data);die;	 */
	
/* 	\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

\Stripe\Charge::create(array(
  "amount" => 2000,
  "currency" => "usd",
  "source" => "tok_189fMK2eZvKYlo2CvNVKMxZf", // obtained with Stripe.js,
  "metadata" => array("order_id" => "6735")
));
	 */
	 
	 
	 
	 
	/*  \Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

\Stripe\Customer::all(array("limit" => 3)); */

	$customers = Stripe_Customer::all(array(
		"limit" => 3
	));
	// $paging = Stripe_Customer::autoPagingIterator();
	/* foreach ($customers_list->autoPagingIterator() as $customer) {
		echo'<pre>';print_r($customer);
	} */
	/* echo'<pre>';print_r($customers);
	die; */
	
	//send the file, this line will be reached if no error was thrown above
	echo "<h1>Your payment has been successfully completed</h1>";


  //you can send the file to this email:
  echo $_POST['stripeEmail'];
}

catch(Stripe_CardError $e) {
	
}

//catch the errors in any way you like

 catch (Stripe_InvalidRequestError $e) {
  // Invalid parameters were supplied to Stripe's API

} catch (Stripe_AuthenticationError $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

} catch (Stripe_ApiConnectionError $e) {
  // Network communication with Stripe failed
} catch (Stripe_Error $e) {

  // Display a very generic error to the user, and maybe send
  // yourself an email
} catch (Exception $e) {

  // Something else happened, completely unrelated to Stripe
}
?>