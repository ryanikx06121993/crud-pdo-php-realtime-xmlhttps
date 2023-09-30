<?php
       if($_SERVER["REQUEST_METHOD"] == "POST") {
        require "connection.php";

        function insert_data() {
                 // echo json_encode($_POST);
            global $conn;
                // SQL query string
                $sql = "INSERT INTO sampledata (fname, lname, age) VALUES(:fname, :lname, :age)";
                
                // Preparing the statement
                $result = $conn->prepare($sql);
                
                // Actually executing the query in database
                $result->execute(array(
                ":fname" => $_POST["fname"],
                ":lname" => $_POST["lname"],
                ":age" => $_POST["age"]
                ));

                if(!$result) {
                        $return = array(
                       'status' => "error",
                       'message' => " Unsuccessful fetchdata."
                   );
                       echo json_encode($return);
                   }
                
                   $return = array(
                    'status' => "success",
                    
                // Sending inserted ID back to AJAX
                    'message' => "The last ID number saved ".$conn->lastInsertId()
                );
                    echo json_encode($return);

        }
        // initialized code
        insert_data();
             
       }else {
        $return = array(
                'status' => "error",
                'message' => "Post not set."
            );
                echo json_encode($return);
       }
?>