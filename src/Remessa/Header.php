<?php

namespace Remessa;

use Util;
use Pessoa;

class Header {
	private $beneficiario;
	public function setBeneficiario(Pessoa $beneficiario) {
		$this->beneficiario = $beneficiario;
		return $this;
	}
	public function getBeneficiario() {
		return $this->beneficiario;
	}


	//001-001: 9(001)
	private $codigo_registro;
	public function setCodigoRegistro($codigo_registro = 0) {
		$this->codigo_registro = Util::format('9(001)', $codigo_registro);
	}
	public function getCodigoRegistro() {
		return $this->codigo_registro;
	}

	//002-002: 9(001)
	private $codigo_remessa;
	public function setCodigoRemessa($codigo_remessa = 1) {
		$this->codigo_remessa = Util::format('9(001)', $codigo_remessa);
	}
	public function getCodigoRemessa() {
		return $this->codigo_remessa;
	}

	//003-009: X(007)
	private $literal_transmissao;
	public function setLiteralTransmissao($literal_transmissao = "REMESSA") {
		$this->literal_transmissao = Util::format('X(007)', $literal_transmissao);
	}
	public function getLiteralTransmissao() {
		return $this->literal_transmissao;
	}

	//010-011: 9(002)
	private $codigo_servico;
	public function setCodigoServico($codigo_servico = 1) {
		$this->codigo_servico = \Util::format('9(002)', $codigo_servico);
	}
	public function getCodigoServico() {
		return $this->codigo_servico;
	}

	//012-026: X(015)
	private $literal_servico;
	public function setLiteralServico($literal_servico = 'COBRANÇA') {
		$this->literal_servico = \Util::format('X(015)', $literal_servico);
	}
	public function getLiteralServico() {
		return $this->literal_servico;
	}

	//027-046: 9(020)
	private $codigo_transmissao;
	public function setCodigoTransmissao($codigo_transmissao = "") {
		$this->codigo_transmissao = \Util::format('9(020)',$codigo_transmissao);
		return $this;
	}
	public function getCodigoTransmissao() {
		return $this->codigo_transmissao;
	}

	//047-076: X(030)
	private $nome_beneficiario;
	public function setNomeBeneficiario($nome_beneficiario = "") {
		$this->getBeneficiario()->setNome($nome_beneficiario);
		return $this;
	}
	public function getNomeBeneficiario() {
		return Util::format('X(030)',$this->getBeneficiario()->getNome());
	}

	//077-079: 9(003);
	private $codigo_banco;
	public function setCodigoBanco($codigo_banco = 33) {
		$this->getBeneficiario()->getDadosBancarios()->getBanco()->setCodigo($codigo_banco);
		return $this;
	}
	public function getCodigoBanco() {
		return Util::format('9(003)',$this->getBeneficiario()->getDadosBancarios()->getBanco()->getCodigo());
	}

	//080-094: X(015);
	private $nome_banco;
	public function setNomeBanco($nome_banco = "SANTANDER") {
		$this->getBeneficiario()->getDadosBancarios()->getBanco()->setNome($nome_banco);
		return $this;
	}
	public function getNomeBanco() {
		return Util::format('X(015)',$this->getBeneficiario()->getDadosBancarios()->getBanco()->getNome());
	}

	//095-100: 9(006)
	private $data_gravacao;
	public function setDataGravacao($data_gravacao) {
		$data_gravacao = date("dmy",strtotime($data_gravacao));

		$this->data_gravacao = Util::format("9(006)",$data_gravacao);
		return $this;
	}
	public function getDataGravacao() {
		return $this->data_gravacao;
	}

	//101-116: 9(016)
	//zeros

	//117-163: X(047)
	//164-210: X(047)
	//211-257: X(047)
	//258-304: X(047)
	//305-351: X(047)
	private $mensagens = array();
	public function addMensagem($mensagem = '') {
		$this->mensagens[] = \Util::format("X(047)", $mensagem);
		return $this;
	}
	public function getMensagens() {
		return $this->mensagens;
	}
	public function setMensagem($mensagem = '', $numero = 1) {
		$index = (int)$numero - 1;
		$this->mensagem[$index] = \Util::format('X(047)',$mensagem);
		return $this;
	}
	public function getMensagem($numero = 1) {
		$index = (int)$numero - 1;
		return isset($this->mensagens[$index])?$this->mensagens[$index]:'';
	}

	//353-385: X(034)
	//386-391: X(006)
	//brancos

	//392-394: 9(003)
	private $versao_remessa;
	public function setVersaoRemessa($versao_remessa = 217) {
		$this->versao_remessa = \Util::format('9(003)', $versao_remessa);
	}
	public function getVersaoRemessa() {
		return $this->versao_remessa;
	}

	//395-400: 9(006)
	private $sequencial;
	public function setSequencial($sequencial = 1) {
		$this->sequencial = \Util::format('9(006)',$sequencial);
	}
	public function getSequencial() {
		return $this->sequencial;
	}

	public function __construct($codigo_transmissao = null, $nome_beneficiario = null, $data_gravacao = null) {
		$this->setBeneficiario(new Pessoa());
		$this->setCodigoRegistro(0);
		$this->setCodigoRemessa(1);
		$this->setLiteralTransmissao('REMESSA');
		$this->setCodigoServico(1);
		$this->setLiteralServico('COBRANÇA');
		$this->setCodigoBanco(33);
		$this->setNomeBanco("SANTANDER");

		if (null == $data_gravacao) {
			$this->setDataGravacao(date('Y-m-d'));
		} else {
			$this->setDataGravacao($data_gravacao);
		}

		$this->setVersaoRemessa(217);
		$this->setSequencial(1);

		$this->setCodigoTransmissao($codigo_transmissao);
		$this->setNomeBeneficiario($nome_beneficiario);
	}

	public function __toString() {
		try {
			$str = '';
			$codigo_registro = $this->getCodigoRegistro();

			$codigo_remessa = $this->getCodigoRemessa();
			$literal_transmissao = $this->getLiteralTransmissao();
			$codigo_servico = $this->getCodigoServico();
			$literal_servico = $this->getLiteralServico();
			$codigo_transmissao = $this->getCodigoTransmissao();
			$nome_beneficiario = $this->getNomeBeneficiario();
			$codigo_banco = $this->getCodigoBanco();
			$nome_banco = $this->getNomeBanco();
			$data_gravacao = $this->getDataGravacao();
			$mensagem = $this->getMensagens();
			$versao_remessa = $this->getVersaoRemessa();
			$sequencial = $this->getSequencial();

			$str = "{$codigo_registro}{$codigo_remessa}{$literal_transmissao}{$codigo_servico}{$literal_servico}{$codigo_transmissao}{$nome_beneficiario}{$codigo_banco}{$nome_banco}{$data_gravacao}";

			//zeros
			$str .= \Util::str_pad("", 16, '0');

			//mensagens
			$mensagens = $this->getMensagens();
			for($i=count($mensagens); $i<5; $i++) {
				$this->addMensagem('');
			}
			$mensagens = $this->getMensagens();
			foreach($mensagens as $mensagem) {
				$str .= $mensagem;
			}

			//brancos
			$str .= \Util::str_pad(" ", 40, ' ');

			$str .= "{$versao_remessa}{$sequencial}";

			return $str;

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}
}