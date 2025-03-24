<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate inputs
        if (empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['username']) || empty($_POST['email']) || empty($_POST['number']) || empty($_POST['tournament']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo "No arguments Provided!";
                        exit;
                            }

                                // Assign form data to variables
                                    $firstName = $_POST['firstName'];
                                        $lastName = $_POST['lastName'];
                                            $username = $_POST['username'];
                                                $email = $_POST['email'];
                                                    $number = $_POST['number'];
                                                        $tournament = $_POST['tournament'];
                                                            $new = $_POST['new'];
                                                                $refer = $_POST['refer'];
                                                                    
                                                                        // Database connection details
                                                                            $servername = "sql313.byetcluster.com"; // Your server name
                                                                                $username = "if0_38226882"; // Your database username
                                                                                    $password = "vPwSH5XcSms"; // Replace with your actual database password
                                                                                        $dbname = "if0_38226882_register"; // Your database name

                                                                                            // Create connection
                                                                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                                                                    // Check connection
                                                                                                        if ($conn->connect_error) {
                                                                                                                die("Connection failed: " . $conn->connect_error);
                                                                                                                    }

                                                                                                                   
                                                                                                                                                                              } else {
                                                                                                                                                                                        // Insert new registration
                                                                                                                                                                                                $stmt = $conn->prepare("INSERT INTO registrations (firstName, lastName, username, email, number, tournament, new, refer) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                                                                                                                                                                                                        $stmt->bind_param("sssssssss", $firstName, $lastName, $username, $email, $number, $tournament, $new, $refer);

                                                                                                                                                                                                                if ($stmt->execute()) {
                                                                                                                                                                                                                            // Redirect on success
                                                                                                                                                                                                                                        header("Location: success.html");
                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                            // Display error if insertion fails
                                                                                                                                                                                                                                                                        echo "Error: " . $stmt->error;
                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                        $stmt->close();
                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                // Close connection
                                                                                                                                                                                                                                                                                                    $conn->close();
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                    ?>
