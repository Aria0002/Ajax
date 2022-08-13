<html>  
      <head>  
           <title>Document</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <div class="container box">  
                <h3 align="center">Ajax opdracht 3.3-4.3</h3>  
                <br /><br />   
                <label>Naam van Boek</label>  
                <input type="text" name="title" id="title" class="form-control" />  
                <br />  
                <label>Schrijver van Boek</label>  
                <input type="text" name="author" id="author" class="form-control" /> 
                <br />  
                <label>ISBN Boek</label>  
                <input type="number" name="isbn" id="isbn" class="form-control" /> 
                <br /><br />  
                <div align="center">  
                     <input type="hidden" name="id" id="user_id" />  
                     <button type="button" name="action" id="action" class="btn btn-danger">Toevoegen</button>  
                </div>  
                <br />  
                <br />  
                <div id="result" class="table-responsive">  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      fetchUser();  
      function fetchUser()  
      {  
           var action = "Selecteer";  
           $.ajax({  
                url : "select.php",  
                method:"POST",  
                data:{action:action},  
                success:function(data){  
                     $('#title').val('');  
                     $('#author').val(''); 
                     $('#isbn').val('');  
                     $('#action').text("Add");  
                     $('#result').html(data);  
                }  
           });  
      }  
      $('#action').click(function(){  
           var title = $('#title').val();  
           var author = $('#author').val();  
           var isbn = $('#isbn').val();  
           var id = $('#user_id').val();  
           var action = $('#action').text();  
           if(title != '' && author != '' && isbn != '')  
           {  
                $.ajax({  
                     url : "action.php",  
                     method:"POST",  
                     data:{title:title, author:author, isbn:isbn, id:id, action:action},  
                     success:function(data){  
                          alert(data);  
                          fetchUser();  
                     }  
                });  
           }  
           else  
           {  
                alert("Een veld is niet ingevuld");  
           }  
      });  
      $(document).on('click', '.update', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                     $('#action').text("Edit");  
                     $('#user_id').val(id);  
                     $('#title').val(data.title);  
                     $('#author').val(data.author);  
                     $('#isbn').val(data.isbn);  
                }  
           })  
      });  
      $(document).on('click', '.delete', function(){  
           var id = $(this).attr("id");  
           if(confirm("wil je deze verwijderen?"))  
           {  
                var action = "Delete";  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data:{id:id, action:action},  
                     success:function(data)  
                     {  
                          fetchUser();  
                          alert(data);  
                     }  
                })  
           }  
           else  
           {  
                return false;  
           }  
      });  
 });  
 </script>  