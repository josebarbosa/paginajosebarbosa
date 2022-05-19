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



	function orgaoAltera(){
		var orgao = document.getElementById("orgao_mpu").checked;
		if(orgao){
			document.getElementById("fc_mpu").style.display = "block";
			document.getElementById("fc_jud").style.display = "none";
			document.getElementById("at_mpu").style.display = "block";
			document.getElementById("at_jud").style.display = "none";
      document.getElementById("div_aux_saude").style.display = "block";
			}else{
			document.getElementById("fc_jud").style.display = "block";
			document.getElementById("fc_mpu").style.display = "none";
			document.getElementById("at_jud").style.display = "block";
			document.getElementById("at_mpu").style.display = "none";
      document.getElementById("div_aux_saude").style.display = "none";
		}
	}

	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})

</script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Salário MPU - Leis 13.316/2016 (MPU) e 13.317/2016 (Judiciário)</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();orgaoAltera();">
      <?php
     include '../menu.php';
      ?>
      <div class="container-fluid">
        <h1>Simulação dos PLs do MPU e Judiciário</h1>
        <p>Planilha para cálculo personalizado de como ficarão os salários dos servidores do MPU e Judiciário com a aprovação das Leis
        <a href=http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2016/Lei/L13316.htm target="resource window">13.316/2016</a>  e
        <a href=http://www.planalto.gov.br/ccivil_03/_Ato2015-2018/2016/Lei/L13317.htm target="resource window">13.317/2016</a>
        , planos do MPU e Judiciário, respectivamente.</p>
         <div>

            <form action="calcula_2022.php" method="post" class="row ">
              <div class="input-group mb-3">
                <div class="input-group mb-3">
                  <label for="penosa" class="col-sm-3 col-form-label">Órgão</label>
                  <div class="col-sm-9 col">
                    <input type="radio" id="orgao_mpu" name="orgao" value="1" checked="true"  class="btn-check" autocomplete="off"  onchange="orgaoAltera();">
                        <label class="btn btn-outline-secondary" for="orgao_mpu"/>MPU</label>
                        <input type="radio" id="orgao_jud" name="orgao" value="2" onchange="orgaoAltera();" class="btn-check" autocomplete="off">
                        <label class="btn btn-outline-secondary" for="orgao_jud"/>Judiciário</label>
                  </div>
                </div>


                <div class="input-group mb-3">
                    <label for="previdencia" class="col-sm-3 col-form-label">Regime Previdenciário</label>
                    <div class="col-sm-9">
                      <input type="radio" id="previdencia_proprio" name="previdencia" value="1" checked class="btn-check" autocomplete="off"
                     onchange="mostraContribuicaoFunpresp();"/>
                     <label class="btn btn-outline-secondary" for="previdencia_proprio"/>Paridade/Média Int.</label>
                     <input type="radio" id="previdencia_funpresp" name="previdencia" value="2"  class="btn-check" autocomplete="off"
        onchange="mostraContribuicaoFunpresp();"/>
                    <label class="btn btn-outline-secondary" for="previdencia_funpresp"/>Prev. Complementar (FUNPRESP-JUD)</label>
                    <div class="form-check form-switch form-floating" id="trfunpresp">
                      <div class="form-floating">
                        <select id="funprespIndice" name="funprespIndice" class="form-select mb-3" >
                          <option value="0.085"> 8,5%</option>
                          <option value="0.065"> 6,5%</option>
                          <option value="0.07"> 7%</option>
                           <option value="0.075"> 7,5%</option>
                          <option value="0.08"> 8%</option>

                          <option value="0"> Não (0%)</option>
                        </select>
                        <label for="funprespIndice">Contribuição Patrocinada</label>
                      </div>
                    <div class="form-check form-switch">
                      <input  class="form-check-input" type="checkbox" id="funcaoContribuicaoFunpresp"
                      name="funcaoContribuicaoFunpresp" value="1"/>
                      <label class="form-check-label" for="funcaoContribuicaoFunpresp">Marque se deseja incluir FC/CC/CJ na base de cálculo da contribuição à Funpresp-JUD.</label>
                    </div>
                      <div class="form-floating mb-3">
                        <input type="number" id="trfunpresp" class="form-control" name="funprespOpcional" size="4" maxlength="2" value="0"
                          min="0" max="20" step="0.5"/>
                        <label for="trfunpresp">Contribuição Opcional (%)</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="cargo" class="col-sm-3 col-form-label">Cargo</label>
                  <div class="col-sm-9">
                    <select id="cargo" name="cargo" class="form-select-lg col mb-3">
                        <option value="2">Técnico</option>
                        <option value="3">Analista</option>
                        <option disabled value="4">Requisitado</option>
                    </select>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="nivel" class="col-sm-3 col-form-label">Classe / Padrão</label>
                  <div class="col-sm-9">
                    <select id="nivel" name="nivel" class="form-select-lg col mb-3">
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
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="fc_jud" class="col-sm-3 col-form-label">Função ou Cargo em Comissão</label>
                  <div class="col-sm-9">
                    <select id="fc_jud" name="fc_jud" class="form-select-lg col mb-3">
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
                    <select id="fc_mpu" name="fc" class="form-select-lg col mb-3">
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
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="gas" class="col-sm-3 col-form-label">GAS/GAE/GP</label>
                  <div class="col-sm-9 col">
                    <input type="radio" name="gas" id="gas35" value="0.35"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="gas35"/>GAS, GAE ou Projeto (35%)</label>
                    <input type="radio" name="gas" id="gas25" value="0.25" class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="gas25"/>GAS (25%)</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="penosa" class="col-sm-3 col-form-label">Penosidade ou Periculosidade</label>
                  <div class="col-sm-9 col">
                    <input type="radio" name="penosa" id="penosa10" value="0.1"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="penosa10"/>Penosidade ou Insalubridade(10%)</label>
                    <input type="radio" name="penosa" id="penosa20" value="0.2"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="penosa20"/>Penosidade ou Insalubridade(20%)</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="aq" class="col-sm-3 col-form-label">Adicional de Qualificação</label>
                  <div class="col-sm-9 col">
                    <input type="radio" id="aq" name="aq" value="0" checked class="btn-check" autocomplete="off" />
                    <label class="btn btn-outline-secondary" for="aq"/>Não</label>
                    <input type="radio" id="aqGraduacao" name="aq"  value="0.05" class="btn-check" autocomplete="off" />
                    <label class="btn btn-outline-secondary" for="aqGraduacao"/>Graduação (5%)</label>
                    <input type="radio" id="aqEspecializacao" name="aq" value="0.075" class="btn-check" autocomplete="off" />
                    <label class="btn btn-outline-secondary" for="aqEspecializacao"/>Especialização (7,5%)</label>
                    <input type="radio" id="aqMestrado" name="aq"  value="0.1" class="btn-check" autocomplete="off" />
                    <label class="btn btn-outline-secondary" for="aqMestrado"/>Mestrado (10%)</label>
                    <input type="radio" id="aqDoutorado" name="aq"  value="0.125" class="btn-check" autocomplete="off" />
                    <label class="btn btn-outline-secondary" for="aqDoutorado"/>Doutorado(12,5%)</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="at_jud" class="col-sm-3 col-form-label">Adicional de Treinamento</label>
                  <div class="col-sm-9">
                    <select name="at" id="at_mpu" class="form-select-lg col mb-3">
        							<option value="">Não</option>
                                    <option value="0.01">2,5% (120 horas)</option>
                                    <option value="0.02">5% (240 horas)</option>
        							</select>
        							<select name="at_jud" id="at_jud" class="form-select-lg col mb-3">
        							<option value="">Não</option>
                                    <option value="0.01">1% (120 horas)</option>
                                    <option value="0.02">2% (240 horas)</option>
                                    <option value="0.03">3% (360 horas)</option>
        							</select>
                      <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="atPSS"/> Marque se deseja incluir o adicional de treinamento na base de cálculo de contribuição previdenciária.</label>
                      </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="anuenio" class="col-sm-3 col-form-label">Adicional por Tempo de Serviço</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="number" id="anuenio" name="anuenio" size="2" maxlength="2" value="0"
                    max="35" min="0" class="form-control"/>
                    <label for="anuenio"> ATS/Anuênios (%)</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="dependentes" class="col-sm-3 col-form-label">Dependentes (IRRF)</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="number" id="dependentes" name="dependentes" size="2" maxlength="1" value="0"
                    min="0" max="9" class="form-control"/>
                    <label for="dependentes"> Número</label>
                  </div>
                </div>
                <div class="input-group mb-3" >
                  <label for="dependentesCreche" class="col-sm-3 col-form-label">Auxílio-creche</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="number" id="dependentesCreche" name="dependentesCreche" size="2" maxlength="1"
        						value="0"  min="0" max="9" class="form-control"/>
                    <label for="dependentesCreche"> Número</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="depAuxSaude" class=col-sm-3 col-form-label>Dep. Auxílio Saúde</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="number" id="depAuxSaude" name="depAuxSaude" size="2" maxlength="1" value="0"
                    min="0" max="9" class="form-control"/>
                    <label for="depAuxSaude"> Número</label>
                  </div>
                </div>
                <div class="input-group mb-3" >
                  <label for="vpni" class="col-sm-3 col-form-label">VPNI / Incorporações:</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="text" name="vpni" id="vpni" size ="10" maxlength="9"  class="form-control"/>
                    <label for="vpni"> VPNI (R$)</label>
                  </div>
                </div>

              </div>
                <input  class="btn btn-secondary btn-lg mb-3" type="submit" value="Calcular"/>
            </form>
        </div>


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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5983876568090420"
     crossorigin="anonymous"></script>
	<p>Atualizado em 14/05/2022. <a href="sobre.php">Sobre o Sistema</a></p>
      <p>© Todos os direitos reservados. Criado por José Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:jose@josebarbosa.com.br">
jose@josebarbosa.com.br</a></adress>
</div>
    </body>
</html>
