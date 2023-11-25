<?php
// Define a function for validating form input
function validateFormInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your form fields and initialize error array
    $fields = ['name', 'email', 'phone', 'currentState', 'currentCity', 'newState', 'newCity', 'newAddress', 'movingDate'];
    $errors = [];

    // Validate each field
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " is required";
        } else {
            $_POST[$field] = validateFormInput($_POST[$field]);
        }
    }

    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Validate phone number format
    $phonePattern = "/^\d{10}$/"; // Adjust the pattern based on your requirements
    if (!preg_match($phonePattern, $_POST['phone'])) {
        $errors['phone'] = "Invalid phone number format";
    }

    // If there are no errors, you can process the form data
    if (empty($errors)) {
        // Retrieve and sanitize form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $currentState = $_POST['currentState'];
        $currentCity = $_POST['currentCity'];
        $newState = $_POST['newState'];
        $newCity = $_POST['newCity'];
        $newAddress = $_POST['newAddress'];
        $movingDate = $_POST['movingDate'];

        // Add your database insertion or other processing logic here
        // For example, you can use MySQLi or PDO to insert data into a database
        // Make sure to handle SQL injection properly

        // Redirect after successful submission (optional)
        header("Location: success_page.html");
        exit();
    }
}
?>