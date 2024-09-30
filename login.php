<?php
// Database connection details
$server = "mariuss.database.windows.net";
$username = "admin_mkg";
$password = "HyperX3146!";
$database = "BBIT_MKG"; // The database name

try {
    // Establish connection using PDO (SQL Server driver)
    $conn = new PDO("sqlsrv:server=$server;Database=$database;Encrypt=yes;TrustServerCertificate=no", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully!<br>";

    // List all tables in the current database for debugging purposes
    $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES";
    $stmt = $conn->query($sql);
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "Tables in the database:<br>";
    foreach ($tables as $table) {
        echo $table['TABLE_NAME'] . "<br>";
    }

    // Check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get username and password from the form
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        // Prepare and execute SQL query to check user in NewSchemaName.UserRocket
        $sql = "SELECT user_id, password_hash FROM NewSchemaName.UserRocket WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $inputUsername);
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and the password matches
        if ($user && password_verify($inputPassword, $user['password_hash'])) {
            // Password is correct, start a session and store user details
            session_start();
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $inputUsername;

            // Redirect to the clock-in/out page
            header("Location: clock_in_out.php");
            exit();
        } else {
            // Invalid username or password
            echo "Invalid username or password";
        }
    }
} catch (PDOException $e) {
    // Handle any connection errors
    echo "Error connecting to the database: " . $e->getMessage();
}
?>
