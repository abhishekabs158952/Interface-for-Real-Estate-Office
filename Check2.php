<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Details</title>
    <!--<link rel="stylesheet" href="Agent_css.css">-->
</head>
<body style="text-align: center;">
    <?php 
        $servername = "localhost";
        $username = "root";
        $password = "Abhishe1";
        $dbname = "dbms_project2";
        $conn = new mysqli($servername, $username, $password, $dbname);
        $val=0;
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }    
        $sql1 = "SELECT id FROM buyer_login ";
        $sql2 = "SELECT id FROM seller_login ";
        $sql3=  "SELECT id from agent_login ";
        $result1 = $conn->query($sql1);
        $result2 = $conn->query($sql2);
        $result3 = $conn->query($sql3);
        if(array_key_exists('customer', $_POST)){
            if ($result1->num_rows > 0) {
                $val=1;
            } else {
                $val=2;
            }
        }else if(array_key_exists('seller', $_POST)){
            if ($result2->num_rows > 0) {
                $val=3;
            } else {
                $val=4;
            }
        }else if(array_key_exists('agent', $_POST)){
            if ($result3->num_rows > 0) {    
                $val=5;
            } else {
                $val=6;
            }
        }
        $conn->close();
        $valpass = json_encode ($val);
    ?>
    <form action="Customer.php" id="customer">
        <p style="color: green;">You are logged In</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="CustomerLC.php" id="customerRT">
        <p style="color: red;">click to login or create account</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="Seller.php" id="seller">
        <p style="color: green;">You are Logged In</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="SellerLC.php" id="sellerRT">
        <p style="color: red;">Click to login or create account</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="Agent.php" id="agent">
        <p style="color: green;">you are logged in</p> <br><br>
        <input type="submit"><br><br>
    </form>
    <form action="AgentLC.php" id="agentRT">
        <p style="color: red;">click to login or create account</p> <br><br>
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