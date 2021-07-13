<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>fav_v_Agent</title>
        <meta charset="UTF-8">
        <!--<link rel="stylesheet" href="Agent_css.css">-->
        <script src="Agent.js"></script>
    </head>
    <body style="margin: 0;   
                 background-color: bisque; 
                 text-align: center;"
    >
        <div style="text-align: left;
                    background-image: url('h5.jpg'); background-repeat: no-repeat; height:200px;   background-size: 100% 100%;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: rgb(241, 204, 159);
                                    padding: 10px 22px 10px 22px;
                                    border-radius: 0px;
                                    ">
                <article >    
                    <a href="favV.php"  style="font-size: 100px; text-decoration: none">Fav V</a>
                </article>
        </div>
        <div class="nevigation" style="background-color: bisque;
                                        text-align-last: left;
                                        border-style: outset;
                                        padding: 1%;
                                        border-radius: 0px;
                                        font-size-adjust: 1;"
        >   
            <form action="AgentLC.php" method="post" style="text-align-last: right;
                                                            ">
                <input type="submit" name="logout" value="Logout">
            </form>

        </div>
        <div class="uppage">
            <p id="agent name"></p>
            <form method="post"> 
                <input type="submit" name="button1" class="button" value="Buyers Request"> 
                <input type="submit" name="button2" class="button" value="Sellers Request"> 
                <input type="submit" name="selledList" value="Sold">
            </form>
        </div>

        <table id="reqList" style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: red;
                                    border-radius: 20px;
                                    ">
            <h1> Agent Id <?php
                            $host = "localhost";
                            $dbUsername = "root";
                            $dbPassword="Abhishe1";
                            $dbname = "dbms_project2";
                            $conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);
                            $agentId="";
                            if(mysqli_connect_error()){
                                die('Connect Error('. mysqli_connect_error().')'.mysqli_connect_error());
                            }else{
                                $SELECTA="SELECT id FROM agent_login";
                                $agentId1="";
                                $result = $conn->query($SELECTA);
                                if($result->num_rows > 0){
                                    $agentId1=$result->fetch_assoc();
                                }else{
                                    //loggedOut
                                }
                                $agentId=$agentId1["id"]; 
                            }
                            echo "$agentId" ;
                        ?> 
            </h1>
            <h2 style="text-align: left;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 60px 10px 22px;
                                    ">Request</h2>
            <tr>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 60px;
                                    "><?php
                    if(array_key_exists('button1', $_POST)) {
                        echo "Buyer's Id";
                    }else{
                        echo "Seller's Id";
                    }
                    ?>
                </th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Address</th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">noOfBedrooms</th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Size</th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    ">Rent Or House</th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    "><?php
                    if(array_key_exists('button1', $_POST)) {
                        echo "Lower Limit";
                    }else{
                        echo "House Id";
                    }
                    ?>
                </th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 22px 10px 22px;
                                    "><?php
                    if(array_key_exists('button1', $_POST)) {
                        echo "Upper Limit";
                    }else{
                        echo "Price";
                    }
                    ?>
                </th>
                <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 60px 10px 22px;
                                    ">Date Of Request</th>
                
            </tr>
            <?php
                if(array_key_exists('button1', $_POST)) { 
                    
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
                }else if(array_key_exists('button2', $_POST)) { 
                    
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
        
        <div class="selledList">
        <table id="sellList" style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    border-radius: 20px;
                                    ">
                <h2>Sold</h2>
                <tr style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 25px 50px 75px 100px;
                                    ">
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Buyer's Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Date Of Request</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Selled Date</th>
                </tr>
                <?php
                    if(array_key_exists('selledList', $_POST)) { 
                    
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
        <div class="searchList" style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    border-radius: 20px;
                                    ">
            <form action="Agent.php" method="post"> 
            <table id="searchList" style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: green;
                                    border-radius: 20px;
                                    ">
                <h2>Searched</h2>
                <tr style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 25px 50px 75px 100px;
                                    ">
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Select House</th>                
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Seller Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Address</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">noOfBedrooms</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Size</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Rent Or House</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">House Id</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Price</th>
                    <th style="text-align: center;
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 20px 10px 20px;
                                    ">Date Of Request</th>
                    
                </tr>
                <?php
                    if(array_key_exists('search', $_POST)) { 
                    
                        $conn = mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $city1=$_POST["address"];
                        $lowerLimit=$_POST["lowerLimit"]-1;
                        $upperLimit=$_POST["upperLimit"]+1;
                        $sql5 = "SELECT sellerId, address,houseId, noOfBedrooms,size,rent,price,dateDay,dateMonth,dateYear FROM house_detail 
                                where agentId=$agentId and address='$city1' and price>$lowerLimit and price<$upperLimit and SorN=2";
                        $result112 = $conn->query($sql5);
                        if ($result112->num_rows > 0) {
                            // output data of each row
                            $cnt1=0;
                            $houseid1=0;
                            while($row = $result112->fetch_assoc()) {
                                $cnt1+=1;
                                $houseid1=$row['houseId'];
                                echo "<tr><td>" . "<input type='checkbox' id='vehicle1' name='check_list[]' value='$houseid1'>".
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
            </table><br>
                <input type="text" name="buyerId" required>
                <input type="submit" name="suggest" value="Suggest">
            </form><br>
        </div>
        <?php 
            if(array_key_exists('suggest', $_POST)){
                $conn= mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $buyerId=$_POST["buyerId"];
                if(!empty($_POST['check_list'])){
                    // Loop to store and display values of individual checked checkbox.
                    foreach($_POST['check_list'] as $selected){
                        $sql = "insert into suggest_list (buyerId,houseId,agentId) values ($buyerId,$selected,$agentId)";
                        $conn->query($sql);
                    }
                }
                
                $conn->close();
            }
        ?>
        <div>
        <?php 
            if(array_key_exists('allot', $_POST)){
                $conn= mysqli_connect("localhost", "root", "Abhishe1", "dbms_project2");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $buyerId=$_POST["buyerId"];
                $selledDateDay=$_POST['selledDateDay'];
                $selledDateMonth=$_POST['selledDateMonth'];
                $selledDateYear=$_POST['selledDateYear'];
                $houseId=$_POST["houseId"];
                $dateDay=$_POST["dateDay"];
                $dateMonth=$_POST["dateMonth"];
                $dateYear=$_POST["dateYear"];
                //$address=$_POST["address"];
                $sql = "UPDATE house_detail set SorN=3 where /*address=address and*/ buyerId=$buyerId and dateDay=$dateDay and 
                        dateMonth=$dateMonth and dateYear=$dateYear and agentId=$agentId ";
                //$sql = "DELETE FROM house_detail WHERE address=$address and buyerId=$buyerId and dateDay=$dateDay and 
                //        dateMonth=$dateMonth and dateYear=$dateYear and agentId=$agentId ";
                if ($conn->query($sql) === TRUE) {
                    $sql2="UPDATE house_detail SET buyerId=$buyerId,selledDateDay=$selledDateDay,
                            selledDateYear=$selledDateYear,selledDateMonth=$selledDateMonth,SorN=1  WHERE houseId=$houseId";
                    if($conn->query($sql2)==TRUE){
                        echo "<script> alert('Record updated successfully');</script>";
                    }else{
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "Error deleting record: " . $conn->error;
                }

                $conn->close();
            }
        
        ?>
        <article style="text-align: center;
                        width: 43%; height: 50%;float:left;
                        border-radius: 5px;
                        background-color: skyblue; 
                                    border-style: solid;
                                    border-width: 2%;
                                    border-color: bisque;
                                    padding: 10px 60px 10px 22px;
                                    ">
            <h1>Allot House</h1>
            <form action="Agent.php" method="post">
                House Id : <input type="text" name="houseId" size="4" required>
                <h3> Buyer Details </h3>
                Buyer's Id : <input type="text" name="buyerId" size="4" required><br><br>
                <!-- Address : <input type="text" name="address" required><br><br> -->
                Request Day : <input type="text" name="dateDay" size="2" required>
                Month : <input type="text" name="dateMonth" size="2" required>
                Year : <input type="text" name="dateYear" size="4" required><br><br>
                Today's Day : <input type="text" name="selledDateDay" size="2" required>
                Month : <input type="text" name="selledDateMonth" size="2" required>
                Year : <input type="text" name="selledDateYear" size="4" required><br><br>
                <input type="submit" name="allot" value="Allot">
             </form>
            </article>
            <article style="text-align: center;
                                    width: 43%; height: 50%;float:left;
                                    border-radius: 2%;
                                    background-color: skyblue; 
                                    border-style: solid;
                                    border-width: 5px;
                                    border-color: bisque;
                                    padding: 10px 60px 10px 22px;
                                    ">
                <br><br>
                <h1>Search House</h1><br>
                <form action="Agent.php" method="post">
                    city : <input type="text" name="address" size="15" required><br><br>
                    Lower Limit : <input type="text" name="lowerLimit" size="7" required><br><br>
                    Upper Limit : <input type="text" name="upperLimit" size="7" required><br><br>
                    <input type="submit" name="search" value="Search"><br><br>
                </form>
            </article>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        
        <div style="background-image: url('pic.jpg'); background-repeat: no-repeat; background-size: 100% 100%; height: 400px; width: 100%; text-align: center;text-align: bottom;">
                
        </div>
    </body>
</html>