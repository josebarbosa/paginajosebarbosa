<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="descrição" content="Compare o salário atual com as propostas de reajuste ao TCU, de 5% e 13% - PL 1392/2022."/>


  	<!--adsense-->
  	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5983876568090420"
  	     crossorigin="anonymous"> </script>
         <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74364698-1', 'auto');
  ga('send', 'pageview');

	function mostraContribuicaoFunpresp(){
		var funprespChecked = document.getElementById("previdencia_funpresp").checked;
		if(funprespChecked)
		document.getElementById("trfunpresp").style.display = "block";
		else
		document.getElementById("trfunpresp").style.display = "none";
	}


</script>
<?php
include '../bootstrap.php';
?>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Salário TCU - PL 1392/2022</title>
    </head>
    <body onload="mostraContribuicaoFunpresp();">
      <?php
     include '../menu.php';
      ?>
      <div class="container">
        <h1>Simulação das Propostas de Reajuste ao TCU - 2022</h1>
        <p>Planilha para cálculo personalizado de como ficarão os salários dos servidores do Tribunal de Contas da União - TCU, em caso de concessão de revisão geral anual no importe de 5% em 2022 e/ou aprovação do PL n. 1392/2022.</p>

         <div>

            <form action="calcula_2022.php" method="post" class="form-group ">

              <div class="input-group mb-3">
                <label for="cargo" class="col-sm-3 col-form-label">Cargo</label>
                <div class="col-sm-9">
                  <select id="cargo" name="cargo" class="form-select-lg col mb-3">
                      <option value="1">Auditor</option>
                      <option value="2">Técnico</option>
                      <option value="3">Auxiliar</option>
                      <option disabled value="4">Comissionado</option>
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
                <label for="fc" class="col-sm-3 col-form-label">Função ou Cargo em Comissão</label>
                <div class="col-sm-9">
                  <select id="fc" name="fc" class="form-select-lg col mb-3">
                      <option value="">Não</option>
                      <option value="1">FC-1</option>
                      <option value="2">FC-2</option>
                      <option value="3">FC-3</option>
                      <option value="4">FC-4</option>
                      <option value="5">FC-5</option>
                      <option value="6">FC-6</option>
                      <option value="7">CC | Assistente</option>
                      <option value="8">CC | Oficial de Gabinete</option>
                  </select>

                </div>
              </div>
              <div class="input-group mb-3">
                  <label for="previdencia" class="col-sm-3 col-form-label">Regime Previdenciário</label>
                  <div class="col-sm-9 mb-3">
                    <input type="radio" id="previdencia_proprio" name="previdencia" value="1" checked class="btn-check" autocomplete="off"
                     onchange="mostraContribuicaoFunpresp();"/>
                     <label class="btn btn-outline-secondary" for="previdencia_proprio"/>Paridade/Média Int.</label>
                     <input type="radio" id="previdencia_funpresp" name="previdencia" value="2"  class="btn-check" autocomplete="off" onchange="mostraContribuicaoFunpresp();"/>
                    <label class="btn btn-outline-secondary" for="previdencia_funpresp"/>Prev. Complementar (FUNPRESP)</label>
                    <div class="mt-3 form-check form-switch form-floating" id="trfunpresp">
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
                      <label class="form-check-label" for="funcaoContribuicaoFunpresp">Marque se deseja incluir FC/CC na base de cálculo da contribuição à Funpresp.</label>
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
                  <label for="jornada" class="col-sm-3 col-form-label">Jornada:</label>
                  <div class="col-sm-9 col">
                    <input type="radio" name="jornada" id="jornada20" value="0.5"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="jornada20"/>20h (Médico)</label>
                    <input type="radio" name="jornada" id="jornada30" value="0.75"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="jornada30"/>30 horas</label>
                    <input type="radio" checked name="jornada" id="jornada40" value="1"  class="btn-check" autocomplete="off"/>
                    <label class="btn btn-outline-secondary" for="jornada40"/>40 horas</label>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <label for="desempenho" class="col-sm-3 col-form-label">Gratificação de Desempenho</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="number" id="desempenho" name="desempenho" size="2" maxlength="2" value="80"
                    max="80" min="48" class="form-control"/>
                    <label for="desempenho"> Perc. Gratificação de Desempenho (%)</label>
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

                <div class="input-group mb-3" >
                  <label for="vpni" class="col-sm-3 col-form-label">VPNI / Incorporações:</label>
                  <div class="col-sm-9 col form-floating mb-3">
                    <input type="text" name="vpni" id="vpni" size ="10" maxlength="9" value="0,00" class="form-control"/>
                    <label for="vpni"> VPNI (R$)</label>
                  </div>
                </div>

              </div>
                <input  class="btn btn-secondary btn-lg mb-3" type="submit" value="Calcular"/>
            </form>
            <p><b>Obs.:</b> A tabela não inclui o benefício de assistência médica, calcular à parte.</p>
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
	<p>Atualizado em 31/05/2022. <a href="sobre.php">Sobre o Sistema</a></p>
      <p>© Todos os direitos reservados. Criado por José Antonio dos Santos Barbosa. <adress>Contato: <a href="mailto:jose@josebarbosa.com.br">
jose@josebarbosa.com.br</a></adress>
</div>
    </body>
</html>
