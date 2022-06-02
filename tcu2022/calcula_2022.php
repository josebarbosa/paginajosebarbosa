<?php
if(!$_POST['cargo']) header('location:index.php');
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
  <head>
		<!--
			Inclui a biblioteca bootstrap, para melhorar o visual da página.
		-->
    <?php
    include '../bootstrap.php';
    include '../../funcoes.php';
    ?>
                <style type="text/css">
                        BODY{
                                font-family: arial, verdana, courier;
                        }
                </style>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-19927451-1']);
            _gaq.push(['_trackPageview']);

            (function() {
              var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

          </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74364698-1', 'auto');
  ga('send', 'pageview');

</script>

        <title>Resultado da Simulação</title>
    </head>
    <body>
      <?php
      include '../menu.php';
      ?>
                <div class="container" style="background-color:#FFF">
<?php
    setlocale(LC_ALL, 'pt_BR');


    echo "<h3>Resultado</h3><a href='index.php'>Novo Cálculo</a> <hr />";


        $previdencia = $_POST['previdencia'];
        $funprespIndice = $_POST['funprespIndice'];
        $funprespFC = $_POST['funcaoContribuicaoFunpresp'];
        $cargo = $_POST['cargo'];
        $nivel = $_POST['nivel'];
        $fc = $_POST['fc'];
        $jornada = $_POST['jornada'];
        $desempenho = $_POST['desempenho'];
        $vpni = $_POST['vpni'];
        $vpni = explode(",", $vpni);
        $vpni = implode(".", $vpni);

        $anuenio = $_POST['anuenio'];
        $dependentes = $_POST['dependentes'];
        $dependentesCreche = $_POST['dependentesCreche'];
        if($_POST['funprespOpcional'])$funprespOpcional = $_POST['funprespOpcional']/100;



//falta considerar o cargo, se ÃƒÂƒÃ‚Â© MPU ou Judiciário, negritar linha do salário e mostrar a reestruturação de 15 para 13 nÃƒÂƒÃ‚Â­veis
//ÃƒÂƒÃ‚Â© colocado um if para testar se nÃƒÂƒÃ‚Â£o está sendo enviado um formulário vazio, o que pode ser o caso de quem entra diretamente atravÃƒÂƒÃ‚Â©s do site calcula.php, por exemplo.

/*
 * CabeÃƒÂ§alhos: nÃƒÂ£o devem ser alterados, contÃƒÂ©m a configuraÃƒÂ§ÃƒÂ£o para acesso ao banco de dados.
 * Tabelas utilizadas atualmente no banco de dados
 * 1) gajgampuindice: referencia, indice (exemplo referencia: 42016; indice 0.9688
 * 2) vencimentos: referencia, cargo, nivel, vencimento_basico (exemplo referencia: 42016; cargo 3; nivel 13; vencimento_basico 7061.77
 */

                /*
                 * Função que formata os nÃºmeros em dois algarismos
                 */


	//Testando o novo banco de dados em localhost.
        //ConexÃ£o com o banco de dados
        //    $conexao = mysqli_connect("br1004.hostgator.com.br", "joseba98_pub", "josebarbosa04", "joseba98_josebarbosa04");
        //setlocale(LC_ALL, 'pt_BR');
        // a consulta sql ÃƒÂ© a seguinte: select referencia from gajgampuindice;

//        or die ("Seleção não realizada.");




                /*
                * Dentro do loop, busca o vencimento bÃ¡sico
                */
                $query = "select valorvb as vb from vencimentos where
                cargo='".$cargo."' AND
                nivel='".$nivel."' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $vencimento[0] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentos5 where
                cargo='".$cargo."' AND
                nivel='".$nivel."' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $vencimento[1] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentospl where
                cargo='".$cargo."' AND
                nivel='".$nivel."' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $vencimento[2] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentospl where
                cargo='".$cargo."' AND
                nivel='".$nivel."' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $vencimento[3] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentos where
                cargo='".$cargo."' AND
                nivel='13' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $maiorVencimento[0] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentos5 where
                cargo='".$cargo."' AND
                nivel='13' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $maiorVencimento[1] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentospl where
                cargo='".$cargo."' AND
                nivel='13' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $maiorVencimento[2] = $row2['vb'] * $jornada;

                $query = "select valorvb as vb from vencimentospl where
                cargo='".$cargo."' AND
                nivel='13' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $maiorVencimento[3] = $row2['vb'] * $jornada;

                echo "<table class='table table-sm table-striped'>
                <thead class='table-light'>
                <th>Rubrica</th><th>Valor Atual (R$)</th><th>Revisão Geral 5%</th><th>PL 1392/2022</th><th> 5% + 8%</th></thead>
                <tbody>
                <tr class='table-success'>
                <td>Vencimento Básico (".$nivel."): </td><td align='right'>".formataNumeroReal($vencimento[0])." </td>
                <td align='right'>".formataNumeroReal($vencimento[1])." </td>
                <td align='right'>".formataNumeroReal($vencimento[2])." </td>
                <td align='right'>".formataNumeroReal($vencimento[3])." </td>
                </tr>";

                for($x = 0; $x <= 3; $x++){
                  $bruto[$x] = $vencimento[$x];
                  $baseIrrf[$x] = $vencimento[$x];
                  $basepss[$x] = $vencimento[$x];
                  $remuneracao[$x] = $vencimento[$x];
                }
                /*
                * Busca o valor relativo ÃƒÂ&nbsp; GAMPU/GAJ
                */
                $query = "select indice from percentuais_gce where cargo='".$cargo."' AND nivel='".$nivel."' limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $gce = $row2['indice'];

                $gceIndice = $gce/100;
                for($x = 0; $x <= 3; $x++){
                  echo $gceValor[$x];
                  $gceValor[$x] = round(($vencimento[$x] * $gceIndice),2);
                }
                echo "<tr class='table-success'><td>GCE: </td>
                <td align='right'>".formataNumeroReal($gceValor[0])." </td>
                <td align='right'>".formataNumeroReal($gceValor[1])." </td>
                <td align='right'>".formataNumeroReal($gceValor[2])." </td>
                <td align='right'>".formataNumeroReal($gceValor[3])." </td>
                </tr>";
                for($x = 0; $x <= 3; $x++){
                  $bruto[$x] += $gceValor[$x];
                  $baseIrrf[$x] += $gceValor[$x];
                  $basepss[$x] += $gceValor[$x];
                  $remuneracao[$x] += $gceValor[$x];
                }

                $desempenhoIndice = $desempenho/100;
                for($x = 0; $x <= 3; $x++){
                  $desempenhoValor[$x] = round(($maiorVencimento[$x] * $desempenhoIndice),2);
                }
                echo "<tr class='table-success'><td>Grat. Desempenho: </td>
                <td align='right'>".formataNumeroReal($desempenhoValor[0])." </td>
                <td align='right'>".formataNumeroReal($desempenhoValor[1])." </td>
                <td align='right'>".formataNumeroReal($desempenhoValor[2])." </td>
                <td align='right'>".formataNumeroReal($desempenhoValor[3])." </td>
                </tr>";
                for($x = 0; $x <= 3; $x++){
                  $bruto[$x] += $desempenhoValor[$x];
                  $baseIrrf[$x] += $desempenhoValor[$x];
                  $basepss[$x] += $desempenhoValor[$x];
                  $remuneracao[$x] += $desempenhoValor[$x];
                }

                /*
                * Calcula o valor de FC ou CC do TCU
                */
                if($_POST['fc'] != ""){
                        //busca o valor de opção no banco de dados

                        $query = "select valor as fc from funcoes where nivel='".$fc."'  limit 1";
                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $fcValor[0] = $row2['fc'];

                        $query = "select valor as fc from funcoes5 where nivel='".$fc."'  limit 1";
                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $fcValor[1] = $row2['fc'];

                        $query = "select valor as fc from funcoespl where nivel='".$fc."'  limit 1";
                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $fcValor[2] = $row2['fc'];

                        if($fc <= 6){
                          $query = "select valor as fc from funcoes where nivel='".$fc."'  limit 1";
                        }else{
                          $query = "select valor as fc from funcoespl where nivel='".$fc."'  limit 1";
                        }
                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $fcValor[3] = $row2['fc'];


                        echo "<tr class='table-success'><td>Função/Cargo de Confiança: </td>
                          <td align='right'>".formataNumeroReal($fcValor[0])." </td>
                          <td align='right'>".formataNumeroReal($fcValor[1])." </td>
                          <td align='right'>".formataNumeroReal($fcValor[2])." </td>
                          <td align='right'>".formataNumeroReal($fcValor[3])." </td>
                        </tr>";
                        for($x = 0; $x <= 3; $x++){
                          $bruto[$x] += $fcValor[$x];
                          $baseIrrf[$x] += $fcValor[$x];
                          $remuneracao[$x] += $fcValor[$x];
                          if($funprespFC && $previdencia==2)$basepss[$x] += $fcValor[$x];
                        }
                }

                /*
                * Busca o valor dos anuÃƒÂªnios
                */
            if($anuenio){
              for($x = 0; $x <= 3; $x++){
                $anuenioValor[$x] = round(($vencimento[$x] * $anuenio / 100),2);
              }


                        echo "<tr class='table-success'><td>Anuênio: </td>
                        <td align='right'>".formataNumeroReal($anuenioValor[0])." </td>
                        <td align='right'>".formataNumeroReal($anuenioValor[1])." </td>
                        <td align='right'>".formataNumeroReal($anuenioValor[2])." </td>
                        <td align='right'>".formataNumeroReal($anuenioValor[3])." </td>
                        </tr>";
                        for($x = 0; $x <= 3; $x++){
                          $bruto[$x] += $anuenioValor[$x];
                          $baseIrrf[$x] += $anuenioValor[$x];
                          $basepss[$x] += $anuenioValor[$x];
                          $remuneracao[$x] += $anuenioValor[$x];
                        }
                }
                /*
                * Soma valor do VPNI, se houver
                */
                $vpi = 68.85;

                  echo "<tr class='table-success'><td>VPI: </td>
                  <td align='right'>".formataNumeroReal($vpi)." </td>
                  <td align='right'>".formataNumeroReal($vpi)." </td>
                  <td align='right'>".formataNumeroReal($vpi)." </td>
                  <td align='right'>".formataNumeroReal($vpi)." </td>
                  </tr>";
                  for($x = 0; $x <= 3; $x++){
                    $bruto[$x] += $vpi;
                    $baseIrrf[$x] += $vpi;
                    $basepss[$x] += $vpi;
                    $remuneracao[$x] += $vpi;
                  }

                if($vpni>0){
                        $vpniAjustada = $vpni * 1.05;
                        echo "<tr class='table-success'><td>VPNI: </td>
                        <td align='right'>".formataNumeroReal($vpni)." </td>
                        <td align='right'>".formataNumeroReal($vpniAjustada)." </td>
                        <td align='right'>".formataNumeroReal($vpni)." </td>
                        <td align='right'>".formataNumeroReal($vpniAjustada)." </td>
                        </tr>";
                        for($x = 0; $x <= 3; $x++){
                          if($x % 2 == 0){
                            $bruto[$x] += $vpni[$x];
                            $baseIrrf[$x] += $vpni[$x];
                            $basepss[$x] += $vpni[$x];
                            $remuneracao[$x] += $vpni[$x];
                          }else{
                            $bruto[$x] += $vpniAjustada[$x];
                            $baseIrrf[$x] += $vpniAjustada[$x];
                            $basepss[$x] += $vpniAjustada[$x];
                            $remuneracao[$x] += $vpniAjustada[$x];
                          }

                        }

                }
                /*
                * Apura o valor do auxÃƒÂ­lio alimentação
                */

            $auxilioAlimentacao = 1011.04;
            echo "<tr class='table-success'><td>Auxílio-alimentação: </td><td align='right'>".formataNumeroReal($auxilioAlimentacao)." </td>
            <td align='right'>".formataNumeroReal($auxilioAlimentacao)." </td><td align='right'>".formataNumeroReal($auxilioAlimentacao)." </td>
            <td align='right'>".formataNumeroReal($auxilioAlimentacao)." </td></tr>";
            for($x = 0; $x <= 3; $x++){
              $bruto[$x] += $auxilioAlimentacao;
            }

                /*
                * Apura o valor do auxÃ­lio-creche
                */
                if($dependentesCreche){
                    $auxilioCreche = $dependentesCreche * 791.58;
                    echo "<tr class='table-success'><td>Auxílio-creche: </td><td align='right'>".formataNumeroReal($auxilioCreche)." </td>
                  <td align='right'>".formataNumeroReal($auxilioCreche)." </td><td align='right'>".formataNumeroReal($auxilioCreche)." </td>
                    <td align='right'>".formataNumeroReal($auxilioCreche)." </td></tr>";
                    for($x = 0; $x <= 3; $x++){
                      $bruto[$x] += $auxilioCreche;
                    }
            }




                /*
                * Calcula salário bruto
                */
                echo "<tr  class='table-info'><td><b>SALÁRIO BRUTO</b>: </td>
                <td align='right'><font size='4'><b>".formataNumeroReal($bruto[0])." </b></font></td>
                <td align='right'><font size='4'><b>".formataNumeroReal($bruto[1])." </b></font></td>
                <td align='right'><font size='4'><b>".formataNumeroReal($bruto[2])." </b></font></td>
                <td align='right'><font size='4'><b>".formataNumeroReal($bruto[3])." </b></font></td></tr>";

                /*
                * DESCONTOS
                */


                //arrumar aqui - cálculo da previdência - ajustar após reforma
                /*
                * calcula PSS: apresenta dois valores, um com Regime geral antigo, outro com teto
                * Regime prÃƒÂ³prio = 1; funpresp (sem calcular contribuiÃƒÂ§ÃƒÂ£o = 2)
                * LEMBRAR DE TODO LIST CORRIGIR A VARIÃ�VEL CASO ADOTE FUNÃ‡Ã•ES (HAVERIA DIVERGÃƒÂŠNCIA)
                *
                * Incluir nos prÃƒÂ³ximos anos as correÃƒÂ§ÃƒÂµes do teto da previdÃƒÂªncia
                * Teto em 2016: R$ 5189,82
                */
                $query = "select tetovalor as teto from previdenciateto where ano<='2022' ORDER BY ano DESC limit 1";
                $resultado3 = mysqli_query($conexao, $query) or die ("Erro de consulta do teto previdenciário.");
                $row3 = mysqli_fetch_array($resultado3, MYSQLI_ASSOC);
                $teto = $row3['teto'];
                //tabela previdenciateto colunas ano e tetovalor


                if($previdencia == 1 || $basepss <  $teto){
                    for($x = 0; $x <= 3; $x++) $pssValor[$x] = round(calculaNovaPrevidencia($basepss[$x],2022),2);
                    //$pssValor = round(($basepss * 0.11),2);
                    //considera nova alíquota de 14% a partir de 01/02/2018 para os que recebem acima do teto e estão nos regimes de integralidade e média
                    //apontar aqui para a função previdência - função previdência
                }
                else {

                    for($x = 0; $x <= 3; $x++) $pssValor[$x] = round(calculaNovaPrevidencia($teto,2022),2);

                }
                for($x = 0; $x <= 3; $x++){
                  $descontos[$x] += $pssValor[$x];
                  $rendimentosTributaveis[$x] = $baseIrrf[$x];
                  $baseIrrf[$x]-= $pssValor[$x];
                }

                echo "<tr class='table-warning'><td>PSS: </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($pssValor[0]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($pssValor[1]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($pssValor[2]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($pssValor[3]).")</font> </td>
                </tr>";

                //Calculo de contribuição do FUNPRESP
                if($previdencia == 2 && $basepss >= $teto && $funprespIndice > 0){
                    for($x = 0; $x <= 3; $x++){
                        $funprespValor[$x] = round((($basepss[$x] - $teto) * $funprespIndice),2);
                        $descontos[$x] += $funprespValor[$x];
                        $baseIrrf[$x] -= $funprespValor[$x];
                      }
                        echo "<tr><td>Contribuição Funpresp (".($funprespIndice*100)."%): </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespValor[0]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespValor[1]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespValor[2]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespValor[3]).")</font> </td>
                        </tr>";
                  if($funprespOpcional > 0){
                    for($x = 0; $x <= 3; $x++){
                        $funprespOpcionalValor[$x] = round((($basepss[$x] - $teto) * $funprespOpcional),2);
                        $descontos[$x] += $funprespOpcionalValor[$x];
                        $baseIrrf[$x] -= $funprespOpcionalValor[$x];
                      }
                        echo "<tr class='table-warning'><td>Contribuição Funpresp Opcional (".($funprespOpcional*100)."%): </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespOpcionalValor[0]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespOpcionalValor[1]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespOpcionalValor[2]).")</font> </td>
                        <td align='right'><font color='660000'>(".formataNumeroReal($funprespOpcionalValor[3]).")</font> </td>
                        </tr>";

                  }
                }


                /*
                * Apura imposto de renda (a funÃƒÂ§ÃƒÂ£o de imposto de renda jÃƒÂ¡ estÃƒÂ¡ escrita, olhar no final do cÃƒÂ³digo)
                */
                for($x = 0; $x <= 3; $x++){
                  $irrfValor[$x] = calculaIRRF($baseIrrf[$x], $dependentes, 0);
                  $descontos[$x] += $irrfValor[$x];
                }
                echo "<tr class='table-warning'><td>Imposto de Renda: </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($irrfValor[0]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($irrfValor[1]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($irrfValor[2]).")</font> </td>
                <td align='right'><font color='660000'>(".formataNumeroReal($irrfValor[3]).")</font> </td></tr>";

                echo "<tr class='table-info'><td>Total de Descontos: </td>
                <td align='right'><font color='660000'><b>(".formataNumeroReal($descontos[0]).")</b></font></td>
                <td align='right'><font color='660000'><b>(".formataNumeroReal($descontos[1]).")</b></font></td>
                <td align='right'><font color='660000'><b>(".formataNumeroReal($descontos[2]).")</b></font></td>
                <td align='right'><font color='660000'><b>(".formataNumeroReal($descontos[3]).")</b></font></td></tr>";


                for($x = 0; $x <= 3; $x++)   $liquido[$x] = $bruto[$x] - $descontos[$x];

                echo "<tr class='table-dark'><td><b>SALÁRIO LÍQUIDO</b>: </td>
                <td align='right' ><font size='4'><b>".formataNumeroReal($liquido[0])."</b></font> </td>
                <td align='right' ><font size='4'><b>".formataNumeroReal($liquido[1])."</b></font> </td>
                <td align='right' ><font size='4'><b>".formataNumeroReal($liquido[2])."</b></font> </td>
                <td align='right' ><font size='4'><b>".formataNumeroReal($liquido[3])."</b></font> </td>
                </tr>";

                /*
                * Informações complementares
Rendimentos Tributáveis
Margem consignável
                */
echo "<tr><td><font size='2'>Rendimentos Tributáveis</b>: </td>
<td align='right'><b>".formataNumeroReal($rendimentosTributaveis[0])."</font> </td>
<td align='right'><b>".formataNumeroReal($rendimentosTributaveis[1])."</font> </td>
<td align='right'><b>".formataNumeroReal($rendimentosTributaveis[2])."</font> </td>
<td align='right'><b>".formataNumeroReal($rendimentosTributaveis[3])."</font> </td>
</tr>";


             echo "</tbody></table><hr />";

             /*
             CALCULAR PLAN-ASSISTE
             Se for servidor do MPU, abrir um link para calcular as despesas do plan-assiste, passando
             num post as variáveis de salário bruto e líquido.
             Verificar se passa o teto do auxílio saúde também e repassar os valores aos servidores.


             */










	mysqli_close($conexao);
    ?>


         <br />
         <div>
                        <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                        <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
                        <!-- NÃƒÂƒO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                        <input type="hidden" name="currency" value="BRL" />
                        <input type="hidden" name="receiverEmail" value="jose.as.barbosa@uol.com.br" />
                        <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - ÃƒÂ© rÃƒÂ¡pido, grÃƒÂ¡tis e seguro!" />
                        </form>
                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
        </div>
                <p>Se você gostou, contribua com a iniciativa. Doe! A sua contribuição é importante para manter os custos de manutenção de hospedagem e registro de domínio da página. </p>
                <a href='index.php'>Novo Cálculo</a>
                <hr width="50%">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5983876568090420"
     crossorigin="anonymous"></script>
        <p>Atualizado em 31/05/2022. </p>
 </div></body>
</html>
