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
            font-size: 20px;
        }
        ul {
            list-style: none;
        }
        
        #archived {
            float:right;
            font-size: 18px;
        }
        
        </style>
        <title> </title>
    </head>
    <a id="archived" href="dashboard.php">Go to dashboard</a><br>
    <body>
        <h1>Preview</h1>
        
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
            $status=$row['status'];
            $title=$row['title'];
            $slogan=$row['slogan'];
            $action=$row['action'];
            $description=$row['description'];
        }
        
        
        

        ?>
        
        
        <div id="preview">
            <ul>
                <li>From : <?php echo $start; ?></li>
                <li>To : <?php echo $end; ?></li>
                <li>Type : <?php echo $type; ?></li>
                <li>Code : <?php echo $code; ?></li>
                <li>Title : <?php echo $title; ?></li>
                <li>Slogan : <?php echo $slogan; ?></li>
                <li>Action : <?php echo $action; ?></li>
                <li>Description : <?php echo $description; ?></li>
                <li>Status : <?php 
                if($status ==0 ){
                    echo "Active";
                } else {
                echo "Archived"; }?></li>
        </div>
        

            
       
        
        
           
            
        
             
    </body>
</html>

