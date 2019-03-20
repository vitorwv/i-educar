<?php

use iEducar\Modules\Educacenso\Model\AreasExternas;
use iEducar\Modules\Educacenso\Model\Banheiros;
use iEducar\Modules\Educacenso\Model\Dormitorios;
use iEducar\Modules\Educacenso\Model\Laboratorios;
use iEducar\Modules\Educacenso\Model\LocalFuncionamento;
use iEducar\Modules\Educacenso\Model\OrgaoVinculadoEscola;
use iEducar\Modules\Educacenso\Model\LocalizacaoDiferenciadaEscola;
use iEducar\Modules\Educacenso\Model\DependenciaAdministrativaEscola;
use iEducar\Modules\Educacenso\Model\EsferaAdministrativa;
use iEducar\Modules\Educacenso\Model\RecursosAcessibilidade;
use iEducar\Modules\Educacenso\Model\Regulamentacao;
use iEducar\Modules\Educacenso\Model\SalasAtividades;
use iEducar\Modules\Educacenso\Model\SalasFuncionais;
use iEducar\Modules\Educacenso\Model\SalasGerais;
use iEducar\Modules\Educacenso\Model\TratamentoLixo;
use iEducar\Modules\Educacenso\Model\MantenedoraDaEscolaPrivada;
use iEducar\Modules\Educacenso\Validator\Telefone;
use iEducar\Support\View\SelectOptions;

require_once 'include/clsBase.inc.php';
require_once 'include/clsCadastro.inc.php';
require_once 'include/clsBanco.inc.php';
require_once 'include/pmieducar/geral.inc.php';
require_once 'Portabilis/View/Helper/Application.php';
require_once 'Portabilis/Utils/Database.php';
require_once 'include/modules/clsModulesAuditoriaGeral.inc.php';
require_once 'App/Model/ZonaLocalizacao.php';

class clsIndexBase extends clsBase
{
    public function Formular()
    {
        $this->SetTitulo("{$this->_instituicao} i-Educar - Escola");
        $this->processoAp = "561";
    }
}

class indice extends clsCadastro
{
    /**
     * Referencia pega da session para o idpes do usuario atual
     *
     * @var int
     */
    public $pessoa_logada;

    public $cod_escola;
    public $ref_usuario_cad;
    public $ref_usuario_exc;
    public $ref_cod_instituicao;
    public $ref_cod_escola_rede_ensino;
    public $ref_idpes;
    public $cnpj;
    public $sigla;
    public $data_cadastro;
    public $data_exclusao;
    public $ativo;
    public $nm_escola;
    public $passou;
    public $escola_curso;
    public $escola_curso_autorizacao;
    public $escola_curso_anos_letivos;
    public $ref_cod_curso;
    public $autorizacao;
    public $fantasia;
    public $sigla_uf_;
    public $cidade_;
    public $cep_;
    public $idtlog_;
    public $idbai_;
    public $endereco;
    public $cep;
    public $ref_bairro;
    public $p_ddd_telefone_1;
    public $p_telefone_1;
    public $p_ddd_telefone_2;
    public $p_telefone_2;
    public $p_ddd_telefone_mov;
    public $p_telefone_mov;
    public $p_ddd_telefone_fax;
    public $p_telefone_fax;
    public $p_email;
    public $p_http;
    public $tipo_pessoa;
    public $cidade;
    public $bairro;
    public $logradouro;
    public $idlog;
    public $idbai;
    public $idtlog;
    public $sigla_uf;
    public $complemento;
    public $numero;
    public $andar;
    public $situacao_funcionamento;
    public $dependencia_administrativa;
    public $orgao_vinculado_escola;
    public $latitude;
    public $longitude;
    public $regulamentacao;
    public $acesso;
    public $gestor_id;
    public $cargo_gestor;
    public $email_gestor;
    public $local_funcionamento;
    public $condicao;
    public $predio_compartilhado_outra_escola;
    public $codigo_inep_escola_compartilhada;
    public $codigo_inep_escola_compartilhada2;
    public $codigo_inep_escola_compartilhada3;
    public $codigo_inep_escola_compartilhada4;
    public $codigo_inep_escola_compartilhada5;
    public $codigo_inep_escola_compartilhada6;
    public $decreto_criacao;
    public $area_terreno_total;
    public $area_construida;
    public $area_disponivel;
    public $num_pavimentos;
    public $tipo_piso;
    public $medidor_energia;
    public $agua_consumida;
    public $agua_potavel_consumo;
    public $abastecimento_agua;
    public $abastecimento_energia;
    public $esgoto_sanitario;
    public $destinacao_lixo;
    public $tratamento_lixo;
    public $salas_funcionais;
    public $salas_gerais;
    public $banheiros;
    public $laboratorios;
    public $salas_atividades;
    public $dormitorios;
    public $areas_externas;
    public $recursos_acessibilidade;
    public $possui_dependencias;
    public $dependencia_numero_salas_existente;
    public $dependencia_numero_salas_utilizadas;
    public $total_funcionario;
    public $atendimento_aee;
    public $atividade_complementar;
    public $fundamental_ciclo;
    public $localizacao_diferenciada;
    public $materiais_didaticos_especificos;
    public $educacao_indigena;
    public $lingua_ministrada;
    public $espaco_brasil_aprendizado;
    public $abre_final_semana;
    public $codigo_lingua_indigena;
    public $televisoes;
    public $videocassetes;
    public $dvds;
    public $antenas_parabolicas;
    public $copiadoras;
    public $retroprojetores;
    public $impressoras;
    public $aparelhos_de_som;
    public $projetores_digitais;
    public $faxs;
    public $maquinas_fotograficas;
    public $computadores;
    public $computadores_administrativo;
    public $computadores_alunos;
    public $impressoras_multifuncionais;
    public $acesso_internet;
    public $ato_criacao;
    public $ato_autorizativo;
    public $secretario_id;
    public $utiliza_regra_diferenciada;
    public $categoria_escola_privada;
    public $conveniada_com_poder_publico;
    public $mantenedora_escola_privada;
    public $cnpj_mantenedora_principal;
    public $incluir_curso;
    public $excluir_curso;
    public $sem_cnpj;
    public $com_cnpj;
    public $isEnderecoExterno = 0;
    public $esfera_administrativa;

    public function Inicializar()
    {
        $retorno = "Novo";

        $obj_permissoes = new clsPermissoes();
        $obj_permissoes->permissao_cadastra(561, $this->pessoa_logada, 7, "educar_escola_lst.php");

        $this->cod_escola = $this->getQueryString('cod_escola');

        $this->sem_cnpj = false;

        // cadastro Novo sem CNPJ
        if (is_numeric($_POST["sem_cnpj"]) && !$this->cod_escola) {
            $this->sem_cnpj = true;
            $retorno = "Novo";
        } // cadastro Novo com CNPJ
        elseif ($_POST["cnpj"]) {
            $this->com_cnpj = true;
            $obj_juridica = new clsPessoaJuridica();
            $lst_juridica = $obj_juridica->lista(idFederal2int($_POST["cnpj"]));
            // caso exista o CNPJ na BD
            if (is_array($lst_juridica)) {
                $retorno = "Editar";
                $det_juridica = array_shift($lst_juridica);
                $this->ref_idpes = $det_juridica["idpes"];
                $obj = new clsPmieducarEscola();
                $lst_escola = $obj->lista(null, null, null, null, null, null, $this->ref_idpes, null, null, null, 1);
                if (is_array($lst_escola)) {
                    $registro = array_shift($lst_escola);
                    $this->cod_escola = $registro["cod_escola"];
                }
            } // caso nao exista o CNPJ
            else {
                $retorno = "Editar";
            }
        } // cadastro Editar
        if (is_numeric($this->cod_escola) && !$_POST["passou"]) {
            $obj = new clsPmieducarEscola($this->cod_escola);
            $registro = $obj->detalhe();

            if ($registro["ref_idpes"]) {
                $this->com_cnpj = true;
            } else {
                $this->sem_cnpj = true;
            }

            if ($registro) {

                foreach ($registro as $campo => $val) {
                    // passa todos os valores obtidos no registro para atributos do objeto
                    $this->$campo = $val;
                }

                $this->gestor_id = $registro['ref_idpes_gestor'];
                $this->secretario_id = $registro['ref_idpes_secretario_escolar'];
                $objEndereco = new clsPessoaEndereco($this->ref_idpes);
                $detEndereco = $objEndereco->detalhe();

                if ($detEndereco) {
                    $this->isEnderecoExterno = 0;
                } else {
                    $this->isEnderecoExterno = 1;
                }

                $this->fantasia = $registro['nome'];
                $objJuridica = new clsPessoaJuridica($this->ref_idpes);
                $det = $objJuridica->detalhe();
                $this->cnpj = int2CNPJ($det["cnpj"]);
                $this->fexcluir = $obj_permissoes->permissao_excluir(561, $this->pessoa_logada, 3);
                $retorno = "Editar";

                if ($registro["tipo_cadastro"] == 1) {
                    $objJuridica = new clsPessoaJuridica(false, idFederal2int($this->cnpj));
                    $det = $objJuridica->detalhe();
                    $objPessoa = new clsPessoaFj($det["idpes"]);
                    list($this->endereco,
                        $this->cep,
                        $this->ref_bairro,
                        $this->p_ddd_telefone_1,
                        $this->p_telefone_1,
                        $this->p_ddd_telefone_2,
                        $this->p_telefone_2,
                        $this->p_ddd_telefone_mov,
                        $this->p_telefone_mov,
                        $this->p_ddd_telefone_fax,
                        $this->p_telefone_fax,
                        $this->p_email,
                        $this->p_http,
                        $this->tipo_pessoa,
                        $this->cidade,
                        $this->bairro,
                        $this->logradouro,
                        $this->idlog,
                        $this->idbai,
                        $this->idtlog,
                        $this->sigla_uf,
                        $this->complemento,
                        $this->numero,
                        $this->andar) = $objPessoa->queryRapida($det["idpes"],
                        "endereco",
                        "cep",
                        "bairro",
                        "ddd_1",
                        "fone_1",
                        "ddd_2",
                        "fone_2",
                        "ddd_mov",
                        "fone_mov",
                        "ddd_fax",
                        "fone_fax",
                        "email",
                        "url",
                        "tipo",
                        "cidade",
                        "bairro",
                        "logradouro",
                        "idlog",
                        "idbai",
                        "idtlog",
                        "sigla_uf",
                        "complemento",
                        "numero",
                        "andar");
                } else {
                    $objEscolaComplemento = new clsPmieducarEscolaComplemento($this->cod_escola);
                    $detComplemento = $objEscolaComplemento->detalhe();

                    foreach ($detComplemento as $campo => $val) {
                        $this->$campo = $val;
                    }

                    $this->cep_ = $this->cep;
                    $this->p_email = $this->email;
                    $this->cidade = $this->municipio;
                    $this->p_ddd_telefone_1 = $this->ddd_telefone;
                    $this->p_telefone_1 = $this->telefone;
                    $this->p_ddd_telefone_fax = $this->ddd_fax;
                    $this->p_telefone_fax = $this->fax;
                }
            }
        } elseif ($_POST['cnpj'] && !$_POST["passou"]) {
            $objJuridica = new clsPessoaJuridica(false, idFederal2int($_POST['cnpj']));
            $det = $objJuridica->detalhe();
            $objPessoa = new clsPessoaFj($det["idpes"]);
            list($this->endereco,
                $this->cep,
                $this->ref_bairro,
                $this->p_ddd_telefone_1,
                $this->p_telefone_1,
                $this->p_ddd_telefone_2,
                $this->p_telefone_2,
                $this->p_ddd_telefone_mov,
                $this->p_telefone_mov,
                $this->p_ddd_telefone_fax,
                $this->p_telefone_fax,
                $this->p_email,
                $this->p_http,
                $this->tipo_pessoa,
                $this->cidade,
                $this->bairro,
                $this->logradouro,
                $this->idlog,
                $this->idbai,
                $this->idtlog,
                $this->sigla_uf,
                $this->complemento,
                $this->numero,
                $this->andar) = $objPessoa->queryRapida($det["idpes"],
                "endereco",
                "cep",
                "bairro",
                "ddd_1",
                "fone_1",
                "ddd_2",
                "fone_2",
                "ddd_mov",
                "fone_mov",
                "ddd_fax",
                "fone_fax",
                "email",
                "url",
                "tipo",
                "cidade",
                "bairro",
                "logradouro",
                "idlog",
                "idbai",
                "idtlog",
                "sigla_uf",
                "complemento",
                "numero",
                "andar");
        }

        if ($this->cnpj_mantenedora_principal) {
            $this->cnpj_mantenedora_principal = int2CNPJ($this->cnpj_mantenedora_principal);
        }

        if (is_string($this->local_funcionamento)) {
            $this->local_funcionamento = explode(',', str_replace(array('{', "}"), '', $this->local_funcionamento));
        }

        if (is_string($this->abastecimento_agua)) {
            $this->abastecimento_agua = explode(',', str_replace(array('{', "}"), '', $this->abastecimento_agua));
        }

        if (is_string($this->abastecimento_energia)) {
            $this->abastecimento_energia = explode(',', str_replace(array('{', "}"), '', $this->abastecimento_energia));
        }

        if (is_string($this->esgoto_sanitario)) {
            $this->esgoto_sanitario = explode(',', str_replace(array('{', "}"), '', $this->esgoto_sanitario));
        }

        if (is_string($this->destinacao_lixo)) {
            $this->destinacao_lixo = explode(',', str_replace(array('{', "}"), '', $this->destinacao_lixo));
        }

        if (is_string($this->tratamento_lixo)) {
            $this->tratamento_lixo = explode(',', str_replace(array('{', "}"), '', $this->tratamento_lixo));
        }


        if (is_string($this->salas_funcionais)) {
            $this->salas_funcionais = explode(',', str_replace(array('{', "}"), '', $this->salas_funcionais));
        }

        if (is_string($this->salas_gerais)) {
            $this->salas_gerais = explode(',', str_replace(array('{', "}"), '', $this->salas_gerais));
        }

        if (is_string($this->banheiros)) {
            $this->banheiros = explode(',', str_replace(array('{', "}"), '', $this->banheiros));
        }

        if (is_string($this->laboratorios)) {
            $this->laboratorios = explode(',', str_replace(array('{', "}"), '', $this->laboratorios));
        }

        if (is_string($this->salas_atividades)) {
            $this->salas_atividades = explode(',', str_replace(array('{', "}"), '', $this->salas_atividades));
        }

        if (is_string($this->dormitorios)) {
            $this->dormitorios = explode(',', str_replace(array('{', "}"), '', $this->dormitorios));
        }

        if (is_string($this->areas_externas)) {
            $this->areas_externas = explode(',', str_replace(array('{', "}"), '', $this->areas_externas));
        }

        if (is_string($this->recursos_acessibilidade)) {
            $this->recursos_acessibilidade = explode(',', str_replace(array('{', "}"), '', $this->recursos_acessibilidade));
        }

        if (is_string($this->mantenedora_escola_privada)) {
            $this->mantenedora_escola_privada = explode(',', str_replace(array('{', "}"), '', $this->mantenedora_escola_privada));
        }

        if (is_string($this->orgao_vinculado_escola)) {
            $this->orgao_vinculado_escola = explode(',', str_replace(array('{', "}"), '', $this->orgao_vinculado_escola));
        }

        $this->url_cancelar = ($retorno == "Editar") ? "educar_escola_det.php?cod_escola={$registro["cod_escola"]}" : "educar_escola_lst.php";

        $this->breadcrumb('Escola', ['educar_index.php' => 'Escola']);
        $this->nome_url_cancelar = "Cancelar";
        return $retorno;
    }

    public function Gerar()
    {
        // assets
        $scripts = array(
            '/modules/Portabilis/Assets/Javascripts/Utils.js',
            '/modules/Portabilis/Assets/Javascripts/ClientApi.js',
            '/modules/Cadastro/Assets/Javascripts/Escola.js',
        );
        Portabilis_View_Helper_Application::loadJavascript($this, $scripts);
        $styles = array('/modules/Cadastro/Assets/Stylesheets/Escola.css');
        Portabilis_View_Helper_Application::loadStylesheet($this, $styles);

        $obj_permissoes = new clsPermissoes();

        $obrigarCamposCenso = $this->validarCamposObrigatoriosCenso();

        $this->campoOculto('obrigar_campos_censo', (int) $obrigarCamposCenso);

        if (!$this->sem_cnpj && !$this->com_cnpj) {
            $parametros = new clsParametrosPesquisas();
            $parametros->setSubmit(1);
            $parametros->setPessoa('J');
            $parametros->setPessoaCampo('sem_cnpj');
            $parametros->setPessoaNovo("S");
            $parametros->setPessoaCPF("N");
            $parametros->setPessoaTela('window');
            $this->campoOculto("sem_cnpj", "");
            $parametros->setCodSistema(13);
            $parametros->adicionaCampoTexto("cnpj", "cnpj");
            $this->campoCnpjPesq("cnpj", "CNPJ", $this->cnpj, "pesquisa_pessoa_lst.php", $parametros->serializaCampos(), true);
            $this->acao_enviar = false;
            $this->url_cancelar = false;
            $this->array_botao = array("Continuar", "Cancelar");
            $this->array_botao_url_script = array("obj = document.getElementById('cnpj');if(obj.value != '' ) { acao(); } else { acao(); }", "go('educar_escola_lst.php');");
        } else {
            $this->inputsHelper()->integer('escola_inep_id', array('label' => 'Código INEP', 'placeholder' => 'INEP', 'required' => $obrigarCamposCenso, 'max_length' => 8, 'label_hint' => 'Somente números'));

            if ($_POST) {
                foreach ($_POST as $campo => $val) {
                    if ($campo != 'tipoacao' && $campo != 'sem_cnpj') {
                        $this->$campo = ($this->$campo) ? $this->$campo : $val;
                    }
                }
            }

            if ($this->sem_cnpj) {
                $this->campoOculto("sem_cnpj", $this->sem_cnpj);
                $this->p_ddd_telefone_1 = ($this->p_ddd_telefone_1 == null) ? "" : $this->p_ddd_telefone_1;
                $this->p_ddd_telefone_fax = ($this->p_ddd_telefone_fax == null) ? "" : $this->p_ddd_telefone_fax;

                if ($this->ref_idpes) {
                    $objTemp = new clsPessoaJuridica($this->ref_idpes);
                    $detalhe = $objTemp->detalhe();
                }
                $this->campoOculto("cod_escola", $this->cod_escola);
                $this->campoTexto("fantasia", "Escola", $this->fantasia, 30, 255, true);
                $this->campoTexto("sigla", "Sigla", $this->sigla, 30, 255, true);
                $nivel = $obj_permissoes->nivel_acesso($this->pessoa_logada);

                if ($nivel == 1) {
                    $cabecalhos[] = "Instituicao";
                    $objInstituicao = new clsPmieducarInstituicao();
                    $opcoes = array("" => "Selecione");
                    $objInstituicao->setOrderby("nm_instituicao ASC");
                    $lista = $objInstituicao->lista();

                    if (is_array($lista)) {
                        foreach ($lista as $linha) {
                            $opcoes[$linha["cod_instituicao"]] = $linha["nm_instituicao"];
                        }
                    }

                    $this->campoLista("ref_cod_instituicao", "Instituição", $opcoes, $this->ref_cod_instituicao);
                } else {
                    $this->ref_cod_instituicao = $obj_permissoes->getInstituicao($this->pessoa_logada);

                    if ($this->ref_cod_instituicao) {
                        $this->campoOculto("ref_cod_instituicao", $this->ref_cod_instituicao);
                    } else {
                        die("Usuário não é do nivel poli-institucional e não possui uma instituição");
                    }
                }

                $opcoes = array("" => "Selecione");
                if (class_exists("clsPmieducarEscolaRedeEnsino")) {
                    // EDITAR
                    $script = "javascript:showExpansivelIframe(520, 120, 'educar_escola_rede_ensino_cad_pop.php');";

                    if ($this->ref_cod_instituicao) {
                        $objTemp = new clsPmieducarEscolaRedeEnsino();
                        $lista = $objTemp->lista(null, null, null, null, null, null, null, null, 1, $this->ref_cod_instituicao);

                        if (is_array($lista) && count($lista)) {
                            foreach ($lista as $registro) {
                                $opcoes["{$registro['cod_escola_rede_ensino']}"] = "{$registro['nm_rede']}";
                            }
                        }

                        $script = "<img id='img_rede_ensino' style='display: \'\'' src='imagens/banco_imagens/escreve.gif' style='cursor:hand; cursor:pointer;' border='0' onclick=\"{$script}\">";
                    } else {
                        $script = "<img id='img_rede_ensino' style='display: none;'  src='imagens/banco_imagens/escreve.gif' style='cursor:hand; cursor:pointer;' border='0' onclick=\"{$script}\">";
                    }
                } else {
                    echo "<!--\nErro\nClasse clsPmieducarEscolaRedeEnsino nao encontrada\n-->";
                    $opcoes = array("" => "Erro na geracao");
                }

                $this->campoLista("ref_cod_escola_rede_ensino", "Rede Ensino", $opcoes, $this->ref_cod_escola_rede_ensino, "", false, "", $script);

                $zonas = App_Model_ZonaLocalizacao::getInstance();
                $zonas = [null => 'Selecione'] + $zonas->getEnums();

                $options = array(
                    'label' => 'Zona localização',
                    'value' => $this->zona_localizacao,
                    'resources' => $zonas,
                    'required' => true,
                );

                $this->inputsHelper()->select('zona_localizacao', $options);

                if (is_numeric($this->cep)) {
                    $this->cep = int2CEP($this->cep);
                }

                $this->campoCep("cep", "CEP", $this->cep, true, "-", false, false);
                $this->campoTexto("cidade", "Cidade", $this->cidade, "50", "255", true);
                $this->campoTexto("bairro", "Bairro", $this->bairro, "50", "20", true);
                $this->campoTexto("logradouro", "Logradouro", $this->logradouro, "50", "255", true);
                $this->campoTexto("complemento", "Complemento", $this->complemento, "22", "20", false);
                $this->campoNumero("numero", "Número", $this->numero, "10", "10", true);
                $this->campoTexto("p_ddd_telefone_1", "DDD Telefone 1", $this->p_ddd_telefone_1, "2", "2", false);
                $this->campoTexto("p_telefone_1", "Telefone 1", $this->p_telefone_1, "10", "15", false);
                $this->campoTexto("p_ddd_telefone_fax", "DDD Fax", $this->p_ddd_telefone_fax, "2", "2", false);
                $this->campoTexto("p_telefone_fax", "Fax", $this->p_telefone_fax, "10", "15", false);
                $this->campoTexto("p_email", "E-mail", $this->p_email, "50", "255", false);
            }

            if ($this->com_cnpj) {
                $this->campoOculto("com_cnpj", $this->com_cnpj);

                if (!$this->cod_escola) {
                    $this->cnpj = urldecode($_POST['cnpj']);
                    $this->cnpj = idFederal2int($this->cnpj);
                    $this->cnpj = int2IdFederal($this->cnpj);
                }

                $objJuridica = new clsPessoaJuridica(false, idFederal2int($this->cnpj));
                $det = $objJuridica->detalhe();
                $this->ref_idpes = $det["idpes"];

                if (!$this->fantasia) {
                    $this->fantasia = $det["fantasia"];
                }

                if ($this->passou) {
                    $this->cnpj = (is_numeric($this->cnpj)) ? $this->cnpj : idFederal2int($this->cnpj);
                    $this->cnpj = int2IdFederal($this->cnpj);
                }

                $this->campoRotulo("cnpj_", "CNPJ", $this->cnpj);
                $this->campoOculto("cnpj", idFederal2int($this->cnpj));
                $this->campoOculto("ref_idpes", $this->ref_idpes);
                $this->campoOculto("cod_escola", $this->cod_escola);
                $this->campoTexto("fantasia", "Escola", $this->fantasia, 30, 255, true);
                $this->campoTexto("sigla", "Sigla", $this->sigla, 30, 20, true);
                $nivel = $obj_permissoes->nivel_acesso($this->pessoa_logada);

                if ($nivel == 1) {
                    $cabecalhos[] = "Instituicao";
                    $objInstituicao = new clsPmieducarInstituicao();
                    $opcoes = array("" => "Selecione");
                    $objInstituicao->setOrderby("nm_instituicao ASC");
                    $lista = $objInstituicao->lista();

                    if (is_array($lista)) {
                        foreach ($lista as $linha) {
                            $opcoes[$linha["cod_instituicao"]] = $linha["nm_instituicao"];
                        }
                    }

                    $this->campoLista("ref_cod_instituicao", "Instituicao", $opcoes, $this->ref_cod_instituicao);
                } else {
                    $this->ref_cod_instituicao = $obj_permissoes->getInstituicao($this->pessoa_logada);

                    if ($this->ref_cod_instituicao) {
                        $this->campoOculto("ref_cod_instituicao", $this->ref_cod_instituicao);
                    } else {
                        die("Usuário não é do nivel poli-institucional e não possui uma instituição");
                    }
                }

                $opcoes = array("" => "Selecione");
                if (class_exists("clsPmieducarEscolaRedeEnsino")) {
                    // EDITAR
                    $script = "javascript:showExpansivelIframe(520, 120, 'educar_escola_rede_ensino_cad_pop.php');";
                    if ($this->ref_cod_instituicao) {
                        $objTemp = new clsPmieducarEscolaRedeEnsino();
                        $lista = $objTemp->lista(null, null, null, null, null, null, null, null, 1, $this->ref_cod_instituicao);

                        if (is_array($lista) && count($lista)) {
                            foreach ($lista as $registro) {
                                $opcoes["{$registro['cod_escola_rede_ensino']}"] = "{$registro['nm_rede']}";
                            }
                        }

                        $script = "<img id='img_rede_ensino' style='display:\'\'' src='imagens/banco_imagens/escreve.gif' style='cursor:hand; cursor:pointer;' border='0' onclick=\"{$script}\">";
                    } else {
                        $script = "<img id='img_rede_ensino' style='display: none;'  src='imagens/banco_imagens/escreve.gif' style='cursor:hand; cursor:pointer;' border='0' onclick=\"{$script}\">";
                    }
                } else {
                    echo "<!--\nErro\nClasse clsPmieducarEscolaRedeEnsino nao encontrada\n-->";
                    $opcoes = array("" => "Erro na geracao");
                }

                $this->campoLista("ref_cod_escola_rede_ensino", "Rede Ensino", $opcoes, $this->ref_cod_escola_rede_ensino, "", false, "", $script);
                $opcoes = array("" => "Selecione");

                $zonas = App_Model_ZonaLocalizacao::getInstance();
                $zonas = [null => 'Selecione'] + $zonas->getEnums();

                $options = array(
                    'label' => 'Zona localização',
                    'value' => $this->zona_localizacao,
                    'resources' => $zonas,
                    'required' => true,
                );

                $this->inputsHelper()->select('zona_localizacao', $options);

                // Detalhes do Endereco
                $objUf = new clsUf();
                $listauf = $objUf->lista();
                $listaEstado = array("" => "Selecione");

                if ($listauf) {
                    foreach ($listauf as $uf) {
                        $listaEstado[$uf['sigla_uf']] = $uf['sigla_uf'];
                    }
                }

                $objTipoLog = new clsTipoLogradouro();
                $listaTipoLog = $objTipoLog->lista();
                $listaTLog = array("" => "Selecione");

                if ($listaTipoLog) {
                    foreach ($listaTipoLog as $tipoLog) {
                        $listaTLog[urldecode($tipoLog['idtlog'])] = $tipoLog['descricao'];
                    }
                }

                $this->campoOculto("isEnderecoExterno", $this->isEnderecoExterno);
                $this->campoOculto("cep_", $this->cep_);
                $this->campoOculto("sigla_uf_", $this->sigla_uf_);
                $this->campoOculto("cidade_", $this->cidade_);
                $this->campoOculto("bairro_", $this->bairro_);
                $this->campoOculto("idbai", $this->idbai);
                $this->campoOculto("logradouro_", $this->logradouro_);
                $this->campoOculto("idlog", $this->idlog);
                $this->campoOculto("idtlog_", $this->idtlog_);
                $disabled = $this->isEnderecoExterno ? false : true;

                if ($this->idlog && $this->idbai && $this->cep && $this->ref_idpes) {
                    $this->campoOculto("cep_", $this->cep);
                    $this->cep_ = int2CEP($this->cep);
                    $this->campoCep("cep", "CEP", $this->cep_, true, "-", "<img id='lupa' src=\"imagens/lupa.png\" border=\"0\" onclick=\"showExpansivel(500,500, '<iframe name=\'miolo\' id=\'miolo\' frameborder=\'0\' height=\'100%\' width=\'500\' marginheight=\'0\' marginwidth=\'0\' src=\'educar_pesquisa_cep_log_bairro.php?campo1=bairro&campo2=idbai&campo3=cep_&campo4=logradouro&campo5=idlog&campo6=sigla_uf_&campo7=cidade&campo8=idtlog_&campo9=isEnderecoExterno&campo10=cep&campo11=sigla_uf&campo12=idtlog&campo13=cidade_\'></iframe>');\">", $disabled);
                    $this->campoLista("sigla_uf", "Estado", $listaEstado, $this->sigla_uf, false, false, false, false, true, true);
                    $this->campoTexto("cidade", "Cidade", $this->cidade, "50", "255", true, false, false, "", "", "", "onKeyUp", true);
                    $this->campoTexto("bairro", "Bairro", $this->bairro, "50", "255", true, false, false, "", "", "", "onKeyUp", true);
                    $this->campoLista("idtlog", "Tipo Logradouro", $listaTLog, $this->idtlog, false, false, false, false, true, true);
                    $this->campoTexto("logradouro", "Logradouro", $this->logradouro, "50", "255", true, false, false, "", "", "", "onKeyUp", true);
                    $this->campoTexto("complemento", "Complemento", $this->complemento, "22", "20", false, false);
                    $this->campoNumero("numero", "Número", $this->numero, "10", "10", false);
                    $this->campoNumero("andar", "Andar", $this->andar, "2", "2", false);
                } elseif ($this->ref_idpes && $this->cep) {
                    $this->cep = (is_numeric($this->cep)) ? int2CEP($this->cep) : $this->cep;
                    $this->campoCep("cep", "CEP", $this->cep, true, "-", "<img id='lupa' src=\"imagens/lupa.png\" border=\"0\" onclick=\"showExpansivel(500,500, '<iframe name=\'miolo\' id=\'miolo\' frameborder=\'0\' height=\'100%\' width=\'500\' marginheight=\'0\' marginwidth=\'0\' src=\'educar_pesquisa_cep_log_bairro.php?campo1=bairro&campo2=idbai&campo3=cep_&campo4=logradouro&campo5=idlog&campo6=sigla_uf_&campo7=cidade&campo8=idtlog_&campo9=isEnderecoExterno&campo10=cep&campo11=sigla_uf&campo12=idtlog&campo13=cidade_\'></iframe>');\">");
                    $this->campoLista("sigla_uf", "Estado", $listaEstado, $this->sigla_uf, "", false, "", "", false, true);
                    $this->campoTexto("cidade", "Cidade", $this->cidade, "50", "255", true, false, false, "", "", "", "onKeyUp", false);
                    $this->campoTexto("bairro", "Bairro", $this->bairro, "50", "255", true, false, false, "", "", "", "onKeyUp", false);
                    $this->campoLista("idtlog", "Tipo Logradouro", $listaTLog, $this->idtlog, "", false, "", "", false, true);
                    $this->campoTexto("logradouro", "Logradouro", $this->logradouro, "50", "255", true, false, false, "", "", "", "onKeyUp", false);
                    $this->campoTexto("complemento", "Complemento", $this->complemento, "22", "20", false, false, false, "", "", "", "onKeyUp", false);
                    $this->campoNumero("numero", "Número", $this->numero, 10, 10, false, "", "");
                    $this->campoNumero("andar", "Andar", $this->andar, "2", "2", false);
                } else {
                    if (!$this->isEnderecoExterno) {
                        $obj_bairro = new clsBairro($this->idbai);
                        $this->cep_ = int2CEP($this->cep_);
                        $obj_bairro_det = $obj_bairro->detalhe();

                        if ($obj_bairro_det) {
                            $this->bairro = $obj_bairro_det["nome"];
                        }

                        $obj_log = new clsLogradouro($this->idlog);
                        $obj_log_det = $obj_log->detalhe();

                        if ($obj_log_det) {
                            $this->logradouro = $obj_log_det["nome"];
                            $this->idtlog = $obj_log_det["idtlog"]->idtlog;
                            $obj_mun = new clsMunicipio($obj_log_det["idmun"]);
                            $det_mun = $obj_mun->detalhe();

                            if ($det_mun) {
                                $this->cidade = strtoupper(ucfirst(strtolower($det_mun["nome"])));
                            }

                            $this->sigla_uf = $this->sigla_uf_ = $det_mun['sigla_uf']->sigla_uf;
                        }
                    } else {
                        $this->cep_ = $this->cep;
                    }

                    $this->campoCep("cep", "CEP", $this->cep_, true, "-", "<img id='lupa' src=\"imagens/lupa.png\" border=\"0\" onclick=\"showExpansivel(500,500, '<iframe name=\'miolo\' id=\'miolo\' frameborder=\'0\' height=\'100%\' width=\'500\' marginheight=\'0\' marginwidth=\'0\' src=\'educar_pesquisa_cep_log_bairro.php?campo1=bairro&campo2=idbai&campo3=cep_&campo4=logradouro&campo5=idlog&campo6=sigla_uf_&campo7=cidade&campo8=idtlog_&campo9=isEnderecoExterno&campo10=cep&campo11=sigla_uf&campo12=idtlog&campo13=cidade_\'></iframe>');\">", $disabled);
                    $this->campoLista("sigla_uf", "Estado", $listaEstado, $this->sigla_uf, false, false, false, false, $disabled, true);
                    $this->campoTexto("cidade", "Cidade", $this->cidade, "50", "255", true, false, false, "", "", "", "", $disabled, true);
                    $this->campoTexto("bairro", "Bairro", $this->bairro, "50", "20", true, false, false, "", "", "", "", $disabled, true);
                    $this->campoLista("idtlog", "Tipo Logradouro", $listaTLog, $this->idtlog, false, false, false, false, $disabled, true);
                    $this->campoTexto("logradouro", "Logradouro", $this->logradouro, "50", "255", true, false, false, "", "", "", "", $disabled, true);
                    $this->campoTexto("complemento", "Complemento", $this->complemento, "22", "20", false, false, false);
                    $this->campoNumero("numero", "N&uacute;mero", $this->numero, "10", "10", false);
                    $this->campoNumero("andar", "Andar", $this->andar, "2", "2", false);
                }

                $this->campoTexto("p_http", "Site", $this->p_http, "50", "255", false);
                $this->campoTexto("p_email", "E-mail", $this->p_email, "50", "255", false);
                $this->inputTelefone('1', 'Telefone 1');
                $this->inputTelefone('2', 'Telefone 2');
                $this->inputTelefone('mov', 'Celular');
                $this->inputTelefone('fax', 'Fax');
                $this->passou = true;
                $this->campoOculto("passou", $this->passou);
            }
            $this->inputsHelper()->numeric('latitude', array('max_length' => '20', 'size' => '20', 'required' => false, 'value' => $this->latitude, 'label_hint' => 'São aceito somente os seguintes caracteres: 0123456789 .-'));
            $this->inputsHelper()->numeric('longitude', array('max_length' => '20', 'size' => '20', 'required' => false, 'value' => $this->longitude, 'label_hint' => 'São aceito somente os seguintes caracteres: 0123456789 .-'));
            $this->campoCheck("bloquear_lancamento_diario_anos_letivos_encerrados", "Bloquear lançamento no diário para anos letivos encerrados", $this->bloquear_lancamento_diario_anos_letivos_encerrados);
            $this->campoCheck("utiliza_regra_diferenciada", "Utiliza regra diferenciada", dbBool($this->utiliza_regra_diferenciada), '', false, false, false, 'Se marcado, utilizará regra de avaliação diferenciada informada na Série');

            $resources = SelectOptions::situacoesFuncionamentoEscola();
            $options = array('label' => 'Situação de funcionamento', 'resources' => $resources, 'value' => $this->situacao_funcionamento);
            $this->inputsHelper()->select('situacao_funcionamento', $options);

            $resources = SelectOptions::dependenciasAdministrativasEscola();
            $options = array('label' => 'Dependência administrativa', 'resources' => $resources, 'value' => $this->dependencia_administrativa);
            $this->inputsHelper()->select('dependencia_administrativa', $options);

            $orgaos = OrgaoVinculadoEscola::getDescriptiveValues();
            $helperOptions = ['objectName'  => 'orgao_vinculado_escola'];
            $options = [
                'label' => 'Órgão que a escola pública está vinculada',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->orgao_vinculado_escola,
                    'all_values' => $orgaos
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $resources = [
                null => 'Selecione',
                0 => 'Não',
                1 => 'Sim',
                2 => 'Em tramitação'
            ];
            $options = [
                'label' => 'Regulamentação/Autorização no conselho ou órgão público de educação',
                'resources' => $resources,
                'value' => $this->regulamentacao,
                'size' => 70,
                'required' => false
            ];
            $this->inputsHelper()->select('regulamentacao', $options);

            $options = array('label' => 'Ato de criação', 'value' => $this->ato_criacao, 'size' => 70, 'required' => false);
            $this->inputsHelper()->text('ato_criacao', $options);

            $options = array('label' => 'Ato autorizativo', 'value' => $this->ato_autorizativo, 'size' => 70, 'required' => false);
            $this->inputsHelper()->text('ato_autorizativo', $options);

            $hiddenInputOptions = array('options' => array('value' => $this->gestor_id));
            $helperOptions = array('objectName' => 'gestor', 'hiddenInputOptions' => $hiddenInputOptions);
            $options = array('label' => 'Gestor escolar',
                'required' => $obrigarCamposCenso,
                'size' => 50);
            $this->inputsHelper()->simpleSearchPessoa('nome', $options, $helperOptions);

            $hiddenInputOptions = array('options' => array('value' => $this->secretario_id));
            $helperOptions = array('objectName' => 'secretario', 'hiddenInputOptions' => $hiddenInputOptions);
            $options = array('label' => 'Secretário escolar',
                'size' => 50,
                'required' => false);
            $this->inputsHelper()->simpleSearchPessoa('nome', $options, $helperOptions);

            $resources = array(1 => 'Diretor',
                2 => 'Outro cargo');
            $options = array('label' => 'Cargo do gestor escolar', 'resources' => $resources, 'value' => $this->cargo_gestor, 'required' => $obrigarCamposCenso, 'size' => 50);
            $this->inputsHelper()->select('cargo_gestor', $options);

            $options = array('label' => 'E-mail do gestor escolar', 'value' => $this->email_gestor, 'required' => $obrigarCamposCenso, 'size' => 50);

            $this->inputsHelper()->text('email_gestor', $options);

            $resources = SelectOptions::esferasAdministrativasEscola();
            $options = [
                'label' => 'Esfera administrativa do conselho ou órgão responsável pela Regulamentação/Autorização',
                'resources' => $resources,
                'value' => $this->esfera_administrativa,
                'required' => false,
            ];
            $this->inputsHelper()->select('esfera_administrativa', $options);

            if ($_POST["escola_curso"]) {
                $this->escola_curso = unserialize(urldecode($_POST["escola_curso"]));
            }

            if ($_POST["escola_curso_autorizacao"]) {
                $this->escola_curso_autorizacao = unserialize(urldecode($_POST["escola_curso_autorizacao"]));
            }

            if ($_POST["escola_curso_anos_letivos"]) {
                $this->escola_curso_anos_letivos = unserialize(urldecode($_POST["escola_curso_anos_letivos"]));
            }

            if (is_numeric($this->cod_escola) && !$_POST) {
                $obj = new clsPmieducarEscolaCurso($this->cod_escola);
                $registros = $obj->lista($this->cod_escola);
                if ($registros) {
                    foreach ($registros as $campo) {
                        $this->escola_curso[$campo["ref_cod_curso"]] = $campo["ref_cod_curso"];
                        $this->escola_curso_autorizacao[$campo["ref_cod_curso"]] = $campo["autorizacao"];
                        $this->escola_curso_anos_letivos[$campo["ref_cod_curso"]] = json_decode($campo["anos_letivos"]);
                    }
                }
            }

            if ($_POST["ref_cod_curso"]) {
                $this->escola_curso[$_POST["ref_cod_curso"]] = $_POST["ref_cod_curso"];

                if ($this->autorizacao) {
                    $this->escola_curso_autorizacao[$_POST["ref_cod_curso"]] = $this->autorizacao;
                }

                if ($this->adicionar_anos_letivos) {
                    $this->escola_curso_anos_letivos[$_POST["ref_cod_curso"]] = $this->adicionar_anos_letivos;
                }

                unset($this->ref_cod_curso);
            }

            $this->campoQuebra();
            $this->campoOculto("excluir_curso", "");
            unset($aux);

            if ($this->escola_curso) {
                foreach ($this->escola_curso as $curso) {
                    if ($this->excluir_curso == $curso) {
                        unset($this->escola_curso[$curso]);
                        $this->escola_curso_autorizacao[$curso] = null;
                        $this->excluir_curso = null;
                    } else {
                        $obj_curso = new clsPmieducarCurso($curso);
                        $obj_curso_det = $obj_curso->detalhe();
                        $nm_curso = $obj_curso_det["nm_curso"];
                        $nm_autorizacao = $this->escola_curso_autorizacao[$curso];
                        $anosLetivos = $this->escola_curso_anos_letivos[$curso] ?: [];
                        $this->campoTextoInv("ref_cod_curso_{$curso}", "", $nm_curso, 50, 255, false, false, true);
                        $this->campoTextoInv("autorizacao_{$curso}", "", $nm_autorizacao, 20, 255);
                        $this->campoTextoInv("anos_letivos_{$curso}", "", 'Anos: '.implode(',', $anosLetivos), 20, 255, false, false, false, "", "<a href='#' onclick=\"getElementById('excluir_curso').value = '{$curso}'; getElementById('tipoacao').value = ''; {$this->__nome}.submit();\"><img src='imagens/nvp_bola_xis.gif' title='Excluir' border=0></a>");
                        $aux[$curso] = $curso;
                        $aux_autorizacao[$curso] = $nm_autorizacao;
                        $auxAnosLetivos[$curso] = $anosLetivos;
                    }
                }

                unset($this->escola_curso);
                $this->escola_curso = $aux;
                $this->escola_curso_autorizacao = $aux_autorizacao;
                $this->escola_curso_anos_letivos = $auxAnosLetivos;
            }

            $this->campoOculto("escola_curso", serialize($this->escola_curso));
            $this->campoOculto("escola_curso_autorizacao", serialize($this->escola_curso_autorizacao));
            $this->campoOculto("escola_curso_anos_letivos", serialize($this->escola_curso_anos_letivos));
            $opcoes = array("" => "Selecione");

            if (class_exists("clsPmieducarCurso")) {
                // EDITAR
                if ($this->cod_escola || $this->ref_cod_instituicao) {
                    $objTemp = new clsPmieducarCurso();
                    $objTemp->setOrderby("nm_curso");
                    $lista = $objTemp->lista(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 1, null, $this->ref_cod_instituicao);

                    if (is_array($lista) && count($lista)) {
                        foreach ($lista as $registro) {
                            $opcoes["{$registro['cod_curso']}"] = "{$registro['nm_curso']}";
                        }
                    }
                }
            } else {
                echo "<!--\nErro\nClasse clsPmieducarCurso não encontrada\n-->";
                $opcoes = array("" => "Erro na geração");
            }

            if ($aux) {
                $this->campoLista("ref_cod_curso", "Curso", $opcoes, $this->ref_cod_curso, "", false, "", "<a href='#' onclick=\"getElementById('incluir_curso').value = 'S'; getElementById('tipoacao').value = ''; {$this->__nome}.submit();\"><img src='imagens/nvp_bot_adiciona.gif' title='Incluir' border=0></a>", false, false);
            } else {
                $this->campoLista("ref_cod_curso", "Curso", $opcoes, $this->ref_cod_curso, "", false, "", "<a href='#' onclick=\"getElementById('incluir_curso').value = 'S'; getElementById('tipoacao').value = ''; {$this->__nome}.submit();\"><img src='imagens/nvp_bot_adiciona.gif' title='Incluir' border=0></a>");
            }

            $this->campoTexto("autorizacao", "Autorização", "", 30, 255, false);

            $helperOptions = [
                'objectName' => 'adicionar_anos_letivos'
            ];

            $options = [
                'label' => 'Anos letivos',
                'required' => FALSE,
                'size' => 50,
                'value' => '',
                'options' => [
                    'all_values' => $this->sugestaoAnosLetivos()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $this->campoOculto("incluir_curso", "");
            $this->campoQuebra();

            $helperOptions = array('objectName' => 'local_funcionamento');
            $options = [
                'label' => 'Local de funcionamento',
                'options' => [
                    'values' => $this->local_funcionamento,
                    'all_values' => SelectOptions::locaisFuncionamentoEscola(),
                ],
                'size' => 70,
                'required' => $obrigarCamposCenso
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            // Os campos: Forma de ocupação do prédio e Código da escola que compartilha o prédio
            // serão desabilitados quando local de funcionamento for diferente de 3 (Prédio escolar)
            $disabled = !in_array(LocalFuncionamento::PREDIO_ESCOLAR, $this->local_funcionamento);
            $resources = array(NULL => 'Selecione',
                1 => 'Próprio',
                2 => 'Alugado',
                3 => 'Cedido');
            $options = array('disabled' => $disabled, 'label' => 'Forma de ocupação do prédio', 'resources' => $resources, 'value' => $this->condicao, 'size' => 70, 'required' => false);
            $this->inputsHelper()->select('condicao', $options);

            $resources = [
                null => 'Selecione',
                0 => 'Não',
                1 => 'Sim',
            ];
            $options = [
                'disabled' => $disabled,
                'label' => 'Prédio compartilhado com outra escola',
                'resources' => $resources,
                'value' => $this->predio_compartilhado_outra_escola,
                'size' => 70,
                'required' => false
            ];
            $this->inputsHelper()->select('predio_compartilhado_outra_escola', $options);

            $this->geraCamposCodigoInepEscolaCompartilhada();

            $resources = array(null => 'Selecione',
                1 => 'Difícil',
                2 => 'Dificílimo');
            $options = array('label' => 'Acesso à escola', 'resources' => $resources, 'value' => $this->acesso, 'required' => false, 'size' => 50);
            $this->inputsHelper()->select('acesso', $options);

            $options = array('label' => 'Decreto de criação de unidade', 'resources' => $resources, 'value' => $this->decreto_criacao, 'required' => false, 'size' => 50);
            $this->inputsHelper()->text('decreto_criacao', $options);

            $options = array('label' => 'Área do terreno total', 'resources' => $resources, 'value' => $this->area_terreno_total, 'required' => false, 'size' => 10, 'placeholder' => '');
            $this->inputsHelper()->text('area_terreno_total', $options);

            $options = array('label' => 'Área construída', 'resources' => $resources, 'value' => $this->area_construida, 'required' => false, 'size' => 10, 'placeholder' => '');
            $this->inputsHelper()->text('area_construida', $options);

            $options = array('label' => 'Área disponível', 'resources' => $resources, 'value' => $this->area_disponivel, 'required' => false, 'size' => 10, 'placeholder' => '');
            $this->inputsHelper()->text('area_disponivel', $options);

            $options = array('label' => 'Número de pavimentos', 'resources' => $resources, 'value' => $this->num_pavimentos, 'required' => false, 'size' => 5, 'placeholder' => '');
            $this->inputsHelper()->integer('num_pavimentos', $options);

            $resources = array(null => 'Selecione',
                1 => 'Cerâmica',
                2 => 'Acimentado',
                3 => 'Madeira',
                4 => 'Outros');
            $options = array('label' => 'Tipo de piso', 'resources' => $resources, 'value' => $this->tipo_piso, 'required' => false, 'size' => 70);
            $this->inputsHelper()->select('tipo_piso', $options);

            $resources = array(null => 'Selecione',
                1 => 'Monofásico',
                2 => 'Bifásico',
                3 => 'Trifásico',
                4 => 'Não');

            $options = array('label' => 'Medidor de energia', 'resources' => $resources, 'value' => $this->medidor_energia, 'required' => false, 'size' => 70);
            $this->inputsHelper()->select('medidor_energia', $options);

            $resources = array(null => 'Selecione',
                1 => 'Não filtrada',
                2 => 'Filtrada');
            $options = array('label' => 'Água consumida pelos alunos', 'resources' => $resources, 'value' => $this->agua_consumida, 'required' => $obrigarCamposCenso, 'size' => 70);
            $this->inputsHelper()->select('agua_consumida', $options);

            $resources = [
                null => 'Selecione',
                0 => 'Não',
                1 => 'Sim'
            ];
            $options = [
                'label' => 'Fornecimento de água potável para consumo',
                'resources' => $resources,
                'value' => $this->agua_potavel_consumo,
                'required' => $obrigarCamposCenso,
                'size' => 70
            ];
            $this->inputsHelper()->select('agua_potavel_consumo', $options);

            $helperOptions = array('objectName' => 'abastecimento_agua');
            $options = array('label' => 'Abastecimento de água',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => array('values' => $this->abastecimento_agua,
                    'all_values' => array(1 => 'Rede pública',
                        2 => 'Poço artesiano',
                        3 => 'Cacimba/cisterna/poço',
                        4 => 'Fonte/rio/igarapé/riacho/córrego',
                        5 => 'Não há abastecimento de água')));
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = array('objectName' => 'abastecimento_energia');
            $options = array('label' => 'Fonte de energia elétrica',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => array('values' => $this->abastecimento_energia,
                    'all_values' => array(1 => 'Rede pública',
                        2 => 'Gerador movido a combustível fóssil',
                        3 => 'Fontes de energia renováveis ou alternativas (gerador a biocombustível e/ou biodigestores, eólica, solar, outras)',
                        4 => 'Não há energia elétrica')));
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = array('objectName' => 'esgoto_sanitario');
            $options = array('label' => 'Esgotamento sanitário',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => array('values' => $this->esgoto_sanitario,
                    'all_values' => array(1 => 'Rede pública',
                        2 => 'Fossa séptica',
                        4 => 'Fossa rudimentar/comum',
                        3 => 'Não há esgotamento sanitário')));
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = array('objectName' => 'destinacao_lixo');
            $options = array('label' => 'Destinação do lixo',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => array('values' => $this->destinacao_lixo,
                    'all_values' => array(1 => 'Serviço de coleta',
                        2 => 'Queima',
                        7 => 'Enterra',
                        5 => 'Leva a uma destinação final licenciada pelo poder público',
                        3 => 'Descarta em outra área',)));
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'tratamento_lixo'];
            $options = [
                'label' => 'Tratamento do lixo/resíduos que a escola realiza',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => [
                    'values' => $this->tratamento_lixo,
                    'all_values' => TratamentoLixo::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $resources = [
                null => 'Selecione',
                0 => 'Não',
                1 => 'Sim'
            ];
            $options = [
                'label' => 'Possui dependências',
                'label_hint' => 'Se preenchido com: Não, nenhuma dependência será exportada para o Censo escolar',
                'resources' => $resources,
                'value' => $this->possui_dependencias,
                'required' => $obrigarCamposCenso,
                'size' => 40
            ];
            $this->inputsHelper()->select('possui_dependencias', $options);

            $helperOptions = ['objectName' => 'salas_gerais'];
            $options = [
                'label' => 'Salas gerais',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->salas_gerais,
                    'all_values' => SalasGerais::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'salas_funcionais'];
            $options = [
                'label' => 'Salas Funcionais',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->salas_funcionais,
                    'all_values' => SalasFuncionais::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'banheiros'];
            $options = [
                'label' => 'Banheiros',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->banheiros,
                    'all_values' => Banheiros::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'laboratorios'];
            $options = [
                'label' => 'Laboratorios',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->laboratorios,
                    'all_values' => Laboratorios::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'salas_atividades'];
            $options = [
                'label' => 'Salas de atividades',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->salas_atividades,
                    'all_values' => SalasAtividades::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'dormitorios'];
            $options = [
                'label' => 'Dormitórios',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->dormitorios,
                    'all_values' => Dormitorios::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'areas_externas'];
            $options = [
                'label' => 'Áreas Externas',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->areas_externas,
                    'all_values' => AreasExternas::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $helperOptions = ['objectName' => 'recursos_acessibilidade'];
            $options = [
                'label' => 'Recursos de acessibilidade',
                'size' => 50,
                'required' => $obrigarCamposCenso,
                'options' => [
                    'values' => $this->recursos_acessibilidade,
                    'all_values' => RecursosAcessibilidade::getDescriptiveValues()
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $options = array('label' => 'Número de salas de aula existentes na escola', 'resources' => $resources, 'value' => $this->dependencia_numero_salas_existente, 'required' => false, 'size' => 5, 'placeholder' => '', 'max_length' => 4);
            $this->inputsHelper()->integer('dependencia_numero_salas_existente', $options);

            $options = array('label' => 'Número de salas utilizadas como sala de aula - Dentro e fora do prédio', 'resources' => $resources, 'value' => $this->dependencia_numero_salas_utilizadas, 'required' => $obrigarCamposCenso, 'size' => 5, 'placeholder' => '');
            $this->inputsHelper()->integer('dependencia_numero_salas_utilizadas', $options);

            $options = array('label' => 'Quantidade de televisores', 'resources' => $resources, 'value' => $this->televisoes, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('televisoes', $options);

            $options = array('label' => 'Quantidade de videocassetes', 'resources' => $resources, 'value' => $this->videocassetes, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('videocassetes', $options);

            $options = array('label' => 'Quantidade de DVDs', 'resources' => $resources, 'value' => $this->dvds, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('dvds', $options);

            $options = array('label' => 'Quantidade de antenas parabólicas', 'resources' => $resources, 'value' => $this->antenas_parabolicas, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('antenas_parabolicas', $options);

            $options = array('label' => 'Quantidade de copiadoras', 'resources' => $resources, 'value' => $this->copiadoras, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('copiadoras', $options);

            $options = array('label' => 'Quantidade de retroprojetores', 'resources' => $resources, 'value' => $this->retroprojetores, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('retroprojetores', $options);

            $options = array('label' => 'Quantidade de impressoras', 'resources' => $resources, 'value' => $this->impressoras, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('impressoras', $options);

            $options = array('label' => 'Quantidade de aparelhos de som', 'resources' => $resources, 'value' => $this->aparelhos_de_som, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('aparelhos_de_som', $options);

            $options = array('label' => 'Quantidade de data show', 'resources' => $resources, 'value' => $this->projetores_digitais, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('projetores_digitais', $options);

            $options = array('label' => 'Quantidade de FAXs', 'resources' => $resources, 'value' => $this->faxs, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('faxs', $options);

            $options = array('label' => 'Quantidade de máquinas fotográficas ou filmadoras', 'resources' => $resources, 'value' => $this->maquinas_fotograficas, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('maquinas_fotograficas', $options);

            $options = array('label' => 'Quantidade de impressoras multifuncionais', 'resources' => $resources, 'value' => $this->impressoras_multifuncionais, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('impressoras_multifuncionais', $options);

            $options = array('label' => 'Quantidade de computadores de uso administrativo', 'resources' => $resources, 'value' => $this->computadores_administrativo, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('computadores_administrativo', $options);

            $options = array('label' => 'Quantidade de computadores de uso dos alunos', 'resources' => $resources, 'value' => $this->computadores_alunos, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('computadores_alunos', $options);

            $options = array('label' => 'Quantidade total de computadores', 'resources' => $resources, 'value' => $this->computadores, 'required' => false, 'size' => 4, 'max_length' => 4, 'placeholder' => '');
            $this->inputsHelper()->integer('computadores', $options);

            $disabled = $this->computadores > 0;
            $options = array(
                'label' => 'Possui internet banda larga',
                'value' => $this->acesso_internet,
                'required' => false,
                'prompt' => 'Selecione',
                'disabled' => !$disabled
            );
            $this->inputsHelper()->booleanSelect('acesso_internet', $options);

            $options = array('label' => 'Total de funcionários da escola (inclusive profissionais escolares em sala de aula)', 'resources' => $resources, 'value' => $this->total_funcionario, 'required' => $obrigarCamposCenso, 'size' => 5, 'placeholder' => '');
            $this->inputsHelper()->integer('total_funcionario', $options);

            $resources = array(NULL => 'Selecione',
                0 => 'Não oferece',
                1 => 'Não exclusivamente',
                2 => 'Exclusivamente');
            $options = array('label' => 'Atendimento educacional especializado - AEE', 'resources' => $resources, 'value' => $this->atendimento_aee, 'required' => $obrigarCamposCenso, 'size' => 70);
            $this->inputsHelper()->select('atendimento_aee', $options);

            $resources = array(NULL => 'Selecione',
                0 => 'Não oferece',
                1 => 'Não exclusivamente',
                2 => 'Exclusivamente');
            $options = array('label' => 'Atividade complementar', 'resources' => $resources, 'value' => $this->atividade_complementar, 'required' => $obrigarCamposCenso, 'size' => 70);
            $this->inputsHelper()->select('atividade_complementar', $options);

            $habilitaFundamentalCiclo = false;
            if ($this->cod_escola) {
                $objEscola = new clsPmieducarEscola($this->cod_escola);
                $habilitaFundamentalCiclo = dbBool($objEscola->possuiTurmasDoEnsinoFundamentalEmCiclos());
            }

            $options = array(
                'label' => 'Ensino fundamental organizado em ciclos',
                'placeholder' => 'Selecione',
                'prompt' => 'Selecione',
                'value' => $this->fundamental_ciclo,
                'required' => $habilitaFundamentalCiclo,
                'disabled' => !$habilitaFundamentalCiclo
            );
            $this->inputsHelper()->booleanSelect('fundamental_ciclo', $options);

            $resources = SelectOptions::localizacoesDiferenciadasEscola();
            $options = array('label' => 'Localização diferenciada da escola', 'resources' => $resources, 'value' => $this->localizacao_diferenciada, 'required' => $obrigarCamposCenso, 'size' => 70);
            $this->inputsHelper()->select('localizacao_diferenciada', $options);

            $resources = array(NULL => 'Selecione',
                1 => 'Não utiliza',
                2 => 'Quilombola',
                3 => 'Indígena');
            $options = array('label' => 'Materiais didáticos específicos para atendimento à diversidade sócio-cultural',
                'resources' => $resources,
                'value' => $this->materiais_didaticos_especificos,
                'required' => $obrigarCamposCenso,
                'size' => 70);
            $this->inputsHelper()->select('materiais_didaticos_especificos', $options);

            $options = array('label' => 'Escola indígena',
                'value' => $this->educacao_indigena,
                'required' => false);
            $this->inputsHelper()->booleanSelect('educacao_indigena', $options);

            $resources = array(1 => 'Língua Portuguesa',
                2 => 'Língua Indígena');
            $habilitaLiguaMinistrada = $this->educacao_indigena == 1;
            $options = array('label' => 'Língua em que o ensino é ministrado',
                'resources' => $resources,
                'value' => $this->lingua_ministrada,
                'required' => $habilitaLiguaMinistrada,
                'disabled' => !$habilitaLiguaMinistrada,
                'size' => 70);
            $this->inputsHelper()->select('lingua_ministrada', $options);

            $habilitaLiguasIndigenas = $this->lingua_ministrada == 2;
            $resources_ = Portabilis_Utils_Database::fetchPreparedQuery('SELECT * FROM modules.lingua_indigena_educacenso');

            foreach ($resources_ as $reg) {
                $resources[$reg['id']] = $reg['lingua'];
            }

            $options = array('label' => Portabilis_String_Utils::toLatin1('Línguas indígenas'),
                'resources' => $resources,
                'value' => $this->codigo_lingua_indigena,
                'required' => $habilitaLiguasIndigenas && $habilitaLiguaMinistrada,
                'disabled' => !$habilitaLiguasIndigenas || !$habilitaLiguaMinistrada,
                'size' => 70);
            $this->inputsHelper()->select('codigo_lingua_indigena', $options);

            $options = array('label' => 'Escola cede espaço para turmas do Brasil Alfabetizado',
                'prompt' => 'Selecione',
                'value' => $this->espaco_brasil_aprendizado,
                'required' => $obrigarCamposCenso);
            $this->inputsHelper()->booleanSelect('espaco_brasil_aprendizado', $options);

            $options = array('label' => 'Escola abre aos finais de semana para a comunidade',
                'prompt' => 'Selecione',
                'value' => $this->abre_final_semana,
                'required' => $obrigarCamposCenso);
            $this->inputsHelper()->booleanSelect('abre_final_semana', $options);

            $options = array('label' => 'Escola com proposta pedagógica de formação por alternância',
                'prompt' => 'Selecione',
                'value' => $this->proposta_pedagogica,
                'required' => $obrigarCamposCenso);
            $this->inputsHelper()->booleanSelect('proposta_pedagogica', $options);
            
            $resources = SelectOptions::unidadesVinculadasEscola();
            $options = [
                'label' => 'Unidade vinculada à Escola de Educação Básica ou Unidade Ofertante de Educação Superior',
                'resources' => $resources,
                'value' => $this->unidade_vinculada_outra_instituicao,
                'size' => 70
            ];
            $this->inputsHelper()->select('unidade_vinculada_outra_instituicao', $options);

            $this->campoTexto("inep_escola_sede", "Código da escola sede", $this->inep_escola_sede, 10, 8, false);

            $options = [
                'label' => 'Código da IES',
                'required' => false
            ];
            $helperOptions = [
                'objectName' => 'codigo_ies',
                'hiddenInputOptions' => [
                    'options' => ['value' => $this->codigo_ies]
                ]
            ];
            $this->inputsHelper()->simpleSearchIes(null, $options, $helperOptions);

            $mantenedoras = MantenedoraDaEscolaPrivada::getDescriptiveValues();
            $helperOptions = ['objectName' => 'mantenedora_escola_privada'];
            $options = [
                'label' => 'Mantenedora da escola privada',
                'size' => 50,
                'required' => false,
                'options' => [
                    'values' => $this->mantenedora_escola_privada,
                    'all_values' => $mantenedoras
                ]
            ];
            $this->inputsHelper()->multipleSearchCustom('', $options, $helperOptions);

            $resources = array('' => 'Selecione',
                1 => 'Particular',
                2 => 'Comunitária',
                3 => 'Confessional',
                4 => 'Filantrópica');
            $options = array('label' => 'Categoria da escola privada',
                'resources' => $resources,
                'value' => $this->categoria_escola_privada,
                'required' => false,
                'size' => 70);
            $this->inputsHelper()->select('categoria_escola_privada', $options);

            $resources = array('' => 'Selecione',
                1 => 'Estadual',
                2 => 'Municipal',
                3 => 'Estadual e Municipal');
            $options = array('label' => 'Conveniada com poder público',
                'resources' => $resources,
                'value' => $this->conveniada_com_poder_publico,
                'required' => false,
                'size' => 70);
            $this->inputsHelper()->select('conveniada_com_poder_publico', $options);

            $this->campoCnpj("cnpj_mantenedora_principal", "CNPJ da mantenedora principal da escola privada", $this->cnpj_mantenedora_principal);
        }
    }

    public function Novo()
    {
        $obj_permissoes = new clsPermissoes();
        $obj_permissoes->permissao_cadastra(561, $this->pessoa_logada, 3, "educar_escola_lst.php");
        $orgao_vinculado_escola = implode(',', $this->orgao_vinculado_escola);
        $mantenedora_escola_privada = implode(',', $this->mantenedora_escola_privada);
        $local_funcionamento = implode(',', $this->local_funcionamento);
        $abastecimento_agua = implode(',', $this->abastecimento_agua);
        $abastecimento_energia = implode(',', $this->abastecimento_energia);
        $esgoto_sanitario = implode(',', $this->esgoto_sanitario);
        $destinacao_lixo = implode(',', $this->destinacao_lixo);
        $tratamento_lixo = implode(',', $this->tratamento_lixo);
        $salas_funcionais = implode(',', $this->salas_funcionais);
        $salas_gerais = implode(',', $this->salas_gerais);
        $banheiros = implode(',', $this->banheiros);
        $laboratorios = implode(',', $this->laboratorios);
        $salas_atividades = implode(',', $this->salas_atividades);
        $dormitorios = implode(',', $this->dormitorios);
        $areas_externas = implode(',', $this->areas_externas);
        $recursos_acessibilidade = implode(',', $this->recursos_acessibilidade);

        if (!$this->validaDigitosInepEscola($this->escola_inep_id, 'Código INEP')) {
            return false;
        }

        if (!$this->validaLatitudeLongitude()) {
            return false;
        }

        if (!$this->validaDadosTelefones()) {
            return false;
        }

        if (!$this->validaCamposCenso()) {
            return false;
        }

        for ( $i = 1; $i <= 6; $i++) {
            $seq = $i == 1 ? '' : $i;
            $campo = 'codigo_inep_escola_compartilhada'.$seq;
            $ret = $this->validaDigitosInepEscola($this->$campo, 'Código da escola que compartilha o prédio '.$i);
            if (!$ret) {
                return false;
            }
        }

        if (in_array(5, $this->abastecimento_agua) && count($this->abastecimento_agua) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Abastecimento de água</b>, quando a opção: <b>Não há abastecimento de água</b> estiver selecionada.';
            return false;
        }

        if (in_array(4, $this->abastecimento_energia) && count($this->abastecimento_energia) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Fonte de energia elétrica</b>, quando a opção: <b>Não há energia elétrica</b> estiver selecionada.';
            return false;
        }

        if (in_array(3, $this->esgoto_sanitario) && count($this->esgoto_sanitario) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Esgotamento sanitário</b>, quando a opção: <b>Não há esgotamento sanitário</b> estiver selecionada.';
            return false;
        }

        if (in_array(TratamentoLixo::NAO_FAZ, $this->tratamento_lixo) && count($this->tratamento_lixo) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Tratamento do lixo/resíduos que a escola realiza</b>, quando a opção: <b>Não faz tratamento</b> estiver selecionada';
            return false;
        }

        if (in_array(RecursosAcessibilidade::NENHUM, $this->recursos_acessibilidade) && count($this->recursos_acessibilidade) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Recursos de acessibilidade</b>, quando a opção: <b>Nenhum dos recursos de acessibilidade</b> estiver selecionada.';
            return false;
        }

        $this->bloquear_lancamento_diario_anos_letivos_encerrados = is_null($this->bloquear_lancamento_diario_anos_letivos_encerrados) ? 0 : 1;
        $this->utiliza_regra_diferenciada = !is_null($this->utiliza_regra_diferenciada);

        if ($this->com_cnpj) {
            $objPessoa = new clsPessoa_(false, $this->fantasia, $this->pessoa_logada, $this->p_http, "J", false, false, $this->p_email);
            $this->ref_idpes = $objPessoa->cadastra();

            if ($this->ref_idpes) {
                $obj_pes_juridica = new clsJuridica($this->ref_idpes, $this->cnpj, $this->fantasia, false, false, $this->pessoa_logada);
                $cadastrou = $obj_pes_juridica->cadastra();

                if ($cadastrou) {
                    $obj = new clsPmieducarEscola(null, $this->pessoa_logada, null, $this->ref_cod_instituicao, $this->zona_localizacao, $this->ref_cod_escola_rede_ensino, $this->ref_idpes, $this->sigla, null, null, 1, null, $this->bloquear_lancamento_diario_anos_letivos_encerrados);
                    $obj->situacao_funcionamento = $this->situacao_funcionamento;
                    $obj->dependencia_administrativa = $this->dependencia_administrativa;
                    $obj->orgao_vinculado_escola = $orgao_vinculado_escola;
                    $obj->latitude = $this->latitude;
                    $obj->longitude = $this->longitude;
                    $obj->regulamentacao = $this->regulamentacao;
                    $obj->acesso = $this->acesso;
                    $obj->ref_idpes_gestor = $this->gestor_id;
                    $obj->cargo_gestor = $this->cargo_gestor;
                    $obj->email_gestor = $this->email_gestor;
                    $obj->local_funcionamento = $local_funcionamento;
                    $obj->condicao = $this->condicao;
                    $obj->predio_compartilhado_outra_escola = $this->predio_compartilhado_outra_escola;
                    $obj->codigo_inep_escola_compartilhada = $this->codigo_inep_escola_compartilhada;
                    $obj->codigo_inep_escola_compartilhada2 = $this->codigo_inep_escola_compartilhada2;
                    $obj->codigo_inep_escola_compartilhada3 = $this->codigo_inep_escola_compartilhada3;
                    $obj->codigo_inep_escola_compartilhada4 = $this->codigo_inep_escola_compartilhada4;
                    $obj->codigo_inep_escola_compartilhada5 = $this->codigo_inep_escola_compartilhada5;
                    $obj->codigo_inep_escola_compartilhada6 = $this->codigo_inep_escola_compartilhada6;
                    $obj->decreto_criacao = $this->decreto_criacao;
                    $obj->area_terreno_total = $this->area_terreno_total;
                    $obj->area_construida = $this->area_construida;
                    $obj->area_disponivel = $this->area_disponivel;
                    $obj->num_pavimentos = $this->num_pavimentos;
                    $obj->tipo_piso = $this->tipo_piso;
                    $obj->medidor_energia = $this->medidor_energia;
                    $obj->agua_consumida = $this->agua_consumida;
                    $obj->agua_potavel_consumo = $this->agua_potavel_consumo;
                    $obj->abastecimento_agua = $abastecimento_agua;
                    $obj->abastecimento_energia = $abastecimento_energia;
                    $obj->esgoto_sanitario = $esgoto_sanitario;
                    $obj->destinacao_lixo = $destinacao_lixo;
                    $obj->tratamento_lixo = $tratamento_lixo;
                    $obj->salas_funcionais = $salas_funcionais;
                    $obj->salas_gerais = $salas_gerais;
                    $obj->banheiros = $banheiros;
                    $obj->laboratorios = $laboratorios;
                    $obj->salas_atividades = $salas_atividades;
                    $obj->dormitorios = $dormitorios;
                    $obj->areas_externas = $areas_externas;
                    $obj->recursos_acessibilidade = $recursos_acessibilidade;
                    $obj->dependencia_numero_salas_utilizadas = $this->dependencia_numero_salas_utilizadas;
                    $obj->dependencia_numero_salas_existente = $this->dependencia_numero_salas_existente;
                    $obj->total_funcionario = $this->total_funcionario;
                    $obj->atendimento_aee = $this->atendimento_aee;
                    $obj->atividade_complementar = $this->atividade_complementar;
                    $obj->fundamental_ciclo = $this->fundamental_ciclo;
                    $obj->localizacao_diferenciada = $this->localizacao_diferenciada;
                    $obj->materiais_didaticos_especificos = $this->materiais_didaticos_especificos;
                    $obj->educacao_indigena = $this->educacao_indigena;
                    $obj->lingua_ministrada = $this->lingua_ministrada;
                    $obj->espaco_brasil_aprendizado = $this->espaco_brasil_aprendizado;
                    $obj->abre_final_semana = $this->abre_final_semana;
                    $obj->codigo_lingua_indigena = $this->codigo_lingua_indigena;
                    $obj->proposta_pedagogica = $this->proposta_pedagogica;
                    $obj->televisoes = $this->televisoes;
                    $obj->videocassetes = $this->videocassetes;
                    $obj->dvds = $this->dvds;
                    $obj->antenas_parabolicas = $this->antenas_parabolicas;
                    $obj->copiadoras = $this->copiadoras;
                    $obj->retroprojetores = $this->retroprojetores;
                    $obj->impressoras = $this->impressoras;
                    $obj->aparelhos_de_som = $this->aparelhos_de_som;
                    $obj->projetores_digitais = $this->projetores_digitais;
                    $obj->faxs = $this->faxs;
                    $obj->maquinas_fotograficas = $this->maquinas_fotograficas;
                    $obj->computadores = $this->computadores;
                    $obj->computadores_administrativo = $this->computadores_administrativo;
                    $obj->computadores_alunos = $this->computadores_alunos;
                    $obj->impressoras_multifuncionais = $this->impressoras_multifuncionais;
                    $obj->acesso_internet = $this->acesso_internet;
                    $obj->ato_criacao = $this->ato_criacao;
                    $obj->ato_autorizativo = $this->ato_autorizativo;
                    $obj->ref_idpes_secretario_escolar = $this->secretario_id;
                    $obj->unidade_vinculada_outra_instituicao = $this->unidade_vinculada_outra_instituicao;
                    $obj->inep_escola_sede = $this->inep_escola_sede;
                    $obj->codigo_ies = $this->codigo_ies_id;
                    $obj->categoria_escola_privada = $this->categoria_escola_privada;
                    $obj->conveniada_com_poder_publico = $this->conveniada_com_poder_publico;
                    $obj->mantenedora_escola_privada = $mantenedora_escola_privada;
                    $obj->cnpj_mantenedora_principal = idFederal2int($this->cnpj_mantenedora_principal);
                    $obj->esfera_administrativa = $this->esfera_administrativa;

                    $cod_escola = $cadastrou1 = $obj->cadastra();

                    if ($cadastrou1) {
                        $escola = new clsPmieducarEscola($cod_escola);
                        $escola = $escola->detalhe();
                        $auditoria = new clsModulesAuditoriaGeral("escola", $this->pessoa_logada, $cod_escola);
                        $auditoria->inclusao($escola);

                        $objTelefone = new clsPessoaTelefone($this->ref_idpes);
                        $objTelefone->excluiTodos();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 1, str_replace("-", "", $this->p_telefone_1), $this->p_ddd_telefone_1);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 2, str_replace("-", "", $this->p_telefone_2), $this->p_ddd_telefone_2);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 3, str_replace("-", "", $this->p_telefone_mov), $this->p_ddd_telefone_mov);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 4, str_replace("-", "", $this->p_telefone_fax), $this->p_ddd_telefone_fax);
                        $objTelefone->cadastra();

                        if (!$this->isEnderecoExterno) {
                            $this->cep = $this->cep_;
                            $objEndereco = new clsPessoaEndereco($this->ref_idpes, $this->cep, $this->idlog, $this->idbai, $this->numero, $this->complemento, false);

                            if ($objEndereco->detalhe()) {
                                $objEndereco->edita();
                            } else {
                                $objEndereco->cadastra();
                            }

                        } else {
                            $this->cep = idFederal2int($this->cep);
                            $objEnderecoExterno = new clsEnderecoExterno($this->ref_idpes, "1", $this->idtlog, $this->logradouro, $this->numero, $this->letra, $this->complemento, $this->bairro, $this->cep, $this->cidade, $this->sigla_uf, false);

                            if ($objEnderecoExterno->existe()) {
                                $objEnderecoExterno->edita();
                            } else {
                                $objEnderecoExterno->cadastra();
                            }
                        }

                        //-----------------------CADASTRA CURSO------------------------//
                        $this->escola_curso = unserialize(urldecode($this->escola_curso));
                        $this->escola_curso_autorizacao = unserialize(urldecode($this->escola_curso_autorizacao));
                        $this->escola_curso_anos_letivos = unserialize(urldecode($this->escola_curso_anos_letivos));

                        if ($this->escola_curso) {
                            foreach ($this->escola_curso as $campo) {
                                $curso_escola = new clsPmieducarEscolaCurso($cadastrou1, $campo, null, $this->pessoa_logada, null, null, 1, $this->escola_curso_autorizacao[$campo], $this->escola_curso_anos_letivos[$campo]);
                                $cadastrou_ = $curso_escola->cadastra();

                                if (!$cadastrou_) {
                                    $this->mensagem = "Cadastro não realizado.<br>";
                                    echo "<!--\nErro ao cadastrar clsPmieducarEscolaCurso\nvalores obrigat&oacute;rios\nis_numeric($cadastrou) && is_numeric({$campo}) \n-->";
                                    return false;
                                }
                            }
                        }
                        //-----------------------FIM CADASTRA CURSO------------------------//
                    } else {
                        $this->mensagem = "Cadastro não realizado (clsPmieducarEscola).<br>";
                        return false;
                    }
                } else {
                    $this->mensagem = "Cadastro não realizado (clsJuridica).<br>";
                    return false;
                }

                $this->mensagem .= "Cadastro efetuado com sucesso.<br>";
                header("Location: educar_escola_lst.php");
                die();
                return true;
            } else {
                $this->mensagem = "Cadastro não realizado (clsPessoa_).<br>";
                return false;
            }
        } elseif ($this->sem_cnpj) {
            $obj = new clsPmieducarEscola(null, $this->pessoa_logada, null, $this->ref_cod_instituicao, $this->zona_localizacao, $this->ref_cod_escola_rede_ensino, null, $this->sigla, null, null, 1, null, $this->bloquear_lancamento_diario_anos_letivos_encerrados, $this->utiliza_regra_diferenciada);
            $obj->dependencia_administrativa = $this->dependencia_administrativa;
            $obj->orgao_vinculado_escola = $orgao_vinculado_escola;
            $obj->latitude = $this->latitude;
            $obj->longitude = $this->longitude;
            $obj->regulamentacao = $this->regulamentacao;
            $obj->situacao_funcionamento = $this->situacao_funcionamento;
            $obj->acesso = $this->acesso;
            $obj->ref_idpes_gestor = $this->gestor_id;
            $obj->cargo_gestor = $this->cargo_gestor;
            $obj->email_gestor = $this->email_gestor;
            $obj->local_funcionamento = $local_funcionamento;
            $obj->condicao = $this->condicao;
            $obj->predio_compartilhado_outra_escola = $this->predio_compartilhado_outra_escola;
            $obj->codigo_inep_escola_compartilhada = $this->codigo_inep_escola_compartilhada;
            $obj->codigo_inep_escola_compartilhada2 = $this->codigo_inep_escola_compartilhada2;
            $obj->codigo_inep_escola_compartilhada3 = $this->codigo_inep_escola_compartilhada3;
            $obj->codigo_inep_escola_compartilhada4 = $this->codigo_inep_escola_compartilhada4;
            $obj->codigo_inep_escola_compartilhada5 = $this->codigo_inep_escola_compartilhada5;
            $obj->codigo_inep_escola_compartilhada6 = $this->codigo_inep_escola_compartilhada6;
            $obj->decreto_criacao = $this->decreto_criacao;
            $obj->area_terreno_total = $this->area_terreno_total;
            $obj->area_construida = $this->area_construida;
            $obj->area_disponivel = $this->area_disponivel;
            $obj->num_pavimentos = $this->num_pavimentos;
            $obj->tipo_piso = $this->tipo_piso;
            $obj->medidor_energia = $this->medidor_energia;
            $obj->agua_consumida = $this->agua_consumida;
            $obj->agua_potavel_consumo = $this->agua_potavel_consumo;
            $obj->abastecimento_agua = $abastecimento_agua;
            $obj->abastecimento_energia = $abastecimento_energia;
            $obj->esgoto_sanitario = $esgoto_sanitario;
            $obj->destinacao_lixo = $destinacao_lixo;
            $obj->tratamento_lixo = $tratamento_lixo;
            $obj->salas_funcionais = $salas_funcionais;
            $obj->salas_gerais = $salas_gerais;
            $obj->banheiros = $banheiros;
            $obj->laboratorios = $laboratorios;
            $obj->salas_atividades = $salas_atividades;
            $obj->dormitorios = $dormitorios;
            $obj->areas_externas = $areas_externas;
            $obj->recursos_acessibilidade = $recursos_acessibilidade;
            $obj->dependencia_numero_salas_utilizadas = $this->dependencia_numero_salas_utilizadas;
            $obj->dependencia_numero_salas_existente = $this->dependencia_numero_salas_existente;
            $obj->total_funcionario = $this->total_funcionario;
            $obj->atendimento_aee = $this->atendimento_aee;
            $obj->atividade_complementar = $this->atividade_complementar;
            $obj->fundamental_ciclo = $this->fundamental_ciclo;
            $obj->localizacao_diferenciada = $this->localizacao_diferenciada;
            $obj->materiais_didaticos_especificos = $this->materiais_didaticos_especificos;
            $obj->educacao_indigena = $this->educacao_indigena;
            $obj->lingua_ministrada = $this->lingua_ministrada;
            $obj->espaco_brasil_aprendizado = $this->espaco_brasil_aprendizado;
            $obj->abre_final_semana = $this->abre_final_semana;
            $obj->codigo_lingua_indigena = $this->codigo_lingua_indigena;
            $obj->proposta_pedagogica = $this->proposta_pedagogica;
            $obj->televisoes = $this->televisoes;
            $obj->videocassetes = $this->videocassetes;
            $obj->dvds = $this->dvds;
            $obj->antenas_parabolicas = $this->antenas_parabolicas;
            $obj->copiadoras = $this->copiadoras;
            $obj->retroprojetores = $this->retroprojetores;
            $obj->impressoras = $this->impressoras;
            $obj->aparelhos_de_som = $this->aparelhos_de_som;
            $obj->projetores_digitais = $this->projetores_digitais;
            $obj->faxs = $this->faxs;
            $obj->maquinas_fotograficas = $this->maquinas_fotograficas;
            $obj->computadores = $this->computadores;
            $obj->computadores_administrativo = $this->computadores_administrativo;
            $obj->computadores_alunos = $this->computadores_alunos;
            $obj->impressoras_multifuncionais = $this->impressoras_multifuncionais;
            $obj->acesso_internet = $this->acesso_internet;
            $obj->ato_criacao = $this->ato_criacao;
            $obj->ato_autorizativo = $this->ato_autorizativo;
            $obj->ref_idpes_secretario_escolar = $this->secretario_id;
            $obj->unidade_vinculada_outra_instituicao = $this->unidade_vinculada_outra_instituicao;
            $obj->inep_escola_sede = $this->inep_escola_sede;
            $obj->codigo_ies = $this->codigo_ies_id;
            $obj->categoria_escola_privada = $this->categoria_escola_privada;
            $obj->conveniada_com_poder_publico = $this->conveniada_com_poder_publico;
            $obj->mantenedora_escola_privada = $mantenedora_escola_privada;
            $obj->cnpj_mantenedora_principal = idFederal2int($this->cnpj_mantenedora_principal);
            $obj->esfera_administrativa = $this->esfera_administrativa;

            $cod_escola = $cadastrou = $obj->cadastra();

            if ($cadastrou) {
                $escola = new clsPmieducarEscola($cod_escola);
                $escola = $escola->detalhe();
                $auditoria = new clsModulesAuditoriaGeral("escola", $this->pessoa_logada, $cod_escola);
                $auditoria->inclusao($escola);
                $obj2 = new clsPmieducarEscolaComplemento($cadastrou, null, $this->pessoa_logada, idFederal2int($this->cep), $this->numero, $this->complemento, $this->p_email, $this->fantasia, $this->cidade, $this->bairro, $this->logradouro, $this->p_ddd_telefone_1, $this->p_telefone_1, $this->p_ddd_telefone_fax, $this->p_telefone_fax, null, null, 1);
                $cadastrou2 = $obj2->cadastra();

                if ($cadastrou2) {
                    //-----------------------CADASTRA CURSO------------------------//
                    $this->escola_curso = unserialize(urldecode($this->escola_curso));
                    $this->escola_curso_autorizacao = unserialize(urldecode($this->escola_curso_autorizacao));
                    $this->escola_curso_anos_letivos = unserialize(urldecode($this->escola_curso_anos_letivos));

                    if ($this->escola_curso) {
                        foreach ($this->escola_curso as $campo) {
                            $curso_escola = new clsPmieducarEscolaCurso($cadastrou, $campo, null, $this->pessoa_logada, null, null, 1, $this->escola_curso_autorizacao[$campo], $this->escola_curso_anos_letivos[$campo]);
                            $cadastrou_ = $curso_escola->cadastra();

                            if (!$cadastrou_) {
                                $this->mensagem = "Cadastro não realizado.<br>";
                                echo "<!--\nErro ao cadastrar clsPmieducarEscolaCurso\nvalores obrigat&oacute;rios\nis_numeric($cadastrou) && is_numeric({$campo}) \n-->";
                                return false;
                            }
                        }
                    }
                    //-----------------------FIM CADASTRA CURSO------------------------//
                    $this->mensagem .= "Cadastro efetuado com sucesso.<br>";
                    header("Location: educar_escola_lst.php");
                    die();
                    return true;
                } else {
                    $this->mensagem = "Cadastro não realizado.<br>";
                    echo "<!--\nErro ao cadastrar clsPmieducarEscolaComplemento\nvalores obrigat&oacute;rios\nis_numeric($cadastrou) && is_numeric($this->pessoa_logada) && is_numeric($this->numero) && is_string($this->complemento) && is_string($this->p_email) && is_string($this->fantasia) && is_string($this->cidade) && is_string($this->bairro)\n-->";
                    return false;
                }
            } else {
                $this->mensagem = "Cadastro não realizado (clsPmieducarEscola).<br>";
                return false;
            }
        }
    }

    public function Editar()
    {
        $obj_permissoes = new clsPermissoes();
        $obj_permissoes->permissao_cadastra(561, $this->pessoa_logada, 7, "educar_escola_lst.php");

        if (!$this->validaDigitosInepEscola($this->escola_inep_id, 'Código INEP')) {
            return false;
        }

        if (!$this->validaDadosTelefones()) {
            return false;
        }

        if (!$this->validaLatitudeLongitude()) {
            return false;
        }

        if (!$this->validaCamposCenso()) {
            return false;
        }

        for ( $i = 1; $i <= 6; $i++) {
            $seq = $i == 1 ? '' : $i;
            $campo = 'codigo_inep_escola_compartilhada'.$seq;
            $ret = $this->validaDigitosInepEscola($this->$campo, 'Código da escola que compartilha o prédio '.$i);
            if (!$ret) {
                return false;
            }
        }

        $orgao_vinculado_escola = implode(',', $this->orgao_vinculado_escola);
        $mantenedora_escola_privada = implode(',', $this->mantenedora_escola_privada);
        $local_funcionamento = implode(',', $this->local_funcionamento);
        $abastecimento_agua = implode(',', $this->abastecimento_agua);
        $abastecimento_energia = implode(',', $this->abastecimento_energia);
        $esgoto_sanitario = implode(',', $this->esgoto_sanitario);
        $destinacao_lixo = implode(',', $this->destinacao_lixo);
        $tratamento_lixo = implode(',', $this->tratamento_lixo);
        $salas_funcionais = implode(',', $this->salas_funcionais);
        $salas_gerais = implode(',', $this->salas_gerais);
        $banheiros = implode(',', $this->banheiros);
        $laboratorios = implode(',', $this->laboratorios);
        $salas_atividades = implode(',', $this->salas_atividades);
        $dormitorios = implode(',', $this->dormitorios);
        $areas_externas = implode(',', $this->areas_externas);
        $recursos_acessibilidade = implode(',', $this->recursos_acessibilidade);

        if (in_array(5, $this->abastecimento_agua) && count($this->abastecimento_agua) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Abastecimento de água</b>, quando a opção: <b>Não há abastecimento de água</b> estiver selecionada.';
            return false;
        }

        if (in_array(4, $this->abastecimento_energia) && count($this->abastecimento_energia) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Fonte de energia elétrica</b>, quando a opção: <b>Não há energia elétrica</b> estiver selecionada.';
            return false;
        }

        if (in_array(3, $this->esgoto_sanitario) && count($this->esgoto_sanitario) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Esgotamento sanitário</b>, quando a opção: <b>Não há esgotamento sanitário</b> estiver selecionada.';
            return false;
        }

        if (in_array(TratamentoLixo::NAO_FAZ, $this->tratamento_lixo) && count($this->tratamento_lixo) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Tratamento do lixo/resíduos que a escola realiza</b>, quando a opção: <b>Não faz tratamento</b> estiver selecionada';
            return false;
        }

        if (in_array(RecursosAcessibilidade::NENHUM, $this->recursos_acessibilidade) && count($this->recursos_acessibilidade) > 1) {
            $this->mensagem = 'Não é possível informar mais de uma opção no campo: <b>Recursos de acessibilidade</b>, quando a opção: <b>Nenhum dos recursos de acessibilidade</b> estiver selecionada.';
            return false;
        }

        $this->bloquear_lancamento_diario_anos_letivos_encerrados = is_null($this->bloquear_lancamento_diario_anos_letivos_encerrados) ? 0 : 1;
        $this->utiliza_regra_diferenciada = !is_null($this->utiliza_regra_diferenciada);
        $obj = new clsPmieducarEscola($this->cod_escola);
        $escolaDetAntigo = $obj->detalhe();

        if ($this->cod_escola) {
            $obj = new clsPmieducarEscola($this->cod_escola, null, $this->pessoa_logada, $this->ref_cod_instituicao, $this->zona_localizacao, $this->ref_cod_escola_rede_ensino, $this->ref_idpes, $this->sigla, null, null, 1, $this->bloquear_lancamento_diario_anos_letivos_encerrados, $this->utiliza_regra_diferenciada);
            $obj->dependencia_administrativa = $this->dependencia_administrativa;
            $obj->orgao_vinculado_escola = $orgao_vinculado_escola;
            $obj->latitude = $this->latitude;
            $obj->longitude = $this->longitude;
            $obj->regulamentacao = $this->regulamentacao;
            $obj->situacao_funcionamento = $this->situacao_funcionamento;
            $obj->acesso = $this->acesso;
            $obj->ref_idpes_gestor = $this->gestor_id;
            $obj->cargo_gestor = $this->cargo_gestor;
            $obj->email_gestor = $this->email_gestor;
            $obj->local_funcionamento = $local_funcionamento;
            $obj->condicao = $this->condicao;
            $obj->predio_compartilhado_outra_escola = $this->predio_compartilhado_outra_escola;
            $obj->codigo_inep_escola_compartilhada = $this->codigo_inep_escola_compartilhada;
            $obj->codigo_inep_escola_compartilhada2 = $this->codigo_inep_escola_compartilhada2;
            $obj->codigo_inep_escola_compartilhada3 = $this->codigo_inep_escola_compartilhada3;
            $obj->codigo_inep_escola_compartilhada4 = $this->codigo_inep_escola_compartilhada4;
            $obj->codigo_inep_escola_compartilhada5 = $this->codigo_inep_escola_compartilhada5;
            $obj->codigo_inep_escola_compartilhada6 = $this->codigo_inep_escola_compartilhada6;
            $obj->decreto_criacao = $this->decreto_criacao;
            $obj->area_terreno_total = $this->area_terreno_total;
            $obj->area_construida = $this->area_construida;
            $obj->area_disponivel = $this->area_disponivel;
            $obj->num_pavimentos = $this->num_pavimentos;
            $obj->tipo_piso = $this->tipo_piso;
            $obj->medidor_energia = $this->medidor_energia;
            $obj->agua_consumida = $this->agua_consumida;
            $obj->agua_potavel_consumo = $this->agua_potavel_consumo;
            $obj->abastecimento_agua = $abastecimento_agua;
            $obj->abastecimento_energia = $abastecimento_energia;
            $obj->esgoto_sanitario = $esgoto_sanitario;
            $obj->destinacao_lixo = $destinacao_lixo;
            $obj->tratamento_lixo = $tratamento_lixo;
            $obj->salas_funcionais = $salas_funcionais;
            $obj->salas_gerais = $salas_gerais;
            $obj->banheiros = $banheiros;
            $obj->laboratorios = $laboratorios;
            $obj->salas_atividades = $salas_atividades;
            $obj->dormitorios = $dormitorios;
            $obj->areas_externas = $areas_externas;
            $obj->recursos_acessibilidade = $recursos_acessibilidade;
            $obj->dependencia_numero_salas_utilizadas = $this->dependencia_numero_salas_utilizadas;
            $obj->dependencia_numero_salas_existente = $this->dependencia_numero_salas_existente;
            $obj->total_funcionario = $this->total_funcionario;
            $obj->atendimento_aee = $this->atendimento_aee;
            $obj->atividade_complementar = $this->atividade_complementar;
            $obj->fundamental_ciclo = $this->fundamental_ciclo;
            $obj->localizacao_diferenciada = $this->localizacao_diferenciada;
            $obj->materiais_didaticos_especificos = $this->materiais_didaticos_especificos;
            $obj->educacao_indigena = $this->educacao_indigena;
            $obj->lingua_ministrada = $this->lingua_ministrada;
            $obj->espaco_brasil_aprendizado = $this->espaco_brasil_aprendizado;
            $obj->abre_final_semana = $this->abre_final_semana;
            $obj->codigo_lingua_indigena = $this->codigo_lingua_indigena;
            $obj->proposta_pedagogica = $this->proposta_pedagogica;
            $obj->televisoes = $this->televisoes;
            $obj->videocassetes = $this->videocassetes;
            $obj->dvds = $this->dvds;
            $obj->antenas_parabolicas = $this->antenas_parabolicas;
            $obj->copiadoras = $this->copiadoras;
            $obj->retroprojetores = $this->retroprojetores;
            $obj->impressoras = $this->impressoras;
            $obj->aparelhos_de_som = $this->aparelhos_de_som;
            $obj->projetores_digitais = $this->projetores_digitais;
            $obj->faxs = $this->faxs;
            $obj->maquinas_fotograficas = $this->maquinas_fotograficas;
            $obj->computadores = $this->computadores;
            $obj->computadores_administrativo = $this->computadores_administrativo;
            $obj->computadores_alunos = $this->computadores_alunos;
            $obj->impressoras_multifuncionais = $this->impressoras_multifuncionais;
            $obj->acesso_internet = $this->acesso_internet;
            $obj->ato_criacao = $this->ato_criacao;
            $obj->ato_autorizativo = $this->ato_autorizativo;
            $obj->ref_idpes_secretario_escolar = $this->secretario_id;
            $obj->unidade_vinculada_outra_instituicao = $this->unidade_vinculada_outra_instituicao;
            $obj->inep_escola_sede = $this->inep_escola_sede;
            $obj->codigo_ies = $this->codigo_ies_id;
            $obj->categoria_escola_privada = $this->categoria_escola_privada;
            $obj->conveniada_com_poder_publico = $this->conveniada_com_poder_publico;
            $obj->mantenedora_escola_privada = $mantenedora_escola_privada;
            $obj->cnpj_mantenedora_principal = idFederal2int($this->cnpj_mantenedora_principal);
            $obj->esfera_administrativa = $this->esfera_administrativa;

            $editou = $obj->edita();

            if ($editou) {
                $escolaDetAtual = $obj->detalhe();
                $auditoria = new clsModulesAuditoriaGeral("escola", $this->pessoa_logada, $this->cod_escola);
                $auditoria->alteracao($escolaDetAntigo, $escolaDetAtual);
            }
        } else {
            $obj = new clsPmieducarEscola(null, $this->pessoa_logada, null, $this->ref_cod_instituicao, $this->zona_localizacao, $this->ref_cod_escola_rede_ensino, $this->ref_idpes, $this->sigla, null, null, 1, $this->bloquear_lancamento_diario_anos_letivos_encerrados, $this->utiliza_regra_diferenciada);
            $obj->situacao_funcionamento = $this->situacao_funcionamento;
            $obj->dependencia_administrativa = $this->dependencia_administrativa;
            $obj->orgao_vinculado_escola = $orgao_vinculado_escola;
            $obj->latitude = $this->latitude;
            $obj->longitude = $this->longitude;
            $obj->regulamentacao = $this->regulamentacao;
            $obj->acesso = $this->acesso;
            $obj->ref_idpes_gestor = $this->gestor_id;
            $obj->cargo_gestor = $this->cargo_gestor;
            $obj->email_gestor = $this->email_gestor;
            $obj->local_funcionamento = $local_funcionamento;
            $obj->condicao = $this->condicao;
            $obj->predio_compartilhado_outra_escola = $this->predio_compartilhado_outra_escola;
            $obj->codigo_inep_escola_compartilhada = $this->codigo_inep_escola_compartilhada;
            $obj->codigo_inep_escola_compartilhada2 = $this->codigo_inep_escola_compartilhada2;
            $obj->codigo_inep_escola_compartilhada3 = $this->codigo_inep_escola_compartilhada3;
            $obj->codigo_inep_escola_compartilhada4 = $this->codigo_inep_escola_compartilhada4;
            $obj->codigo_inep_escola_compartilhada5 = $this->codigo_inep_escola_compartilhada5;
            $obj->codigo_inep_escola_compartilhada6 = $this->codigo_inep_escola_compartilhada6;
            $obj->decreto_criacao = $this->decreto_criacao;
            $obj->area_terreno_total = $this->area_terreno_total;
            $obj->area_construida = $this->area_construida;
            $obj->area_disponivel = $this->area_disponivel;
            $obj->num_pavimentos = $this->num_pavimentos;
            $obj->tipo_piso = $this->tipo_piso;
            $obj->medidor_energia = $this->medidor_energia;
            $obj->agua_consumida = $this->agua_consumida;
            $obj->agua_potavel_consumo = $this->agua_potavel_consumo;
            $obj->abastecimento_agua = $abastecimento_agua;
            $obj->abastecimento_energia = $abastecimento_energia;
            $obj->esgoto_sanitario = $esgoto_sanitario;
            $obj->destinacao_lixo = $destinacao_lixo;
            $obj->tratamento_lixo = $tratamento_lixo;
            $obj->salas_funcionais = $salas_funcionais;
            $obj->salas_gerais = $salas_gerais;
            $obj->banheiros = $banheiros;
            $obj->laboratorios = $laboratorios;
            $obj->salas_atividades = $salas_atividades;
            $obj->dormitorios = $dormitorios;
            $obj->areas_externas = $areas_externas;
            $obj->recursos_acessibilidade = $recursos_acessibilidade;
            $obj->dependencia_unidade_climatizada = $this->dependencia_unidade_climatizada;
            $obj->dependencia_quantidade_ambiente_climatizado = $this->dependencia_quantidade_ambiente_climatizado;
            $obj->dependencia_numero_salas_utilizadas = $this->dependencia_numero_salas_utilizadas;
            $obj->dependencia_numero_salas_existente = $this->dependencia_numero_salas_existente;
            $obj->total_funcionario = $this->total_funcionario;
            $obj->atendimento_aee = $this->atendimento_aee;
            $obj->atividade_complementar = $this->atividade_complementar;
            $obj->fundamental_ciclo = $this->fundamental_ciclo;
            $obj->localizacao_diferenciada = $this->localizacao_diferenciada;
            $obj->materiais_didaticos_especificos = $this->materiais_didaticos_especificos;
            $obj->educacao_indigena = $this->educacao_indigena;
            $obj->lingua_ministrada = $this->lingua_ministrada;
            $obj->espaco_brasil_aprendizado = $this->espaco_brasil_aprendizado;
            $obj->abre_final_semana = $this->abre_final_semana;
            $obj->codigo_lingua_indigena = $this->codigo_lingua_indigena;
            $obj->proposta_pedagogica = $this->proposta_pedagogica;
            $obj->televisoes = $this->televisoes;
            $obj->videocassetes = $this->videocassetes;
            $obj->dvds = $this->dvds;
            $obj->antenas_parabolicas = $this->antenas_parabolicas;
            $obj->copiadoras = $this->copiadoras;
            $obj->retroprojetores = $this->retroprojetores;
            $obj->impressoras = $this->impressoras;
            $obj->aparelhos_de_som = $this->aparelhos_de_som;
            $obj->projetores_digitais = $this->projetores_digitais;
            $obj->faxs = $this->faxs;
            $obj->maquinas_fotograficas = $this->maquinas_fotograficas;
            $obj->computadores = $this->computadores;
            $obj->computadores_administrativo = $this->computadores_administrativo;
            $obj->computadores_alunos = $this->computadores_alunos;
            $obj->impressoras_multifuncionais = $this->impressoras_multifuncionais;
            $obj->acesso_internet = $this->acesso_internet;
            $obj->ato_criacao = $this->ato_criacao;
            $obj->ato_autorizativo = $this->ato_autorizativo;
            $obj->ref_idpes_secretario_escolar = $this->secretario_id;
            $obj->unidade_vinculada_outra_instituicao = $this->unidade_vinculada_outra_instituicao;
            $obj->inep_escola_sede = $this->inep_escola_sede;
            $obj->codigo_ies = $this->codigo_ies_id;
            $obj->categoria_escola_privada = $this->categoria_escola_privada;
            $obj->conveniada_com_poder_publico = $this->conveniada_com_poder_publico;
            $obj->mantenedora_escola_privada = $mantenedora_escola_privada;
            $obj->cnpj_mantenedora_principal = idFederal2int($this->cnpj_mantenedora_principal);
            $obj->esfera_administrativa = $this->esfera_administrativa;

            $this->cod_escola = $editou = $obj->cadastra();

            if ($this->cod_escola) {
                $obj = new clsPmieducarEscola($this->cod_escola);
                $escolaDetAtual = $obj->detalhe();
                $auditoria = new clsModulesAuditoriaGeral("escola", $this->pessoa_logada, $this->cod_escola);
                $auditoria->inclusao($escolaDetAtual);
            }
        }

        if ($editou) {
            if ($this->com_cnpj) {
                $objPessoa = new clsPessoa_($this->ref_idpes, null, false, $this->p_http, false, $this->pessoa_logada, date("Y-m-d H:i:s", time()), $this->p_email);
                $editou1 = $objPessoa->edita();

                if ($editou1) {
                    $obj_pes_juridica = new clsJuridica($this->ref_idpes, $this->cnpj, $this->fantasia, false, false, false, $this->pessoa_logada);
                    $editou2 = $obj_pes_juridica->edita();

                    if ($editou2) {
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes);
                        $objTelefone->excluiTodos();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 1, str_replace("-", "", $this->p_telefone_1), $this->p_ddd_telefone_1);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 2, str_replace("-", "", $this->p_telefone_2), $this->p_ddd_telefone_2);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 3, str_replace("-", "", $this->p_telefone_mov), $this->p_ddd_telefone_mov);
                        $objTelefone->cadastra();
                        $objTelefone = new clsPessoaTelefone($this->ref_idpes, 4, str_replace("-", "", $this->p_telefone_fax), $this->p_ddd_telefone_fax);
                        $objTelefone->cadastra();
                        $objEndereco = new clsPessoaEndereco($this->ref_idpes);
                        $detEndereco = $objEndereco->detalhe();

                        if ($this->cep) {
                            $this->cep_ = idFederal2int($this->cep);
                        }

                        $this->cep = $this->cep;

                        if (!$this->isEnderecoExterno) {
                            $this->cep = $this->cep_;
                            $objEndereco = new clsPessoaEndereco($this->ref_idpes, $this->cep, $this->idlog, $this->idbai, $this->numero, $this->complemento, false);

                            if ($objEndereco->detalhe()) {
                                $objEndereco->edita();
                            } else {
                                $objEndereco->cadastra();
                            }
                        } else {
                            $this->cep = idFederal2int($this->cep);
                            $objEnderecoExterno = new clsEnderecoExterno($this->ref_idpes, "1", $this->idtlog, $this->logradouro, $this->numero, $this->letra, $this->complemento, $this->bairro, $this->cep, $this->cidade, $this->sigla_uf, false);

                            if ($objEnderecoExterno->existe()) {
                                $objEnderecoExterno->edita();
                            } else {
                                $objEnderecoExterno->cadastra();
                            }
                        }
                        //-----------------------EDITA CURSO------------------------//
                        $this->escola_curso = unserialize(urldecode($this->escola_curso));
                        $this->escola_curso_autorizacao = unserialize(urldecode($this->escola_curso_autorizacao));
                        $this->escola_curso_anos_letivos = unserialize(urldecode($this->escola_curso_anos_letivos));
                        $obj = new clsPmieducarEscolaCurso($this->cod_escola);
                        $excluiu = $obj->excluirTodos();

                        if ($excluiu) {
                            if ($this->escola_curso) {
                                foreach ($this->escola_curso as $campo) {
                                    $obj = new clsPmieducarEscolaCurso($this->cod_escola, $campo, null, $this->pessoa_logada, null, null, 1, $this->escola_curso_autorizacao[$campo], $this->escola_curso_anos_letivos[$campo]);
                                    $cadastrou_ = $obj->cadastra();

                                    if (!$cadastrou_) {
                                        $this->mensagem = "Edição não realizada.<br>";
                                        echo "<!--\nErro ao editar clsPmieducarEscolaCurso\nvalores obrigat&oacute;rios\nis_numeric($this->cod_serie) && is_numeric({$campo}) && is_numeric($this->pessoa_logada)\n-->";
                                        return false;
                                    }
                                }
                            }
                        }
                        //-----------------------FIM EDITA CURSO------------------------//
                        $this->mensagem .= "Edição efetuada com sucesso.<br>";
                        header("Location: educar_escola_lst.php");
                        die();
                        return true;
                    }
                }
            } elseif ($this->sem_cnpj) {
                $objComplemento = new clsPmieducarEscolaComplemento($this->cod_escola, $this->pessoa_logada, null, idFederal2int($this->cep_), $this->numero, $this->complemento, $this->p_email, $this->fantasia, $this->cidade, $this->bairro, $this->logradouro, $this->p_ddd_telefone_1, $this->p_telefone_1, $this->p_ddd_telefone_fax, $this->p_telefone_fax);
                $editou1 = $objComplemento->edita();

                if ($editou1) {
                    //-----------------------EDITA CURSO------------------------//
                    $this->escola_curso = unserialize(urldecode($this->escola_curso));
                    $this->escola_curso_autorizacao = unserialize(urldecode($this->escola_curso_autorizacao));
                    $this->escola_curso_anos_letivos = unserialize(urldecode($this->escola_curso_anos_letivos));
                    $obj = new clsPmieducarEscolaCurso($this->cod_escola);
                    $excluiu = $obj->excluirTodos();

                    if ($excluiu) {
                        if ($this->escola_curso) {
                            foreach ($this->escola_curso as $campo) {
                                $obj = new clsPmieducarEscolaCurso($this->cod_escola, $campo, null, $this->pessoa_logada, null, null, 1, $this->escola_curso_autorizacao[$campo], $this->escola_curso_anos_letivos[$campo]);
                                $cadastrou_ = $obj->cadastra();
                                if (!$cadastrou_) {
                                    $this->mensagem = "Edição não realizada.<br>";
                                    echo "<!--\nErro ao editar clsPmieducarEscolaCurso\nvalores obrigat&oacute;rios\nis_numeric($this->cod_serie) && is_numeric({$campo[$i]}) && is_numeric($this->pessoa_logada)\n-->";
                                    return false;
                                }
                            }
                        }
                    }
                    //-----------------------FIM EDITA CURSO------------------------//
                    $this->mensagem .= "Edição efetuada com sucesso.<br>";
                    header("Location: educar_escola_lst.php");
                    die();
                    return true;
                } else {
                    $this->mensagem = "Edição não realizada (clsPmieducarEscolaComplemento).<br>";
                    return false;
                }
            }
        }

        $this->mensagem = "Edição não realizada.<br>";
        echo "<!--\nErro ao editar clsPmieducarEscola\nvalores obrigatorios\nif(is_numeric($this->cod_escola) && is_numeric($this->pessoa_logada))\n-->";
        return false;
    }

    public function Excluir()
    {
        $obj_permissoes = new clsPermissoes();
        $obj_permissoes->permissao_cadastra(561, $this->pessoa_logada, 3, "educar_escola_lst.php");
        $obj = new clsPmieducarEscola($this->cod_escola, null, $this->pessoa_logada, null, null, null, null, null, null, null, 0);
        $escola = $obj->detalhe();
        $excluiu = $obj->excluir();

        if ($excluiu) {
            $auditoria = new clsModulesAuditoriaGeral("escola", $this->pessoa_logada, $this->cod_escola);
            $auditoria->exclusao($escola);
            $this->mensagem .= "Exclusão efetuada com sucesso.<br>";
            header("Location: educar_escola_lst.php");
            die();
            return true;
        }

        $this->mensagem = "Exclusão não realizada.<br>";
        echo "<!--\nErro ao excluir clsPmieducarEscola\nvalores obrigatorios\nif(is_numeric($this->cod_escola) && is_numeric($this->pessoa_logada))\n-->";
        return false;
    }
    protected function inputTelefone($type, $typeLabel = '')
    {
        if (!$typeLabel) {
            $typeLabel = "Telefone {$type}";
        }

        // ddd
        $options = array(
            'required' => false,
            'label' => "(DDD) / {$typeLabel}",
            'placeholder' => 'DDD',
            'value' => $this->{"p_ddd_telefone_{$type}"},
            'max_length' => 3,
            'size' => 3,
            'inline' => true,
        );
        $this->inputsHelper()->integer("p_ddd_telefone_{$type}", $options);

        // telefone
        $options = array(
            'required' => false,
            'label' => '',
            'placeholder' => $typeLabel,
            'value' => $this->{"p_telefone_{$type}"},
            'max_length' => 9,
        );
        $this->inputsHelper()->integer("p_telefone_{$type}", $options);
    }

    protected function validaCamposCenso()
    {
        if (!$this->validarCamposObrigatoriosCenso()) {
            return TRUE;
        }
        return $this->validaEscolaPrivada() &&
                $this->validaOcupacaoPredio() &&
                $this->validaSalasExistentes() &&
                $this->validaPossuiBandaLarga() &&
                $this->validaLocalizacaoDiferenciada() &&
                $this->validaEsferaAdministrativa() &&
                $this->validaDigitosInepEscola($this->inep_escola_sede, 'Código escola sede') &&
                $this->inepEscolaSedeDiferenteDaEscolaPrincipal() &&
                $this->validaEscolaCompartilhaPredio();
    }

    protected function validaOcupacaoPredio()
    {
        if (in_array(LocalFuncionamento::PREDIO_ESCOLAR, $this->local_funcionamento) && empty($this->condicao)) {
            $this->mensagem = 'O campo: Forma de ocupação do prédio, deve ser informado quando o Local de funcionamento for prédio escolar.';
            return FALSE;
        }
        return TRUE;
    }

    protected function validaSalasExistentes()
    {
        if (in_array(LocalFuncionamento::PREDIO_ESCOLAR, $this->local_funcionamento) && ((int) $this->dependencia_numero_salas_existente) <= 0) {
            $this->mensagem = 'O campo: Número de salas de aula existentes na escola, deve ser informado quando o Local de funcionamento for prédio escolar.';
            return FALSE;
        }
        return TRUE;
    }

    protected function validaLocalizacaoDiferenciada()
    {
        if ($this->localizacao_diferenciada == LocalizacaoDiferenciadaEscola::AREA_ASSENTAMENTO &&
            $this->zona_localizacao == App_Model_ZonaLocalizacao::URBANA) {
            $this->mensagem = 'O campo: Localização diferenciada da escola não pode ser preenchido com Área de assentamento quando o campo: Zona localização for Urbana';
            return false;
        }

        return true;
    }

    protected function validaPossuiBandaLarga()
    {
        if (((int)$this->computadores) > 0 && !in_array($this->acesso_internet, array('0', '1'))) {
            $this->mensagem = 'O campo: Possui internet banda larga, deve ser informado quando existir computadores na escola.';
            return FALSE;
        }
        return TRUE;
    }

    protected function validaEsferaAdministrativa()
    {
        if ($this->regulamentacao == Regulamentacao::NAO) {
            return true;
        }

        $esferaAdministrativa = $this->esfera_administrativa;
        $dependenciaAdministrativa = $this->dependencia_administrativa;
        $mensagem = 'O campo: Esfera administrativa do conselho ou órgão responsável pela Regulamentação/Autorização, foi preenchido com um valor incorreto';

        if ($this->regulamentacao != Regulamentacao::NAO && empty($esferaAdministrativa)) {
            $this->mensagem = $mensagem;
            return false;
        }

        /**
         * Se o campo "dependência administrativa" for:
         * 2 (Estadual) este campo também deve ser 2
         */
        if ($dependenciaAdministrativa == DependenciaAdministrativaEscola::ESTADUAL) {
            if ($esferaAdministrativa != EsferaAdministrativa::ESTADUAL) {
                $this->mensagem = $mensagem;
                return false;
            }
        }
        /**
         * Se o campo "dependência administrativa" for:
         * 1 (Federal) este campo deve ser 1 ou 2
         */
        if ($dependenciaAdministrativa == DependenciaAdministrativaEscola::FEDERAL) {
            if (
                $esferaAdministrativa != EsferaAdministrativa::FEDERAL &&
                $esferaAdministrativa != EsferaAdministrativa::ESTADUAL
            ) {
                $this->mensagem = $mensagem;
                return false;
            }

        }
        /**
         * Se o campo "dependência administrativa" for:
         * 3 (Municipal) este campo deve ser 2 ou 3
         */
        if ($dependenciaAdministrativa == DependenciaAdministrativaEscola::MUNICIPAL) {
            if (
                $esferaAdministrativa != EsferaAdministrativa::ESTADUAL &&
                $esferaAdministrativa != EsferaAdministrativa::MUNICIPAL
            ) {
                $this->mensagem = $mensagem;
                return false;
            }
        }

        return true;
    }

    protected function validaEscolaPrivada()
    {
        if ($this->dependencia_administrativa != "4" || $this->situacao_funcionamento != 1) {
            return TRUE;
        }
        if (empty($this->categoria_escola_privada)) {
            $this->mensagem = "O campo categoria da escola privada é obrigatório para escolas em atividade de administração privada.";
            return FALSE;
        }
        if (empty($this->conveniada_com_poder_publico)) {
            $this->mensagem = "O campo conveniada com poder público é obrigatório para escolas em atividade de administração privada.";
            return FALSE;
        }
        if (empty($this->mantenedora_escola_privada) ||
            (is_array($this->mantenedora_escola_privada) &&
            count($this->mantenedora_escola_privada) == 1 &&
            empty($this->mantenedora_escola_privada[0]))) {
            $this->mensagem = "O campo mantenedora da escola privada é obrigatório para escolas em atividade de administração privada.";
            return FALSE;
        }
        return TRUE;
    }

    protected function validaLatitudeLongitude()
    {
        $caracteres = array(" ", ".", "-", null, '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        $mensagemErro = "O campo: Latitude e/ou Longitude foi preenchido com valor inválido.";

        for ($i = 0; $i <= strlen($this->latitude); $i++) {
            $char = substr($this->latitude, $i, 1);

            if (!in_array($char, $caracteres)) {
                $this->mensagem = $mensagemErro;
                return false;
            }
        }

        for ($i = 0; $i <= strlen($this->longitude); $i++) {
            $char = substr($this->longitude, $i, 1);
            if (!in_array($char, $caracteres)) {
                $this->mensagem = $mensagemErro;
                return false;
            }
        }

        if (empty($this->latitude) && !empty($this->longitude)) {
            $this->mensagem = "O campo Latitude deve ser preenchido quando o Longitude estiver preenchido.";
            return false;
        } elseif (!empty($this->latitude) && empty($this->longitude)) {
            $this->mensagem = "O campo Longitude deve ser preenchido quando o Latitude estiver preenchido.";
            return false;
        }

        return true;
    }

    protected function validaDadosTelefones()
    {
        return $this->validaDDDTelefone($this->p_ddd_telefone_1, $this->p_telefone_1, 'Telefone 1') &&
        $this->validaTelefone($this->p_telefone_1, 'Telefone 1') &&
        $this->validaDDDTelefone($this->p_ddd_telefone_2, $this->p_telefone_2, 'Telefone 2') &&
        $this->validaTelefone($this->p_telefone_2, 'Telefone 2') &&
        $this->validaDDDTelefone($this->p_ddd_telefone_mov, $this->p_telefone_mov, 'Celular') &&
        $this->validaDDDTelefone($this->p_ddd_telefone_fax, $this->p_telefone_fax, 'Fax');
    }

    protected function validaDDDTelefone($valorDDD = null, $valorTelefone = null, $nomeCampo)
    {
        $msgRequereTelefone = "O campo: {$nomeCampo}, deve ser preenchido quando o DDD estiver preenchido.";
        $msgRequereDDD = "O campo: DDD, deve ser preenchido quando o {$nomeCampo} estiver preenchido.";

        if (!empty($valorDDD) && empty($valorTelefone)) {
            $this->mensagem = $msgRequereTelefone;
            return false;
        }

        if (empty($valorDDD) && !empty($valorTelefone)) {
            $this->mensagem = $msgRequereDDD;
            return false;
        }

        return true;
    }

    protected function validaTelefone($telefone, $nomeCampo)
    {
        if (empty($telefone)) {
            return true;
        }

        $telefoneValidator = new Telefone($nomeCampo, $telefone);
        if (!$telefoneValidator->isValid()) {
            $this->mensagem = implode('<br>', $telefoneValidator->getMessage());
            return false;
        }

        return true;
    }

    protected function validaDigitosInepEscola($inep, $nomeCampo)
    {
        if (!empty($inep) && strlen($inep) != 8) {
            $this->mensagem = "O campo: {$nomeCampo} deve conter 8 dígitos.";
            return false;
        }
        return true;
    }

    protected function inepEscolaSedeDiferenteDaEscolaPrincipal()
    {
        if ($this->inep_escola_sede == $this->escola_inep_id) {
            $this->mensagem = "O campo: Código da escola sede deve ser diferente do campo: Código INEP";
            return false;
        }

        return true;
    }

    protected function geraCamposCodigoInepEscolaCompartilhada()
    {
        $options = array('label_hint' => 'Caso compartilhe o prédio escolar com outra escola preencha com o código INEP',
                        'required' => false, 'size' => 8, 'max_length' => 8, 'placeholder' => '');

        for ( $i = 1; $i <= 6; $i++){
            $seq = $i == 1 ? '' : $i;
            $options['label'] = 'Código da escola que compartilha o prédio '.$i;
            $campo = 'codigo_inep_escola_compartilhada'.$seq;
            $options['value'] = $this->$campo;
            $this->inputsHelper()->integer('codigo_inep_escola_compartilhada'.$seq, $options);
        }

    }

    protected function validaEscolaCompartilhaPredio()
    {
        $arrayCampos = [
            $this->codigo_inep_escola_compartilhada,
            $this->codigo_inep_escola_compartilhada2,
            $this->codigo_inep_escola_compartilhada3,
            $this->codigo_inep_escola_compartilhada4,
            $this->codigo_inep_escola_compartilhada5,
            $this->codigo_inep_escola_compartilhada6,
        ];

        if (in_array($this->escola_inep_id, $arrayCampos)) {
            $this->mensagem = "O campo: Código da escola que compartilha o prédio 1, 2, 3, 4, 5 ou 6, deve ser diferente do Código INEP da escola atual.";
            return false;
        }

        $arrayCamposSemNulos = array_filter($arrayCampos);
        if (count(array_unique($arrayCamposSemNulos)) < count($arrayCamposSemNulos)) {
            $this->mensagem = "Os códigos Inep's das escolas compartilhadas devem ser diferentes entre si.";
            return false;
        }

        return true;
    }
}

// cria uma extensao da classe base
$pagina = new clsIndexBase();
// cria o conteudo
$miolo = new indice();
// adiciona o conteudo na clsBase
$pagina->addForm($miolo);
// gera o html
$pagina->MakeAll();
