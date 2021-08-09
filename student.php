<?php
$subject = strval($_GET['sub']);

// echo $exam;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
die("Connection failed:  ".$conn->connect_error);
}
$sqld = "SELECT question,op1,op2,op3,op4,ans FROM ".$subject;
$result = $conn->query($sqld);
$count = 0;
echo '
<form action = "/quizz/check.php/?sub='.$subject.'" method = "GET">
  <div class="mb-3">
    <label  class="form-label">Enter your name </label>
    <input type="text" class="form-control"  aria-describedby="emailHelp" name = "name">
  </div>
  <input type="hidden" value="'.$subject.'" name = "sub">';
  while($row = $result->fetch_assoc()){
    $count++;
    echo $count." : <b>".$row["question"]. "</b><br><br>";
    echo ' <div class="form-check">
    <input class="form-check-input" type="radio" name="q'.$count.'" id="gridRadios1" value="1" >
    <label class="form-check-label" for="gridRadios1">
      '.$row["op1"] .'
    </label>
  </div><br>  ';
  echo ' <div class="form-check">
    <input class="form-check-input" type="radio" name="q'.$count.'" id="gridRadios1" value="2" >
    <label class="form-check-label" for="gridRadios1">
      '.$row["op2"] .'
    </label>
  </div><br>  ';
  echo ' <div class="form-check">
    <input class="form-check-input" type="radio" name="q'.$count.'" id="gridRadios1" value="3" >
    <label class="form-check-label" for="gridRadios1">
      '.$row["op3"] .'
    </label>
  </div><br>  ';
  echo ' <div class="form-check">
    <input class="form-check-input" type="radio" name="q'.$count.'" id="gridRadios1" value="4" >
    <label class="form-check-label" for="gridRadios1">
      '.$row["op4"] .'
    </label>
  </div><br>  ';
  }
  echo '<input type="hidden" value="'.$count.'" name = "count">';
  echo '<button type="submit" class="btn btn-primary">Submit</button>
</form>
';



?>