<?php 
$host="localhost";
$name="root";
$pass="";
$db_name="form_db";

$connsql=mysqli_connect($host,$name,$pass);

if(!mysqli_connect($host,$name,$pass))
{
    echo " not connected";
}
$bdcreate="CREATE DATABASE  form_db";
$setdb=mysqli_query($connsql,$bdcreate);
if(isset($setdb))
{
    echo " database created";
}

$conndb=mysqli_connect($host,$name,$pass,$db_name);
if(isset($conndb))
{
    echo" db_name connet ";
}
$quritb="CREATE TABLE form_tb(

    id INT AUTO_INCREMENT PRIMARY key,
    name VARCHAR(250),
    phon INT,
    country TEXT,
    sallary INT
)";

if(mysqli_query($conndb,$quritb))
{
    echo "table create";
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">

     <form action="" method="POST">
         <div class="form-group">
             <label for="name">name</label>
             <input type="text" name="name" class="form-control">
         </div>
         <div class="form-group">
             <label for="phon">phon</label>
             <input type="text" name="phon" class="form-control">
         </div>
         <div class="form-group">
             <label for="country">country</label>
             <input type="text" name="country" class="form-control">
         </div>
         <div class="form-group">
             <label for="sallary">sallary</label>
             <input type="text" name="sallary" class="form-control">
         </div>
         <button type="submit" name="submit"class="btn btn-success">insert</button>
     </form>

    </div>
    </div>
        </div>

        <?php 
        //////////////// INASERT INTO DATABASE TABLE/////////////////////
        
        if(isset($_REQUEST['submit']))
        {
            $namef=$_REQUEST['name'];
            $phonf=$_REQUEST['phon'];
            $countryf=$_REQUEST['country'];
            $sallaryf=$_REQUEST['sallary'];
             
            if($namef!==""|| $phonf== !""||$countryf !==""||$sallaryf !=="")
            {
                $sqliinsert="INSERT INTO  form_tb (name,phon,country,sallary) VALUE('$namef','$phonf','$countryf','$sallaryf')";
                if(mysqli_query($conndb,$sqliinsert))
                {
                    echo "insert";
                }

            }
            else{
                echo "fillup all";
            }
         
        }
        //////////////// INSERT INTO DATABASE TABLE END/////////////////////
        
        ?>

        <?php 
        ////////////    DELETE  //////////////////////////////////
        if(isset($_REQUEST['delete']))
        {
            echo"delete call id=".$_REQUEST['id'];
        $deletequery="DELETE FROM form_tb WHERE id={$_REQUEST['id']}";
        if(mysqli_query($conndb,$deletequery))
        {
            echo" id:{$_REQUEST['id']} is deleted";
        }
        }
        else{
            echo"delete not  call";
        }
        
        ?>
        
        <?PHP
        //////////////SHOW DATABASE TABLE ////////////////////// 
        $tableque="SELECT * FROM form_tb";
        $gettable=mysqli_query($conndb,$tableque);
        $row=mysqli_fetch_assoc($gettable);  //provite value row wise row 1 then 2 then 3// 
        // print_r($row);
        $rownumber=mysqli_num_rows($gettable);
        echo $rownumber;
        if($rownumber>0)
        {
            
          echo"  <div class='container'>";
            
           echo' <table class="table">';
           echo" <thead>";
            echo"<tr>";
            echo"<th>id</th>";
            echo"<th>name</th>";
            echo"<th>phon</th>";
            echo"<th>country</th>";
            echo"<th>sallary</th>";
            echo"<th>option</th>";
            echo"</tr>";
            
            echo"</thead>";
              
            echo"<tbody>";
            while($row=mysqli_fetch_assoc($gettable))
            {
                echo"<tr>";
                echo"<td>".$row['id']."</td>";
                echo"<td>".$row['name']."</td>";
                echo"<td>".$row['phon']."</td>";
                echo"<td>".$row['country']."</td>";
                echo"<td>".$row['sallary']."</td>";
                echo"<td><form action='' method='POST'>
                <input type='text' name='id' value=".$row['id']." class='btn btn-danger'>
                <input type='submit' name='delete' value='delete' class='btn btn-danger'>
                </form>
                </td>";
               echo" </tr>";

            }
            echo"</tbody>";
            echo"</table>";
            
             echo"</div>";

        }
             
        ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>