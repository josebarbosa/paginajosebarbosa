<?php
if(!$_POST['orgao']) header('location:index.php');
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
  <head>
		<!--
			Inclui a biblioteca bootstrap, para melhorar o visual da página.
		-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                
                <div style="background-color:#FFF">
<?php
    setlocale(LC_ALL, 'pt_BR');


    echo "<h3>Resultado</h3><a href='index.php'>Novo Cálculo</a> <hr />";


    listaReferencias();
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
    function formataNumeroReal($numero){
                return number_format($numero, 2, ",", ".");
        }

function calculaNovaPrevidencia($vencimento, $ano){

        if($ano==2019){
            if($vencimento <= 998) return round(($vencimento * 0.075),2);
            if(998.01<= $vencimento && $vencimento <= 2000) return round(($vencimento * 0.09-14.97),2);
            if(2000.01<= $vencimento && $vencimento <= 3000) return round(($vencimento * 0.12-74.97),2);
            if(3000.01<= $vencimento && $vencimento <= 5839.45) return round(($vencimento * 0.14-134.97),2);
            if(5839.46<= $vencimento && $vencimento <= 10000) return round(($vencimento * 0.145-164.17),2);
            if(10000.01<= $vencimento && $vencimento <= 20000) return round(($vencimento * 0.165-364.17),2);
            if(20000.01<= $vencimento && $vencimento <= 39000) return round(($vencimento * 0.19-864.17),2);
            if(39000.01<= $vencimento ) return round(($vencimento * 0.22-2034.17),2);
        }
        if($ano ==2021){

            if($vencimento <= 1100) return round(($vencimento * 0.075),2);
            if(1100.01<= $vencimento && $vencimento <= 2203.48) return round(($vencimento * 0.09-16.50),2);
            if(2203.49<= $vencimento && $vencimento <= 3305.22) return round(($vencimento * 0.12-82.60),2);
            if(3305.23<= $vencimento && $vencimento <= 6433.57) return round(($vencimento * 0.14-148.70),2);
            if(6433.58<= $vencimento && $vencimento <= 11017.42) return round(($vencimento * 0.145-180.86),2);
            if(11017.43<= $vencimento && $vencimento <= 22034.83) return round(($vencimento * 0.165-401.20),2);
            if(22034.84<= $vencimento && $vencimento <= 42967.92) return round(($vencimento * 0.19-952.07),2);
            if(42967.93<= $vencimento ) return round(($vencimento * 0.22-2241.10),2);
        }
}


        /*
         * Busca as referÃªncias possÃƒÂ­veis, e faz um loop a cada uma delas.
         */

    function listaReferencias(){
        $orgao = $_POST['orgao'];
        $previdencia = $_POST['previdencia'];
        $funprespIndice = $_POST['funprespIndice'];
        $funprespFC = $_POST['funcaoContribuicaoFunpresp'];
        $atPSS = $_POST['atPSS'];
        $cargo = $_POST['cargo'];
        $nivel = $_POST['nivel'];
        $vpni = $_POST['vpni'];
        $vpni = explode(",", $vpni);
        $vpni = implode(".", $vpni);
        //indenizatorias
        $indenizatorias = $_POST['indenizatorias'];
        $indenizatorias = explode(",", $indenizatorias);
        $indenizatorias = implode(".", $indenizatorias);
        //outrosDescontos
        $outrosDescontos = $_POST['outrosDescontos'];
        $outrosDescontos = explode(",", $outrosDescontos);
        $outrosDescontos = implode(".", $outrosDescontos);
        //PensÃ£o AlimentÃ­cia Judicial
        $pensaoAlimentciaJudicial = $_POST['pensaoAlimenticiaJudicial'];
        $pensaoAlimentciaJudicial = explode(",", $pensaoAlimentciaJudicial);
        $pensaoAlimentciaJudicial = implode(".", $pensaoAlimentciaJudicial);
        if($_POST['gas'])$gas = $_POST['gas'];
        if($_POST['projeto'])$projeto = $_POST['projeto'];
        if($_POST['penosa'])$penosa = $_POST['penosa'];
        $aq = $_POST['aq'];
        $anuenio = $_POST['anuenio'];
        $at = $_POST['at'];
        $at_jud = $_POST['at_jud'];
        $dependentes = $_POST['dependentes'];
        $dependentesCreche = $_POST['dependentesCreche'];
        //campos opcionais
        $isPlanAssiste = $_POST['PlanAssiste'];
        $isParcIndenizatoria = $_POST['parcIndenizatoria'];
        $isPensaoJudicial = $_POST['pensaoJudicial'];
        $isOutrosDescontos = $_POST['outrosDescontosCheck'];
        //InformaÃ§Ãµes para Ã­ndice do plan-assiste
        $planTit = $_POST['planAssisteTitular'];
        $planConj = $_POST['planAssisteConjuge'];
        $planAssisteFilho = $_POST['planAssisteFilho'];
        $parcialJulho = $_POST['parcialjulho'];
        if($_POST['funprespOpcional'])$funprespOpcional = $_POST['funprespOpcional']/100;
        $gasIndice = $_POST['gas'];
        $at2015 = $at;
        $planAssistePais = $_POST['planAssistePais'];
        $planAssisteExConjuge = $_POST['planAssisteExConjuge'];
        $planAssisteBeneficiariosEspeciais = $_POST['planAssisteBeneficiariosEspeciais'];
        $pensaoAlimenticiaJudicialPercentual = $_POST['pensaoAlimenticiaJudicialPercentual'];

        //ConexÃ£o com o banco de dados
            $conexao = mysqli_connect("br1004.hostgator.com.br", "joseba98_pub", "josebarbosa04", "joseba98_josebarbosa04");
        setlocale(LC_ALL, 'pt_BR');

        // a consulta sql ÃƒÂ© a seguinte: select referencia from gajgampuindice;
        $query = "select referencia from gajgampuindice where referencia=12019";
        $resultado = mysqli_query($conexao, $query)
        or die ("Seleção não realizada.");
        while($row = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){
                $referencia = $row['referencia'];
                if (strlen($referencia) == 5){
                        //colocar aqui quanod mÃªs tiver apenas um dÃ­gito
                        $mesReferencia = substr($referencia, 0,1);
                }else{
                        //colocar aqui quando tiver dois dÃ­gitos
                        $mesReferencia = substr($referencia, 0,2);
                }
                $anoReferencia = substr($referencia, -4, 4);




                /*
                * Dentro do loop, busca o vencimento bÃ¡sico
                */
                $query = "select vencimento_basico as vb from vencimentos where
                referencia='".$referencia."' AND cargo='".$_POST['cargo']."' AND
                nivel='".$nivel."' limit 1";

                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $vencimento = $row2['vb'];
                echo "<table>
                <tr><td>Rubrica</td><td>Valor (R$)</td></tr>
                <tr><td>Vencimento Básico (".$nivel."): </td><td align='right'>".formataNumeroReal($vencimento)." </td></tr>";
                $bruto = $vencimento;
                $baseIrrf = $vencimento;
                $basepss = $vencimento;
                $remuneracao = $vencimento;
                /*
                * Busca o valor relativo ÃƒÂ&nbsp; GAMPU/GAJ
                */
                $query = "select indice as gaj from gajgampuindice where
                referencia='".$referencia."'  limit 1";
                $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                $gaj = $row2['gaj'];
                $gajIndice = $gaj;
                $gaj = round(($vencimento * $gaj),2);
                if($orgao==1) echo "<tr><td>GAMPU: </td><td align='right'>".formataNumeroReal($gaj)." </td></tr>";
                else echo "<tr><td>Gratificação Judiciária: </td><td align='right'>".formataNumeroReal($gaj)." </td></tr>";
                $bruto += $gaj;
                $baseIrrf += $gaj;
                $basepss += $gaj;
                $remuneracao+= $gaj;

                /*
                * Busca o valor relativo ÃƒÂ&nbsp; GAS ou GratificaÃƒÂ§ÃƒÂ£o de Projeto, se for o caso
                */
                if($gas){
                        $gasValor = round(($vencimento * $gasIndice),2);
                        echo "<tr><td>GAS/Projeto: </td><td align='right'>".formataNumeroReal($gasValor)." </td></tr>";
                        $bruto += $gasValor;
                        $baseIrrf += $gasValor;
                        $basepss+= $gasValor;
                        $remuneracao += $gasValor;
                }
                /*
                * Busca o valor relativo ÃƒÂ&nbsp; penosidade
                * utilizada a variavel gasvalor apenas por preguiÃƒÂ§a mesmo
                */
                if($penosa){
                        $gasValor = round(($vencimento * $penosa),2);
                        echo "<tr><td>Penosidade: </td><td align='right'>".formataNumeroReal($gasValor)." </td></tr>";
                        $bruto += $gasValor;
                        $baseIrrf += $gasValor;
                }
                /*
                * Busca o valor relativo ÃƒÂ&nbsp; adicional de qualificaÃƒÂ§ÃƒÂ£o
                */
                if($aq>0 ){
                        if($cargo == 3 && $aq==0.05) $gasValor=0;
                        else $gasValor = round(($vencimento * $aq),2);
                        echo "<tr><td>Adicional de Qualificação: </td><td align='right'>".formataNumeroReal($gasValor)." </td></tr>";
                        $bruto += $gasValor;
                        $baseIrrf += $gasValor;
                        $basepss += $gasValor;
                        $remuneracao += $gasValor;
                }
                /*
                * Busca o valor relativo ÃƒÂ&nbsp; adicional de treinamento
                */
                if($at && $orgao==1){
                        //novo at
                        if($referencia != 12015){
                                switch($at){
                                        case 0.01:
                                        $at = 0.025;
                                        default:
                                        $at = 0.05;
                                }
                        }
                        $atValor = round(($vencimento * $at),2);
                        echo "<tr><td>Adicional de Treinamento: </td><td align='right'>".formataNumeroReal($atValor)." </td></tr>";
                        $bruto += $atValor;
                        $baseIrrf += $atValor;

                        if($atPSS){
                                $basepss+= $atValor;
                        }
                }
                if($at_jud && $orgao==2){
                        $gasValor = round(($vencimento * $at_jud),2);
                        echo "<tr><td>Adicional de Treinamento: </td><td align='right'>".formataNumeroReal($gasValor)." </td></tr>";
                        $bruto += $gasValor;
                        $baseIrrf += $gasValor;

                                $remuneracao += $gasValor;
                        if($atPSS){
                                $basepss+= $gasValor;
                                $remuneracao += $gasValor;
                        }

                }
                /*
                * Busca o valor dos anuÃƒÂªnios
                */
            if($anuenio){
                        $gasValor = round(($vencimento * ($anuenio/100)),2);
                        echo "<tr><td>Anuênio: </td><td align='right'>".formataNumeroReal($gasValor)." </td></tr>";
                        $bruto += $gasValor;
                        $baseIrrf += $gasValor;
                        $basepss += $gasValor;
                        $remuneracao += $gasValor;
                }
                /*
                * Soma valor do VPNI, se houver
                */
                if($vpni>0){

                        echo "<tr><td>VPNI: </td><td align='right'>".formataNumeroReal($vpni)." </td></tr>";
                        $bruto += $vpni;
                        $baseIrrf += $vpni;
                        $basepss += $vpni;
                        $remuneracao += $vpni;
                }
                /*
                * Apura o valor do auxÃƒÂ­lio alimentação
                */

            $auxilioAlimentacao = 910.08;
            echo "<tr><td>Auxílio-alimentação: </td><td align='right'>".formataNumeroReal($auxilioAlimentacao)." </td></tr>";
            $bruto += $auxilioAlimentacao;

                /*
                * Apura o valor do auxÃ­lio-creche
                */
                if($dependentesCreche){
                    $auxilioCreche = $dependentesCreche * 719.62;
                    echo "<tr><td>Auxílio-creche: </td><td align='right'>".formataNumeroReal($auxilioCreche)." </td></tr>";
                    $bruto += $auxilioCreche;
            }
            if($indenizatorias > 0 && $isParcIndenizatoria == 1){
                    echo "<tr><td>Parcelas Indenizatórias: </td><td align='right'>".formataNumeroReal($indenizatorias)." </td></tr>";
                    $bruto += $indenizatorias;
            }

                /*
                * Calcula o valor de FC ou CC do MPU
                */
                if($_POST['fc'] != "" && $orgao == 1){
                        //busca o valor de opção no banco de dados
                    if ($referencia==12015){
                            $query = "select valor_opcao as vb from funcoes where
                            orgao='".$_POST['orgao']."' AND
                            nivel='".$_POST['fc']."' AND vigencia='12015' limit 1";
                    }else{
                            $query = "select valor_opcao as vb from funcoes where
                            orgao='".$_POST['orgao']."' AND
                            nivel='".$_POST['fc']."' AND vigencia='72016' limit 1";
                    }
                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $vencimento = $row2['vb'];
                        echo "<tr><td>Função/Cargo de Confiança: </td><td align='right'>".formataNumeroReal($vencimento)." </td></tr>";
                        $bruto += $vencimento;
                        $baseIrrf += $vencimento;
                        $remuneracao += $vencimento;
                        if($funprespFC && $previdencia==2)$basepss += $vencimento;
                }
                /*
                * Calcula o valor de FC ou CC do JudiciÃ¡rio
                */
                if($_POST['fc_jud'] != "" && $orgao == 2){
                        //busca o valor de opção no banco de dados

                            $query = "select valor_opcao as vb from funcoes where
                            orgao='".$_POST['orgao']."' AND
                            nivel='".$_POST['fc_jud']."' AND vigencia='72016' limit 1";


                        $resultado2 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row2 = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);
                        $vencimento = $row2['vb'];
                        echo "
                        <tr><td>Função/Cargo de Confiança: </td><td align='right'>".formataNumeroReal($vencimento)." </td></tr>";
                        $bruto += $vencimento;
                        $baseIrrf += $vencimento;
                        $remuneracao += $vencimento;
                        if($funprespFC && $previdencia==2)$basepss += $vencimento;
                }

                /*
                * Calcula salário bruto
                */
                echo "<tr><td><b>SALÁRIO BRUTO</b>: </td><td align='right'><font size='4'><b>".formataNumeroReal($bruto)." </b></font></td></tr>";

                /*
                * DESCONTOS
                */

                /*
                * CÃ¡lculo de remuneração e margem consignável
                */
                $margemConsignavel = round($remuneracao * 0.3, 2);

                //arrumar aqui - cálculo da previdência - ajustar após reforma
                /*
                * calcula PSS: apresenta dois valores, um com Regime geral antigo, outro com teto
                * Regime prÃƒÂ³prio = 1; funpresp (sem calcular contribuiÃƒÂ§ÃƒÂ£o = 2)
                * LEMBRAR DE TODO LIST CORRIGIR A VARIÃ�VEL CASO ADOTE FUNÃ‡Ã•ES (HAVERIA DIVERGÃƒÂŠNCIA)
                *
                * Incluir nos prÃƒÂ³ximos anos as correÃƒÂ§ÃƒÂµes do teto da previdÃƒÂªncia
                * Teto em 2016: R$ 5189,82
                */
                $query = "select tetovalor as teto from previdenciateto where ano<='2021' ORDER BY ano DESC limit 1";
                $resultado3 = mysqli_query($conexao, $query) or die ("Erro de consulta do teto previdenciário.");
                $row3 = mysqli_fetch_array($resultado3, MYSQLI_ASSOC);
                $teto = $row3['teto'];
                //tabela previdenciateto colunas ano e tetovalor


                if($previdencia == 1 || $basepss <  $teto){
                    $pssValor = round(calculaNovaPrevidencia($basepss,2021),2);
                    //$pssValor = round(($basepss * 0.11),2);
                    //considera nova alíquota de 14% a partir de 01/02/2018 para os que recebem acima do teto e estão nos regimes de integralidade e média
                    //apontar aqui para a função previdência - função previdência
                }
                else {

                    $pssValor = round(calculaNovaPrevidencia($teto,2021),2);

                }
                $descontos = $pssValor;
                $rendimentosTributaveis = $baseIrrf;
                $baseIrrf -= $pssValor;
                echo "<tr><td>PSS: </td><td align='right'><font color='660000'>(".formataNumeroReal($pssValor).")</font> </td></tr>";

                //Calculo de contribuição do FUNPRESP
                if($previdencia == 2 && $basepss >= $teto && $funprespIndice > 0){
                        $funprespValor = round((($basepss - $teto) * $funprespIndice),2);
                        $descontos += $funprespValor;
                        $baseIrrf -= $funprespValor;
                        echo "<tr><td>Contribuição Funpresp (".($funprespIndice*100)."%): </td><td align='right'><font color='660000'>(".formataNumeroReal($funprespValor).")</font> </td></tr>";
if($funprespOpcional > 0){
$funprespOpcionalValor = round((($basepss - $teto) * $funprespOpcional),2);
$descontos += $funprespOpcionalValor;
$baseIrrf -= $funprespOpcionalValor;
echo "<tr><td>Contribuição Funpresp Opcional (".($funprespOpcional*100)."%): </td><td align='right'><font color='660000'>(".formataNumeroReal($funprespOpcionalValor).")</font> </td></tr>";

}
                }
                /*
                * Plan Assiste - Alterar para nova implementação.
                */
                if($planTit && $orgao == 1 && $isPlanAssiste == 1){
                        //Busca o valor da maior remuneração (teto do Plan Assiste), equivalente a VB + GAMPU de analista 13
                        $query = "select vencimento_basico as vb from vencimentos where
                        referencia='".$referencia."' AND cargo='3' AND
                        nivel='13' limit 1";
                        $resultado3 = mysqli_query($conexao, $query) or die ("Erro de consulta do VB");
                        $row3 = mysqli_fetch_array($resultado3, MYSQLI_ASSOC);
                        $tetoPlanAssiste = $row3['vb'] * (1+$gajIndice);
                        $remuneracaoPlanAssiste = $remuneracao;
                        if($remuneracaoPlanAssiste > $tetoPlanAssiste) $remuneracaoPlanAssiste = $tetoPlanAssiste;




                        $planIndice = $planTit + $planConj + ($planFilhos/200);
                        $planValor = round($remuneracaoPlanAssiste * $planTit,2);
                        echo "<tr><td>Mensalidade Plan-Assiste (Titular): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                        $descontos += $planValor;
                        $margemConsignavel -= $planValor;
                        if($planConj){
                                $planValor  = round($remuneracaoPlanAssiste * $planConj,2);
                                echo "<tr><td>Mensalidade Plan-Assiste (Cônjuge): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                                $descontos += $planValor;
                                $margemConsignavel -= $planValor;
                        }
                        if($planAssisteFilho > 0){
                                $planValor  = round($remuneracaoPlanAssiste * ($planAssisteFilho/200),2);
                                echo "<tr><td>Mensalidade Plan-Assiste (Filhos): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                                $descontos += $planValor;
                                $margemConsignavel -= $planValor;
                        }
                        if($planAssistePais > 0){
                                $planValor  = round($remuneracaoPlanAssiste * ($planAssistePais*1.5/100),2);
                                echo "<tr><td>Mensalidade Plan-Assiste (Pais): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                                $descontos += $planValor;
                                $margemConsignavel -= $planValor;
                        }
                        if($planAssisteBeneficiariosEspeciais > 0){
                                $planValor  = round($tetoPlanAssiste * ($planAssisteBeneficiariosEspeciais*1.5/100),2);
                                echo "<tr><td>Mensalidade Plan-Assiste (Beneficiários Especiais): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                                $descontos += $planValor;
                                $margemConsignavel -= $planValor;
                        }
                        if($planAssisteExConjuge > 0){
                                $planValor  = round($tetoPlanAssiste * ($planAssisteExConjuge*3/100),2);
                                echo "<tr><td>Mensalidade Plan-Assiste (Ex-Cônjuge): </td><td align='right'><font color='660000'>(".formataNumeroReal($planValor).")</font> </td></tr>";
                                $descontos += $planValor;
                                $margemConsignavel -= $planValor;
                        }

                }

                /*
                *PensÃ£o alimentÃ­cia Judicial
                */
                if($pensaoAlimentciaJudicial > 0 && $isPensaoJudicial == 1){
                    echo "<tr><td>Pensão Alimentícia(judicial): </td><td align='right'><font color='660000'>(".formataNumeroReal($pensaoAlimentciaJudicial).")</font> </td></tr>";
                    $descontos += $pensaoAlimentciaJudicial;
                    $baseIrrf -= $pensaoAlimentciaJudicial;
            }

            //Apura a pensão alimentícia Judicial definida sobre percentual da remuneração
                if($pensaoAlimenticiaJudicialPercentual > 0 && $isPensaoJudicial == 1){
                        $pensaoAlimenticiaJudicialPercentualValor = round(($pensaoAlimenticiaJudicialPercentual * $remuneracao / 100),2);
                    echo "<tr><td>Pensão Alimentícia(judicial) - ".$pensaoAlimenticiaJudicialPercentual."%: </td><td align='right'><font color='660000'>(".formataNumeroReal($pensaoAlimenticiaJudicialPercentualValor).")</font> </td></tr>";
                    $descontos += $pensaoAlimenticiaJudicialPercentualValor;
                    $baseIrrf -= $pensaoAlimenticiaJudicialPercentualValor;
            }

                /*
                * Apura imposto de renda (a funÃƒÂ§ÃƒÂ£o de imposto de renda jÃƒÂ¡ estÃƒÂ¡ escrita, olhar no final do cÃƒÂ³digo)
                */
                $irrfValor = calculaIRRF($baseIrrf, $dependentes, 0);
                $descontos += $irrfValor;
                echo "<tr><td>Imposto de Renda: </td><td align='right'><font color='660000'>(".formataNumeroReal($irrfValor).")</font> </td></tr>";



                if($outrosDescontos > 0  && $isOutrosDescontos == 1){
                    echo "<tr><td>Outros Descontos: </td><td align='right'><font color='660000'>(".formataNumeroReal($outrosDescontos).")</font> </td></tr>";
                    $descontos += $outrosDescontos;
                    $margemConsignavel -= $outrosDescontos;
            }

                echo "<tr><td>Total de Descontos: </td><td align='right'><font color='660000'><b>(".formataNumeroReal($descontos).")</b></font></td></tr>";

                $liquido = $bruto - $descontos;
                echo "<tr><td><b>SALÁRIO LÍQUIDO</b>: </td><td align='right' bgcolor='yellow'><font size='4'><b>".formataNumeroReal($liquido)."</b></font> </td></tr>";

                /*
                * Informações complementares
Rendimentos Tributáveis
Margem consignável
                */
echo "<tr><td><font size='2'>Rendimentos Tributáveis</b>: </td><td align='right'><b>".formataNumeroReal($rendimentosTributaveis)."</font> </td></tr>";
            echo "<tr><td><font size='2'>Margem Consignável<br>(Estimativa de disponibilidade)</b>: </td><td align='right'><b>".formataNumeroReal($margemConsignavel)."</font> </td></tr>";


                                 echo "</table><hr />";
                 }
         }



function calculaIRRF($vencimento, $dependentes, $ano){
        /*
         * Este cÃƒÂ³digo ÃƒÂ© apenas para ficar de lembranÃƒÂ§a. Vai ser adotada a tabela de 2015, ainda sem correÃƒÂ§ÃƒÂ£o, mas este cÃƒÂ³digo serve de inspiraÃƒÂ§ÃƒÂ£o para os outros anos.
        //calcula imposto do ano de 2012
        if($ano == 0){
                $vencimento = $vencimento - $dependentes * 164.56;
                if($vencimento < 1637.11) return 0;
                if(1637.12 <= $vencimento && $vencimento <= 2453.50) return round(($vencimento * 0.075 - 122.78),2);
                if(2453.51 <= $vencimento && $vencimento <= 3271.38) return round(($vencimento * 0.150 - 306.80),2);
                if(3271.39 <= $vencimento && $vencimento <= 4087.65) return round(($vencimento * 0.225 - 552.15),2);
                return round($vencimento * 0.275 - 756.53 ,2);
        }
        //calcula imposto do ano de 2013
        if($ano == 1){
                $vencimento = $vencimento - $dependentes * 171.97;
                if($vencimento < 1710.78) return 0;
                        if(1710.79 <= $vencimento && $vencimento <= 2563.91) return round(($vencimento * 0.075 - 128.31),2);
                        if(2563.92 <= $vencimento && $vencimento <= 3418.59) return round(($vencimento * 0.15 - 320.60),2);
                        if(3418.60 <= $vencimento && $vencimento <= 4271.59) return round(($vencimento * 0.225 - 577),2);
                        return round(($vencimento * 0.275 - 790.58 ),2);
        }

        //if($ano == 2){
                //calcula imposto a partir de 2014
                $vencimento = $vencimento - $dependentes * 179.71;
                if($vencimento < 1877.77) return 0;
                if(1878.78 <= $vencimento && $vencimento <= 2679.29) return round(($vencimento * 0.075 - 134.08),2);
                if(2679.30 <= $vencimento && $vencimento <= 3572.43) return round(($vencimento * 0.150 - 335.03),2);
                if(3572.44 <= $vencimento && $vencimento <= 4463.81) return round(($vencimento * 0.225 - 602.96),2);
                return round(($vencimento * 0.275 - 826.15),2);
        //}
        //Calcula o imposto de renda a partir de 2015, considerando uma correÃƒÂƒÃ‚Â§ÃƒÂƒÃ‚Â£o de 6,5%
        //
        */
        $vencimento = $vencimento - $dependentes * 189.59;
        if($vencimento < 1903.98) return 0;
        if(1903.99 <= $vencimento && $vencimento <= 2826.65) return round(($vencimento * 0.075 - 142.80),2);
        if(2826.66 <= $vencimento && $vencimento <= 3751.05) return round(($vencimento * 0.150 - 354.80),2);
        if(3751.06 <= $vencimento && $vencimento <= 4664.68) return round(($vencimento * 0.225 - 636.13),2);
        return round(($vencimento * 0.275 - 869.36),2);
	}





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
        <p>Atualizado em 02/11/2021. <a href="sobre.php">Sobre o Sistema</a></p>
      <p>© Todos os direitos reservados. Criado por José Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:webmaster@josebarbosa.com.br">
webmaster@josebarbosa.com.br</a></adress>
<p><b>Observação</b>: os valores ora demonstrados são apenas uma perspectiva, e podem apresentar diferenças em razão de interpretação ou aplicação por parte dos órgãos.
Favor utilizar o e-mail para esclarecer dúvidas sobre eventuais inconsistências encontradas, ou verificar o motivo para a simulação apresentar diferenças significativas nos valores.
           </div></body>
</html>


	
