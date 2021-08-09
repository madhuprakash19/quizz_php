<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Add qp</title>
  </head>
  <body>
    <div class=" jumbotron-fluid container-fluid container">
    <h1>Fill below to add question and options</h1>
    <form action = "qp.php" method = "POST">
  <div class="mb-3">
    <label  class="form-label">Question</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "question">
  </div>
  <div class="mb-3">
    <label  class="form-label">Option 1</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "op1">
  </div>
  <div class="mb-3">
    <label  class="form-label">Option 2</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "op2">
  </div>
  <div class="mb-3">
    <label  class="form-label">Option 3</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "op3">
  </div>
  <div class="mb-3">
    <label  class="form-label">Option 4</label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "op4">
  </div>
  <div class="mb-3">
    <label  class="form-label">Enter correct option number</label>
    <input type="number" class="form-control"  aria-describedby="emailHelp" name = "ans">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    
  </body>
</html>

<?php
session_start();
$subject = $_SESSION['subject'];
// echo $subject;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
die("Connection failed:  ".$conn->connect_error);
}
// echo "Connection Sucess";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $question = $_POST["question"];
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $op3 = $_POST["op3"];
    $op4 = $_POST["op4"];
    $ans = $_POST["ans"];
    // insert into table

    
    $sql = "INSERT INTO ".$subject."(question,op1,op2,op3,op4,ans)
    VALUES ('".$question."','".$op1."','".$op2."','".$op3."','".$op4."','".$ans."')";

    if($conn->query($sql) === TRUE){
        echo "<br>";
        echo $question." Question added";
        echo "<br><hr><br>";
        
        
    }
    else{
        echo "Error: ".$sql. "<br>".$conn->error;
    }

    echo "Copy below URL. Send to your students to start quizz <br>";
    echo "http://localhost/quizz/student.php/?sub=".$subject."<br><br><hr>";

    $sqld = "SELECT question,op1,op2,op3,op4,ans FROM ".$subject;
    $result = $conn->query($sqld);

    if ($result->num_rows > 0) {
  // output data of each row
  $count = 0;
   while($row = $result->fetch_assoc()) {
    $count++;
    echo $count." : " . $row["question"]. "<br>a) " . $row["op1"]. " " ."<br>b) " . $row["op2"]. " " ."<br>c) " . $row["op3"]. " " ."<br>d) " . $row["op4"]. " <br><br>";
  }
} else {
  echo "0 results";
}

    $conn->close();


}




?>
