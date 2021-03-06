<!DOCTYPE html>
<html lang="en">
   <head>
      <title>PuzzlePedia</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <link rel="icon" href="puz.png">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Quattrocento|Righteous|Yellowtail" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">
         .bg-4 { 
         background-color: #2f2f2f; /* Black Gray */
         color: #fff;
         }
         .b{ 
         background-color: #e6e6e6; /* light grey */
         color: #000000;
         }
         body {
            background-color: #c2d6d6;
            font-family: 'Quattrocento', serif;
        }
         h2{
            font-family: 'Lobster', cursive;
         }
      </style>
   </head>
   <body>
      <?php
         require 'connect.inc.php';
         require 'core.inc.php';
         ?>
      <nav class="navbar navbar-inverse ">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span> 
               </button>
               <a class="navbar-brand" href="index.php">PuzzlePedia</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="puzzlemine.php">Puzzle Mine</a></li>
                  <li class="active"><a href="practise.php">Practice</a></li>
                  <li><a href="leaderboard.php">Leaderboard</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                  <?php if(!loggedin())
                     {?>
                  <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a data-toggle="modal" data-target="#register"><span class="glyphicon glyphicon-edit"></span> Register</a></li>
                  <?php
                     }
                     else
                     {?>
                  <li><a href="add.php">Add Puzzle</a></li>
                  <li><a href="profile.php?id=<?php echo $_SESSION['id'];?>"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                  <li style="padding:5px"><button class="btn btn-primary" type="button">Score <span class="badge">
                     <?php
                        $query="select * from userinfo where id = '".$_SESSION['id']."' ";
                        if( $query_run = mysqli_query($con,$query) )  
                        {  
                          $result = $con->query($query);       
                          if ($result->num_rows > 0) 
                          {
                        
                          while($row = $result->fetch_assoc())
                          {
                         
                           echo $row['score'];?></span></button>
                  </li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                  <?php
                     }
                     }
                     }
                     
                     
                     }?>
               </ul>
            </div>
         </div>
      </nav>
      <div class="container">
         <div class="row">
            <?php 
               $query="select * from puzzle where level='-'";
               if( $query_run = mysqli_query($con,$query) )  
               {
               
               $result = $con->query($query);  
                 
               if ($result->num_rows > 0) 
               {
               while($row = $result->fetch_assoc())
               {
                     
               
                     ?>
            <div class="col-sm-6">
               <div class="panel panel-danger">
                  <div class="panel-heading"><?php echo $row['title'];?> 
                  </div>
                  <div class="panel-footer"><a href="showpract.php?id= <?php echo $row["id"]; ?>"><button type="button" class="btn btn-primary btn-md" >Try Now</button></a>
                  </div>
               </div>
            </div>
            <?php 
               } 
               } 
               
               }
               
               ?>
         </div>
      </div>
      <div class=" bg-4">
         <hr>
         <div class="text-center center-block">
            <h3>PuzzlePedia</h3>
            <h5>Think, Solve, Compete</h5>
            <h5>-Designed & Developed by <a href="https://in.linkedin.com/in/rahul-bagad-b7810bb0"><strong>Rahul Bagad</strong></a></h5>
            <a href="https://www.facebook.com/PuzzlePedia-933560270109874"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
            <a href=""><i id="social-tw" class="fa fa-github fa-3x social"></i></a>
            <a href="https://plus.google.com/u/0/114174056107999198883"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
            <a href="mailto:itspuzzlepedia@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
         </div>
         <center>
            <script type="text/javascript" src="http://widget.supercounters.com/hit.js"></script><script type="text/javascript">sc_hit(1353537,2,5);</script>
         </center>
      </div>
      <div class="modal fade" id="login" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title">Login</h4>
                  </center>
               </div>
               <div class="modal-body">
                  <form class="form" method="post" action="index.php">
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="lemail">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="lpwd">
                     </div>
                     <button type="submit" class="btn btn-default">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <a href="fp.php"><button type="button" class="btn btn-danger" data-dismiss="modal">Forgot Password</button></a>
                  <button type="button" class="btn btn-Warning" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="register" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title">Register</h4>
                  </center>
               </div>
               <div class="modal-body">
                  <form class="form" method="post" action="index.php">
                     <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name">
                     </div>
                     <div class="form-group">
                        <label for="contact">Contact No:</label>
                        <input type="text" class="form-control" name="contact">
                     </div>
                     <div class="form-group">
                        <label for="contact">Institute/Work Place:</label>
                        <input type="text" class="form-control" name="institute">
                     </div>
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email">
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="pwd">
                     </div>
                     <button type="submit" class="btn btn-default">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <?php
         if(!loggedin())
         {
         if(isset($_POST['lemail'])&&isset($_POST['lpwd'])) 
         {
         
             
             $eid = trim($_POST['lemail']); $pwd=trim($_POST['lpwd']); 
             
             if(!empty($eid) && !empty($pwd))
             {
             
           
             $query = "SELECT * FROM `userinfo` WHERE trim(`email`) = '$eid' AND trim(`password`) = '$pwd' ";
           if( $query_run = mysqli_query($con,$query) )  
           {
           
              $result = $con->query($query); 
               
               if ($result->num_rows > 0) 
                     {
                      while($row = $result->fetch_assoc())
               {
                        
                           $_SESSION['id']=$row['id'];
                           $_SESSION['eid']=$row['email'];
                           $_SESSION['name']=$row['name'];
                                 $_SESSION['contact']=$row['contact'];
                                
         
                           echo mysqli_error($con);
                           ?>
      <script type="text/javascript">
         alert("Successfully Logged In..");  
      </script>
      <?php
         header("Refresh:0");
         
         }
         }
         else
         {
         
         ?>
      <script type="text/javascript">
         alert("invalid Login Id or Password");
      </script>
      <?php               
         }           
         
         }
         else
         {
         ?>
      <script type="text/javascript">
         alert("Sorry an error Ocurred . Try again later");
      </script>
      <?php           
         }
         }
         else
         {
         ?>
      <script type="text/javascript">
         alert("Please fill in all fields");
      </script>
      <?php           
         }
                 
         }
         
         }
         
         ?>
      <?php
         if(!loggedin())
         {
         if(isset($_POST['email'])&&isset($_POST['pwd'])&&isset($_POST['name'])&&isset($_POST['institute'])) 
         {
             $eid = $_POST['email']; $pwd=$_POST['pwd']; $name=$_POST['name'];$institute=$_POST['institute'];
             $pwdhash=md5($pwd);
         
             if(isset($_FILES['img']))
             { 
               echo "i2";
               $fname = $_FILES['img']['name'];
               $ext = @strtolower(  end ( explode( '.', $fname) ) );
               $ftmp = $_FILES['img']['tmp_name'];
               echo $fname;
             }
         
         
             if( !empty($eid) && !empty($pwd) && !empty($name)&&!empty($institute))
             {
                 $query1= "SELECT email FROM userinfo WHERE trim(email)='".$eid."';";
                 $res=mysqli_query($con,$query1);
                 
                 if(mysqli_num_rows($res)>0)
                 {
         ?>
      <script type="text/javascript">
         alert("Already registered.");
      </script>
      <?php
         }
         else
         {
         
           if(!empty($fname))
           {   
             $tim = time();
             $iname = $tim.".".$ext;
         
             if(!empty($_POST['contact']))  
             {
                 $mob=$_POST['contact'];
                 $query="INSERT INTO `userinfo`( `email`, `password`, `name`, `contact`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$mob."','".$iname."','".$institute."')    ";
             }
             else
                 $query = "INSERT INTO `userinfo`( `email`, `password`, `name`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$iname."','".$institute."')    ";
             $path="img/profile/".$iname;
             if(move_uploaded_file($ftmp,$path));
                                                 
           
           }   
         
           else    
           {
             echo "i4";
             $tim = time();
             if(!empty($_POST['contact']))  
             {
                $mob=$_POST['contact'];
                $query = "INSERT INTO `userinfo`( `email`, `password`, `name`, `contact`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$mob."','ni.jpg','".$institute."')    ";
             }
             else   
                $query = "INSERT INTO `userinfo`( `email`, `password`, `name`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','ni.jpg','".$institute."')    ";
         
             
           }
         
         if( $query_run = mysqli_query($con,$query) )
         {
                 $subject="link for email verification";
                 $message = "Successfully registered";
                 mail($eid,$subject,$message,$headers);
                 ?>
      <script type="text/javascript">
         alert("Registered Successfully..");    
      </script>
      <?php
         header("Refresh:0");
            
         }
         else
         {
         ?>
      <script type="text/javascript">
         alert("Sorry an error Ocurred . Try again later");
      </script>
      <?php           
         }
         }
         }
         
         else
         {
         ?>
      <script type="text/javascript">
         alert("Please fill in all fields");
      </script>
      <?php           
         }
         }
         
         }
         
         ?> 
   </body>
</html>
