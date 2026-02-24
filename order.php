<?php
// Database connection variables
$servername = "localhost"; // Database server
$username = "root";        // Database username (change if necessary)
$password = "";            // Database password (change if necessary)
$dbname = "food_order";    // Database name (make sure it matches the created database)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $meal_type = $_POST['meal_type'];
    $quantity = $_POST['quantity'];
    $message = $_POST['message'];

    // Prepare SQL query with prepared statements
    $stmt = $conn->prepare("INSERT INTO orders (name, phone, address, meal_type, quantity, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $phone, $address, $meal_type, $quantity, $message);

    // Execute the prepared statement and check for success
    if ($stmt->execute()) {
        // Show success message using JavaScript alert
        echo "<script type='text/javascript'>
                alert('Your table has been successfully booked!');
                window.location.href = 'Grilli.html'; // or redirect to any page
              </script>";
    } else {
        // If there was an error, show an error message
        echo "<script type='text/javascript'>
                alert('There was an error in booking your table. Please try again!');
                window.location.href = 'Grilli.html'; // or redirect to any page
              </script>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>