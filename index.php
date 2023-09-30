
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <div class="container insertdata">
        <h1>INSERT DATA</h1>
     <form action="" method="POST" onsubmit="return addData();">
     <input type="text" id="fname" name="fname" placeholder="fname" required><br><br>
     <input type="text" id="lname" name="fname" placeholder="lname" required><br><br>
     <input type="number" id="age" name="age" placeholder="age" required><br><br>
     <input type="submit" name="submit">
     </form>
  
     </div>   
    <div class="container display-data">
        <h1>DISPLAY DATA</h1>
        <table>
             <thead>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Age</th>
             </thead>   
             <tbody id="data"></tbody>
        </table>
    </div>
</body>
<script>
    // FUNCTION FOR DISPLAYING DATA FROM DATABASE PHP MYSQL
"use strict";
function display_data() {
  //   console.log(xhr);
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "get-data.php", true);
  xhr.send();

  xhr.onreadystatechange = function () {
    // console.log(this);
    if (this.readyState == 4 && this.status == 200) {
      // this way i can see the result in json format from php get-data
      console.log("this is a response XMLHttpRequest");
      console.log(this);
      //   var data use to conver json files data into object
      var data = JSON.parse(this.responseText);
      //   //   console.log(this);
      var html = "";
      //   for to loop all multiple data arrays
      for (var i = 0; i < data.length; i++) {
        console.log(data);
        // var id = data[i].id;
        // console.log(id);
        html += "<tr>";
        html += "<td>" + data[i].fname + "</td>";
        html += "<td>" + data[i][2] + "</td>";
        html += "<td>" + data[i].age + "</td>";
        html += `<td><a href='edit.php?id=${data[i][0]}'><button>Edit</button></a>`;
        html += ` | `;
        // html += `<a href='javascript:delData("${data[i].id}") ' id="delete">Delete</a></td>`;
        html += "<td><button onclick='deleteData(\"" + data[i].id + "\")'>Delete</button></td>";
        html += "</tr>";
      }
      document.getElementById("data").innerHTML += html;
    }
  };
}

display_data();
// ===========================================================================================
// FUNCTION FOR INSERTING DATA POST PHP
function addData(event) {
  //   event.preventDefault();
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var age = document.getElementById("age").value;
  // var params = ("fname=" + fname) & ("lname=" + lname) & ("age=" + age);
  var params = "fname=" + fname + "&lname=" + lname + "&age=" + age;

  //   console.log(age);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "save-data.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(params);

  xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.response);
      var data = JSON.parse(this.response);
      // console.log(data);
      if (data.status == "success") {
        alert("Data inserted successfully");
        window.location.reload();
      } else {
        console.log(data.status);
      }
    }
  };

  //   important for running the function insert
  return false;
}
// ===========================================================================================
// DELETE FUNCTION

// // and argument from function click delete from ${data[i].id}
// function delData(id){

//     // alert(delete_id);
//     if (confirm("Are you sure you want to delete this record?")) {
//     //   window.location = "product.php?did="+product_id;
//     // console.log(delete_id);
//  var delete_id = id;
// var xhr = new XMLHttpRequest();
//   xhr.open("POST", "delete.php", true);
//   xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xhr.send(delete_id);

//   xhr.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//       // console.log(this.response);
//       var data = JSON.parse(this.response);
//       // console.log(data);
//     //   if (data.status == "success") {
//     //     alert("Data inserted successfully");
//     //     window.location.reload();
//     //   } else {
//     //     console.log(data.status);
//     //   }
//     }
//   };
//   }
    
// }

function deleteData(id) {
    if (confirm("Are you sure you want to delete this record?")) {
        var ajax = new XMLHttpRequest();
        ajax.open("POST", "delete.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.send("id=" + id);
 
        ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this);
                var data = JSON.parse(this.response);
                if (data.type == "success") {
                    window.alert("Succesfully data deleted");
                    // window.location.href = "index.php";
                    window.location.reload();
                } else {
                    alert(data.msg);
                    window.location.reload();
                }
                        }
        };
    }
}



</script>
</html>