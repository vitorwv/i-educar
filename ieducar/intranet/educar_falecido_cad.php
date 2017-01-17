<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
*																	     *
*	@author Prefeitura Municipal de Itaja�								 *
*	@updated 29/03/2007													 *
*   Pacote: i-PLB Software P�blico Livre e Brasileiro					 *
*																		 *
*	Copyright (C) 2006	PMI - Prefeitura Municipal de Itaja�			 *
*						ctima@itajai.sc.gov.br					    	 *
*																		 *
*	Este  programa  �  software livre, voc� pode redistribu�-lo e/ou	 *
*	modific�-lo sob os termos da Licen�a P�blica Geral GNU, conforme	 *
*	publicada pela Free  Software  Foundation,  tanto  a vers�o 2 da	 *
*	Licen�a   como  (a  seu  crit�rio)  qualquer  vers�o  mais  nova.	 *
*																		 *
*	Este programa  � distribu�do na expectativa de ser �til, mas SEM	 *
*	QUALQUER GARANTIA. Sem mesmo a garantia impl�cita de COMERCIALI-	 *
*	ZA��O  ou  de ADEQUA��O A QUALQUER PROP�SITO EM PARTICULAR. Con-	 *
*	sulte  a  Licen�a  P�blica  Geral  GNU para obter mais detalhes.	 *
*																		 *
*	Voc�  deve  ter  recebido uma c�pia da Licen�a P�blica Geral GNU	 *
*	junto  com  este  programa. Se n�o, escreva para a Free Software	 *
*	Foundation,  Inc.,  59  Temple  Place,  Suite  330,  Boston,  MA	 *
*	02111-1307, USA.													 *
*																		 *
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
require_once "include/clsBase.inc.php";
require_once "include/clsCadastro.inc.php";
require_once "include/clsBanco.inc.php";
require_once "include/pmieducar/geral.inc.php";
require_once "lib/Portabilis/Date/Utils.php";

class clsIndexBase extends clsBase
{
	function Formular()
	{
		$this->SetTitulo( "{$this->_instituicao} i-Educar - Transfer&ecirc;ncia Solicita&ccedil;&atilde;o" );
		$this->processoAp = "578";
		$this->addEstilo("localizacaoSistema");
	}
}

class indice extends clsCadastro
{
	/**
	 * Referencia pega da session para o idpes do usuario atual
	 *
	 * @var int
	 */
	var $pessoa_logada;

	function Inicializar()
	{
		$retorno = "Novo";
		@session_start();
		$this->pessoa_logada = $_SESSION['id_pessoa'];
		@session_write_close();

		$this->ref_cod_matricula=$_GET["ref_cod_matricula"];
		$this->ref_cod_aluno=$_GET["ref_cod_aluno"];

		$obj_permissoes = new clsPermissoes();
		$obj_permissoes->permissao_cadastra( 578, $this->pessoa_logada, 7,  "educar_matricula_lst.php?ref_cod_aluno={$this->ref_cod_aluno}" );

		$obj_matricula = new clsPmieducarMatricula( $this->cod_matricula,null,null,null,$this->pessoa_logada,null,null,6 );

		$det_matricula = $obj_matricula->detalhe();

		$this->url_cancelar = "educar_matricula_det.php?cod_matricula={$this->ref_cod_matricula}";

        $localizacao = new LocalizacaoSistema();
        $localizacao->entradaCaminhos( array(
             $_SERVER['SERVER_NAME']."/intranet" => "In&iacute;cio",
             "educar_index.php"                  => "i-Educar - Escola",
             ""       							 => "Cadastrar falecimento"
        ));
        $this->enviaLocalizacao($localizacao->montar());

		$this->nome_url_cancelar = "Cancelar";

		return $retorno;
	}

	function Gerar()
	{
		// primary keys
		$this->campoOculto( "ref_cod_aluno", $this->ref_cod_aluno );
		$this->campoOculto( "ref_cod_matricula", $this->ref_cod_matricula );

		$obj_aluno = new clsPmieducarAluno();
		$lst_aluno = $obj_aluno->lista( $this->ref_cod_aluno,null,null,null,null,null,null,null,null,null,1 );
		if ( is_array($lst_aluno) )
		{
			$det_aluno = array_shift($lst_aluno);
			$this->nm_aluno = $det_aluno["nome_aluno"];
			$this->campoTexto( "nm_aluno", "Aluno", $this->nm_aluno, 30, 255, false,false,false,"","","","",true );
		}

		$this->inputsHelper()->date('data_cancel', array('label' => 'Data do falecimento', 'placeholder' => 'dd/mm/yyyy', 'value' => date('d/m/Y')));

		$this->campoMemo( "observacao", "Observa&ccedil;&atilde;o", $this->observacao, 60, 5, false );
	}

	function Novo()
	{
		@session_start();
		 $this->pessoa_logada = $_SESSION['id_pessoa'];
		@session_write_close();

		$obj_permissoes = new clsPermissoes();
		$obj_permissoes->permissao_cadastra( 578, $this->pessoa_logada, 7,  "educar_matricula_det.php?cod_matricula={$this->ref_cod_matricula}" );

		$tamanhoObs = strlen($this->observacao);
		if($tamanhoObs > 300){
			$this->mensagem = "O campo observa��o deve conter no m�ximo 300 caracteres.<br>";
			return FALSE;
		}

		$obj_matricula = new clsPmieducarMatricula( $this->ref_cod_matricula,null,null,null,$this->pessoa_logada,null,null,6 );
		$obj_matricula->data_cancel = Portabilis_Date_Utils::brToPgSQL($this->data_cancel);

		$det_matricula = $obj_matricula->detalhe();

		if(is_null($det_matricula['data_matricula'])){

			if(substr($det_matricula['data_cadastro'], 0, 10) > $obj_matricula->data_cancel) {
				$this->mensagem = "Data de falecimento n�o pode ser inferior a data da matr�cula.<br>";
				return false;
			}
		}else {
			if(substr($det_matricula['data_matricula'], 0, 10) > $obj_matricula->data_cancel){
				$this->mensagem = "Data de falecimento n�o pode ser inferior a data da matr�cula.<br>";
				return false;
			}
		}

		if($obj_matricula->edita()) {
			if($obj_matricula->cadastraObservacaoFalecido($this->observacao)) {
				$enturmacoes = new clsPmieducarMatriculaTurma();
				$enturmacoes = $enturmacoes->lista($this->ref_cod_matricula, null, null, null, null, null, null, null, 1 );

				foreach ($enturmacoes as $enturmacao) {
				  $enturmacao = new clsPmieducarMatriculaTurma( $this->ref_cod_matricula, $enturmacao['ref_cod_turma'], $this->pessoa_logada, null, null, null, 0, null, $enturmacao['sequencial']);

				  if(! $enturmacao->edita())
				  {
				  	$this->mensagem = "N&atilde;o foi poss&iacute;vel desativar as enturma&ccedil;&otilde;es da matr&iacute;cula.";
					return false;
				  }else
				  	$enturmacao->marcaAlunoFalecido($this->data_cancel);

      			}
				$this->mensagem .= "Altera��o realizado com sucesso.<br>";
				header( "Location: educar_matricula_det.php?cod_matricula={$this->ref_cod_matricula}" );
				return true;
			}

			$this->mensagem = "A altera��o n�o pode ser salva.<br>";

			return false;
		}
		$this->mensagem = "A altera��o n�o pode ser realizado.<br>";
		return false;
	}

}

// cria uma extensao da classe base
$pagina = new clsIndexBase();
// cria o conteudo
$miolo = new indice();
// adiciona o conteudo na clsBase
$pagina->addForm( $miolo );
// gera o html
$pagina->MakeAll();
?>