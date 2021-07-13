<!DOCTYPE html>
<htlm lang="en-US">
    <head>
        <title>Fav_v_manager</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Manager.css">
        <script src="javaScript.js"></script>
        <!--<script src="Manager.js"></script>-->
    </head>
    <body style="text-align: left;
                                    border-style: solid;
                                    border-color: bisque;
                                    padding: 0px 0px 0px 0px;
                                    ">
        <?php
        if(array_key_exists('submit', $_POST)) { 
        
            $idErr = $nameErr = "";
            $id = $password = "";
            $checkVal = $checkVal2 = 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["id"])) {
                    $idErr = "ID is required";
                    $checkVal = 0;
                } else {
                    $id =$_POST["id"];
                    $checkVal = 1;
                }
                if (empty($_POST["password"])) {
                    $nameErr = "password is required";
                    $checkVal2 = 0;
                } else {
                    $password =$_POST["password"];
                    $checkVal2 = 1;
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if($checkVal == 1 and $checkVal == 1){
                $host = "localhost";
                $dbUsername = "root";
                $dbPassword="Abhishe1";
                $dbname = "dbms_project2";
                $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
                if(mysqli_connect_error()){
                    die('Connect Error('. mysqli_connect_error().')'.mysqli_connect_error());
                }else{
                    $SELECT="SELECT id FROM agent_detail where id = ? limit 1";
                    $INSERT="INSERT into agent_detail (id,password,
                        avilableHouse,avilableRent,requestHouse,requestRent)
                        values (?,?,?,?,?,?)";
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
                        $all=0;
                        $stmt->bind_param("isiiii",$id,$password,$all,$all,$all,$all);
                        $stmt->execute();
                        echo "<script>alert('Agent added');</script>";
                    }else{
                        echo "<script>alert('someone with same id is in database');</script>";
                    }
                    $stmt->close();
                    $conn->close();
                }
                
            }

        }
        ?>
        
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

            <div class="nevigation" id="nev" style="text-align: center;
                                    background-color: bisque;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                <p style="height:10px">
                    <a href="#donn0" style="font-size: 30px; text-decoration: none">City detail</a>
                    <a href="#donn" style="font-size: 30px; text-decoration: none">Agent Work</a>
                    <a href="#donn1" style="font-size: 30px; text-decoration: none">Add Agent</a>
                </p> 
            </div>
            <h1><a name="donn0">City Details</a></h1>
        <div id="cityView" style="text-align: center;
                                    background-color: bisque;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                <form action="Manager.php" method="post" onsubmit="viewAgent()">
                    City : <input placeholder="enter city name" name="city">
                    <input type="submit" name="cViewBut" value="View">
                </form>
                <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h1  style="text-align: center"> City Name <?php
                                $cityNam=$_POST["city"];
                                echo "$cityNam" ;
                            ?> 
                </h1>
                <h2>Customer Request</h2>
                <tr style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Agent's Id</th>
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Buyer's Id</th>
                    <th style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Lower Limit</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Upper Limit</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('cViewBut', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT agentId,buyerId, address, noOfBedrooms,size,rent,upperLimit,lowerLimit,dateDay,dateMonth,dateYear FROM house_detail 
                                where SorB=2 and address='$cityNam' and sellerId=-1 and SorN=2";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["agentId"].
                                     "</td><td>" . $row["buyerId"] . 
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["lowerLimit"].
                                    "</td><td>" . $row["upperLimit"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
            <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Avilable For Sell</h2>
                <tr style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Agent Id</th>                
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('cViewBut', $_POST)) { 
                    
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT agentId,sellerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear FROM house_detail 
                                where SorB=1 and address='$cityNam' and BuyerId=-1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["agentId"]. 
                                     "</td><td>" . $row["sellerId"] . 
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["houseId"].
                                    "</td><td>" . $row["price"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
            <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Selled</h2>
                <tr style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Agent Id</th>                
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Seller Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Buyer's Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">House Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Price</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Selled Date</th>
                </tr>
                <?php
                    if(array_key_exists('cViewBut', $_POST)) { 
                    
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT agentId,sellerId,buyerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear,selledDateDay,selledDateMonth,selledDateYear FROM house_detail 
                                where address='$cityNam' and SorN=1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["agentId"]. 
                                     "</td><td>" . $row["sellerId"] .
                                     "</td><td>" . $row["buyerId"] .
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["houseId"].
                                    "</td><td>" . $row["price"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td><td>" . $row["selledDateDay"]. "/" . $row["selledDateMonth"]. "/" . $row["selledDateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
        </div>
        <h1><a name="donn">Agent Work</a></h1>
            <div class="viewForm" id="agentView" style="text-align: center;
                                    background-color:skyblue;
                                    border-style: solid;
                                    border-width: 0px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                <br>
                <form action="Manager.php" method="post" onsubmit="viewAgent()">
                    Agent id : <input placeholder="enter Agent id" name="id">
                    <input type="submit" name="viewBut" value="View">
                </form>
                <br>
                <button id="agent_list">Agent List</button>
                <br>
            </div>
        
        <div id="agentDetail">
            <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h1  style="text-align: center"> Agent Id <?php
                                $agentId=$_POST["id"];
                                echo "$agentId" ;
                            ?> 
                </h1>
                <h2>Request</h2>
                <tr style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Buyer's Id</th>
                    <th style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: left;
                                   
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Lower Limit</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Upper Limit</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('viewBut', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT buyerId, address, noOfBedrooms,size,rent,upperLimit,lowerLimit,dateDay,dateMonth,dateYear FROM house_detail 
                                where SorB=2 and agentId=$agentId and sellerId=-1 and SorN=2";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["buyerId"]. 
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["lowerLimit"].
                                    "</td><td>" . $row["upperLimit"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
            <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Avilable For Sell</h2>
                <tr style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('viewBut', $_POST)) { 
                    
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT sellerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear FROM house_detail 
                                where SorB=1 and agentId=$agentId and BuyerId=-1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["sellerId"]. 
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["houseId"].
                                    "</td><td>" . $row["price"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
            <table style="text-align: center;
                                    background-color:rgb(233, 218, 230);
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Selled</h2>
                <tr style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Seller Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Buyer's Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Address</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">House Id</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Price</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Date Of Request</th>
                    <th style="text-align: left;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">Selled Date</th>
                </tr>
                <?php
                    if(array_key_exists('viewBut', $_POST)) { 
                    
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT sellerId,buyerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear,selledDateDay,selledDateMonth,selledDateYear FROM house_detail 
                                where agentId=$agentId and SorN=1";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["sellerId"]. 
                                     "</td><td>" . $row["buyerId"] .
                                     "</td><td>" . $row["address"] . 
                                     "</td><td>" . $row["noOfBedrooms"]. 
                                     "</td><td>" . $row["size"].  
                                     "</td>";
                                if($row["rent"]==1){
                                    echo "<td> Rent </td>"; 
                                }else{
                                    echo "<td> House </td>"; 
                                }
                                echo "<td>" . $row["houseId"].
                                    "</td><td>" . $row["price"].
                                    "</td><td>" . $row["dateDay"]. "/" . $row["dateMonth"]. "/" . $row["dateYear"]. 
                                    "</td><td>" . $row["selledDateDay"]. "/" . $row["selledDateMonth"]. "/" . $row["selledDateYear"]. 
                                    "</td></tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    }
                ?>
            </table>
        </div>
        <h1><a name="donn1">Add Agent</a></h1>
            <div id="addAgent" style="text-align: center;
                                    background-color:skyblue;
                                    
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                <h2>Add Agent </h2>
                <!-- <button onclick="afd()" id="addAgent">Add Agent</button> -->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="agentForm">
                    ID :        <input type="text" name="id" required>
                    <br><br>
                    Password : <input type="text" name="password" required>
                    <br><br>                  
                    <input type="submit" name="submit">
                </form>
            </div>

        <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
        </div>
    </body>
</htlm>