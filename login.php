<?php
    session_start();
    if(isset($_POST["registered"])){
        header("Location: registered.php");
    }
    if(isset($_POST["login"])){
        if($_POST["username"]!="" && $_POST["passwd"]!=""){
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["passwd"] = $_POST["passwd"];
            require_once("connMysql.php");
            //echo "ok1";
            $commandText = sprintf ( "SELECT accountid,password 
                FROM account 
                WHERE accountid='%s' AND password='%s'", $_POST["username"], $_POST["passwd"] );
            $result=$db_link->query ( $commandText );
            $row=mysqli_num_rows($result);
            //echo "row=",$row;
            $db_link->close();
            if($row>0){
                header("Location: userView.php");
            }
            else{
                echo "<script>alert('登入失敗！');</script>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="form1" name="form1" method="POST" action="login.php">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <font color="#FFFFFF">帳戶登入</font></td>
            </tr>
            <tr><td width="80" align="center" valign="baseline">帳號</td>
                <td valign="baseline"><input type="text" name="username" id="username" /></td>
            </tr>
            <tr><td width="80" align="center" valign="baseline">密碼</td>
                <td valign="baseline"><input type="password" name="passwd" id="passwd" /></td>
            </tr>
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <input type="submit" name="login" id="login" value="登入" />
                <input type="submit" name="registered" id="registered" value="註冊" /></td>
            </tr>
        </table>
    </form>
</body>
</html>