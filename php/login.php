<!-- Contributors: Po Wei Tsao (pt5rsx), Qasim Qasim (qq4fd) -->

<?php
 include_once("./library.php"); // To connect to the database
 if(true){
    $_GET = $_POST;
 }

 $con = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
 // Check connection
 if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }


 $sql="SELECT * FROM users WHERE userID='$_GET[email]' AND password='$_GET[password]'";


 if (!mysqli_query($con,$sql)) {
    die('Error: ' . mysqli_error($con));
 }  

 $result = mysqli_query($con,$sql);
 session_start();

 if (isset($_SESSION["signup_error_message"])){
    unset($_SESSION["signup_error_message"]);
}

if (isset($_SESSION["signup_success"])){
    unset($_SESSION["signup_success"]);
}

if (mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    // echo $row["email"];
    $_SESSION["userID"] = $row["userID"];
    // echo $_SESSION["userID"];
    if (isset($_SESSION["login_error_message"])){
        unset($_SESSION["login_error_message"]);
    }

    header("Location: ../homepage.php");
} else{
    // echo "Log in failed. Username and password combination not found. Please try again.";
    // sleep(5);
    $_SESSION["login_error_message"] = "Incorrect username and password.";
    header("Location: ../landing_page.php");

}


mysqli_close($con);
?>