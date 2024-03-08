<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Validation</title>

  <style>
    .error {
      color: red;
    }

    h1 {
      color: darkgreen;
    }
  </style>

</head>

</html>

<?php
$name = $email = $website = $comment = $gender = "";
$nameErr = $emailErr = $websiteErr = $commentErr = $genderErr = "";
 
if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(empty($_POST["name"])){
    $nameErr = "Name is required!";
  }
  else{
    $name = check_data($_POST["name"]);
    if(!preg_match("/[a-zA-Z-' ]*$/",$name)){
      $nameErr = "Only character and white spaces are allowed";
    }
  }

  if(empty($_POST["email"])){
    $emailErr = "Mail is required!";
  }
  else{
    $email = check_data($_POST["email"]);
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $emailErr = "Invalid E-mail";
    }
  }



  if(empty($_POST["website"])){
    $websiteErr = "";
  }
  else{
    $website = check_data($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    $websiteErr = "Invalid URL";
    }
  }

  if(empty($_POST["comment"])){
    $commentErr = "";
  }
  else{
    $comment = check_data($_POST["comment"]);
    
  }

  if(empty($_POST["gender"])){
    $genderErr = "Gender is required!";
  }
  else{
    $gender = check_data($_POST["gender"]);
    
  }
}

function check_data($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>PHP Form Validation</h1>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <label for="name">Name : </label>
  <input type="text" name="name" id="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>

  <label for="email">Mail : </label>
  <input type="text" name="email" id="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>

  <label for="website">Website : </label>
  <input type="text" name="website" id="website" value="<?php echo $website;?>"><br><br>

  <label for="comment">Comment : </label><br>
  <textarea name="comment" id="comment" cols="30" rows="10" value="<?php echo $comment;?>"></textarea><br><br>

  <label for="gender">Gender : </label>
  <input type="radio" name="gender" id="gender" value="Male" <?php if(isset($gender) && $gender=="Male") echo "checked";?>>Male
  <input type="radio" name="gender" id="gender" value="Female" <?php if(isset($gender) && $gender=="Female") echo "checked";?>>Female
  <input type="radio" name="gender" id="gender" value="Others" <?php if(isset($gender) && $gender=="Other") echo "checked";?>>Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>

  <button>submit</button>

</form>
<?php

echo "<h1> Your Input : </h1>";

echo $name;
echo "<br>";

echo $email;
echo "<br>";

echo $website;
echo "<br>";

echo $comment;
echo "<br>";

echo $gender;
echo "<br>";
?>
