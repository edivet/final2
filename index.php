<?php
session_start();


function dbConnect() {
    $connUrl = "mysql://gonadbcm28b2pbc2:j8logw12pooo3jyl@p2d0untihotgr5f6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jmjet2bi89ylt1b5";
            $hasConnUrl = !empty($connUrl);
            
            $connParts = null;
            if ($hasConnUrl) {
                $connParts = parse_url($connUrl);
            }
            
            //var_dump($hasConnUrl);
            $host = $hasConnUrl ? $connParts['host'] : getenv('IP');
            $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'lab5';
            $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
            $password = $hasConnUrl ? $connParts['pass'] : '';
            
            //return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            return new PDO("mysql:host=localhost;dbname=final2", 'etiennedivet', '');
            
            
}
$conn = dbConnect();





?>

<style>
    #Login {
        border: 1px solid black;
        margin-left: auto;
        margin-right: auto;
        width: 300px;
        height: 140px;
        text-align: center;
        padding-top: 15px;
    }
</style>


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        
    </head>
    <body>
        <h1>Login</h1>
        <div id="Login">
            <p>Use admin and admin</p>
       
            <form method="POST">
        
                Username: <input type="text" name="username"/> <br />
                Password: <input type="password" name="password"/> <br /><br />
                <input type="submit" id="submit" value="Login" name="submitButton" />
            
                
            </form>
        
       
         </div>
        
        
        
        
        <?php 
        
        
        
       




        
    
        if(isset($_POST['submitButton'])) {
                $username=$_POST['username'];
                $password=$_POST['password'];
               
                
            
            
            
            
                
                $pass = sha1($_POST['password']);
                
                
                
                 $sql = "SELECT * FROM user WHERE username='$username' AND password_hash='$pass'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['username'] = $username;
                    header("Location: dashboard.php");
                    echo "good";
                    
                } else {
                    echo "Invalid username or password.<br>";
                }
             }
        
        
        
        
        
        
            
        ?>
        
        

        
    </body>
    
</html>
</html>