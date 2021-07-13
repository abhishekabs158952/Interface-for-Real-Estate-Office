<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent LC</title>
</head>
<body style="text-align: left;
                                    border-style: solid;
                                    border-color: bisque;
                                    padding: 0px 0px 0px 0px;
                                    ">
    <div style="text-align: left;
                        background-image: url('h5.jpg'); background-repeat: no-repeat; height:200px;   background-size: 100% 100%;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
                <article class="link">    
                    <a href="favV.php"  style="font-size: 100px; text-decoration: none">Fav V</a>
                </article>
    </div>
    <?php
        if(array_key_exists('logout', $_POST)){
            $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql="SELECT id from agent_login";
            $result = $conn->query($sql);
            $row=$result->fetch_assoc();
            $id=$row["id"];
            $sql2="DELETE from agent_login where id=$id";
            if($conn->query($sql2)==TRUE){
                echo "<script> alert('Logout Successfully'); </script>";
            }
        }

    ?>
    <div class="login" id="login" style="width: 30%; height: 320px; float:left; border-style: solid;
                                    
                                    background-color:skyblue;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;">
        <br><br><br><br>
        <h2>Log in</h2>
        <form action="check.php" method="post">
            
            Id:        <input type="text" name="loggedInId" required><br><br>
            Password:  <input type="password" name="loggedInPassword" required><br><br>
            <input type="submit" name="buttonAL">
            <input type="reset">
            <br>
        </form>
    </div>
    <div style="background-image: url('h4.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 350px;width: 100%">

    </div>
    <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
    </div>
</body>
</html>