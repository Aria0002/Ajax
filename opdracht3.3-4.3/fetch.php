<?php  
 $connect = mysqli_connect("localhost","boeken_ajax", "Rotterdam100", "boeken_ajax");  
 if(isset($_POST["id"]))  
 {  
      $output = array();  
      $procedure = "  
      CREATE PROCEDURE whereUser(IN user_id int(11))  
      BEGIN   
      SELECT * FROM boeken WHERE id = user_id;  
      END;   
      ";  
      if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS whereUser"))  
      {  
           if(mysqli_query($connect, $procedure))  
           {  
                $query = "CALL whereUser(".$_POST["id"].")";  
                $result = mysqli_query($connect, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     $output['title'] = $row["title"];  
                     $output['author'] = $row["author"];  
                     $output['isbn'] = $row["isbn"];  

                }  
                echo json_encode($output);  
           }  
      }  
 }  
 ?>  