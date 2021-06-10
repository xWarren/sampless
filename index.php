<?php 
include ('server.php');
$db=mysqli_connect("localhost","root","","mydb");
$query = "SELECT id FROM mytable";
$result = mysqli_query($db, $query);
$row=mysqli_fetch_assoc($result);
?>
<html>
<head>
  <title>My Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">
</head>
<body>
      <div class="hero">
  
<div class="navbar">
  <a href="#">Home</a>
  <a href="#">News</a>
  <div class="dropdown">
  <button class="dropbtn" onclick="myFunction()"><?php if (isset($_SESSION["username"])): ?>
        <?php echo $_SESSION['username']; ?>
       <i class="zmdi zmdi-caret-down"></i>
  <?php endif ?>
  </button>
  <div class="dropdown-content" id="myDropdown">
   <?php echo"<a href='display.php?personalid=".$_SESSION['username']."'>Personal Information</a>"; ?>
    <a href="cp.php">Change Password</a>
    <a href="update.php">Update Personal Information</a>
    <a href="login.php" class="logout">Logout</a>
  </div>
  </div> 
</div>
        <div class="content">
          <small>Welcome to</small>
          <h1>Bikini Bottom</h1>
    </div>
        <div class="bubbles">
          <img src="images/bubble.png">
          <img src="images/bubble.png">
          <img src="images/bubble.png">
          <img src="images/bubble.png">
          <img src="images/bubble.png">
          <img src="images/bubble.png">
          <img src="images/bubble.png">

        </div>
   </div>
   
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(e) {
  if (!e.target.matches('.dropbtn')) {
  var myDropdown = document.getElementById("myDropdown");
    if (myDropdown.classList.contains('show')) {
      myDropdown.classList.remove('show');
    }
  }
}
</script>
</body>
</html>
