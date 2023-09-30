<?php
    require "connection.php";
    // $return = array(
    //     'status' => 200,
    //     'message' => " Successful."
    // );
    // echo json_encode($return);
    $sql = "SELECT * FROM sampledata";
    $result = $conn->query($sql);
   
    if(!$result) {
         $return = array(
        'status' => "error",
        'message' => " Unsuccessful fetchdata.");
        echo json_encode($return);
    }else {
        echo json_encode($result->fetchAll());
    }
?>