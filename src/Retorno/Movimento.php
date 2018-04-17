<?php

namespace Santander\Retorno;

use Santander\Util;

class Movimento {
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