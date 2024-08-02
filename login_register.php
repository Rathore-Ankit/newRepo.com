<?php
require('connection.php'); // Ensure this file establishes a connection

// Start a session to manage user data
session_start();

// Register new user
if (isset($_POST['register'])) {
    $fullname = $con->real_escape_string($_POST['fullname']);
    $username = $con->real_escape_string($_POST['username']);
    $email = $con->real_escape_string($_POST['email']);
    $password = $con->real_escape_string($_POST['password']);

    // Check if the username or email already exists
    $stmt = $con->prepare("SELECT * FROM registered_user WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $result_fetch = $result->fetch_assoc();
            if ($result_fetch['username'] === $username) {
                echo "<script>alert('Username already taken'); window.location.href='SignUp.html';</script>";
            } else {
                echo "<script>alert('Email already taken'); window.location.href='SignUp.html';</script>";
            }
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $con->prepare("INSERT INTO registered_user (fullname, username, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);
            if ($stmt->execute()) {
                echo "<script>alert('Registration successful'); window.location.href='NeemanLogin.html';</script>";
            } else {
                echo "<script>alert('Registration failed'); window.location.href='SignUp.html';</script>";
            }
        }
    } else {
        echo "<script>alert('Query failed'); window.location.href='SignUp.html';</script>";
    }
    $stmt->close();
}

// Login existing user
if (isset($_POST['login'])) {
    $email_username = $con->real_escape_string($_POST['email_username']);
    $password = $con->real_escape_string($_POST['password']);

    // Check if user exists
    $stmt = $con->prepare("SELECT * FROM registered_user WHERE email=? OR username=?");
    $stmt->bind_param("ss", $email_username, $email_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user; // Store user data in session
                echo "<script>alert('Login successful'); window.location.href='Index.html';</script>";
            } else {
                echo "<script>alert('Incorrect password'); window.location.href='SignUp.html';</script>";
            }
        } else {
            echo "<script>alert('User not found'); window.location.href='SignUp.html';</script>";
        }
    } else {
        echo "<script>alert('Query failed'); window.location.href='SignUp.html';</script>";
    }
    $stmt->close();
}

$con->close();
?>
