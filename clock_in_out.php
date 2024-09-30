<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Display the username
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock In/Out</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { text-align: center; padding: 50px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
    <button id="clockIn">Clock In</button>
    <button id="clockOut">Clock Out</button>
</div>

<!-- JS for clock-in/clock-out functionality -->
<script>
    document.getElementById('clockIn').addEventListener('click', function() {
        // Implement clock in logic (open camera, scan QR, etc.)
        alert('Clock In clicked');
    });

    document.getElementById('clockOut').addEventListener('click', function() {
        // Implement clock out logic (open camera, scan QR, etc.)
        alert('Clock Out clicked');
    });
</script>

</body>
</html>
