<?php
session_start();


if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}


function dbConnect() {
    $connUrl = "mysql://gonadbcm28b2pbc2:j8logw12pooo3jyl@p2d0untihotgr5f6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jmjet2bi89ylt1b5";
            $hasConnUrl = !empty($connUrl);
            
            $connParts = null;
            if ($hasConnUrl) {
                $connParts = parse_url($connUrl);
            }
            
            //var_dump($hasConnUrl);
            $host = $hasConnUrl ? $connParts['host'] : getenv('IP');
            $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'final';
            $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
            $password = $hasConnUrl ? $connParts['pass'] : '';
            
            //return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            return new PDO("mysql:host=localhost;dbname=final2", 'etiennedivet', '');
            
}
$conn = dbConnect();







?>


<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
            text-align: center;
        }
        </style>
        <title> </title>
    </head>
    <body>
        <h1>Add</h1>
       <?php
       $bdd= dbConnect();
       $sql='SELECT * FROM service WHERE id = \'' . $_GET['id'] . '\' ';
            $stmt = $bdd->prepare($sql);
        $stmt->execute();
        
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id=$row['id'];
            $start=$row['start'];
            $end=$row['end'];
            $type=$row['type'];
            $code=$row['code'];
        }
        
        
        if (isset($_GET['edit'])) {
            
            $start=$_GET['dateS'];
            $end=$_GET['dateE'];
            $type=$_GET['type'];
            $code=$_GET['code'];
            
            
            $sql = "INSERT INTO service
                (start, end, type, code)
            VALUES
                ('$start', '$end', '$type', '$code')";
    
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
    
            header("Location: dashboard.php");
            
  }

        ?>
        
        
        
        <form method="GET">
            From : <input type="date" name="dateS"  /><br>
            To : <input type="date" name="dateE"  /><br>
            Type : <select name="type" > 
              <option value="standard">Standard</option>
              <option value="special">Special</option>
              <option value="holiday">holiday</option>
              <option value="info">Info</option>
            </select><br>
            Code : <input type="text" name="code" /><br>
            <input type="submit" name="edit" value="Add" >
        </form>

            
       
        
        
           
            
        
             
    </body>
</html>

