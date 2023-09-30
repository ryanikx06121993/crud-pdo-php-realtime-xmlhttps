<?php

if(!array_keys($_REQUEST)) {
    header('Location:index.php', true);
    return false;
}
else {

    // echo json_encode($_REQUEST);
    // echo $_GET['id'];
    require('connection.php');
    $sql = "SELECT * FROM sampledata WHERE id = :id";
    $bind = array( 'id' =>  $_REQUEST['id'] );
    $stmt = $conn->prepare($sql);
    $stmt->execute($bind);
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo json_encode($rows);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container update">
        <h1>UPDATE DATA</h1>
     <form action="" method="POST" onsubmit="return editData();">
     <input type="hidden" name="id" id="id" value="<?=$rows['id'] ?>">
     <input type="text" name="fname" id="fname" value="<?=$rows['fname'] ?>"  placeholder=""><br><br> 
     <input type="text" name="lname" id="lname" value="<?=$rows['lname'] ?>" placeholder=""><br><br> 
     <input type="text" name="age" id="age" value="<?=$rows['age'] ?>" placeholder=""><br><br> 
     <input type="submit" name="update" value="Update">
     </form>
  
     </div>   
</body>
<script>
    // FUNCTION FOR EDIT DATA POST PHP
function editData() {
"use strict";
  var id = document.getElementById("id").value;
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var age = document.getElementById("age").value;

  var params =
    "id=" + id + "&fname=" + fname + "&lname=" + lname + "&age=" + age;
  //   console.log(params);
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "edit-script.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(params);

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //   console.log(this);
      var data = JSON.parse(this.response);
      console.log(data);
      if (data.type == "success") {
        window.alert("Succesfully data updated");
        window.location.href = "index.php";
      } else {
        alert(data.msg);
        window.location.reload();
    }
      }
    }
    //   important for running the function insert
    return false;
  };

</script>
</html>


<?php
}
?>