<?php
        // echo json_encode($_REQUEST);
    if(!array_keys($_REQUEST)) {
        header('Location:index.php', true);
        return false;
    }
    else {
        require('connection.php');
            try {
                $query = "UPDATE sampledata SET fname=:fname, lname=:lname, age=:age WHERE id=:id LIMIT 1";
                $statement = $conn->prepare($query);
                $data = [
                    'id' => $_REQUEST['id'],
                    'fname' => $_REQUEST['fname'],
                    'lname' => $_REQUEST['lname'],
                    'age' => $_REQUEST['age']];
                if($statement->execute($data)) {
                        // $_SESSION['message'] = "Updated Successfully";
                        // header('Location: index.php');
                        $msg = array(
                            'type' => 'success',
                            'msg' => 'Data updated successfully'
                        );
                        echo json_encode($msg);
                        exit(0);
                    }else{
                        // $_SESSION['message'] = "Not Updated";
                        // header('Location: index.php');
                        $msg = array(
                            'type' => 'error',
                            'msg' => 'Failed updated successfully'
                        );
                        echo json_encode($msg);
                        exit(0);
                    }
                

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

    }

    








    ?>