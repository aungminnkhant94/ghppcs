<?php
if($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $visitor_phone = "";
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
    $recipient = "info@ghppcs.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $visitor_email . "\r\n";
    $email_content = "<html><body>";
    $email_content .= "<h1 style='font-family: Arial; font-size: 1rem;text-align:center;'><strong>Contact from Website</strong></h1>";
    $email_content .= "<table style='font-family: Arial;width:100%;'><tbody><tr><td style='background: #eee; padding: 10px;'>Name</td><td style='background: #fda; padding: 10px;'>$visitor_name</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Email</td><td style='background: #fda; padding: 10px;'>$visitor_email</td></tr>";
    $email_content .= "<tr><td style='background: #eee; padding: 10px;'>Phone</td><td style='background: #fda; padding: 10px;'>$visitor_phone</td></tr></tbody></table>";
    $email_content .= '</body></html>';
    
    if(mail($recipient, "Need Quotation!", $email_content, $headers)) {
        echo '<script> alert("Sent Successfully!\n'.$visitor_name.', \nWe will contact you shortly!")</script>';
        echo '<script> window.location.href="../index.htm";</script>';
    } else {
        echo '<p>We are sorry but the booking confirmation email did not go through.</p>';
    }
} else {
    echo '<p>Something went wrong</p>';
}
?>

