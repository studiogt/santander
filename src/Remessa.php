<?php

use Remessa\Header;
use Remessa\Movimento;
use Remessa\Trailer;



class Remessa {
	private $header;
	private $movimentos = array();
	private $trailer;
	private $beneficiario;

	public function __construct() {
		$this->setHeader(new Header());
		$this->setTrailer(new Trailer());
		$this->setBeneficiario(new Pessoa());

		$this->getHeader()->setSequencial(1);
		$this->getTrailer()->setSequencial(2);
	}

	public function setHeader(Header $header) {
		$this->header = $header;
		return $this;
	}
	public function getHeader() {
		return $this->header;
	}

	public function setTrailer(Trailer $trailer) {
		$this->trailer = $trailer;
		return $this;
	}
	public function getTrailer() {
		return $this->trailer;
	}

	public function setBeneficiario(Pessoa $beneficiario) {
		$this->beneficiario = $beneficiario;
		$this->getHeader()->setBeneficiario($beneficiario);
		foreach($this->movimentos as $movimento) {
			$movimento->setBeneficiario($beneficiario);
		}

		return $this;
	}
	public function getBeneficiario() {
		return $this->beneficiario;
	}

	public function addMovimento(Movimento $movimento) {

		$movimento->setBeneficiario($this->getBeneficiario());

		$this->movimentos[] = $movimento;

		$quantidade_documentos = $this->getTrailer()->getQuantidadeDocumentos() + 1;

		$movimento->setSequencial($quantidade_documentos+1);

		$sequencial = 2 + $quantidade_documentos;
		
		$total = $this->getTrailer()->getValorTotalTitulos()/100.0;
		$total += $movimento->getValorTitulo()/100.0;
		

		$this->getTrailer()
			->setQuantidadeDocumentos($quantidade_documentos)
			->setSequencial($sequencial)
			->setValorTotalTitulos($total);
		return $this;
	}

	public function getMovimento() {
		return $this->movimentos;
	}

	public function __toString() {
		$str = $this->getHeader()."\r\n";
		foreach($this->movimentos as $movimento) {
			$str .= $movimento."\r\n";
		}
		$str .= $this->getTrailer()."";
		return $str;
	}
}