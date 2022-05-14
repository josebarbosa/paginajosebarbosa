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
			return "Regime Geral de Previdência Social - RGPS. Trabalhadores contratados pela CLT ou servidores ocupantes de cargo em comissão, sem vínculo efetivo com a administração pública.";
			break;
			case 2:
			return "Regime Próprio de Previdência Social dos Servidores da União. Servidores Públicos Federais da ativa, que ingressaram no serviço público até o ano de 2013 e não fizeram a opção de migração de regime de previdência complementar, nos modelos de paridade e integralidade ou média. Em ambos os casos, a base de cálculo da contribuição previdenciária não está limitada ao teto do RGPS.";
			break;
			case 3:
			return "Regime Próprio de Previdência Social dos Servidores da União. Servidores Públicos Federais inativos ou pensionistas. A contribuição previdenciária incide sobre os proventos superiores ao teto do RGPS.";
			break;
			case 4:
			return "Regime Próprio de Previdência Social dos Servidores da União. Servidores Públicos Federais da ativa, que ingressaram no serviço público a partir de 2013 ou fizeram a opção de migração de regime. A contribuição previdenciária está limitada ao teto do RGPS.";
			break;
		}
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="descrição" content="Simule o seu novo contracheque após a implementação das Leis 13.316/2016 e 13.317/2016, novos planos de carreira
              dos servidores do MinistÃ©rio Público da União e do Poder Judiciário da União."/>
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
        <title>Simulador de Contribuição Previdenciária</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();mostraCampos();orgaoAltera();">
      <?php
      include '../menu.php';
      ?>
        <div class="jumbotron jumbotron-fluid">
			<h1 class="display-4">Calculadora de Contribuição Previdenciária</h1>
			<p class="lead">Serviço não oficial de cálculo de Contribuição Previdenciária. Informe o valor, o regime (geral ou RPPS), e conheça o valor da contribuição devida pelo empregado/funcionário. </p>
        </div>
		<?php
		//No futuro, criar uma div específica para impressão
		if($salario != 0){
			echo '
			<h3>Cálculo</h3>
			<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Rubrica</th>
					<th scope="col">Valor (R$)</th>
				</tr>
			</thead>
			<tbody>
			<tr>
				<th scope="row">Salário Bruto</th>
				<td>';
				echo number_format($salario,2,",",".");
				echo '</td>
				</tr>
				<tr>
				<th scope="row">Contribuição Previdenciária</th>
				<td>'.number_format($valorContribuicao,2,",",".").'</td>
				</tr>
				<tr>
				<th scope="row">Imposto de Renda</th>
				<td>'.number_format($valorIRRF,2,",",".").'</td>
				</tr>
				<tr class="table-info">
				<th scope="row">Salário Líquido</th>
				<td> <b>R$ '.number_format($salarioLiquido,2,",",".").'</b></td>
				</tr>
			</tbody>
			</table>
			';
			echo '<h3>Parâmetros de Cálculo
			</h3>
			<table class="table">
			<tbody>
			<tr>
				<th scope="row">Ano de Referência</th>
				<td>'.$ano.'</td>
			</tr>
			<tr>
				<th scope="row">Descrição Categoria</th>
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
			<p>Informe o salário, a tabela para cálculo e o regime a que está vinculado. No momento, são feitos cálculos para o Regime Geral da Previdência Social, dos empregados filiados ao INSS, e dos servidores públicos federais, ativos e inativos. </p>
            <form action="index.php" method="get">
                 <!--nserir... ano, ente (RGPS/INSS, RPPS-União, Municípios etc) -->
                <div class="input-group mb-3">
				<div class="input-group-prepend">
				<span class="input-group-text">Base de Cálculo:</span>
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
					<option value="2">RPPS - Servidor Ativo (Paridade/Média) </option>
					<option value="4">RPPS - Servidor Ativo (Previdência Complementar) </option>
					<option value="3">RPPS - Servidor Inativo </option>
				</select>
				  <input type="submit" class="btn btn-secondary" value="Calcular"/>
				</div>
            </form>
        </fieldset>
        </div>
        </div>
        <!--Incluir um "para saber mais", e descrever valores  e tabelas, num menu que se expande (desce), conforme o clique do usuário-->

        <hr width="50%">
        <div>
			<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
			<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
			<!-- NÃƒO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
			<input type="hidden" name="currency" value="BRL" />
			<input type="hidden" name="receiverEmail" value="jose.as.barbosa@uol.com.br" />
			<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - Ã© rápido, grátis e seguro!" />
			</form>
			<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
        </div>
		<p>Se você gostou, contribua com a iniciativa. Doe!  É possível doar qualquer valor, o procedimento é seguro (através do PagSeguro), e sua contribuição é muito importante para custear as despesas de manutenção desta página. </p>

		<hr width="50%">

      <p>© Todos os direitos reservados. Criado por José Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:webmaster@josebarbosa.com.br">
webmaster@josebarbosa.com.br</a></adress>
<p>Compartilhe a página no QR CODE abaixo:</p>
<img src="calculadoraINSSatalhoQRCODE.png" />
 </body>
</html>
