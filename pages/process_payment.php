<?php
require_once('../vendor/autoload.php'); // Include Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_51NynyUASHNDt1ImDooy9ZjgHKYGzjk1Luhm6tGWURZwNGtjx1fUFPmbcay0fdhIgbYlANOCRV0iueToXxPUglvYh00lCUZbCKO'); // Replace with your Stripe secret key

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the token submitted by the Stripe Checkout form
        $token = $_POST['stripeToken'];
        $amount = 1000; // Example: $10.00 in cents

        // Charge the customer's card
        $charge = \Stripe\Charge::create(array(
            "amount" => $amount,
            "currency" => "usd",
            "description" => "Payment for Movie Rental",
            "source" => $token,
        ));

        // Payment successful, you can update your database or perform other actions here

        // Redirect to a success page
        header("Location: success.php");
        exit();
    } catch (\Stripe\Exception\CardException $e) {
        // Handle card errors
        $error = $e->getError();
        header("Location: error.php?error=card_error&message=" . urlencode($error->message));
        exit();
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle invalid request errors
        $error = $e->getError();
        header("Location: error.php?error=invalid_request&message=" . urlencode($error->message));
        exit();
    } catch (\Stripe\Exception\InvalidRequestException $e) {
        // Handle other Stripe errors
        header("Location: error.php?error=invalid_request");
        exit();
    } catch (Exception $e) {
        // Handle general PHP errors
        header("Location: error.php?error=server_error");
        exit();
    }
}
?>
<!-- Your HTML form for Stripe Checkout goes here -->
