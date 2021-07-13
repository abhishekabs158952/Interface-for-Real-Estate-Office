<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Details</title>
    <!--<link rel="stylesheet" href="Agent_css.css">-->
</head>
<body style="text-align: center;">
    <?php 
        $loggedInId=$_POST["loggedInId"];
        $loggedInPassword=$_POST["loggedInPassword"];
        $servername = "localhost";
        $username = "root";
        $password = "Abhishe1";
        $dbname = "dbms_project2";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $val=0;
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }    
        $sql1 = "SELECT id, password FROM buyer_detail where id=$loggedInId ";
        $sql11= "INSERT into buyer_login (id) values ($loggedInId)";
        $sql2 = "SELECT id, password FROM seller_detail where id=$loggedInId ";
        $sql22= "INSERT into seller_login (id) values ($loggedInId)";
        $sql3=  "SELECT id, password from agent_detail where id=$loggedInId ";
        $sql33= "INSERT into agent_login (id) values ($loggedInId)";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if(array_key_exists('buttonCL', $_POST)){
            if ($result1->num_rows > 0) {
                // output data of each row
                $row = $result1->fetch_assoc();
                if($loggedInPassword == $row["password"]){
                    $conn->query($sql11);
                    $val=1;
                    //echo "<script> alert($val) </script>";
                    //echo "<br> id: ". $row["id"]. " - Name: ". $row["password"]. "<br>";
                }else{
                    $val=2;
                }
            } else {
                $val=2;
            }
        }else if(array_key_exists('buttonSL', $_POST)){
            if ($result2->num_rows > 0) {
                // output data of each row
                $row = $result2->fetch_assoc();
                if($loggedInPassword == $row["password"]){
                    $conn->query($sql22);
                    $val=3;
                    //echo "<script> alert($val) </script>";
                    //echo "<br> id: ". $row["id"]. " - Name: ". $row["password"]. "<br>";
                }else{
                    $val=4;
                }
            } else {
                $val=4;
            }
        }else if(array_key_exists('buttonAL', $_POST)){

            if ($result3->num_rows > 0) {
                // output data of each row
                $row = $result3->fetch_assoc();
                if($loggedInPassword == $row["password"]){
                    $conn->query($sql33);
                    $val=5;
                    //echo "<script> alert($val) </script>";
                    //echo "<br> id: ". $row["id"]. " - Name: ". $row["password"]. "<br>";
                }else{
                    $val=6;
                }
            } else {
                $val=6;
            }

        }
        $conn->close();
        $valpass = json_encode ($val);
    ?>
    <form action="Customer.php" id="customer">
        <p style="color: green;">Coustomer form is accepted click submit to view your profile</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="CustomerLC.php" id="customerRT">
        <p style="color: red;">*Coustomer form is not accepted click submit to Retry</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="Seller.php" id="seller">
        <p style="color: green;">Seller form is accepted click submit to view your profile</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="SellerLC.php" id="sellerRT">
        <p style="color: red;">*Seller form is not accepted click submit to Retry</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="Agent.php" id="agent">
        <p style="color: green;">Agent form is accepted click submit to view your profile</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="AgentLC.php" id="agentRT">
        <p style="color: red;">*Agent form is not accepted click submit to Retry</p> <br><br>
        <input type="submit"><br><br>
    </form>
</body>
    <script type="text/javascript">
        var var1 = "<?= $valpass?>";
        if(var1 == 1){
            document.getElementById("customer").style.display= "block";
            document.getElementById("customerRT").style.display= "none";
            document.getElementById("seller").style.display= "none";
            document.getElementById("sellerRT").style.display= "none";
            document.getElementById("agent").style.display= "none";
            document.getElementById("agentRT").style.display= "none";
        }else if(var1 == 2){
            document.getElementById("customer").style.display= "none";
            document.getElementById("customerRT").style.display= "block";
            document.getElementById("seller").style.display= "none";
            document.getElementById("sellerRT").style.display= "none";
            document.getElementById("agent").style.display= "none";
            document.getElementById("agentRT").style.display= "none";
            //wrong login
        }else if(var1 == 3){
            document.getElementById("customer").style.display= "none";
            document.getElementById("customerRT").style.display= "none";
            document.getElementById("seller").style.display= "block";
            document.getElementById("sellerRT").style.display= "none";
            document.getElementById("agent").style.display= "none";
            document.getElementById("agentRT").style.display= "none";
        }else if(var1 == 4){
            document.getElementById("customer").style.display= "none";
            document.getElementById("customerRT").style.display= "none";
            document.getElementById("seller").style.display= "none";
            document.getElementById("sellerRT").style.display= "block";
            document.getElementById("agent").style.display= "none";
            document.getElementById("agentRT").style.display= "none";
            //wrong login
        }else if(var1 == 5){
            document.getElementById("customer").style.display= "none";
            document.getElementById("customerRT").style.display= "none";
            document.getElementById("seller").style.display= "none";
            document.getElementById("sellerRT").style.display= "none";
            document.getElementById("agent").style.display= "block";
            document.getElementById("agentRT").style.display= "none";
        }else if(var1 == 6){
            document.getElementById("customer").style.display= "none";
            document.getElementById("customerRT").style.display= "none";
            document.getElementById("seller").style.display= "none";
            document.getElementById("sellerRT").style.display= "none";
            document.getElementById("agent").style.display= "none";
            document.getElementById("agentRT").style.display= "block";
            //wrong login
        }
    </script>
</html>