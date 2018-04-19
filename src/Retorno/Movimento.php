<?php

namespace Santander\Retorno;

use Santander\Util;

class Movimento {

	public static function getDescricaoOcorrencia($codigo_ocorrencia) {
		$ocorrencias = array(
			1 => 'TÍTULO NÃO EXISTE',
			2 => 'ENTRADA TÍT. CONFIRMADA',
			3 => 'ENTRADA TÍT. REJEITADA',
			6 => 'LIQUIDAÇÃO',
			7 => 'LIQUIDAÇÃO POR CONTA',
			8 => 'LIQUIDAÇÃO POR SALDO',
			9 => 'BAIXA AUTOMÁTICA',
			10 => 'TÍT. BAIX. CONF. INSTRUÇÃO',
			11 => 'EM SER',
			12 => 'ABATIMENTO CONCEDIDO',
			13 => 'ABATIMENTO CANCELADO',
			14 => 'ALTERAÇÃO DE VENCIMENTO',
			15 => 'CONFIRMAÇÃO DE PROTESTO',
			16 => 'TÍT. JÁ BAIXADO/LIQUIDADO',
			17 => 'LIQUIDADO EM CARTÓRIO',
			21 => 'TÍT. ENVIADO A CARTÓRIO',
			22 => 'TÍT. RETIRADO DE CARTÓRIO',
			24 => 'CUSTAS DE CARTÓRIO',
			25 => 'PROTESTAR TÍTULO',
			26 => 'SUSTAR PROTESTO',
			35 => 'TÍTULO DDA RECONHECIDO PELO PAGADOR',
			36 => 'TÍTULO DDA NÃO RECONHECIDO PELO PAGADOR',
			37 => 'TÍTULO DDA RECUSADO PELA CIP',
			38 => 'RECEBIMENTO DA INSTRUÇÃO NÃO PROTESTAR',
			39 => 'ESPÉCIE DE TÍTULO NÃO PERMITE A INSTRUÇÃO'
		);

		return $ocorrencias[(int)$codigo_ocorrencia];
	}

	public static function getDescricaoErro($codigo_original_remessa, $codigo_erro) {

		if ((int)$codigo_original_remessa == 0) {
			return '';
		}
		if ((int)$codigo_erro == 0 && $codigo_original_remessa != 3) {
			return '';
		}

		$erros = array();
		for($i=1;$i<=94;$i++) {
			$erros[$i] = array();
		}
		$erros[28][1] = "NOSSO NUMERO NAO NUMERICO";
		$erros[47][2] = "VALOR DO ABATIMENTO NAO NUMERICO";
		$erros[32][3] = "DATA VENCIMENTO NAO NUMERICA";
		$erros[1][4] = "CONTA COBRANCA NAO NUMERICA";
		$erros[31][5] = "CODIGO DA CARTEIRA NAO NUMERICO";
		$erros[31][6] = "CODIGO DA CARTEIRA INVALIDO";
		$erros[36][7] = "ESPECIE DO DOCUMENTO INVALIDA";
		$erros[53][8] = "UNIDADE DE VALOR NAO NUMERICA";
		$erros[53][9] = "UNIDADE DE VALOR INVALIDA";
		$erros[2][10] = "CODIGO PRIMEIRA INSTRUCAO NAO NUMERICA";
		$erros[2][11] = "CODIGO SEGUNDA INSTRUCAO NAO NUMERICA";
		$erros[34][12] = "VALOR DO TITULO EM OUTRA UNIDADE";
		$erros[34][13] = "VALOR DO TITULO NAO NUMERICO";
		$erros[42][14] = "VALOR DE MORA NAO NUMERICO";
		$erros[39][15] = "DATA EMISSAO NAO NUMERICA";
		$erros[32][16] = "DATA DE VENCIMENTO INVALIDA";
		$erros[1][17] = "CODIGO DA AGENCIA COBRADORA NAO NUMERICA";
		$erros[6][18] = "VALOR DO IOC NAO NUMERICO";
		$erros[2][19] = "NUMERO DO CEP NAO NUMERICO";
		$erros[62][19] = "NUMERO DO CEP NAO NUMERICO";
		$erros[59][20] = "TIPO INSCRICAO NAO NUMERICO";
		$erros[59][21] = "NUMERO DO CGC OU CPF NAO NUMERICO";
		$erros[26][22] = "CODIGO OCORRENCIA INVALIDO";
		$erros[55][24] = "TOTAL PARCELA NAO NUMERICO";
		$erros[45][25] = "VALOR DESCONTO NAO NUMERICO";
		$erros[7][26] = "CODIGO BANCO COBRADOR INVALIDO";
		$erros[55][27] = "NUMERO PARCELAS CARNE NAO NUMERICO";
		$erros[55][28] = "NUMERO PARCELAS CARNE ZERADO";
		$erros[42][29] = "VALOR DE MORA INVALIDO";
		$erros[32][30] = "DT VENC MENOR DE 15 DIAS DA DT PROCES";
		$erros[2][31] = "INSTRUÇÃO RECUSADA PELO SISTEMA DE GARANTIAS";
		$erros[2][38] = "MOVIMENTO EXCLUIDO POR SOLICITACAO";
		$erros[4][39] = "PERFIL NAO ACEITA TITULO EM BCO CORRESP";
		$erros[4][40] = "COBR RAPIDA NAO ACEITA-SE BCO CORRESP";
		$erros[7][41] = "AGENCIA COBRADORA NAO ENCONTRADA";
		$erros[1][42] = "CONTA COBRANCA INVALIDA";
		$erros[93][43] = "NAO BAIXAR, COMPL. INFORMADO INVALIDO";
		$erros[94][44] = "NAO PROTESTAR, COMPL. INFORMADO INVALIDO";
		$erros[52][45] = "QTD DE DIAS DE BAIXA NAO PREENCHIDO";
		$erros[49][46] = "QTD DE DIAS PROTESTO NAO PREENCHIDO";
		$erros[55][47] = "TOT PARC. INF. NAO BATE Cl OTD PARC GER";
		$erros[55][48] = "CARNE COM PARCELAS COM ERROs";
		$erros[55][49] = "SEU NUMERO NAO CONFERE COM O CARNE";
		$erros[28][50] = "NUMERO DO TITULO IGUAL A ZERO";
		$erros[28][51] = "TITULO NAO ENCONTRADO";
		$erros[81][52] = "OCOR. NAOACATADA,TITULO LIOUIDADO";
		$erros[80][53] = "OCOR. NAO ACATADA, TITULO BAIXADO";
		$erros[94][54] = "TITULO COM ORDEM DE PROTESTO JA EMITIDA";
		$erros[94][55] = "OCOR. NAO ACATADA, TITULO JA PROTESTADO";
		$erros[84][56] = "OCOR. NAO ACATADA, TIT. NAO VENCIDO";
		$erros[62][57] = "CEP DO SACADO INCORRETO";
		$erros[59][58] = "CGC/CPF INCORRETO";
		$erros[4][59] = "INSTRUCAO ACEITA SO P/ COBRANCA SIMPLES";
		$erros[36][60] = "ESPECIE DOCUMENTO NAO PROTESTAVEL";
		$erros[94][61] = "CEDENTE SEM CARTA DE PROTESTO";
		$erros[89][62] = "SACADO NAO PROTESTAVEL";
		$erros[62][63] = "CEP NAO ENCONTRADO NA TABELA DE PRACAS";
		$erros[94][64] = "TIPO DE COBRANCA NAO PERMITE PROTESTO";
		$erros[2][65] = "PEDIDO SUSTACAO JA SOLICITADO";
		$erros[94][66] = "SUSTACAO PROTESTO FORA DE PRAZO";
		$erros[2][67] = "CLIENTE NAO TRANSMITE REG. DE OCORRENCIA";
		$erros[32][68] = "TIPO DE VENCIMENTO INVALIDO";
		$erros[4][69] = "PRODUTO DIFERENTE DE COBRANCA SIMPLES";
		$erros[5][70] = "DATA PRORROGACAO MENOR OUE DATA VENCTO";
		$erros[5][71] = "DATA ANTECIPACAO MAIOR OUE DATA VENCTO";
		$erros[5][72] = "DATA DOCUMENTO SUPERIOR A DATA INSTRUCAO";
		$erros[90][73] = "ABATIMENTO MAIOR/IGUAL AO VALOR TITULO";
		$erros[45][74] = "PRIM. DESGONTO MAIOR/IGUAL VALOR TITULO";
		$erros[45][75] = "SEG. DESCONTO MAIOR/IGUAL VALOR TITULO";
		$erros[45][76] = "TERC. DESCONTO MAIOR/IGUAL VALOR TITULO";
		$erros[2][77] = "DESC. POR ANTEC. MAIOR/IGUAL VLR TITULO";
		$erros[45][77] = "DESC. POR ANTEC. MAIOR/IGUAL VLR TITULO";
		$erros[92][78] = "NAO EXISTE ABATIMENTO P/ CANCELAR";
		$erros[45][79] = "NAO EXISTE PRIM. DESCONTO P/ CANCELAR";
		$erros[45][80] = "NAO EXISTE SEG. DESCONTO P/ CANCELAR";
		$erros[45][81] = "NAO EXISTE TERC. DESCONTO P/ CANCELAR";
		$erros[45][82] = "NAO EXISTE DESC. POR ANTEC. P/ CANCELAR";
		$erros[77][83] = "NAO EXISTE MULTA POR ATRASO P/ CANCELAR";
		$erros[71][84] = "JA EXISTE SEGUNDO DESCONTO";
		$erros[74][85] = "JA EXISTE TERCEIRO DESCONTO";
		$erros[44][86] = "DATA SEGUNDO DESCONTO INVALIDA";
		$erros[44][87] = "DATA TERCEIRO DESCONTO INVALIDA";
		$erros[5][88] = "DATA INSTRUCAO INVALIDA";
		$erros[76][89] = "DATA MULTA MENOR/IGUAL OUE VENCIMENTO";
		$erros[45][90] = "JA EXISTE DESCONTO POR DIA ANTECIPACAO";
		$erros[1][91] = "TIPO/NÚMERO DE INSCRIÇÃO DO PAGADOR INVALIDO";
		$erros[28][92] = "NOSSO NUMERO JA CADASTRADO";
		$erros[34][93] = "VALOR DO TITULO NAO INFORMADO";
		$erros[34][94] = "VALOR TIT. EM OUTRA MOEDA NAO INFORMADO";
		$erros[34][95] = "PERFIL NAO ACEITA VALOR TITULO ZERADO";
		$erros[94][96] = "ESPECIE DOCTO NAO PERMITE PROTESTO";
		$erros[36][97] = "ESPECIE DOCTO NAO PERMITE IOC ZERADO";
		$erros[39][98] = "DATA EMISSAO INVALIDA";
		$erros[28][99] = "REGISTRO DUPLICADO NO MOVIMENTO DIARIO";
		$erros[39][100] = "DATA EMISSAO MAIOR OUE A DATA VENCIMENTO";
		$erros[61][101] = "NOME DO SACADO NAO INFORMADO";
		$erros[63][102] = "ENDERECO DO SACADO NAO INFORMADO";
		$erros[64][103] = "MUNICIPIO DO SACADO NAO INFORMADO";
		$erros[65][104] = "UNIDADE DA FEDERACAO NAO INFORMADA";
		$erros[59][105] = "TIPO INSCRICAO NAO EXISTE";
		$erros[59][106] = "CGCICPF NAO INFORMADO";
		$erros[65][107] = "UNIDADE DA FEDERACAO";
		$erros[59][108] = "DIGITO CGC/CPF INCORRETO";
		$erros[65][108] = "DIGITO CGC/CPF INCORRETO";
		$erros[42][109] = "VALOR MORA TEM OUE SER ZERO (TIT = ZERO)";
		$erros[44][110] = "DATA PRIMEIRO DESCONTO INVALIDA";
		$erros[44][111] = "DATA DESCONTO NAO NUMERICA";
		$erros[45][112] = "VALOR DESCONTO NAO INFORMADO";
		$erros[45][113] = "VALOR DESCONTO INVALIDO";
		$erros[47][114] = "VALOR ABATIMENTO NAO INFORMADO";
		$erros[90][115] = "VALOR ABATIMENTO MAIOR VALOR TITULO";
		$erros[76][116] = "DATA MULTA NAO NUMERICA";
		$erros[91][117] = "VALOR DESCONTO MAIOR VALOR TITULO";
		$erros[76][118] = "DATA MULTA NAO INFORMADA";
		$erros[76][119] = "DATA MULTA MAIOR OUE DATA DE VENCIMENTO";
		$erros[77][120] = "PERCENTUAL MULTA NAO NUMERICO";
		$erros[77][121] = "PERCENTUAL MULTA NAO INFORMADO";
		$erros[46][122] = "VALOR IOF MAIOR OUE VALOR TITULO";
		$erros[62][123] = "CEP DO SACADO NAO NUMERICO";
		$erros[62][124] = "CEP SACADO NAO ENCONTRADO";
		$erros[2][125] = "COMPLEMENTO DA INSTRUCAO NAO NUMERICO";
		$erros[48][128] = "CODIGO PROTESTO INVALIDO";
		$erros[36][129] = "ESPEC DE DOCUMENTO NAO NUMERICA";
		$erros[8][130] = "FORMA DE CADASTRAMENTO NAO NUMERICA";
		$erros[8][131] = "FORMA DE CADASTRAMENTO INVALIDA";
		$erros[8][132] = "FORMA CADAST. 2 INVALIDA PARA CARTEIRA 3";
		$erros[8][133] = "FORMA CADAST. 2 INVALIDA PARA CARTEIRA 4";
		$erros[26][134] = "CODIGO DO MOV. REMESSA NAO NUMERICO";
		$erros[9][136] = "CODIGO BCO NA COMPENSACAO NAO NUMERICO";
		$erros[9][137] = "CODIGO BCO NA COMPENSACAO INVALIDO";
		$erros[11][138] = "NUM. LOTE REMESSA(DETALHE) NAO NUMERICO";
		$erros[11][139] = "TIPO DE REGISTRO INVALIDO";
		$erros[10][140] = "COD. SEOUEC.DO REG. DETALHE INVALIDO";
		$erros[10][141] = "NUM. SEO. REG. DO LOTE NAO NUMERICO";
		$erros[1][142] = "NUM.AG.CEDENTE/DIG.NAO NUMERICO";
		$erros[1][143] = "NUM. CONTA CEDENTE/DIG. NAO NUMERICO";
		$erros[36][144] = "TIPO DE DOCUMENTO NAO NUMERICO";
		$erros[36][145] = "TIPO DE DOCUMENTO INVALIDO";
		$erros[48][146] = "CODIGO P. PROTESTO NAO NUMERICO";
		$erros[49][147] = "QTDE DE DIAS P. PROTESTO INVALIDO";
		$erros[49][148] = "QTDE DE DIAS P. PROTESTO NAO NUMERICO";
		$erros[41][149] = "CODIGO DE MORA INVALIDO";
		$erros[41][150] = "CODIGO DE MORA NAO NUMERICO";
		$erros[42][151] = "VL.MORA IGUAL A ZEROS P. COD.MORA 1";
		$erros[42][152] = "VL. TAXA MORA IGUAL A ZEROS P.COD MORA 2";
		$erros[42][153] = "VL. MORA DIFERENTE DE ZEROS P.COD.MORA 3";
		$erros[42][154] = "VL. MORA NAO NUMERICO P. COD MORA 2";
		$erros[42][155] = "VL. MORA INVALIDO P. COD.MORA 4";
		$erros[52][156] = "QTDE DIAS P.BAIXA/DEVOL. NAO NUMERICO";
		$erros[52][157] = "QTDE DIAS BAIXA/DEV. INVALIDO P. COD. 1";
		$erros[52][158] = "QTDE DIAS BAIXA/DEV. INVALIDO P.COD. 2";
		$erros[52][159] = "OTDE DIAS BAIXA/DEV.INVALIDO P.COD. 3";
		$erros[63][160] = "BAIRRO DO SACADO NAO INFORMADO";
		$erros[66][161] = "TIPO INSC.CPF/CGC SACADOR/AVAL.NAO NUM.";
		$erros[55][162] = "INDICADOR DE CARNE NAO NUMERICO";
		$erros[55][163] = "NUM. TOTAL DE PARC.CARNE NAO NUMERICO";
		$erros[11][164] = "NUMERO DO PLANO NAO NUMERICO";
		$erros[55][165] = "INDICADOR DE PARCELAS CARNE INVALIDO";
		$erros[57][166] = "N.SEO. PARCELA INV.P.INDIC. MAIOR 0";
		$erros[57][167] = "N. SEO.PARCELA INV.P.INDIC.DIF.ZEROS";
		$erros[55][168] = "N.TOT.PARC.INV.P.INDIC. MAIOR ZEROS";
		$erros[55][169] = "NUM.TOT.PARC.INV.P.INDIC.DIFER.ZEROS";
		$erros[4][170] = "FORMA DE CADASTRAMENTO 2 INV.P.CART.5";
		$erros[66][199] = "TIPO INSC.CGC/CPF SACADOR.AVAL.INVAL.";
		$erros[67][200] = "NUM.INSC.(CGC)SACADOR/AVAL.NAO NUMERICO";
		$erros[4][201] = "ALT.DO CONTR.PARTICIPANTEINVALIDO";
		$erros[12][202] = "ALT. DO SEU NUMERO INVALIDA";
		$erros[1][371] = "TITULO REJEITADO - OPERACAO DE DESCONTO";
		$erros[1][372] = "TIT. REJEITADO - HORARIO LIMITE OP DESCONTO";
		$erros[3][0] = "PAGAMENTO PARCIAL";



		return $erros[(int)$codigo_original_remessa][$codigo_erro];
	}

	private $fields = array(
		'codigo_registro' => '9(001)',
		'tipo_inscricao_beneficiario' => '9(002)',
		'cnpj_cpf_beneficiario' => '9(014)',
		'codigo_agencia_beneficiario' => '9(004)',
		'conta_movimento_beneficiario' => '9(008)',
		'conta_cobranca_beneficiario' => '9(008)',
		'numero_controle_participante' => 'X(025)',
		'nosso_numero' => '9(008)',
		'brancos_071_107' => 'X(037)',
		'codigo_carteira' => '9(001)',
		'codigo_ocorrencia' => '9(002)',
		'data_ocorrencia' => '9(006)',
		'seu_numero' => 'X(010)',
		'nosso_numero_127_134' => '9(008)',
		'codigo_original_remessa' => '9(002)',
		'codigo_erro_1' => 'X(003)',
		'codigo_erro_2' => 'X(003)',
		'codigo_erro_3' => 'X(003)',
		'brancos_146_146' => 'X(001)',
		'data_vencimento_titulo' => '9(006)',
		'valor_titulo_moeda_corrente' => '9(011)v9(2)',
		'numero_banco_cobrador' => '9(003)',
		'codigo_agencia_recebedora' => '9(005)',
		'especie_documento' => '9(002)',
		'valor_tarifa_cobrada' => '9(011)v9(2)',
		'valor_outras_despesas' => '9(011)v9(2)',
		'valor_juros_atraso' => '9(011)v9(2)',
		'valor_iof_devido' => '9(011)v9(2)',
		'valor_abatimento_concedido' => '9(011)v9(2)',
		'valor_desconto_concedido' => '9(011)v9(2)',
		'valor_total_recebido' => '9(011)v9(2)',
		'valor_juros_mora' => '9(011)v9(2)',
		'valor_outros_creditos' => '9(011)v9(2)',
		'branco_293_293' => 'X(001)',
		'codigo_aceite' => 'X(001)',
		'branco_295_295' => 'X(001)',
		'data_credito' => '9(006)',
		'nome_pagador' => 'X(036)',
		'identificador_complemento' => 'X(001)',
		'unidade_moeda_corrente' => 'X(002)',
		'valor_titulo_outra_unidade' => '9(8)v9(5)',
		'valor_iof_outra_unidade' => '9(8)v9(5)',
		'valor_debito_credito' => '9(011)v9(2)',
		'debito_credito' => 'X(001)',
		'brancos_381_383' => 'X(003)',
		'complemento' => '9(002)',
		'sigla_empresa_sistema' => 'X(004)',
		'brancos_390_391' => 'X(002)',
		'numero_versao' => '9(003)',
		'sequencial' => '9(006)'
	);

	private $data = array();
	private $data_formatado = array();


	public function __construct() {
		foreach($this->fields as $field_name => $format) {
			$this->{$field_name} = '';
		}
	}

	public function __set($name, $value) {
		$this->data[$name] = $value;
		$format = $this->fields[$name];
		$this->data_formatado = Util::format($format, $value);
	}
	public function __get($name) {
		return $this->data[$name];
	}

	public function setCodigoRegistro($codigo_registro = 1) {
		$this->codigo_registro = $codigo_registro;
		return $this;
	}
	public function getCodigoRegistro() {
		return $this->codigo_registro;
	}

	public function setTipoInscricaoBeneficiario($tipo_inscricao_beneficiario  = 1) {
		$this->tipo_inscricao_beneficiario = $tipo_inscricao_beneficiario;
		return $this;
	}
	public function getTipoInscricaoBeneficiario() {
		return $this->tipo_inscricao_beneficiario;
	}

	public function setCnpjCpfBeneficiario($cnpj_cpf_beneficiario) {
		$this->cnpj_cpf_beneficiario = $cnpj_cpf_beneficiario;
		return $this;
	}
	public function getCnpjCpfBeneficiario() {
		return $this->cnpj_cpf_beneficiario;
	}

	public function setCodigoAgenciaBeneficiario($codigo_agencia_beneficiario) {
		$this->codigo_agencia_beneficiario = $codigo_agencia_beneficiario;
		return $this;
	}
	public function getCodigoAgenciaBeneficiario() {
		return $this->codigo_agencia_beneficiario;
	}

	public function setContaMovimentoBeneficiario($conta_movimento_beneficiario) {
		$this->conta_movimento_beneficiario = $conta_movimento_beneficiario;
		return $this;
	}
	public function getContaMovimentoBeneficiario() {
		return $this->conta_movimento_beneficiario;
	}

	public function setContaCobrancaBeneficiario($conta_cobranca_beneficiario) {
		$this->conta_cobranca_beneficiario = $conta_cobranca_beneficiario;
		return $this;
	}
	public function getContaCobrancaBeneficiario() {
		return $this->conta_cobranca_beneficiario;
	}

	public function setNumeroControleParticipante($numero_controle_participante) {
		$this->numero_controle_participante = $numero_controle_participante;
		return $this;
	}
	public function getNumeroControleParticipante() {
		return $this->numero_controle_participante;
	}

	public function setNossoNumero($nosso_numero) {
		$this->nosso_numero = $nosso_numero;
		return $this;
	}
	public function getNossoNumero() {
		return $this->nosso_numero;
	}

	public function setCodigoCarteira($codigo_carteira) {
		$this->codigo_carteira = $codigo_carteira;
		return $this;
	}
	public function getCodigoCarteira() {
		return $this->codigo_carteira;
	}

	public function setCodigoOcorrencia($codigo_ocorrencia) {
		$this->codigo_ocorrencia = $codigo_ocorrencia;
		return $this;
	}
	public function getCodigoOcorrencia() {
		return $this->codigo_ocorrencia;
	}

	public function setDataOcorrencia($data_ocorrencia) {
		$this->data_ocorrencia = $data_ocorrencia;
		return $this;
	}
	public function getDataOcorrencia() {
		return $this->data_ocorrencia;
	}

	public function setSeuNumero($seu_numero) {
		$this->seu_numero = $seu_numero;
		return $this;
	}
	public function getSeuNumero() {
		return $this->seu_numero;
	}

	public function setCodigoOriginalRemessa($codigo_original_remessa) {
		$this->codigo_original_remessa = $codigo_original_remessa;
		return $this;
	}
	public function getCodigoOriginalRemessa() {
		return $this->codigo_original_remessa;
	}

	public function setCodigoErro1($codigo_erro_1) {
		$this->codigo_erro_1 = $codigo_erro_1;
		return $this;
	}
	public function getCodigoErro1() {
		return $this->codigo_erro_1;
	}

	public function setCodigoErro2($codigo_erro_2) {
		$this->codigo_erro_2 = $codigo_erro_2;
		return $this;
	}
	public function getCodigoErro2() {
		return $this->codigo_erro_2;
	}

	public function setCodigoErro3($codigo_erro_3) {
		$this->codigo_erro_3 = $codigo_erro_3;
		return $this;
	}
	public function getCodigoErro3() {
		return $this->codigo_erro_3;
	}

	public function setDataVencimentoTitulo($data_vencimento_titulo) {
		$this->data_vencimento_titulo = $data_vencimento_titulo;
		return $this;
	}
	public function getDataVencimentoTitulo() {
		return $this->data_vencimento_titulo;
	}

	public function setValorTituloMoedaCorrente($valor_titulo_moeda_corrente) {
		$this->valor_titulo_moeda_corrente = $valor_titulo_moeda_corrente;
		return $this;
	}
	public function getValorTituloMoedaCorrente() {
		return $this->valor_titulo_moeda_corrente;
	}

	public function setNumeroBancoCobrador($numero_banco_cobrador) {
		$this->numero_banco_cobrador = $numero_banco_cobrador;
		return $this;
	}
	public function getNumeroBancoCobrador() {
		return $this->numero_banco_cobrador;
	}

	public function setCodigoAgenciaRecebedora($codigo_agencia_recebedora) {
		$this->codigo_agencia_recebedora = $codigo_agencia_recebedora;
		return $this;
	}
	public function getCodigoAgenciaRecebedora() {
		return $this->codigo_agencia_recebedora;
	}

	public function setEspecieDocumento($especie_documento) {
		$this->especie_documento = $especie_documento;
		return $this;
	}
	public function getEspecieDocumento() {
		return $this->especie_documento;
	}

	public function setValorTarifaCobrada($valor_tarifa_cobrada) {
		$this->valor_tarifa_cobrada = $valor_tarifa_cobrada;
		return $this;
	}
	public function getValorTarifaCobrada() {
		return $this->valor_tarifa_cobrada;
	}

	public function setValorOutrasDespesas($valor_outras_despesas) {
		$this->valor_outras_despesas = $valor_outras_despesas;
		return $this;
	}
	public function getValorOutrasDespesas() {
		return $this->valor_outras_despesas;
	}

	public function setValorJurosAtraso($valor_juros_atraso) {
		$this->valor_juros_atraso = $valor_juros_atraso;
		return $this;
	}
	public function getValorJurosAtraso() {
		return $this->valor_juros_atraso;
	}

	public function setValorIofDevido($valor_iof_devido) {
		$this->valor_iof_devido = $valor_iof_devido;
		return $this;
	}
	public function getValorIofDevido() {
		return $this->valor_iof_devido;
	}

	public function setValorAbatimentoConcedido($valor_abatimento_concedido) {
		$this->valor_abatimento_concedido = $valor_abatimento_concedido;
		return $this;
	}
	public function getValorAbatimentoConcedido() {
		return $this->valor_abatimento_concedido;
	}

	public function setValorDescontoConcedido($valor_desconto_concedido) {
		$this->valor_desconto_concedido = $valor_desconto_concedido;
		return $this;
	}
	public function getValorDescontoConcedido() {
		return $this->valor_desconto_concedido;
	}

	public function setValorTotalRecebido($valor_total_recebido) {
		$this->valor_total_recebido = $valor_total_recebido;
		return $this;
	}
	public function getValorTotalRecebido() {
		return $this->valor_total_recebido;
	}

	public function setValorJurosMora($valor_juros_mora) {
		$this->valor_juros_mora = $valor_juros_mora;
		return $this;
	}
	public function getValorJurosMora() {
		return $this->valor_juros_mora;
	}

	public function setValorOutrosCreditos($valor_outros_creditos) {
		$this->valor_outros_creditos = $valor_outros_creditos;
		return $this;
	}
	public function getValorOutrosCreditos() {
		return $this->valor_outros_creditos;
	}

	public function setCodigoAceite($codigo_aceite = 'N') {
		$this->codigo_aceite = $codigo_aceite;
		return $this;
	}
	public function getCodigoAceite() {
		return $this->codigo_aceite;
	}

	public function setDataCredito($data_credito) {
		$this->data_credito = $data_credito;
		return $this;
	}
	public function getDataCredito() {
		return $this->data_credito;
	}

	public function setNomePagador($nome_pagador) {
		$this->nome_pagador = $nome_pagador;
		return $this;
	}
	public function getNomePagador() {
		return $this->nome_pagador;
	}

	public function setIdentificadorComplemento($identificador_complemento) {
		$this->identificador_complemento = $identificador_complemento;
		return $this;
	}
	public function getIdentificadorComplemento() {
		return $this->identificador_complemento;
	}

	public function setUnidadeMoedaCorrente($unidade_moeda_corrente) {
		$this->unidade_moeda_corrente = $unidade_moeda_corrente;
		return $this;
	}
	public function getUnidadeMoedaCorrente() {
		return $this->unidade_moeda_corrente;
	}

	public function setValorTituloOutraUnidade($valor_titulo_outra_unidade) {
		$this->valor_titulo_outra_unidade = $valor_titulo_outra_unidade;
		return $this;
	}
	public function getValorTituloOutraUnidade() {
		return $this->valor_titulo_outra_unidade;
	}

	public function setValorIofOutraUnidade($valor_iof_outra_unidade) {
		$this->valor_iof_outra_unidade = $valor_iof_outra_unidade;
		return $this;
	}
	public function getValorIofOutraUnidade() {
		return $this->valor_iof_outra_unidade;
	}

	public function setValorDebitoCredito($valor_debito_credito) {
		$this->valor_debito_credito = $valor_debito_credito;
		return $this;
	}
	public function getValorDebitoCredito() {
		return $this->valor_debito_credito;
	}

	public function setDebitoCredito($debito_credito) {
		$this->debito_credito = $debito_credito;
		return $this;
	}
	public function getDebitoCredito() {
		return $this->debito_credito;
	}

	public function setComplemento($complemento) {
		$this->complemento = $complemento;
		return $this;
	}
	public function getComplemento() {
		return $this->complemento;
	}

	public function setSiglaEmpresaSistema($sigla_empresa_sistema) {
		$this->sigla_empresa_sistema = $sigla_empresa_sistema;
		return $this;
	}
	public function getSiglaEmpresaSistema() {
		return $this->sigla_empresa_sistema;
	}

	public function setNumeroVersao($numero_versao) {
		$this->numero_versao = $numero_versao;
		return $this;
	}
	public function getNumeroVersao() {
		return $this->numero_versao;
	}

	public function setSequencial($sequencial = '') {
		$this->sequencial = $sequencial;
		return $this;
	}
	public function getSequencial() {
		return $this->sequencial;
	}

	public function getRegexp() {
		$regexp = '';

		foreach($this->fields as $field_name => $format_string) {
			$format = Util::parseFormat($format_string);

			switch ($format->type) {
				case 'string':
					$regexp.= "(?P<{$field_name}>.{{$format->size}})";
					break;
				case 'int': 
				case 'decimal':
					$regexp.= "(?P<{$field_name}>\d{{$format->size}})";					
					break;
				default:
					# code...
					break;
			}
		}
		$regexp = "/^{$regexp}$/u";
		return $regexp;
	}

	public function parseLine($line) {
		$regexp = $this->getRegexp();

		if (preg_match($regexp, $line, $matches)) {
			foreach($this->fields as $field_name => $format_string) {
				if (!isset($matches[$field_name])) continue;

				$format = Util::parseFormat($format_string);
				switch ($format->type) {
					case 'string':
						$valor = trim($matches[$field_name]);
						break;
					case 'int':
						$valor = (int)$matches[$field_name];
						break;
					case 'decimal':
						$valor = (double)$matches[$field_name]/pow(10,$format->decimal);
						break;					
					default:
						continue;
						break;
				}

				if (preg_match('/^data_/',$field_name)) {
					$dia = substr($valor, 0, 2);
					$mes = substr($valor, 2, 2);
					$ano = substr($valor, 4, 2);
					$valor = "20{$ano}-{$mes}-{$dia}";
				}
				$this->{$field_name} = $valor;
			}
		}
	}



}