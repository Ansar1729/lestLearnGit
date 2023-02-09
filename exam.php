<?php
  if(isset($_POST['save'])){
     include "config.php";


     $fname = mysqli_real_escape_string($conn,$_POST['fname']);
     $lname = mysqli_real_escape_string($conn,$_POST['lname']);
     $user = mysqli_real_escape_string($conn,$_POST['user']);
     $password = mysqli_real_escape_string($conn, md5($_POST['password']));
     $class = mysqli_real_escape_string($conn,$_POST['class']);
     $subject = mysqli_real_escape_string($conn,$_POST['subject']);
  

    
     $sql = "SELECT username FROM user WHERE username = '{$user}' ";

     $result = mysqli_query($conn,$sql) or die("Query is failed ");
  
      if(mysqli_num_rows($result)>0){
          echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";

      }else{
        $sql1 = "INSERT INTO user (first_name,last_name,username,password ,class,subject) VALUES('{$fname}','{$lname}','{$user}','{$password}','{$class}','{$subject}')";
        if(mysqli_query($conn,$sql1)){
          header("location:http://localhost/kemia_galaxy/payment.php");
          
        }else{
          echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
        }
      }

  }
 

 
 
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
       <link rel="stylesheet" href="style1.css">
</head>

<body>

<div id="admin-content">
      <div class="container">
          <div class="row d-flex justify-content-center ">
              <div class="col-md-12  ">
                  <h1 class="admin-heading">Exam Form </h1>
              </div>
              
              <div class=" card  col-md-offset-3 col-md-6 "  >
                  <!-- Form Start -->
                  <form class="form"  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group m-2">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group m-2">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group m-2">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group m-2">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group m-2">
                          <label>Class</label>
                          <select class="form-control" name="class" >
                             <?php 
                                include "config.php";
                                $sql1 = "SELECT * FROM  class_type ";
                                $result1 = mysqli_query($conn,$sql1) or die(" sub  query is faile ");

                                if(mysqli_num_rows($result1)>0){
                                    while($row = mysqli_fetch_assoc($result1)){
                                        echo "<option value='{$row['class_id']}'>{$row['class_name']}</option>";

                                    }
                                }
                             ?>    
                          </select>
                      </div>
                      <div class="form-group m-2">
                          <label>subject</label>
                          <select class="form-control" name="subject" >

                          <?php 
                                include "config.php";
                                $sql2 = "SELECT * FROM  subject_type ";
                                $result2 = mysqli_query($conn,$sql2) or die(" sub  query is faile ");

                                if(mysqli_num_rows($result2)>0){
                                    while($row = mysqli_fetch_assoc($result2)){
                                        echo "<option value='{$row['subject_id']}'>{$row['subject_name']}</option>";

                                    }
                                }
                                ?>  
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary m-2" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>

</body>
</html>