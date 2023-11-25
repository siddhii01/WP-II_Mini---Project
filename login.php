<?php
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "furnish";

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $email = $_POST['email'];
                $password = $_POST['password'];
                $stmt = $conn->prepare("SELECT * FROM furnish WHERE email = :email AND password = :password");
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    header("Location: homepage.html");
                } else {
                    echo "<p>Invalid username or password. Please try again.</p>";
                }

                $conn = null;
            }
            ?>