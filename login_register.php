<?php
require('connection.php');

// Register new user
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the username or email already exists
    $user_exist_query = "SELECT * FROM registered_user WHERE username='$username' OR email='$email'";
    $result = $con->query($user_exist_query);

    if ($result) {
        if ($result->num_rows > 0) {
            $result_fetch = $result->fetch_assoc();
            if ($result_fetch['username'] === $username) {
                echo "<script>alert('Username already taken'); window.location.href='signup.html';</script>";
            } else {
                echo "<script>alert('Email already taken'); window.location.href='signup.html';</script>";
            }
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO registered_user (fullname, username, email, password) VALUES ('$fullname', '$username', '$email', '$hashed_password')";
            if ($con->query($query)) {
                echo "<script>alert('Registration successful'); window.location.href='login.html';</script>";
            } else {
                echo "<script>alert('Registration failed'); window.location.href='signup.html';</script>";
            }
        }
    } else {
        echo "<script>alert('Query failed'); window.location.href='signup.html';</script>";
    }
}

// Login existing user
if (isset($_POST['login'])) {
    $email_username = $_POST['email_username'];
    $password = $_POST['password'];

    // Check if user exists
    $query = "SELECT * FROM registered_user WHERE email='$email_username' OR username='$email_username'";
    $result = $con->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                echo "<script>alert('Login successful'); window.location.href='welcome.html';</script>";
            } else {
                echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('User not found'); window.location.href='login.html';</script>";
        }
    }}
   
