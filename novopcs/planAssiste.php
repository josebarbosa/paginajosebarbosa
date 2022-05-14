<?php
//Vou pegar as variáveis submetidas via post e gerar um formulário. Se estiver em branco, devolve para index.php
//if($_POST['salarioBruto']=="") header("location: index.php"); else{

    session_start();
    $salarioBruto = $_POST['salarioBruto'];
    $descontos = $_POST['descontos'];
    
    $tabelaContribuicoes = array(
        array(1, "00-18", 131.29, 446.88), 
        array(2, "19-23", 203.98, 459.20),
        array(3, "24-28", 282.10, 526.40),
        array(4, "29-33", 284.27, 560.00),
        array(5, "34-38", 298.38, 683.20),
        array(6, "39-43", 328.76, 728.00),
        array(7, "44-48", 358.05, 873.60),
        array(8, "49-53", 458.96, 1086.40),
        array(9, "54-58", 494.76, 1478.40),
        array(10,"59 ou maior", 632.56, 1573.60)
    );

//}
?>
<html>
<head>
    <title>Cálculo Plan-Assiste</title>
</head>
<body>
    <form action="planAssiste.php" method="post">
        <table>
            Em implementação.
            <?php
echo $salarioBruto;
echo $descontos;
            ?>
        </table>
    </form>
</body>
</html>