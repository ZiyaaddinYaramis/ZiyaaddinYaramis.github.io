<?php
// Set response content type
header('Content-Type: application/json; charset=UTF-8');

// Get POST data
$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

// Basic sanitization
$name    = strip_tags(trim($name));
$email   = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($subject));
$message = strip_tags(trim($message));

// Check for empty fields
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
    exit;
}

// Email settings
$to      = 'ziyaaddinyaramis@gmail.com';  // Replace with your email address
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

// Email content
$email_body = "Name: $name\n";
$email_body .= "Email: $email\n\n";
$email_body .= "Subject: $subject\n\n";
$email_body .= "Message:\n$message\n";

// Send mail
$success = mail($to, $subject, $email_body, $headers);

// Response
if ($success) {
    echo json_encode(['success' => true, 'message' => 'Your message has been sent successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Something went wrong. Please try again later.']);
}
?>

