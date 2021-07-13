<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Fav_v_seller</title>
        <meta charset="UTF-8">
        <!--link rel="stylesheet" href="Agent_css.css">-->
        <script src="javaScript.js"></script>
    </head>
    <body  style="text-align: left;
                        border-style: solid;
                        border-color: bisque;            
                        ">
        <?php
            $loggedInId = "";
            $cityErr = $house_idErr = $priceErr =$no_of_roomsErr=$sizeErr=$agent_idErr=$rentErr= "";
            $city = $house_id = $price=$no_of_rooms=$size =$agent_id=$rent=$dateDay =$dateMonth =$dateYear = "";
            $checkVal = $checkVal2 =$c3=$c4=$c5=$c6=$c7= 0;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["housetype"])) {
                    $rentErr = "City is required";
                    $c7 = 0;
                } else {
                    $rent = test_input($_POST["housetype"]);
                    $c7 = 1;
                }
                if (empty($_POST["city"])) {
                    $cityErr = "City is required";
                    $checkVal = 0;
                } else {
                    $city = test_input($_POST["city"]);
                    $checkVal = 1;
                }
                if (empty($_POST["no_of_bedrooms"])) {
                    $no_of_roomsErr = "No of rooms is required";
                    $c3 = 0;
                } else {
                    $no_of_rooms = test_input($_POST["no_of_bedrooms"]);
                    $c3 = 1;
                }
                if (empty($_POST["size"])) {
                    $sizeErr = "Size is required";
                    $c4 = 0;
                } else {
                    $size = test_input($_POST["size"]);
                    $c4 = 1;
                }
                if (empty($_POST["house_id"])) {
                    $house_idErr = "House Id is required";
                    $checkVal2 = 0;
                } else {
                    $house_id = test_input($_POST["house_id"]);
                    $checkVal2 = 1;
                }
                if (empty($_POST["price"])) {
                    $priceErr = "price is reqired";
                    $c5 = 0;   
                } else {
                    $price = test_input($_POST["price"]);
                    $c5 = 1;
                }
                if (empty($_POST["agent_id"])) {
                    $agent_idErr = "agent id is reqired";
                    $c6 = 0;   
                } else {
                    $agent_id = test_input($_POST["agent_id"]);
                    $c6 = 1;
                }if (empty($_POST["agent_id"])) {
                } else {
                    $dateDay = test_input($_POST["dateDay"]);
                }if (empty($_POST["agent_id"])) {
                } else {
                    $dateMonth = test_input($_POST["dateMonth"]);
                }if (empty($_POST["agent_id"])) {
                } else {
                    $dateYear = test_input($_POST["dateYear"]);
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if($checkVal == 1 and $checkVal2 == 1 and $c3==1 and $c4==1 and $c5==1 and $c6==1 and $c7 == 1){
                $host = "localhost";
                $dbUsername = "root";
                $dbPassword="Abhishe1";
                $dbname = "dbms_project2";
                $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
                if(mysqli_connect_error()){
                    die('Connect Error('. mysqli_connect_error().')'.mysqli_connect_error());
                }else{
                    $SELECTA="SELECT id FROM agent_detail where id = ? limit 1";
                    $SELECTS="SELECT id FROM seller_login";
                    $INSERT="INSERT into house_detail (agentId,sellerId,buyerId,houseId,
                                                        address,noOfBedrooms,size,rent,
                                                        price,SorB,upperLimit,lowerLimit,
                                                        dateDay,dateMonth,dateYear,selledDateDay,
                                                        selledDateMonth,selledDateYear,SorN)
                            values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $stmt=$conn->prepare($SELECTA);
                    $stmt->bind_param("i",$agent_id);
                    $stmt->execute();
                    $stmt->bind_result($agent_id);
                    $stmt->store_result();
                    $rnum=$stmt->num_rows;
                    if($rnum==1){
                        $stmt->close();

                        $sellerId1="";
                        $result = $conn->query($SELECTS);
                        if($result->num_rows > 0){
                            $sellerId1=$result->fetch_assoc();
                        }else{
                            //loggedOut
                        }
                        $sellerId=$sellerId1["id"];    
                        $stmt=$conn->prepare($INSERT);
                        $all=-1;
                        $val1=1;
                        $val2=2;
                        $stmt->bind_param("iiiisiisisiiiiiiiis",$agent_id,$sellerId,$all,$house_id,$city,$no_of_rooms,$size,$rent,$price,$val1,$all,$all,$dateDay,$dateMonth,$dateYear,$all,$all,$all,$val2);                        
                        
                        $stmt->execute();

                        echo "<script>alert('Request Sent');</script>";
                    }else{
                        echo "<script>alert('No agent with this id');</script>";
                    }
                    $stmt->close();
                    $conn->close();
                }
            }
        ?>


        <div>
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
        <div class="nevigation"  style="text-align: right;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
            <form action="SellerLC.php" method="post" style="text-align-last: right;">
                <input type="submit" name="logout" value="Logout" style="text-align-last: right;"><br>
            </form>
        </div>
        <div style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
             <button id="apply_new" onclick="f1()">Apply New</button> <br><br>
            <form action="Seller.php" method="post">  
                
                <input type="submit" name="status" value="Previous Status">
            </form>
        </div>
        <div id="tab" style="       text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
            <table style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    border-radius: 40px;
                                    padding: 10px 22px 10px 22px;
                                    ">
                <h2>Selled</h2>
                <tr style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Seller Id</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Buyer's Id</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Address</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">House Id</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Price</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Date Of Request</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Selled Date</th>
                </tr>
                <?php
                    if(array_key_exists('status', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql1="SELECT id from seller_detail";
                        $result1 = $conn->query($sql1);
                        $row1=$result1->fetch_assoc();
                        $sellerId=$row1["id"];
                        $sql = "SELECT sellerId,buyerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear,selledDateDay,selledDateMonth,selledDateYear FROM house_detail 
                                where sellerId=$sellerId and SorN=1";
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
            <table style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    border-radius: 40px;
                                    padding: 10px 22px 10px 22px;
                                    ">
                <h2>Pending</h2>
                <tr style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Seller's Id</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Address</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Size</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Rent Or House</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">House Id</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">price</th>
                    <th style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('status', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql1="SELECT id from seller_detail";
                        $result1 = $conn->query($sql1);
                        $row1=$result1->fetch_assoc();
                        $sellerId=$row1["id"];
                        $sql = "SELECT sellerId, address, noOfBedrooms,size,rent,houseId,price,dateDay,dateMonth,dateYear FROM house_detail 
                                where sellerId=$sellerId and SorN=2";
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


        </div>
        <div style="text-align: center;
                    width: 400px; height: 50%;float:left;
                                    background-color:skyblue;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    ">
            <h2>Apply</h2>
            <h2>House of Your Choise</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="radio" name="housetype" value="2">sell house
                <input type="radio" name="housetype" value="1">rent house
                <br>
                City:        <input type="text" name="city" size=14 required>
                <br><br>
                No of Bedrooms: <input type="text" name="no_of_bedrooms" size=2 required>
                <br><br>
                Size in meter_squre: <input type="text" name="size" size=4 required>
                <br><br>
                House Id: <input type="text" name="house_id" size=4 required>
                <br><br>
                Price: <input type="text" name="price" size=7 required>
                <br><br>
                Today Date : <input type="text" name="dateDay" size=2 required>
                Month: <input type="text" name="dateMonth" size=2 required>
                Year: <input type="text" name="dateYear" size=2 required>
                <br><br>
                Agent id:  <input type="text" name="agent_id" size=4 required><br><br>
                <input type="submit">
            </form>
        </div>
        <div style="background-image: url('h4.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 458px;width: 100%">

        </div>
        <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
        </div>
    </body>
</html>