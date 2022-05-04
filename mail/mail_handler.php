<?php
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $visitor_phone = "";
    $visitor_message = "";
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
    }
    if(isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }
    if(isset($_POST['visitor_phone'])) {
        $visitor_phone = filter_var($_POST['visitor_phone'], FILTER_SANITIZE_NUMBER_INT);
    }
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
    }
    $recipient = "info@ghppcs.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
    $email_content = "<html><body>";
    $email_content .= "<h1 style='font-family: Arial; font-size: 1rem;text-align:center;'><strong>Contact from Website</strong></h1>";
    $email_content .= "<table style='font-family: Arial;width:100%;'><tbody><tr><td style='background: #eee; padding: 10px;'>Name</td><td style='background: #fda; padding: 10px;'>$visitor_name</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Email</td><td style='background: #fda; padding: 10px;'>$visitor_email</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Phone</td><td style='background: #fda; padding: 10px;'>$visitor_phone</td></tr></tbody></table>";
    $email_content .= "<p style='font-family: Arial; font-size: 1rem;'>Message from <strong>$visitor_name</strong> &mdash;<i> $visitor_message</i>.</p>";
    $email_content .= '</body></html>';
    
    if(mail($recipient, "Inquiry from Home Page!", $email_content, $headers)) {
        echo '<script> alert("Sent Successfully! '.$visitor_name.' We will contact you shortly!")</script>';
        echo '<script> window.location.href="../index.htm";</script>';
    } else {
        echo '<p>We are sorry but the booking confirmation email did not go through.</p>';
    }
} else {
    echo '<p>Something went wrong</p>';
}
?>


