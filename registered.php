<script>
 

</script>

<?php
    session_start();
    if(isset($_POST["determine"])){
        echo $_POST["determine"];
        require_once("connMysql.php");
        if($_POST["username"]!="" && $_POST["passwd"]!=""){
            require_once("connMysql.php");
            echo "ok1";
            $commandText = sprintf ( "INSERT INTO account (accountid,password,amount)
                VALUES('%s', '%s', '%s')", $_POST["username"], $_POST["passwd"], 0 );
            $result = $db_link->query ( $commandText );
            echo "ok2",$result;
            $db_link->close();
            header("Location: login.php");
        }
    }
    if(isset($_POST["cancel"])){
        header("Location: login.php");
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
    <form id="form1" name="form1" method="POST" action="registered.php">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <font color="#FFFFFF">會員註冊</font></td>
            </tr>
            <tr><td width="80" align="center" valign="baseline">註冊帳號</td>
                <td valign="baseline"><input type="text" name="username" id="username" /></td>
            </tr>
            <tr><td width="80" align="center" valign="baseline">註冊密碼</td>
                <td valign="baseline"><input type="password" name="passwd" id="passwd" /></td>
            </tr>
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <input type="submit" name="determine" id="determine" value="確定" />
                <input type="submit" name="cancel" id="cancel" value="取消" /></td>
            </tr>
        </table>
    </form>
</body>
</html>