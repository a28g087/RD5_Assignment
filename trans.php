<?php
    session_start();
    if(isset($_POST["logout"])){
        header("Location: login.php");
    }


    if(isset($_SESSION["username"]) && isset($_SESSION["passwd"])){
        require_once("connMysql.php");
        
        $commandText = sprintf ( "SELECT accountid,password,amount 
            FROM account 
            WHERE accountid='%s' AND password='%s'", $_SESSION["username"], $_SESSION["passwd"] );
        $result=$db_link->query ( $commandText );
        $row=mysqli_fetch_assoc($result);
        if(isset($_SESSION["trans"])){
            require_once("connMysql.php");
            $commandText = sprintf ( "SELECT * FROM detail
                WHERE accountid='%s' 
                ORDER BY id DESC LIMIT 0 , 1", $_SESSION["username"]);
            $result=$db_link->query ($commandText);
            $row_detail=mysqli_fetch_assoc($result);
            
        }
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
    
    <form id="form1" name="form1" method="POST" action="userView.php">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <font color="#FFFF00"><?=$_SESSION["username"]?>的帳戶</font></td>
            </tr>
            <tr><td colspan="2" width="80" align="center" valign="baseline">帳戶餘額：
                <label id="Money"><?=$row["amount"]?></label>元
                <input type="button" name="hiddenMoney" id="hiddenMoney" value="隱藏金額">
                <HR>
                </td>
            </tr>

            <tr><td colspan="2" align="center" >
            &emsp;交易成功！</td>
            </tr>
            <tr> 
                <td colspan="2" align="center" >
                <input type="button" name="detail" id="detail" value="查詢明細" />
                </td>
            </tr>
            <tr><td colspan="2" align="left" id="list">
                
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" >
                
                </td>
            </tr>
            <tr><td colspan="2" align="center" bgcolor="#CCCCCC">
                <input type="submit" name="back" id="back" value="繼續交易" />
                <input type="submit" name="logout" id="logout" value="登出" /></td>
            </tr>
        </table>
    </form>

    <script>
    $(document).ready(function(){
        
        $('input[type=button][name=detail]').click( function(){
            if(event.target.id=='detail'){
                $("#list").empty();
                var $li = $("<p></p>")
                        .text("交易類別：<?php echo $row_detail["type"]?>");
                $li.appendTo("#list");
                $li = $("<p></p>")
                        .text("交易金額：<?php echo $row_detail["typeamount"]?>");
                $li.appendTo("#list");
                $li = $("<p></p>")
                        .text("交易時間：<?php echo $row_detail["date"]?>");
                $li.appendTo("#list");
                $li = $("<p></p>")
                        .text("交易結果：<?php echo $row_detail["result"]?>");
                $li.appendTo("#list");
                
            }
         
        });
        $('#hiddenMoney').click(function(){
            var btnVal=$('#hiddenMoney').val();
            //alert(btnVal);
            if(btnVal=="隱藏金額"){
                var str = $( "#Money" ).text();
                var n = str.length;
                var star="";
                for(let i=0;i<n;i++){
                    star+="*";
                }
                //alert(str+star);
                $("#Money").text(star);
                $('#hiddenMoney').val("顯示金額");
            }
            else if(btnVal=="顯示金額"){
                var str = "<?=$row["amount"]?>";
                //alert(str+star);
                $("#Money").text(str);
                $('#hiddenMoney').val("隱藏金額");
            }
        });
    });
    </script>

</body>
</html>