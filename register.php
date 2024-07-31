<?php
// database connection
$host = 'localhost';
$dbname = 'root';
$username = '';
$password = 'reg';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthDate = $_POST['birth_date'];
    $tier = 'MEMBER'; // Default tier

    $sql = "INSERT INTO Users (FirstName, LastName, Phone, Email, PasswordHash, BirthDate, Tier) VALUES (:firstName, :lastName, :phone, :email, :password, :birthDate, :tier)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':firstName' => $firstName, ':lastName' => $lastName, ':phone' => $phone, ':email' => $email, ':password' => $password, ':birthDate' => $birthDate, ':tier' => $tier]);
        echo "Registration successful!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post">
        <label>First Name:</label><input type="text" name="first_name" required><br>
        <label>Last Name:</label><input type="text" name="last_name" required><br>
        <label>Phone:</label><input type="text" name="phone" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Birth Date:</label><input type="date" name="birth_date" required><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
