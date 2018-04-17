<?php

namespace Santander\Retorno;

use Santander\Util;

class Trailer {
	private $fields = array(
		'codigo_registro' => '9(001)',
		'codigo_remessa' => '9(001)',
		'codigo_servico' => '9(002)',
		'codigo_banco' => '9(003)',
		'brancos_008_017' => 'X(010)',
		'qtd_registros_simples' => '9(008)',
		'valor_titulos_simples' => '9(012)v9(2)',
		'numero_aviso_simples' => '9(008)',
		'brancos_048_057' => 'X(010)',
		'zeros_058_087' => '9(030)',
		'brancos_088_097' => 'X(010)',
		'qtd_registros_caucionada' => '9(008)',
		'valor_titulos_caucionada' => '9(012)v9(2)',
		'numero_aviso_caucionada' => '9(008)',
		'brancos_128_137' => 'X(010)',
		'qtd_registros_descontada' => '9(008)',
		'valor_titulos_descontada' => '9(012)v9(2)',
		'numero_aviso_descontada' => '9(008)',
		'brancos_168_391' => 'X(224)',
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

	public function setCodigoRegistro($codigo_registro = 9) {
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

	public function setCodigoServico($codigo_servico = 1) {
		$this->codigo_servico = $codigo_servico;
		return $this;
	}
	public function getCodigoServico() {
		return $this->codigo_servico;
	}

	public function setCodigoBanco($codigo_banco = 33) {
		$this->codigo_banco = $codigo_banco;
		return $this;
	}
	public function getCodigoBanco() {
		return $this->codigo_banco;
	}

	public function setQuantidadeRegistrosCobrancaSimples($qtd_registros_simples = 0) {
		$this->qtd_registros_simples = $qtd_registros_simples;
		return $this;
	}
	public function getQuantidadeRegistrosCobrancaSimples() {
		return $this->qtd_registros_simples;
	}

	public function setValorTitulosCobrancaSimples($valor_titulos_simples = 0.0) {
		$this->valor_titulos_simples = $valor_titulos_simples;
		return $this;
	}
	public function getValorTitulosCobrancaSimples() {
		return $this->valor_titulos_simples;
	}

	public function setNumeroAvisoCobrancaSimples($numero_aviso_simples = 0) {
		$this->numero_aviso_simples = $numero_aviso_simples;
		return $this;
	}
	public function getNumeroAvisoCobrancaSimples() {
		return $this->numero_aviso_simples;
	}

	public function setQuantidadeRegistrosCobrancaCaucionada($qtd_registros_caucionada = 0) {
		$this->qtd_registros_caucionada = $qtd_registros_caucionada;
		return $this;
	}
	public function getQuantidadeRegistrosCobrancaCaucionada() {
		return $this->qtd_registros_caucionada;
	}

	public function setValorTitulosCobrancaCaucionada($valor_titulos_caucionada = 0.0) {
		$this->valor_titulos_caucionada = $valor_titulos_caucionada;
		return $this;
	}
	public function getValorTitulosCobrancaCaucionada() {
		return $this->valor_titulos_caucionada;
	}

	public function setNumeroAvisoCobrancaCaucionada($numero_aviso_caucionada = 0) {
		$this->numero_aviso_caucionada = $numero_aviso_caucionada;
		return $this;
	}
	public function getNumeroAvisoCobrancaCaucionada() {
		return $this->numero_aviso_caucionada;
	}

	public function setQuantidadeRegistrosCobrancaDescontada($qtd_registros_descontada = 0) {
		$this->qtd_registros_descontada = $qtd_registros_descontada;
		return $this;
	}
	public function getQuantidadeRegistrosCobrancaDescontada() {
		return $this->qtd_registros_descontada;
	}

	public function setValorTitulosCobrancaDescontada($valor_titulos_descontada = 0.0) {
		$this->valor_titulos_descontada = $valor_titulos_descontada;
		return $this;
	}
	public function getValorTitulosCobrancaDescontada() {
		return $this->valor_titulos_descontada;
	}

	public function setNumeroAvisoCobrancaDescontada($numero_aviso_descontada = 0) {
		$this->numero_aviso_descontada = $numero_aviso_descontada;
		return $this;
	}
	public function getNumeroAvisoCobrancaDescontada() {
		return $this->numero_aviso_descontada;
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

				$this->{$field_name} = $valor;
			}
		}
	}



}