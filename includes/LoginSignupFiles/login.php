
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
                echo "<script>alert('Login successful'); window.location.href='Index.html\includes\LoginSignupFiles\.' ; </script>"; //i have to fix it 
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