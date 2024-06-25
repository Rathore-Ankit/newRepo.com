<?php
include ("connection.php");
if(isset($_POST['submit'])){
    $first_name=$_POST['fname'];
    $last_name=$_POST['lname'];

    $email =$_POST['email'];
    $password=$_POST['pass'];
    $cpassword=$_POST['cpass'];


$sql = "SELECT * FROM  'loginform where FirstName='$first_name'";
$result = mysqli_query($conn , $sql);
$count_user_first_name = mysqli_num_rows($result);

$sql = "SELECT * FROM  'loginform' where LastName='$last_name'";
$result = mysqli_query($conn , $sql);
$count_user_last_name = mysqli_num_rows($result);

$sql = "SELECT * FROM 'loginform' where Email='$email'";
$result = mysqli_query($conn , $sql);
$count_email = mysqli_num_rows($result);


if($count_user_first_name == 0 & $count_email == 0 ){

    if($password==$cpassword){
        $hash=password_hash($password , PASSWORD_DEFAULT);
        $sql ="INSERT INTO loginform (FirstName ,LastName ,Email ,Password) VALUES('$first_name' , '$last_name' , '$email' , '$hash' )";
        $result = mysqli_query ($conn ,$sql);
        if($result){
            header("Location: Welcome.php")
        }
    }
}
else{
    if($count_user_first_name>0){
        echo  '<script>
        window.location.href="Signup.html";
        alert("username already exists");
        </script>';
    }

    if($count_email>0){
        echo  '<script>
        window.location.href="Signup.html";
        alert("email already exists");
        </script>';
    }
}

}

?>