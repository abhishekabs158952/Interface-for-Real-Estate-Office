<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller LC</title>
    <!--<link rel="stylesheet" href="Agent_css.css">-->
    <script>
        function create(){
            document.getElementById("create").style.display= "block";
            document.getElementById("login").style.display= "none";
        }
        function login(){
            document.getElementById("create").style.display= "none";
            document.getElementById("login").style.display= "block";
        }
    </script>
    <!--<link rel="stylesheet" href="SellerLC.css">-->
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
            $sql="SELECT id from seller_login";
            $result = $conn->query($sql);
            $row=$result->fetch_assoc();
            $id=$row["id"];
            $sql2="DELETE from seller_login where id=$id";
            if($conn->query($sql2)==TRUE){
                echo "<script> alert('Logout Successfully'); </script>";
            }
        }

    ?>
    <?php
       //check for login details
        $idErr = "";
        $id =$password= "";
        $checkVal = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["id"])) {
                $idErr = "id is required";
                $checkVal = 0;
            } else {
                $id = test_input($_POST["id"]);
                $checkVal = 1;
            }if (empty($_POST["password"])) {
                $idErr = "id is required";
                $checkVal = 0;
            } else {
                $password = test_input($_POST["password"]);
                $checkVal = 1;
            }
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if($checkVal == 1){
                $host = "localhost";
                $dbUsername = "root";
                $dbPassword="Abhishe1";
                $dbname = "dbms_project2";
                $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
                if(mysqli_connect_error()){
                    die('Connect Error('. mysqli_connect_error().')'.mysqli_connect_error());
                }else{
                    $SELECT="SELECT id FROM seller_detail where id = ? limit 1";
                    $INSERT="INSERT into seller_detail (id,password)
                        values (?,?)";
                    //prepared statement
                    $stmt=$conn->prepare($SELECT);
                    $stmt->bind_param("i",$id);
                    $stmt->execute();
                    $stmt->bind_result($id);
                    $stmt->store_result();
                    $rnum=$stmt->num_rows;
                    if($rnum==0){
                        $stmt->close();
                        $stmt=$conn->prepare($INSERT);
                        $stmt->bind_param("is",$id,$password);
                        $stmt->execute();
                        echo "<script>alert('Seller added');</script>";
                    }else{
                        echo "<script>alert('someone with same id is in database');</script>";
                    }
                    $stmt->close();
                    $conn->close();
                }
                
            }
    ?>
    <div style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    " class="option">
        <button onclick="create()">create account</button>
        <button onclick="login()">log in</button>
    </div>
    <div class="create" id="create" style="width: 45%; height: 50%;float:left;  border-style: solid;
                                    background-color:skyblue;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;">
        <h2>Create Account</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            id :        <input type="text" name="id" required><br><br>
            Password:  <input type="password" name="password" required><br><br>
            <input type="submit">
            <br>
        </form>
    </div>
    <div class="login" id="login" style="width: 46%; height: 50%; float:left; border-style: solid;
                                    background-color:skyblue;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;">
        <h2>Log in</h2>
        <form action="check.php" method="post">
            id:        <input type="text" name="loggedInId" required><br><br>
            Password:  <input type="password" name="loggedInPassword" required><br><br>
            <input type="submit" name="buttonSL">
            <input type="reset">
            <br>
        </form>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
    <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
    </div>
</body>
</html>