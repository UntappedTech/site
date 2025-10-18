<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to_email = "inquiries@untapped.tech"; // <<-- REPLACE THIS WITH YOUR REAL EMAIL    
    $subj = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $subject = "NEW LEAD: " . $subj;
   // $subject = "NEW LEAD: Untapped Technologies Strategy Session Request";
    
    // Sanitize and collect input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $budget = filter_var($_POST['budget'], FILTER_SANITIZE_STRING);
    $project_desc = filter_var($_POST['project'], FILTER_SANITIZE_STRING);
    
    // Construct the email body
    $body = "A new prospect has requested a Strategy Session via untapped.tech:\n\n";
    $body .= "Name: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Project Name/Type: " . $subj . "\n";
    $body .= "Budget: " . $budget . "\n";
    $body .= "Project Description: \n" . $project_desc . "\n\n";
    $body .= "--- \nREMINDER: This lead is pre-qualified against the $5,000 minimum.";
    
    // Headers for the email
    $headers = "From: inquiries@untapped.tech" . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to_email, $subject, $body, $headers)) {
        // Success: Redirect the user to a thank you page (or the homepage)
        header('Location: index.html?status=success'); 
        exit;
    } else {
        // Failure: Redirect to an error message
        header('Location: index.html?status=error');
        exit;
    }
} else {
    // If someone tries to access the script directly
    header('Location: index.html');
    exit;
}
?>
