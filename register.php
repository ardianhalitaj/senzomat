<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = "";
$password = "";
$confirm_password = "";
$username_err = "";
$password_err = "";
$confirm_password_err = "";
$email_err = "";
$name = "";
$surname = "";
$business_name = "";
$business_number = "";
$email = "";
$phone_number = ""; 

// Processing form data when form is submitted
if(isset($_POST['register'])){
 
    // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password_1']);
  $confirm_password = mysqli_real_escape_string($db, $_POST['password_2']);
  $name=mysqli_real_escape_string($db, $_POST['name']);
  $surname=mysqli_real_escape_string($db, $_POST['surname']);
  $business_name=mysqli_real_escape_string($db, $_POST['business_name']);
  $business_number=mysqli_real_escape_string($db, $_POST['business_number']);
  $phone_number=mysqli_real_escape_string($db, $_POST['phone']);


    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } 
    else{

    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM Accounts WHERE Username='$username' OR Email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        
        if($user){
            if ($user['username'] === $username) {
               $username_err = "This username is already taken.";
            }

            if ($user['email'] === $email) {
              $email_err = "E-mail is already taken.";
            }
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO Accounts (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

