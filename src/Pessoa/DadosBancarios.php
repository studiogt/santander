<?php

namespace Santander\Pessoa;

use Santander\Banco;

class DadosBancarios {
	private $banco;
	private $agencia;
	private $conta;
	private $conta_movimento;
	private $conta_cobranca;

	private $carteira;

	public function __construct() {
		$this->setBanco(new Banco());
		$this->setAgencia('');
		$this->setConta('');
		$this->setCarteira(0);
	}

	public function setBanco(Banco $banco) {
		$this->banco = $banco;
		return $this;
	}
	public function getBanco() {
		return $this->banco;
	}

	public function setAgencia($agencia = '') {
		$agencia = preg_replace('/\D/','', $agencia);
		$this->agencia = $agencia;
		return $this;
	}
	public function getAgencia() {
		return $this->agencia;
	}

	public function setConta($conta = '') {
		$conta = preg_replace('/\D/','',$conta);
		$this->conta = $conta;
		return $this;
	}
	public function getConta() {
		return $this->conta;
	}

	public function setContaMovimento($conta_movimento = '') {
		$conta_movimento = preg_replace('/\D/','',$conta_movimento);
		$this->conta_movimento = $conta_movimento;
		return $this;
	}
	public function getContaMovimento() {
		return $this->conta_movimento;
	}

	public function setContaCobranca($conta_cobranca = '') {
		$conta_cobranca = preg_replace('/\D/','',$conta_cobranca);
		$this->conta_cobranca = $conta_cobranca;
		return $this;
	}
	public function getContaCobranca() {
		return $this->conta_cobranca;
	}

	public function setCarteira($carteira = 0) {
		$this->carteira = (int)$carteira;
		return $this;
	}
	public function getCarteira() {
		return $this->carteira;
	}
}