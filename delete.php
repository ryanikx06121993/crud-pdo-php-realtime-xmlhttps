<?php

    // echo json_encode($_REQUEST);

            if(!array_keys($_REQUEST)) {
                header('Location:index.php', true);
                return false;
            }else {
                // echo json_encode($_REQUEST);
                // echo "Success";
                try {
                    require("connection.php");
                    $query = "DELETE FROM sampledata WHERE id=:id";
                    $statement = $conn->prepare($query);
                    $data = [
                        ':id' => $_REQUEST['id']
                    ];
                    $query_execute = $statement->execute($data);
            
                    if($query_execute)
                    {
                        $msg = array(
                            'type' => 'success',
                            'msg' => 'Data deleted successfully'
                        );
                        echo json_encode($msg);
                        exit(0);
                
                    }
                    else
                    {
                        $msg = array(
                            'type' => 'error',
                            'msg' => 'Failed updated successfully'
                        );
                        echo json_encode($msg);
                        exit(0);
                    }
                } catch(PDOException $e){
                    echo $e->getMessage();
                }
            }


?>