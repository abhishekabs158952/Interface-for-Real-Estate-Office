<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Fav_v_customer</title>
        <meta charset="UTF-8">
        <script src="javaScript.js"></script>
    </head>
    <body style="text-align: left;
                                    border-style: solid;
                                    border-color: bisque;
                                    padding: 0px 0px 0px 0px;
                                    ">

        <?php
            $cityErr = $lowerErr = $upperErr =$no_of_roomsErr=$sizeErr=$agent_idErr=$rentErr= "";
            $city = $lowerLimit = $upperLimit=$no_of_rooms=$size =$agent_id=$rent=$dateDay =$dateMonth =$dateYear = "";
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
                if (empty($_POST["lowerLimit"])) {
                    $lowerErr = "Lower Limit is required";
                    $checkVal2 = 0;
                } else {
                    $lowerLimit = test_input($_POST["lowerLimit"]);
                    $checkVal2 = 1;
                }
                if (empty($_POST["upperLimit"])) {
                    $upperErr = "Upper limit is reqired";
                    $c5 = 0;   
                } else {
                    $upperLimit = test_input($_POST["upperLimit"]);
                    $c5 = 1;
                }
                if (empty($_POST["agent_id"])) {
                    $agent_idErr = "Upper limit is reqired";
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
                    $SELECTB="SELECT id FROM buyer_login";
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
                        $buyerId1="";
                        $result = $conn->query($SELECTB);
                        if($result->num_rows > 0){
                            $buyerId1=$result->fetch_assoc();
                        }else{
                            //loggedOut
                        }
                        $buyerId=$buyerId1["id"];    
                        $stmt->close();
                        $stmt=$conn->prepare($INSERT);
                        $all=-1;
                        $val2=2; 
                        //$city = $lowerLimit = $upperLimit=$no_of_rooms=$size =$agent_id=$rent=$dateDay =$dateMonth =$dateYear = ;
            
                        $stmt->bind_param("iiiisiisisiiiiiiiis",$agent_id,$all,$buyerId,$all,$city,$no_of_rooms,$size,$rent,$all,$val2,$upperLimit,$lowerLimit,$dateDay,$dateMonth,$dateYear,$all,$all,$all,$val2);
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
        <div class="nevigation" style="text-align: right;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
            <form action="CustomerLC.php" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        </div>
        <div style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
            <button id="apply_new" onclick="f1()">Apply New</button><br><br>
            <form action="Customer.php" method="post">
                <input type="submit" name="status" value="Previous Status">
                <input type="submit" name="suggetion" value="Suggetion">
            </form>
        </div>
        
        <div id="tab" style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
            

            <table style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Alloted</h2>
                <tr>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Buyer's Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Date Of Request</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Selled Date</th>
                </tr>
                <?php
                    if(array_key_exists('status', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql1="SELECT id from buyer_login";
                        $result1 = $conn->query($sql1);
                        $row1=$result1->fetch_assoc();
                        $buyerId=$row1["id"];
                        $sql = "SELECT sellerId,buyerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear,selledDateDay,selledDateMonth,selledDateYear FROM house_detail 
                                where buyerId=$buyerId and SorN=1";
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
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Pending</h2>
                <tr style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Buyer's Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Lower Limit</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Upper Limit</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('status', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql1="SELECT id from buyer_detail";
                        $result1 = $conn->query($sql1);
                        $row1=$result1->fetch_assoc();
                        $buyerId=$row1["id"];
                        $sql = "SELECT buyerId, address, noOfBedrooms,size,rent,lowerLimit,upperLimit,dateDay,dateMonth,dateYear FROM house_detail 
                                where buyerId=$buyerId and SorN=2";
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
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 40px;
                                    ">
                <h2>Suggested</h2>
                <tr>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 1px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">Date Of Request</th>
                </tr>
                <?php
                    if(array_key_exists('suggetion', $_POST)) { 
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $name_two=array();
                        $sql1="SELECT id from buyer_login";
                        $result1 = $conn->query($sql1);
                        $row1=$result1->fetch_assoc();
                        $buyerId=$row1["id"];
                        $sql2="SELECT houseId from suggest_list where buyerId=$buyerId";
                        $result2= $conn->query($sql2);
                        if($result2->num_rows > 0){
                            $cnt=0;
                            while($row2=$result2->fetch_assoc()){
                                $name_two[$cnt] = $row2["houseId"];
                                $cnt+=1; 
                            }
                        }
                        for($i=0; $i<$cnt; $i++){
                        $sql = "SELECT sellerId,address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear FROM house_detail 
                                where houseId = $name_two[$i] ";
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
                        }
                        $conn->close();
                    }
                ?>
            </table>
        </div>
        
        <div style="text-align: center;
                    width: 400px; height: 50%;float:left;
                        border-radius: 5px;
                        background-color: skyblue; 
                                    background-color:skyblue;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    " id="form">
            <h2>Apply</h2>
            <h2>House of Your Choise</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <input type="radio" name="housetype" value="2" >house
                <input type="radio" name="housetype" value="1">rent
                <br>
                City:        <input type="text" name="city" size=15 required>
                <br><br>
                No of Bedrooms: <input type="text" name="no_of_bedrooms" size=2 required>
                <br><br>
                Size in meter_squre: <input type="text" name="size" size=4 required>
                <br><br>
                Lower limit: <input type="text" name="lowerLimit" size=7 required>
                <br><br>
                Upper limit: <input type="text" name="upperLimit" size=7 required>
                <br><br>
                Today Date : <input type="text" name="dateDay" size=2 required>
                Month: <input type="text" name="dateMonth" size=2 required>
                Year: <input type="text" name="dateYear" size=2 required>
                <br><br>
                Agent id:  <input type="text" name="agent_id" size=4 required><br><br>
                <input type="submit" name="button2">
            </form>
        </div>
        <div style="background-image: url('h2.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 458px;width: 100%">

        </div>
        <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
        </div>
    </body>
</html> 