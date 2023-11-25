<?php
// Define a function for validating form input
function validateFormInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your form fields and initialize error array
    $fields = ['name', 'email', 'phone', 'state', 'city', 'currentAddress', 'startDate', 'endDate'];
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

    // Validate date format
    $datePattern = "/^\d{4}-\d{2}-\d{2}$/"; // Adjust the pattern based on your requirements
    if (!preg_match($datePattern, $_POST['startDate']) || !preg_match($datePattern, $_POST['endDate'])) {
        $errors['dates'] = "Invalid date format";
    }

    // If there are no errors, you can process the form data
    if (empty($errors)) {
        // Retrieve and sanitize form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $currentAddress = $_POST['currentAddress'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Add your database insertion or other processing logic here
        // For example, you can use MySQLi or PDO to insert data into a database
        // Make sure to handle SQL injection properly

        // Redirect after successful submission (optional)
        header("Location: success_page.html");
        exit();
    }
}
?>