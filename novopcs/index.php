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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74364698-1', 'auto');
  ga('send', 'pageview');

</script>

<?php
include '../bootstrap.php';
?>
<script>
	function mostraContribuicaoFunpresp(){
		var funprespChecked = document.getElementById("previdencia_funpresp").checked;
		if(funprespChecked)
		document.getElementById("trfunpresp").style.display = "block";
		else
		document.getElementById("trfunpresp").style.display = "none";
	}

	function mostraCampos(){
		var planAssistecheck = document.getElementById("PlanAssiste").checked;
		var parcindcheck = document.getElementById("parcIndenizatoria").checked;
		var pensjudcheck = document.getElementById("pensaoJudicial").checked;
		var outrosDescontoscheck = document.getElementById("outrosDescontosCheck").checked;
		if(planAssistecheck)
		document.getElementById("pPlan").style.display = "block";
		else
		document.getElementById("pPlan").style.display = "none";
		if(parcindcheck)
		document.getElementById("pParcInd").style.display = "block";
		else
		document.getElementById("pParcInd").style.display = "none";
		if(pensjudcheck)
		document.getElementById("pPensaoJud").style.display = "block";
		else
		document.getElementById("pPensaoJud").style.display = "none";
		if(outrosDescontoscheck)
		document.getElementById("pOutrosDescontos").style.display = "block";
		else
		document.getElementById("pOutrosDescontos").style.display = "none";
	}


	function orgaoAltera(){
		var orgao = document.getElementById("orgao_mpu").checked;
		if(orgao){
			document.getElementById("fc_mpu").style.display = "block";
			document.getElementById("fc_jud").style.display = "none";
			document.getElementById("at_mpu").style.display = "block";
			document.getElementById("at_jud").style.display = "none";
			document.getElementById("PlanAssiste").disabled = false;
			}else{
			document.getElementById("fc_jud").style.display = "block";
			document.getElementById("fc_mpu").style.display = "none";
			document.getElementById("at_jud").style.display = "block";
			document.getElementById("at_mpu").style.display = "none";
			document.getElementById("PlanAssiste").disabled = true;
		}
	}

	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

</script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Salário MPU - Leis 13.316/2016 (MPU) e 13.317/2016 (Judiciário)</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();mostraCampos();orgaoAltera();">
      <?php
     include '../menu.php';
      ?>
        <h1>Simulação dos PLs do MPU e Judiciário</h1>
        <p>Planilha para cálculo personalizado de como ficarão os salários dos servidores do MPU e Judiciário com a aprovação das Leis
        <a href=http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2016/Lei/L13316.htm target="resource window">13.316/2016</a>  e
        <a href=http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2016/Lei/L13317.htm target="resource window">13.317/2016</a>
        , planos do MPU e Judiciário, respectivamente.</p>
         <div>
            <div style="background-color:#FFF">
            <fieldset >
            <legend >Informe os dados</legend>
            <form action="calcula_2022.php" method="post">

                <table>
                    <tr>
                        <td>Órgão
                        </td>
                        <td>
                            <input type="radio" id="orgao_mpu" name="orgao" value="1" checked="true"
                            onchange="orgaoAltera();"/>MPU
                            <input type="radio" id="orgao_jud" name="orgao" value="2" onchange="orgaoAltera();"/>Judiciário
                        </td>
                    </tr>
                    <tr>
                        <td>Previdência
                        </td>
                        <td>
                            <input type="radio" id="previdencia_proprio" name="previdencia" value="1" checked="true"
                           onchange="mostraContribuicaoFunpresp();"/>
                            Regime Próprio<a href="https://josebarbosa.com.br/contribuicao-previdenciaria-sobre-verbas-nao-permanentes-para-servidores-contemplados-pela-media/" target="_blank"  data-toggle="tooltip" data-original-title="Para servidores que ingressaram até 2013 e não fizeram a opção pelo regime de previdência complementar, a contribuição previdenciária incide sobre toda a remuneração. Para servidores que ingressaram ou migraram para o RPC, a base de cálculo se limita ao teto do RGPS, atualmente R$ 6.433,57."  >(até 2013)</a>
                            <input type="radio" id="previdencia_funpresp" name="previdencia" value="2"
							 onchange="mostraContribuicaoFunpresp();"/>Funpresp

                    <p id="trfunpresp">
						Contribuição:
                    <select id="funprespIndice" name="funprespIndice">
<option value="0.085"> 8,5%</option>
						<option value="0.065"> 6,5%</option>
						<option value="0.07"> 7%</option>
						 <option value="0.075"> 7,5%</option>
						<option value="0.08"> 8%</option>

						<option value="0"> Não</option>
                    </select>
                    <input type="checkbox" id="funcaoContribuicaoFunpresp"
                    name="funcaoContribuicaoFunpresp" value="1"/> Marque se deseja incluir FC ou CC na base de cálculo.
                     </p><p>Contribuição opcional: <input type="number" id="trfunpresp" name="funprespOpcional" size="4" maxlength="2" value="0"
                        min="0" max="20" step="0.5"/>%</p></td></tr>
                    <tr>
                        <td>Cargo: </td>
                        <td>
                            <select id="cargo" name="cargo">
                                <option value="2">Técnico</option>
                                <option value="3">Analista</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Classe/Padrão*</td>
                        <td>
                            <select id="nivel" name="nivel">
                                <option value="13">13</option>
				<option value="1"> 1</option>
                                <option value="2"> 2</option>
                                <option value="3"> 3</option>
                                <option value="4"> 4</option>
                                <option value="5"> 5</option>
                                <option value="6"> 6</option>
                                <option value="7"> 7</option>
                                <option value="8"> 8</option>
                                <option value="9"> 9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td>FC/CC</td>
                        <td>
                            <select id="fc_jud" name="fc_jud">
                                <option value="">Não</option>
                                <option value="1">FC-1</option>
                                <option value="2">FC-2</option>
                                <option value="3">FC-3</option>
                                <option value="4">FC-4</option>
                                <option value="5">FC-5</option>
                                <option value="6">FC-6</option>
                                <option value="7">CJ-1</option>
                                <option value="8">CJ-2</option>
                                <option value="9">CJ-3</option>
                                <option value="10">CJ-4</option>
                            </select>
                            <select id="fc_mpu" name="fc">
                                <option value="">Não</option>
                                <option value="1">FC-1</option>
                                <option value="2">FC-2</option>
                                <option value="3">FC-3</option>
                                <option value="4">CC-1</option>
                                <option value="5">CC-2</option>
                                <option value="6">CC-3</option>
                                <option value="7">CC-4</option>
                                <option value="8">CC-5</option>
                                <option value="9">CC-6</option>
                                <option value="10">CC-7</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>GAS/GAE
                            <br/>Insalubridade<br />
                            Projeto <br />
                            Penosidade</td>
                        <td>
                            <input type="radio" name="gas" id="gas" value="0.35" />GAS, GAE ou Projeto (35%)<br/>
                            <input type="radio" name="gas" id="gas" value="0.25"/> GAS (25%)<br >
                            <input type="radio" name="penosa" id="penosa" value="0.1" />Periculosidade - Insalubridade(10%)<br />
                            <input type="radio" name="penosa" id="penosa" value="0.2" />Penosidade ou Insalubridade(20%)
                        </td>
                    </tr>
                    <tr>
                        <td>Ad. Qualificação</td>
                        <td><input type="radio" id="aq" name="aq" value="0" checked/>Não<br />
                            <input type="radio" id="aqGraduacao" name="aq"  value="0.05"/>Graduação
                            <input type="radio" id="aqEspecializacao" name="aq" value="0.075"/>Especialização<br />
                            <input type="radio" id="aqMestrado" name="aq"  value="0.1"/> Mestrado
                            <input type="radio" id="aqDoutorado" name="aq"  value="0.125"/>Doutorado</td>
                    </tr>
                    <tr>
                        <td>Ad. Treinamento </td>
                        <td>
							<select name="at" id="at_mpu">
							<option value="">Não</option>
                            <option value="0.01">2,5% (120 horas)</option>
                            <option value="0.02">5% (240 horas)</option>
							</select>
							<select name="at_jud" id="at_jud">
							<option value="">Não</option>
                            <option value="0.01">1% (120 horas)</option>
                            <option value="0.02">2% (240 horas)</option>
                            <option value="0.03">3% (360 horas)</option>
							</select>
							<input type="checkbox" name="atPSS"/> Marque se deseja incluir esta rubrica na base de cálculo de contribuição previdenciária.
                    </tr>
                    <tr>
                        <td>Anuênios</td>
                        <td><input type="number" id="anuenio" name="anuenio" size="2" maxlength="2" value="0"
                        max="35" min="0"/></td>
                    </tr>
                    <tr>
                        <td>Dependentes</td>
                        <td><input type="number" id="dependentes" name="dependentes" size="2" maxlength="1" value="0"
                        min="0" max="9"/></td>
                    </tr>
                    <tr>
						<td>Auxílio-creche</td>
						<td><input type="number" id="dependentesCreche" name="dependentesCreche" size="2" maxlength="1"
						value="0"  min="0" max="9"/></td>
                    </tr>
		    <tr>
			<td>Dep. Aux. Saúde (MPU)</td>
			<td><input type="number" id="depAuxSaude" name="depAuxSaude" size= "2" maxlength="1" value="0" min="0" max="9"/></td>
                    <tr>
                        <td>VPNI </td>
                        <td>
                            R$ <input type="text" name="vpni" id="vpni" value="0,00" size ="10" maxlength="9" /> <b>(não inclua os R$ 59,87 de VPI)</b>
                        </td>
                    </tr>

                    <tr>
						<td>Considerar progressões</td>
						<td><input type="checkbox" name="progredir" />Marque se deseja calcular progressões automáticas.
						<br>Mês da progressão:
							<select name="mesprogressao">
								<option value="1"> 1</option>
                                <option value="2"> 2</option>
                                <option value="3"> 3</option>
                                <option value="4"> 4</option>
                                <option value="5"> 5</option>
                                <option value="6"> 6</option>
                                <option value="7"> 7</option>
                                <option value="8"> 8</option>
                                <option value="9"> 9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="1">12</option>
							</select>
						</td>
                    </tr>
                    <tr>
						<td>Interpretar parcial Julho</td>
						<td>
							<select name="parcialjulho">
								<option value="0.33333333">10/30 dias</option>
								<option value="0.35483871">11/31 dias</option>
							</select>
						</td>
                    </tr>

                    <tr><td>Campos Opcionais<br>(Marque para exibir o conteúdo)</td><td>
						<input type="checkbox" name="PlanAssiste" id="PlanAssiste" value="1"
						onclick="mostraCampos();"/> PlanAssiste  <font style="color: #ffffff; background-color:#003300">__</font>
						<br><input type="checkbox" name="parcIndenizatoria" id="parcIndenizatoria" value="1"
						onclick="mostraCampos();"/> Parcelas Indenizatórias  <font style="color: #ffffff; background-color:#000066">__</font>
						<br><input type="checkbox" name="pensaoJudicial" id="pensaoJudicial"  value="1"
						onclick="mostraCampos();"/> Pensão Alimentícia Judicial <font style="color: #ffffff; background-color:#663300">__</font>
						<br><input type="checkbox" name="outrosDescontosCheck" id="outrosDescontosCheck" value="1"
						onclick="mostraCampos();"/> Descontos (como consignados) <font style="color: #ffffff; background-color:#000000">__</font>


						<p id="pPlan"
						style="color: #ffffff; background-color:#003300">
						    Em implementação. Aguardando a confirmação de reajuste para 2022.
						    <!-- Criar aqui uma tabela pelas faixas etárias
						    00-18
                            131,29
                            446,88
                            19-23
                            203,98
                            459,20
                            24-28
                            282,10
                            526,40
                            29-33
                            284,27
                            560,00
                            34-38
                            298,38
                            683,20
                            39-43
                            328,76
                            728,00
                            44-48
                            358,05
                            873,60
                            49-53
                            458,96
                            1.086,40
                            54-58
                            494,76
                            1.478,40
                            59 ou +
                            632,56
                            1.573,60

						<input type="checkbox" name="planAssisteTitular" checked value="0.02"> Titular
						<input type="checkbox" name="planAssisteConjuge" value="0.01"> Cônjuge
						Filhos: <input type="number" id="planAssisteFilho" name="planAssisteFilho" maxlength="1" value="0" size="2"
						 min="0" max="9"/>
						 Pais: <input type="number" id="planAssistePais" name="planAssistePais" maxlength="1" value="0" size="2"
						 min="0" max="4"/>
						 Ex-cônjuge/companheiro(a): <input type="number" id="planAssisteExConjuge" name="planAssisteExConjuge" maxlength="1" value="0" size="2"
						 min="0" max="2"/>
						 Beneficiários Especiais: <input type="number" id="planAssisteBeneficiariosEspeciais" name="planAssisteBeneficiariosEspeciais" maxlength="1" value="0" size="2"
						 min="0" max="9"/>
						 -->
						</p>
						<p id="pParcInd"
						style="color: #ffffff; background-color:#000066">
						<b>Parcelas Indenizatórias: </b>
						R$ <input type="text" name="indenizatorias" id="indenizatorias" value="0,00" size ="10" maxlength="9" />
						</p>
						<p id="pPensaoJud"
						style="color: #ffffff; background-color:#663300">
						<b>Pensão Alimentícia Judicial:</b> R$ <input type="text" name="pensaoAlimenticiaJudicial" id="pensaoAlimenticiaJudicial" value="0,00" size ="10" maxlength="9" />
						 || <b>Percentual:</b> R$ <input type="number" name="pensaoAlimenticiaJudicialPercentual" id="pensaoAlimenticiaJudicialPercentual" value="0" size ="10" maxlength="9" min="0" max="99"/>%
						</p>
						<p id="pOutrosDescontos"
						style="color: #ffffff; background-color:#000000">
						<b>Outros Descontos:</b> R$ <input type="text" name="outrosDescontos" id="outrosDescontos" value="0,00" size ="10" maxlength="9"  />
						</p>

                    </td></tr>

                    <tr><td>====>>></td><td><input  class="btn btn-secondary" type="submit" value="Calcular"/></td></tr>
                </table>
            </form>
        </fieldset>
        </div>
        </div>
        <br />

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
		<p><b>Dica: </b>Utilize o campo <b>Indenizatórias </b>para inclusão de despesas indenizatórias como diárias ou ajudas de transporte. Já o campo <b>Outros descontos </b> visa facilitar a inclusão de
		rubricas como associações e parcelas de crédito consignado. Ambas não fazem efeito para apuração de tributos (PSS e IRRF).</p>
		<hr width="50%">
	<p>Atualizado em 29/01/2022. <a href="sobre.php">Sobre o Sistema</a></p>
      <p>© Todos os direitos reservados. Criado por José Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:webmaster@josebarbosa.com.br">
webmaster@josebarbosa.com.br</a></adress>
<p><b>Observação</b>: os valores ora demonstrados são apenas uma perspectiva, e podem apresentar diferenças em razão de interpretação ou aplicação por parte dos órgãos.
Favor utilizar o e-mail para esclarecer dúvidas sobre eventuais inconsistências encontradas, ou verificar o motivo para a simulação apresentar diferenças significativas nos valores.

    </body>
</html>
