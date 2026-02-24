<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'bookingabc');

// Check connection
if ($conn->connect_error) {
    error_log("Database Connection Error: " . $conn->connect_error);
    die("Database connection failed. Please try again later.");
}

// Get form data with validation
$name = $_POST["name"] ?? '';
$phone = $_POST["phone"] ?? '';
$person_outline = $_POST["person_outline"] ?? '';
$date = $_POST["date"] ?? '';
$time_outline = $_POST["time_outline"] ?? '';
$message = $_POST["message"] ?? '';

// Sanitize inputs
$name = htmlspecialchars(trim($name));
$phone = trim($phone);
$person_outline = trim($person_outline);
$date = trim($date);
$time_outline = trim($time_outline);
$message = htmlspecialchars(trim($message));

// Validate phone number (digits only, 7-15 characters)
if (!preg_match("/^\+?[0-9]{7,15}$/", $phone)) {
    die("Invalid phone number format.");
}

// Validate person count
if (!filter_var($person_outline, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
    die("Invalid number of people.");
}

// Validate date format (YYYY-MM-DD)
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
    die("Invalid date format. Please use YYYY-MM-DD.");
}

// Validate time format (HH:MM:SS)
if (!preg_match("/^\d{2}:\d{2}:\d{2}$/", $time_outline)) {
    die("Invalid time format. Please use HH:MM:SS.");
}

// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO tablexyz (name, phone, person, date, time, message) VALUES (?, ?, ?, ?, ?, ?)");

if ($stmt) {
    $stmt->bind_param("siisss", $name, $phone, $person_outline, $date, $time_outline, $message);

    if ($stmt->execute()) {
        echo "You have successfully booked a table!";
    } else {
        error_log("SQL Error: " . $stmt->error);
        echo "Something went wrong. Please try again.";
    }

    $stmt->close();
} else {
    error_log("SQL Preparation Error: " . $conn->error);
    echo "We encountered a problem. Please try again later.";
}

// Close the connection
$conn->close();
?>
