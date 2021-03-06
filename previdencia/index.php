<?php
    setlocale(LC_MONETARY, 'pt_BR');
	if(!$_GET["salario"]) $salario=0; else $salario = $_GET["salario"];
	$ano = $_GET["ano"];
	$categoria = $_GET["categoria"];

	$valorContribuicao = calculaNovaPrevidencia($salario, $ano, $categoria);
	if($categoria == 3){
		$valorContribuicao = ajustaInativo($valorContribuicao, $ano);
		if($valorContribuicao < 0) $valorContribuicao = 0;
	}

	$baseIRRF = $salario - $valorContribuicao;

	$valorIRRF = calculaIRRF($baseIRRF);
	$salarioLiquido = $salario - $valorContribuicao - $valorIRRF;

	$descricaoCategoria = descreveCategoria($categoria);

	function calculaNovaPrevidencia($vencimento, $ano, $categoria){
		//Usar futuramente, para criar tabela por faixas
		$salarioResidual = $vencimento;
		$valorAcumulado = 0;
		if($ano==2019){
			$teto = 5839.45;
			if(($vencimento > $teto)&&($categoria == 1 || $categoria==4)) $vencimento = $teto;
            if($vencimento <= 998) return round(($vencimento * 0.075),2);
            if(998.01<= $vencimento && $vencimento <= 2000) return round(($vencimento * 0.09-14.97),2);
            if(2000.01<= $vencimento && $vencimento <= 3000) return round(($vencimento * 0.12-74.97),2);
            if(3000.01<= $vencimento && $vencimento <= 5839.45) return round(($vencimento * 0.14-134.97),2);
            if(5839.46<= $vencimento && $vencimento <= 10000) return round(($vencimento * 0.145-164.17),2);
            if(10000.01<= $vencimento && $vencimento <= 20000) return round(($vencimento * 0.165-364.17),2);
            if(20000.01<= $vencimento && $vencimento <= 39000) return round(($vencimento * 0.19-864.17),2);
            if(39000.01<= $vencimento ) return round(($vencimento * 0.22-2034.17),2);
        }
		if($ano==2020){
			$teto = 6101.06;
			if(($vencimento > $teto)&&($categoria == 1 || $categoria == 4)) $vencimento = $teto;
            if($vencimento <= 1045) return round(($vencimento * 0.075),2);
            if(1045.01<= $vencimento && $vencimento <= 2089.6) return round(($vencimento * 0.09-15.68),2);
            if(2089.61<= $vencimento && $vencimento <= 3134.4) return round(($vencimento * 0.12-78.36),2);
            if(3134.41<= $vencimento && $vencimento <= 6101.06) return round(($vencimento * 0.14-141.05),2);
            if(6101.07<= $vencimento && $vencimento <= 10448) return round(($vencimento * 0.145-171.56),2);
            if(10448.01<= $vencimento && $vencimento <= 20896) return round(($vencimento * 0.165-380.52),2);
            if(20896.01<= $vencimento && $vencimento <= 40747.20) return round(($vencimento * 0.19-902.92),2);
            if(40747.21<= $vencimento ) return round(($vencimento * 0.22-2125.33),2);
        }
        if($ano ==2021){
			$teto = 6433.57;
			if(($vencimento > $teto)&&($categoria == 1 || $categoria == 4)) $vencimento = $teto;
            if($vencimento <= 1100) return round(($vencimento * 0.075),2);
            if(1100.01<= $vencimento && $vencimento <= 2203.48) return round(($vencimento * 0.09-16.50),2);
            if(2203.49<= $vencimento && $vencimento <= 3305.22) return round(($vencimento * 0.12-82.60),2);
            if(3305.23<= $vencimento && $vencimento <= 6433.57) return round(($vencimento * 0.14-148.71),2);
            if(6433.58<= $vencimento && $vencimento <= 11017.42) return round(($vencimento * 0.145-180.88),2);
            if(11017.43<= $vencimento && $vencimento <= 22034.83) return round(($vencimento * 0.165-401.23),2);
            if(22034.84<= $vencimento && $vencimento <= 42967.92) return round(($vencimento * 0.19-952.10),2);
            if(42967.93<= $vencimento ) return round(($vencimento * 0.22-2241.13),2);
        }
        if($ano ==2022){
            $teto = 7087.22;
        	if(($vencimento > $teto)&&($categoria == 1 || $categoria == 4)) $vencimento = $teto;
            if($vencimento <= 1212) return round(($vencimento * 0.075),2);
            if(1212.01<= $vencimento && $vencimento <= 2427.35) return round(($vencimento * 0.09-18.18),2);
            if(2427.36<= $vencimento && $vencimento <= 3641.03) return round(($vencimento * 0.12-90.99),2);
            if(3641.04<= $vencimento && $vencimento <= 7087.22) return round(($vencimento * 0.14-163.82),2);
            if(7087.23<= $vencimento && $vencimento <= 12136.79) return round(($vencimento * 0.145-199.26),2);
            if(12136.8<= $vencimento && $vencimento <= 24273.57) return round(($vencimento * 0.165-441.99),2);
            if(24273.58<= $vencimento && $vencimento <= 47333.46) return round(($vencimento * 0.19-1048.83),2);
            if(47333.47<= $vencimento ) return round(($vencimento * 0.22-2468.83),2);
        }
	}

	function calculaIRRF($vencimento){
		if($vencimento < 1903.98) return 0;
        if(1903.99 <= $vencimento && $vencimento <= 2826.65) return round(($vencimento * 0.075 - 142.80),2);
        if(2826.66 <= $vencimento && $vencimento <= 3751.05) return round(($vencimento * 0.150 - 354.80),2);
        if(3751.06 <= $vencimento && $vencimento <= 4664.68) return round(($vencimento * 0.225 - 636.13),2);
        return round(($vencimento * 0.275 - 869.36),2);
	}

	function ajustaInativo($salario, $ano){
	    if($ano == 2022) return $salario - 828.39;
		if($ano == 2021) return $salario - 751.99;
		if($ano == 2020) return $salario - 713.10;
		if($ano == 2019) return $salario - 682.55;
		return null;
	}

	function descreveCategoria($categoria){
		switch ($categoria){
			case 1:
			return "Regime Geral de Previd??ncia Social - RGPS. Trabalhadores contratados pela CLT ou servidores ocupantes de cargo em comiss??o, sem v??nculo efetivo com a administra????o p??blica.";
			break;
			case 2:
			return "Regime Pr??prio de Previd??ncia Social dos Servidores da Uni??o. Servidores P??blicos Federais da ativa, que ingressaram no servi??o p??blico at?? o ano de 2013 e n??o fizeram a op????o de migra????o de regime de previd??ncia complementar, nos modelos de paridade e integralidade ou m??dia. Em ambos os casos, a base de c??lculo da contribui????o previdenci??ria n??o est?? limitada ao teto do RGPS.";
			break;
			case 3:
			return "Regime Pr??prio de Previd??ncia Social dos Servidores da Uni??o. Servidores P??blicos Federais inativos ou pensionistas. A contribui????o previdenci??ria incide sobre os proventos superiores ao teto do RGPS.";
			break;
			case 4:
			return "Regime Pr??prio de Previd??ncia Social dos Servidores da Uni??o. Servidores P??blicos Federais da ativa, que ingressaram no servi??o p??blico a partir de 2013 ou fizeram a op????o de migra????o de regime. A contribui????o previdenci??ria est?? limitada ao teto do RGPS.";
			break;
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="descri????o" content="Simule o seu novo contracheque ap??s a implementa????o das Leis 13.316/2016 e 13.317/2016, novos planos de carreira
              dos servidores do Minist????rio P??blico da Uni??o e do Poder Judici??rio da Uni??o."/>
		<style type="text/css">
			BODY{
				font-family: arial, verdana, courier;
			}
		</style>
		<!--
			Inclui biblioteca bootstrap, para melhorar o desenho.
		-->
    <?php
    include '../bootstrap.php';
    ?>
<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74364698-1', 'auto');
  ga('send', 'pageview');

</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script>


	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

</script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Simulador de Contribui????o Previdenci??ria</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();mostraCampos();orgaoAltera();">
      <?php
      include '../menu.php';
      ?>
        <div class="jumbotron jumbotron-fluid">
			<h1 class="display-4">Calculadora de Contribui????o Previdenci??ria</h1>
			<p class="lead">Servi??o n??o oficial de c??lculo de Contribui????o Previdenci??ria. Informe o valor, o regime (geral ou RPPS), e conhe??a o valor da contribui????o devida pelo empregado/funcion??rio. </p>
        </div>
		<?php
		//No futuro, criar uma div espec??fica para impress??o
		if($salario != 0){
			echo '
			<h3>C??lculo</h3>
			<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Rubrica</th>
					<th scope="col">Valor (R$)</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th scope="row">Sal??rio Bruto</th>
				<td>';
				echo number_format($salario,2,",",".");
				echo '</td>
				</tr>
				<tr>
				<th scope="row">Contribui????o Previdenci??ria</th>
				<td>'.number_format($valorContribuicao,2,",",".").'</td>
				</tr>
				<tr>
				<th scope="row">Imposto de Renda</th>
				<td>'.number_format($valorIRRF,2,",",".").'</td>
				</tr>
				<tr class="table-info">
				<th scope="row">Sal??rio L??quido</th>
				<td> <b>R$ '.number_format($salarioLiquido,2,",",".").'</b></td>
				</tr>
			</tbody>
			</table>
			';
			echo '<h3>Par??metros de C??lculo
			</h3>
			<table class="table">
			<tbody>
			<tr>
				<th scope="row">Ano de Refer??ncia</th>
				<td>'.$ano.'</td>
			</tr>
			<tr>
				<th scope="row">Descri????o Categoria</th>
				<td>'.$descricaoCategoria.'</td>
			</tr>
			</tbody>
			</table>
			<hr width="50%">
			';
		}
		?>
         <div>
            <div style="background-color:#FFF">
            <fieldset >
            <legend >Informe os dados</legend>
			<p>Informe o sal??rio, a tabela para c??lculo e o regime a que est?? vinculado. No momento, s??o feitos c??lculos para o Regime Geral da Previd??ncia Social, dos empregados filiados ao INSS, e dos servidores p??blicos federais, ativos e inativos. </p>
            <form action="index.php" method="get">
                 <!--nserir... ano, ente (RGPS/INSS, RPPS-Uni??o, Munic??pios etc) -->
                <div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text">Base de C??lculo:</span>
				</div>
				  <input type="number" name="salario" step="0.01" min="0.01" class="form-control" placeholder="R$">
				<select name="ano" class="selectpicker" data-style="btn-info">
					<option value="2022">2022</option>
					<option value="2021">2021</option>
					<option value="2020">2020</option>
					<option value="2019">2019 </option>
				</select>
				<select name="categoria" class="selectpicker" data-style="btn-info">
					<option value="1">RGPS/INSS (Regime Geral)</option>
					<option value="2">RPPS - Servidor Ativo (Paridade/M??dia) </option>
					<option value="4">RPPS - Servidor Ativo (Previd??ncia Complementar) </option>
					<option value="3">RPPS - Servidor Inativo </option>
				</select>
				  <input type="submit" class="btn btn-secondary" value="Calcular"/>
				</div>
            </form>
        </fieldset>
        </div>
        </div>
        <!--Incluir um "para saber mais", e descrever valores  e tabelas, num menu que se expande (desce), conforme o clique do usu??rio-->

        <hr width="50%">
        <div>
			<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
			<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
			<!-- N????O EDITE OS COMANDOS DAS LINHAS ABAIXO -->
			<input type="hidden" name="currency" value="BRL" />
			<input type="hidden" name="receiverEmail" value="jose.as.barbosa@uol.com.br" />
			<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - ???? r??pido, gr??tis e seguro!" />
			</form>
			<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
        </div>
		<p>Se voc?? gostou, contribua com a iniciativa. Doe!  ?? poss??vel doar qualquer valor, o procedimento ?? seguro (atrav??s do PagSeguro), e sua contribui????o ?? muito importante para custear as despesas de manuten????o desta p??gina. </p>

		<hr width="50%">

      <p>?? Todos os direitos reservados. Criado por Jos?? Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:webmaster@josebarbosa.com.br">
webmaster@josebarbosa.com.br</a></adress>
<p>Compartilhe a p??gina no QR CODE abaixo:</p>
<img src="calculadoraINSSatalhoQRCODE.png" />
 </body>
</html>
