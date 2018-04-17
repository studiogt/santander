<?php

namespace Santander\Remessa;

use Santander\Util;

class Trailer {

	private $fields = array(
		'codigo_registro' => '9(001)',
		'quantidade_documentos' => '9(006)',
		'valor_total_titulos' => '9(011)v9(2)',
		'zeros_021_394' => '9(374)',
		'sequencial' => '9(006)'
	);

	private $data = array();

	public function __set($name, $value) {
		$format = $this->fields[$name];
		$value = Util::format($format, $value);
		$this->data[$name] = $value;
	}

	public function __get($name) {
		return $this->data[$name];
	}

	public function __construct($quantidade_documentos = 0, $valor_total_titulos = 0.0, $sequencial = 0) {
		foreach($this->fields as $field_name => $format) {
			$this->{$field_name} = '';
		}

		$this->codigo_registro = 9;
		$this->quantidade_documentos = $quantidade_documentos;
		$this->valor_total_titulos = $valor_total_titulos;
		$this->sequencial = $sequencial;

	}

	public function setQuantidadeDocumentos($quantidade_documentos = 0) {
		$this->quantidade_documentos = (int)$quantidade_documentos;
		return $this;
	}
	public function getQuantidadeDocumentos() {
		return $this->quantidade_documentos;
	}

	public function setValorTotalTitulos($valor_total_titulos = 0.0) {
		$this->valor_total_titulos = (double)$valor_total_titulos;
		return $this;
	}

	public function getValorTotalTitulos() {
		return $this->valor_total_titulos;
	}

	public function setSequencial($sequencial = 0) {
		$this->sequencial = (int)$sequencial;
		return $this;
	}
	public function getSequencial() {
		return $this->sequencial;
	}

	public function __toString() {
		
		return join('',$this->data);
	}
}