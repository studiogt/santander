<?php

namespace Retorno;

use Util;

class Header {
	private $fields = array(
		'codigo_registro' => '9(001)',
		'codigo_remessa' => '9(001)',
		'literal_transmissao' => 'X(007)',
		'codigo_servico' => '9(002)',
		'literal_servico' => 'X(015)',
		'codigo_agencia_beneficiario' => '9(004)',
		'conta_movimento_beneficiario' => '9(008)',
		'conta_cobranca_beneficiario' => '9(008)',
		'nome_beneficiario' => 'X(030)',
		'codigo_banco' => '9(003)',
		'nome_banco' => 'X(015)',
		'data_movimento' => '9(006)',
		'densidade_gravacao' => '9(008)',
		'brancos_109_385' => 'X(277)',
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

	public function setCodigoRegistro($codigo_registro = 0) {
		$this->codigo_registro = $codigo_registro;
		return $this;
	}
	public function getCodigoRegistro() {
		return $this->codigo_registro;
	}

	public function setCodigoRemessa($codigo_remessa = 2) {
		$this->codigo_remessa = $codigo_remessa;
		return $this;
	}
	public function getCodigoRemessa() {
		return $this->codigo_remessa;
	}

	public function setLiteralTransmissao($literal_transmissao = 'RETORNO') {
		$this->$literal_transmissao = $literal_transmissao;
		return $this;
	}
	public function getLiteralTransmissao() {
		return $this->literal_transmissao;
	}

	public function setCodigoServico($codigo_servico = 1) {
		$this->codigo_servico = $codigo_servico;
	}
	public function getCodigoServico() {
		return $this->codigo_servico;
	}

	public function setLiteralServico($literal_servico = 'COBRANÇA') {
		$this->literal_servico = $literal_servico;
	}
	public function getLiteralServico() {
		return $this->literal_servico;
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

	public function setNomeBeneficiario($nome_beneficiario) {
		$this->nome_beneficiario = $nome_beneficiario;
		return $this;
	}
	public function getNomeBeneficiario() {
		return $this->nome_beneficiario;
	}

	public function setCodigoBanco($codigo_banco = 33) {
		$this->codigo_banco = $codigo_banco;
		return $this;
	}
	public function getCodigoBanco() {
		return $this->codigo_banco;
	}

	public function setNomeBanco($nome_banco = 'SANTANDER') {
		$this->nome_banco = $nome_banco;
		return $this;
	}
	public function getNomeBanco() {
		return $this->nome_banco;
	}

	public function setDataMovimento($data_movimento) {
		$this->data_movimento = $data_movimento;
		$this->data_formatado['data_movimento'] = date('dmy',strtotime($data_movimento));
		return $this;
	}
	public function getDataMovimento() {
		return $this->data_movimento;
	}

	public function setDensidadeGravacao($densidade_gravacao = 1600) {
		$this->densidade_gravacao = $densidade_gravacao;
		return $this;
	}
	public function getDensidadeGravacao() {
		return $this->densidade_gravacao;
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

				if ($field_name == 'data_movimento') {
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