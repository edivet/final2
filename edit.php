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
        <h1>Edit</h1>
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
        if (isset($_GET['cancel'])) {
            header("Location: dashboard.php");
            
        }
        
        if (isset($_GET['edit'])) {
            $id=$_GET['id'];
            $start=$_GET['dateS'];
            $end=$_GET['dateE'];
            $type=$_GET['type'];
            $code=$_GET['code'];
            $status=$_GET['status'];
            $title=$_GET['title'];
            $slogan=$_GET['slogan'];
            $action=$_GET['action'];
            $description=$_GET['description'];
            
            //$sql = 'UPDATE service SET start=\'' . $start . '\'  SET end=\'' . $end . '\'  SET type=\'' . $type . '\'  SET code=\'' . $code . '\'  WHERE id= \'' . $id . '\' ';
            $sql = 'UPDATE service SET type =\'' . $type . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET code =\'' . $code . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET start =\'' . $start . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET end =\'' . $end . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET archived =\'' . $status . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET title =\'' . $title . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET slogan =\'' . $slogan . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET action =\'' . $action . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $sql = 'UPDATE service SET description =\'' . $description . '\' WHERE id= \'' . $id . '\' ';
            $conn = dbConnect();
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header("Location: dashboard.php");
  }

        ?>
        
        
        
        <form method="GET">
            <input type="hidden" name="id" value="<?=$id?>" /><br>
            From : <input type="date" name="dateS" value="<?=$start?>" />
            To : <input type="date" name="dateE" value="<?=$end?>" /><br>
            Code : <input type="text" name="code" value="<?=$code?>" /><br>
            Type : <select name="type" > 
              <option value="standard">Standard</option>
              <option value="special">Special</option>
              <option value="holiday">holiday</option>
              <option value="info">Info</option>
            </select>
            
            Status : <select name="status" > 
                <option value="0">on hold</option>
                 <option value="1">Archived</option>
              
              
            </select><br>
            Title : <input type="text" name="title" value="<?=$title?>" /><br>
            Slogan : <input type="text" name="slogan" value="<?=$slogan?>" /><br>
            Action : <input type="text" name="action" value="<?=$action?>" /><br>
            Description : <input type="text" name="description" value="<?=$description?>" /><br>
            <input type="submit" name="cancel" value="Cancel" >
            <input type="submit" name="edit" value="Save" >
        </form>

            
       
        
        
           
            
        
             
    </body>
</html>

