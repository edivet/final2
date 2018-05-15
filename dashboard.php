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


<style>
    #logout {
        text-align: right;
    }
    
    
    #Add {
        display:none ;
        border: 1px solid black;
        width: 250px;
        margin-left:auto;
        margin-right: auto;
    }
    
    #archived {
        float:right;
    }
    
    #data {
        margin-right: auto;
        margin-left: auto;
        border: 1px solid black;
    }
    
    

</style>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <div id="logout">
            <form action="logout.php">
                
                <input type="submit" id="mainPageButtons" value="Logout" />
                
            </form>
        </div>
            
       
        
        
        <a id="archived" href="archived.php">Archived</a>
        
        
        <a href='add.php?id=".$row['id']."'><img src='add.png' style='float:right;width:42px;height:42px;border:0;'></a>
        
        
        
        
        
        <?php
            $bdd= new PDO("mysql:host=localhost;dbname=final2", 'etiennedivet', '');
            $sql='SELECT * FROM service WHERE archived =0 ';

        ?>
           
            <table id="data">
            <tr>
                <th>Code</th>
                <th>Available from - to</th>
                <th>Type</th>
                
                
            </tr>
            <?php 
                showData($sql);
            ?>
        </table>
        
        
             
    </body>
</html>

<?php
    function showData($a) {
        $bdd= dbConnect();
        $sql=$a;
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            
            echo "<td>".$row['code']."</td>";
            echo "<td>".$row['start']."    -     " .$row['end']."</td>";
            echo "<td>".$row['type']."</td>";
            echo "<td><a href='edit.php?id=".$row['id']."'><img src='edit.png' style='width:42px;height:42px;border:0;'></a></td>";
            echo "<td><a href='archive.php?id=".$row['id']."'><img src='archive.png' style='width:42px;height:42px;border:0;'></a></td>";
            echo "<td><a href='copy.php?id=".$row['id']."'><img src='copy.png' style='width:42px;height:42px;border:0;'></a></td>";
            echo "<td><a href='preview.php?id=".$row['id']."'><img src='preview.png' style='width:42px;height:42px;border:0;'></a></td>";
            
             
            
            
            
            echo "</tr>";
        }
    }