<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "furnish";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phoneNumber = $_POST['number'];
        $dob = $_POST['dob'];

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Invalid email address!");</script>';
        } else {
            $checkEmailStmt = $conn->prepare("SELECT * FROM furnish WHERE email = :email");
            $checkEmailStmt->bindParam(':email', $email);
            $checkEmailStmt->execute();

            if ($checkEmailStmt->rowCount() > 0) {
                echo '<script>alert("User with this email already exists!");</script>';
            } else {
                // Check if password and confirm password match
                if ($password !== $_POST['confirm-password']) {
                    echo '<script>alert("Passwords do not match!");</script>';
                } else {
                    // Validate phone number
                    if (!preg_match("/^[0-9]{10}$/", $phoneNumber)) {
                        echo '<script>alert("Invalid phone number!");</script>';
                    } else {
                        // Validate date of birth for minimum age
                        $today = new DateTime();
                        $birthDate = new DateTime($dob);
                        $age = $today->diff($birthDate)->y;
                        if ($age < 0) {
                            echo '<script>alert("You must be old enough to register.");</script>';
                        } else {
                            $stmt = $conn->prepare("INSERT INTO furnish (fullName, email, password, dob, number) VALUES (:fullName, :email, :password, :dob, :number)");
                            $stmt->bindParam(':fullName', $fullName);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':password', $password);
                            $stmt->bindParam(':dob', $dob);
                            $stmt->bindParam(':number', $phoneNumber);
                            $stmt->execute();

                            header("Location: login.html");
                            exit();
                        }
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>