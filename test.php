

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
        
                    <td colspan="2" align="center" >
                    <input type="button" name="onethousand" id="onethousand" value="1000" />
                    <input type="button" name="twothousand" id="twothousand" value="2000" />
                    <input type="button" name="fivethousand" id="fivethousand" value="5000" />
                    <input type="button" name="tenthousand" id="tenthousand" value="10000" />
                    </td>
                    <tr>
                    
                    <td  align="left" >
                    <font>&emsp;其他金額：</font></td>
                    <td>
                    <input type="text" name="tenthousand" id="tenthousand" placeholder="請以千元為基底" value="" />
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input type="submit" name="depositsOK" id="depositsOK" value="確定存入金額" />
                        </td>
        </table>
    </form>
    <script>
    $(document).ready(function(){
        $('#onethousand').click(function(){
            
            <?php $_SESSION["amount"]=1000;
                
            ?>
              var ds ="<?php echo $_SESSION["amount"];?>" ; //賦值
              alert(ds);
        })
        $('#twothousand').click(function(){
            <?php $_SESSION["amount"]=2000;
                
            ?>
              var ds ="<?php echo $_SESSION["amount"];?>" ; //賦值
              alert(ds);
        })
    });
    </script>
</body>
</html>