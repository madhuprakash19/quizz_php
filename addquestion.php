<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Subject</title>
  </head>
  <body>
    <h1>Please enter your subject to continue</h1>
    <form action = "addquestion.php" method = "POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Subject Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "subject">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // taking input of subject name from the user
    $name = $_POST["subject"];
    // echo $name;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quizz";
    $conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
    die("Connection failed:  ".$conn->connect_error);
}
// echo $name;
// crweating a sql table with the subject name
$sql = "CREATE TABLE ".$name."(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(100) NOT NULL,
    op1 VARCHAR(20) NOT NULL,
    op2 VARCHAR(20) NOT NULL,
    op3 VARCHAR(20) NOT NULL,
    op4 VARCHAR(20) NOT NULL,
    ans INT(2) NOT NULL
)";

if($conn->query($sql) === TRUE)
{
    echo $name." Subject table created";
    echo "<br><br>";
    $_SESSION['subject'] = $name;
    
    // passing subject value to the next page using get method
    echo "<a href='qp.php'>Click here to add question</a>";
    

}
else{
    echo "Error creating table :".$conn->error;
}
$conn->close();

}



?>