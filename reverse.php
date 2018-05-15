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
            form {
                margin-left:auto;
                margin-right:auto;
            }
        </style>
        <title> </title>
    </head>
    <body>
        <h1>Remove from archive</h1>
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
        
        if (isset($_GET['Yes'])) {
        
        
        $sql = "UPDATE service SET archived ='0'  WHERE  id =$id";
       
        $conn = dbConnect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
    header("Location: archived.php");
  }
  
  
  
  if (isset($_GET['No'])) {
    header("Location: archived.php");
  }
        

        ?>
        
        
        
        <form method="GET">
            <input type="hidden" name="id" value="<?=$id?>" />
            <input type="submit" id="decision" value="Cancel" name="No" />
            <input type="submit" id="decision" value="Yes remove it !" name="Yes" />
        </form>

            
       
        
        
           
            
        
             
    </body>
</html>

