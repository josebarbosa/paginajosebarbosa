<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="descrição" content="Simule o seu novo contracheque após a implementação do PL 4362/2012 e 4363/2012, novos planos de carreira 
              dos servidores do Ministério Público da União e do Poder Judiciário da União."/>
		<style type="text/css"> 
			BODY{ 
				font-family: arial, verdana, courier; 
			} 
		</style>
     
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74364698-1', 'auto');
  ga('send', 'pageview');

</script>
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
	
</script>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Salário MPU - PLC 41/2015 (Substitutivo) e Judiciário - PL 2648/2015</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();mostraCampos();orgaoAltera();">
        <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
            </script>
            <script type="text/javascript" src="http://apis.google.com/js/plusone.js"></script>
            
            <div align="center">
		
			<script type="text/javascript">
				bb_bid = "1707100";
				bb_lang = "pt-BR";
				bb_name = "custom";
				bb_limit = "8";
				bb_format = "bbb";
			</script>
			<script type="text/javascript" src="http://static.boo-box.com/javascripts/embed.js"></script>
		</div>
            
        <h1>Simulação dos PLs do MPU e Judiciário</h1>
        <p>Planilha para cálculo personalizado de como ficarão os salários dos servidores do MPU e Judiciário em caso de aprovação dos planos de carreira, com escalonamento proposto entre junho de 2016 a janeiro de 2019.</p>
        
         <div>
			 <b><p>Já são válidos os valores do novo substitutivo, aprovados na Câmara em 01/06/2016, e que aguardam aprovação no Senado. </p></b>
            <div style="background-color:#FFF">
            <fieldset >
            <legend >Informe os dados</legend>
            <form action="tcalcula.php" method="post">
                 
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
                            Regime Próprio (até 2013) 
                            <input type="radio" id="previdencia_funpresp" name="previdencia" value="2" 
							 onchange="mostraContribuicaoFunpresp();"/>Funpresp
                       
                    <p id="trfunpresp">
						Contribuição: 
                    <select id="funprespIndice" name="funprespIndice">
						 <option value="0.075"> 7,5%</option> 
						<option value="0.08"> 8%</option> 
						<option value="0.085"> 8,5%</option> 
                    </select>
                    <input type="checkbox" id="funcaoContribuicaoFunpresp" 
                    name="funcaoContribuicaoFunpresp" value="1"/> Marque se deseja incluir FC ou CC na base de cálculo.
                    </p> </td></tr>
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
                                <option value="13">13</option> 
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
                            Penosidade</td>
                        <td>
                            <input type="checkbox" name="gas" id="gas" value="0.35" />GAS ou GAE 
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
                            <option value="0.025">2,5% (120 horas)</option> 
                            <option value="0.05">5% (240 horas)</option> 
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
						value="0"  min="0" max="4"/></td>
                    </tr>
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
                                <option value="12">12</option>
							</select>
						</td>
                    </tr>
                    
                    <tr><td>Campos Opcionais<br>(Marque para exibir o conteúdo)</td><td>
						<input type="checkbox" name="PlanAssiste" id="PlanAssiste"
						onclick="mostraCampos();"/> PlanAssiste  <font style="color: #ffffff; background-color:#003300">__</font>
						<br><input type="checkbox" name="parcIndenizatoria" id="parcIndenizatoria"
						onclick="mostraCampos();"/> Parcelas Indenizatórias  <font style="color: #ffffff; background-color:#000066">__</font>
						<br><input type="checkbox" name="pensaoJudicial" id="pensaoJudicial" 
						onclick="mostraCampos();"/> Pensão Alimentícia Judicial <font style="color: #ffffff; background-color:#663300">__</font>
						<br><input type="checkbox" name="outrosDescontos" id="outrosDescontosCheck" 
						onclick="mostraCampos();"/> Descontos (como consignados) <font style="color: #ffffff; background-color:#000000">__</font>
						
						
						<p id="pPlan"
						style="color: #ffffff; background-color:#003300">
						<input type="checkbox" name="planAssisteTitular" checked value="0.02"> Titular
						<input type="checkbox" name="planAssisteConjuge" value="0.01"> Cônjuge
						Filhos: <input type="number" id="planAssisteFilho" name="planAssisteFilho" maxlength="1" value="0" size="2"
						 min="0" max="9"/>						
						</p>
						<p id="pParcInd"
						style="color: #ffffff; background-color:#000066">
						<b>Parcelas Indenizatórias: </b>
						R$ <input type="text" name="indenizatorias" id="indenizatorias" value="0,00" size ="10" maxlength="9" />
						</p>
						<p id="pPensaoJud"
						style="color: #ffffff; background-color:#663300">
						<b>Pensão Alimentícia Judicial:</b> R$ <input type="text" name="pensaoAlimenticiaJudicial" id="pensaoAlimenticiaJudicial" value="0,00" size ="10" maxlength="9" />
                    
						</p>
						<p id="pOutrosDescontos"
						style="color: #ffffff; background-color:#000000">
						<b>Outros Descontos:</b> R$ <input type="text" name="outrosDescontos" id="outrosDescontos" value="0,00" size ="10" maxlength="9" />
						</p>
						
                    </td></tr>
                   
                    <tr><td>====>>></td><td><input type="submit" value="Calcular"/></td></tr>
                </table>
            </form>
        </fieldset>
        </div>
        </div>
        <br />
        <g:plusone></g:plusone>
        <iframe src="http://www.facebook.com/plugins/like.php?href=http://www.josebarbosa.net.br/pcs/&layout=standard&show_faces=false&width=380&action=like&colorscheme=light&height=25" 
                scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:25px;" allowtransparency="true"></iframe>
        <br />
        <div>
			<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
			<form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
			<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
			<input type="hidden" name="currency" value="BRL" />
			<input type="hidden" name="receiverEmail" value="jose.as.barbosa@uol.com.br" />
			<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
			</form>
			<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
        </div>
		<p>Se você gostou, não deixe de doar! sua contribuição é muito importante para manter a estrutura do site em funcionamento. </p>
		<p><b>Dica: </b>Utilize o campo <b>Indenizatórias </b>para inclusão de despesas indenizatórias como diárias ou ajudas de transporte. Já o campo <b>Outros descontos </b> visa facilitar a inclusão de 
		rubricas como associações e parcelas de crédito consignado. Ambas não fazem efeito para apuração de tributos (PSS e IRRF).</p>
		
      
    </body>
</html>


