<?php
// process_form.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your form fields and initialize error array
    $fields = ['name', 'email', 'phone', 'state', 'city', 'currentAddress', 'newAddress', 'movingDate'];
    $errors = [];

    // Validate each field
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " is required";
        }
    }

    // If there are no errors, you can process the form data
    if (empty($errors)) {
        // Retrieve and sanitize form data
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $phone = htmlspecialchars($_POST['phone']);
        $state = htmlspecialchars($_POST['state']);
        $city = htmlspecialchars($_POST['city']);
        $currentAddress = htmlspecialchars($_POST['currentAddress']);
        $newAddress = htmlspecialchars($_POST['newAddress']);
        $movingDate = htmlspecialchars($_POST['movingDate']);

        // Add your database insertion or other processing logic here
        // For example, you can use MySQLi or PDO to insert data into a database
        // Make sure to handle SQL injection properly

        // Redirect after successful submission (optional)
        header("Location: success_page.html");
        exit();
    }
}
?>
