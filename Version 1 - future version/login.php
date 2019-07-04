<?

require_once "config.php";

$username = $mysqli->escape_string($_POST['username']);

$results=$mysqli->query("SELECT * FROM accounts where username='$username'");

if($results->$num_rows==0)
{
  $_SESSION['message']="Username does not exist!"
  header("error.php")
}
else{

$user=$results->fetch_assoc();
print_r($user);
die;

//if(password_verify($_POST, hash))

}

/*
$errors=array();

// LOGIN USER
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['Username'] = $username;
  	  header('location: dashboard.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
  */
?>