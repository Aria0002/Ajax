<?php  
 if(isset($_POST["action"]))  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost","boeken_ajax", "Rotterdam100", "boeken_ajax");  
      if($_POST["action"] =="Add")  
      {  
           $title = mysqli_real_escape_string($connect, $_POST["title"]);  
           $author = mysqli_real_escape_string($connect, $_POST["author"]);  
           $isbn = mysqli_real_escape_string($connect, $_POST["isbn"]);  

           $procedure = "  
                CREATE PROCEDURE insertUser(IN title varchar(255), author varchar(255), isbn varchar(13))  
                BEGIN  
                INSERT INTO boeken(title, author, isbn) VALUES (title, author, isbn);   
                END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS insertUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL insertUser('".$title."', '".$author."', '".$isbn."')";  
                     mysqli_query($connect, $query);  
                     echo 'Boek toegevoegd';  
                }  
           }  
      }  
      if($_POST["action"] == "Edit")  
      {  
           $title = mysqli_real_escape_string($connect, $_POST["title"]);  
           $author = mysqli_real_escape_string($connect, $_POST["author"]);  
           $isbn = mysqli_real_escape_string($connect, $_POST["isbn"]);   
           $procedure = "  
                CREATE PROCEDURE updateUser(IN user_id int(11), title varchar(255), author varchar(255), isbn varchar(255))  
                BEGIN   
                UPDATE boeken SET title = title, author = author, isbn = isbn
                WHERE id = user_id;  
                END;   
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS updateUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL updateUser('".$_POST["id"]."', '".$title."', '".$author."', '".$isbn."' )";  
                     mysqli_query($connect, $query);  
                     echo 'Boek geupdate';  
                }  
           }  
      }  
      if($_POST["action"] == "Delete")  
      {  
           $procedure = "  
           CREATE PROCEDURE deleteUser(IN user_id int(11))  
           BEGIN   
           DELETE FROM boeken WHERE id = user_id;  
           END;  
           ";  
           if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteUser"))  
           {  
                if(mysqli_query($connect, $procedure))  
                {  
                     $query = "CALL deleteUser('".$_POST["id"]."')";  
                     mysqli_query($connect, $query);  
                     echo 'Boek verwijderd';  
                }  
           }  
      }  
 }  
 ?>  