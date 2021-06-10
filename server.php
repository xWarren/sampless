<?php
  session_start();
  
  $firstname = "";
  $middlename = "";
  $lastname = "";
  $email = ""; 
  $dateofbirth = "";
  $contactnumber = "";
  $address = "";
  $username = "";
  $password_1 = "";
  $password_2 = "";
  $errors = array();

   // connect to the database
  $db = mysqli_connect('localhost', 'root', '', 'mydb');

  // if the register button is clicked
  if(isset($_POST['register'])) {
    $firstname = mysqli_escape_string($db, $_POST['firstname']);
    $middlename = mysqli_escape_string($db, $_POST['middlename']);
    $lastname = mysqli_escape_string($db, $_POST['lastname']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $dateofbirth = mysqli_escape_string($db, $_POST['dateofbirth']);
    $contactnumber = mysqli_escape_string($db, $_POST['contactnumber']);
    $address = mysqli_escape_string($db, $_POST['address']);
    $username = mysqli_escape_string($db, $_POST['username']);
    $password_1 = mysqli_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_escape_string($db, $_POST['password_2']);

   // ensure that form fields are filled properly
    if (empty($firstname)) {
       array_push($errors, "First Name is required");
    }
    if (empty($middlename)) {
       array_push($errors, "Middle Name is required");
    }
    if (empty($lastname)) {
       array_push($errors, "Last Name is required");
    }
    if (empty($email)) {
       array_push($errors, "Email is required");
    }
    if (empty($dateofbirth)) {
       array_push($errors, "Date of Birth is required");
    }
    if (empty($contactnumber)) {
       array_push($errors, "Contact Number is required");
    }
    if (empty($address)) {
       array_push($errors, "Address is required");
    }
    if (empty($username)) {
       array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
       array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
       array_push($errors, "The two passwords do not match");
    }

       // if there are no errors, save user to database
    if (count($errors) == 0) {
       $password = ($password_1); 
       $sql = "INSERT INTO mytable (firstname, middlename, lastname, email, dateofbirth, contactnumber, address, username, password) VALUES ('$firstname', '$middlename', '$lastname', '$email', '$dateofbirth', '$contactnumber', '$address', '$username', '$password')";
          $_SESSION['username'] = $username;
         $_SESSION['success'] = "You are now logged in";
         header('location: index.php'); //redirect to home page
           $result = mysqli_query($db, $sql);
        $sql_select = "SELECT * FROM mytable WHERE username='$username' and password ='$password'";
        $sql_select_result = mysqli_query($db, $sql_select);
        $sql_resultCheck = mysqli_num_rows($sql_select_result);
        $column = mysqli_fetch_assoc($sql_select_result);

          if ($sql_resultCheck > 0) {
            $_SESSION['firstname'] = $column['firstname'];
            $_SESSION['middlename'] = $column['middlename'];
            $_SESSION['lastname'] = $column['lastname'];
            $_SESSION['email'] = $column['email'];
            $_SESSION['dateofbirth'] = $column['dateofbirth'];
            $_SESSION['contactnumber'] = $column['contactnumber'];
            $_SESSION['address'] = $column['address'];

       }
    }

 }
    // log user in from login page
      if (isset($_POST['login'])) {
    $username = mysqli_escape_string($db, $_POST['username']);
    $password = mysqli_escape_string($db, $_POST['password']);
    if (empty($username)) {
       array_push($errors, "Username is required");
    } 
    if (empty($password)) {
       array_push($errors, "Password is required");
    }      
    if (count($errors) == 0 ) {
      $password = ($password);
      $query = "SELECT * FROM mytable WHERE username ='$username' AND password ='$password'";
      $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 1){
           //log user in
       $_SESSION['username'] = $username;
         $_SESSION['success'] = "You are now logged in";
         header('location: loading.php'); //redirect to home page
        }else{
          array_push($errors, "Invalid username/password");
        }
     }
  }
      //logout
      if (isset($_GET['logout'])) {
          session_destroy();
          unset($_SESSION['username']);
          header('location: register.php');
      }

 ?>