<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quizz";
$conn = new mysqli($servername,$username,$password,$dbname);

if($conn->connect_error){
die("Connection failed:  ".$conn->connect_error);
}
$i = 1;
$count = $_GET["count"];
$name = $_GET["name"];
$sub = $_GET["sub"];
// echo $i;
$ans = "";
while($i<=$count){
    $temp = $_GET["q".$i];
    $ans .= $temp;
    $i++;
}
// echo $ans;

$sql = "INSERT INTO student (name,subject,choice)
    VALUES ('".$name."','".$sub."','".$ans."')";



if($conn->query($sql) === TRUE){
    // echo "<br>SUCESS<br>";
    
    
}
else{
    echo "Error: ".$sql. "<br>".$conn->error;
}

$j = 0;
$score = 0;
$sqld = "SELECT ans FROM ".$sub;
    $result = $conn->query($sqld);
while($row = $result->fetch_assoc()) {
    
    if($ans[$j] == $row['ans']){
        $score+=1;
    }
    $j++;
  }
  echo "You scored : ".$score;



  $sql_score = "UPDATE student SET score = ".$score." WHERE name = '".$name."'";

  if($conn->query($sql_score) === TRUE){
    // echo "<br>SUCESS<br>";
    
    
}
else{
    echo "Error: ".$sql_score. "<br>".$conn->error;
}
?>



