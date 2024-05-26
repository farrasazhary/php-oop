<?php
require '../src/User.php';
// require_once __DIR__ . '/../src/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password);

    if ($user->register()) {
        echo "Registration successful! You can now <a href='index.php'>login</a>.";
    } else {
        echo "Registration failed! Username might already be taken.";
    }
} else {
    header("Location: ../public/register.php");
    exit();
}
?>
