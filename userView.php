<?php
    session_start();
    if(isset($_POST["logout"])){
        header("Location: login.php");
    }
    if(isset($_POST["back"])){
        unset($_SESSION["deposits"]);
        unset($_POST["hiddenamount"]);
        unset($_SESSION["amount"]);
        unset($_SESSION["withdraw"]);
        unset($_SESSION["withdraw"]);
        header("Location: userView.php");
    }

    if(isset($_SESSION["deposits"])){
        
        if(isset($_POST["inputamount"])){
            $check100=$_POST["inputamount"];
            if($check100%100!=0){
                echo "ERROR!!";
            }
            else{
                require_once("connMysql.php");
                $total=0;
                $commandText = sprintf ( "INSERT INTO detail(accountid,type,typeamount,date,result) 
                    VALUES('%s', '存款', '%s', NOW(), 'OK')"
                    , $_SESSION["username"], $check100 );
                if($result=$db_link->query ( $commandText )){
                    $total=$_SESSION["amount"]+$check100;
                    $commandText = sprintf ( "UPDATE account 
                        SET amount = '%s' WHERE accountid = '%s'"
                        , $total, $_SESSION["username"] );
                    $result=$db_link->query ( $commandText );
                    unset($_SESSION["deposits"]);
                    unset($_SESSION["amount"]);
                    $_SESSION["trans"]="成功";
                    header("Location: trans.php");
                }
            }
        }
        elseif(isset($_POST["hiddenamount"])){
            require_once("connMysql.php");
            $total=0;
            
            $commandText = sprintf ( "INSERT INTO detail(accountid,type,typeamount,date,result) 
                VALUES('%s', '存款', '%s', NOW(), 'OK')"
                , $_SESSION["username"], $_POST["hiddenamount"] );
            if($result=$db_link->query ( $commandText )){
                $total=$_SESSION["amount"]+$_POST["hiddenamount"];
                $commandText = sprintf ( "UPDATE account 
                    SET amount = '%s' WHERE accountid = '%s'"
                    , $total, $_SESSION["username"] );
                $result=$db_link->query ( $commandText );
                unset($_SESSION["deposits"]);
                unset($_SESSION["amount"]);
                $_SESSION["trans"]="成功";
                header("Location: trans.php");
            }
        }
        else{
            header("Location: userView.php");
        }
        unset($_SESSION["deposits"]);
        unset($_POST["hiddenamount"]);
    }

    if(isset($_SESSION["withdraw"])){

        if(isset($_POST["inputamount"])){
            $check100=$_POST["inputamount"];
            if($check100%100!=0){
                echo "ERROR!!";
            }
            else{
                require_once("connMysql.php");
                $total=0;
                $total=$_SESSION["amount"]-$check100;
                if($total>=0){
                    $commandText = sprintf ( "INSERT INTO detail(accountid,type,typeamount,date,result) 
                        VALUES('%s', '提款', '%s', NOW(), 'OK')"
                        , $_SESSION["username"], $check100 );
                    if($result=$db_link->query ( $commandText )){
                        $commandText = sprintf ( "UPDATE account 
                            SET amount = '%s' WHERE accountid = '%s'"
                            , $total, $_SESSION["username"] );
                        $result=$db_link->query ( $commandText );
                        unset($_SESSION["withdraw"]);
                        $_SESSION["trans"]="成功";
                        header("Location: trans.php");
                    }
                }
            }
        }

        elseif(isset($_POST["hiddenamount"])){
            require_once("connMysql.php");
            $total=0;
            $total=$_SESSION["amount"]-$_POST["hiddenamount"];
            if($total>=0){
            $commandText = sprintf ( "INSERT INTO detail(accountid,type,typeamount,date,result) 
                VALUES('%s', '提款', '%s', NOW(), 'OK')"
                , $_SESSION["username"], $_POST["hiddenamount"] );
                if($result=$db_link->query ( $commandText )){
                    $commandText = sprintf ( "UPDATE account 
                        SET amount = '%s' WHERE accountid = '%s'"
                        , $total, $_SESSION["username"] );
                    $result=$db_link->query ( $commandText );
                    unset($_SESSION["withdraw"]);
                    $_SESSION["trans"]="成功";
                    header("Location: trans.php");
                }
            }
            
        }
        else{
            header("Location: userView.php");
        }
        unset($_SESSION["withdraw"]);
        unset($_POST["hiddenamount"]);
    }


    if(isset($_SESSION["username"]) && isset($_SESSION["passwd"])){
        require_once("connMysql.php");
        $commandText = sprintf ( "SELECT accountid,password,amount 
            FROM account 
            WHERE accountid='%s' AND password='%s'", $_SESSION["username"], $_SESSION["passwd"] );
        $result=$db_link->query ( $commandText );
        $row=mysqli_fetch_assoc($result);
        $db_link->close();
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="./jquery-1.9.1.min.js"></script>
</head>
<body>
    <div name="test" id="test"></div>
    <form id="form1" name="form1" method="POST" action="userView.php">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <font color="#FFFF00"><?=$_SESSION["username"]?>的帳戶</font></td>
            </tr>
            <tr><td colspan="2" width="80" align="center" valign="baseline">帳戶餘額：
                <?=$row["amount"]?>元<HR></td>
            </tr>

            <tr><td colspan="2" align="left" >
                <font>&emsp;請選擇使用項目：</font></td>
            </tr>
            <tr><?php
                    if(isset($_POST["deposits"]) || isset($_POST["withdraw"])){
                        if(isset($_POST["deposits"])){
                            echo $_POST["deposits"];
                            $_SESSION["deposits"]=$_POST["deposits"];
                            $_SESSION["amount"]=$row["amount"];
                        }
                        elseif(isset($_POST["withdraw"])){
                            echo $_POST["withdraw"];
                            $_SESSION["withdraw"]=$_POST["withdraw"];
                            $_SESSION["amount"]=$row["amount"];
                        }
                ?>
                    <tr><td colspan="2" align="left" >
                    <font>&emsp;請選擇<?= isset($_POST["deposits"]) ? "存入":"提款"?>金額：</font></td>
                    </tr>
                    <td colspan="2" align="center" >

                    <input type="radio" name="amount" value="1000"id="onethousand"><label for="onethousand">1000</label>
                    <input type="radio" name="amount" value="2000"id="twothousand"><label for="twothousand">2000</label>
                    <input type="radio" name="amount" value="5000"id="fivethousand"><label for="fivethousand">5000</label>
                    <input type="radio" name="amount" value="10000"id="tenthousand"><label for="tenthousand">10000</label>

                    </td>
                    <tr>
                    
                    <td  colspan="2" align="center" >
                    <input type="radio" name="amount" value="其他金額："id="elseamount" ><label for="elseamount">其他金額：</label>
                    <input type="text" disabled="disabled" name="inputamount" id="inputamount" placeholder="請以百元為基底" value="" />
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input type="hidden" name="hiddenamount" id="hiddenamount" value="">
                        <input type="submit" name="<?= isset($_POST["deposits"]) ? "deposits":"withdraw"?>" id="<?= isset($_POST["deposits"]) ? "deposits":"withdraw"?>" value="確定<?= isset($_POST["deposits"]) ? "存入":"提款"?>金額" />
                        </td>
                    </tr>
                <?php
                    }
                    else{
                ?>
                <td colspan="2" align="center" >
                <input type="submit" name="deposits" id="deposits" value="存款" />
                <input type="submit" name="withdraw" id="withdraw" value="提款" />
                </td>
                    <?php }?>
            </tr>
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
            <?php if(isset($_POST["deposits"]) || isset($_POST["withdraw"])){ ?>
                <input type="submit" name="back" id="back" value="回上一頁" />
            <?php }?>
                <input type="submit" name="logout" id="logout" value="登出" /></td>
            </tr>
        </table>
    </form>

    <script>
    $(document).ready(function(){
        var amount=0;
        $('#inputamount').prop('disabled',true);
        $('input[type=radio][name=amount]').click( function(){
            if(event.target.id=='onethousand'){
                amount=$('#onethousand').attr('value');
                $('#test').html(amount); 
                $('#inputamount').prop('disabled',true);
                $('#hiddenamount').prop('value',amount);
            }
            else if(event.target.id=='twothousand'){
                amount=$('#twothousand').attr('value');
                $('#test').html(amount); 
                $('#inputamount').prop('disabled',true);
                $('#hiddenamount').prop('value',amount);
            }
            else if(event.target.id=='fivethousand'){
                amount=$('#fivethousand').attr('value');
                $('#test').html(amount); 
                $('#inputamount').prop('disabled',true);
                $('#hiddenamount').prop('value',amount);
            }
            else if(event.target.id=='tenthousand'){
                amount=$('#tenthousand').attr('value');
                $('#test').html(amount); 
                $('#inputamount').prop('disabled',true);
                $('#hiddenamount').prop('value',amount);
            }
            else if(event.target.id=='elseamount'){
                $('#inputamount').prop('disabled',false);
                //$('#hiddenamount').prop('value',amount);
                //$('#test').html(amount); 
            }
        });

    });
    </script>

</body>
</html>