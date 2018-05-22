<?php

namespace Santander\Boleto;
use Santander\Util;

class LinhaDigitavel {
	private $bar_code;

	public function __construct() {
		$this->bar_code = new BarCode();
	}

	public function setBarCode(BarCode $bar_code) {
		$this->bar_code = $bar_code;
		return $this;
	}
	public function getBarCode() {
		return $this->bar_code;
	}


	public static function getDV($str) {
		$str = preg_replace('/\D/','',$str);
		return Util::modulo10($str);
	}

	public function getCodigoBeneficiario() {
		return Util::format('9(7)', $this->getBarCode()->getCodigoBeneficiario());
	}

	public function getNossoNumero() {
		return Util::format('9(13)', $this->getBarCode()->getNossoNumero());
	}

	public function getPrimeiroGrupo() {
		$data = array();
		$data[] = Util::format('9(03)', $this->getBarCode()->getBeneficiario()->getDadosBancarios()->getBanco()->getCodigo());
		$data[] = Util::format('9(01)', 9);
		$data[] = Util::format('9(01)', 9);
		$data[] = Util::format('9(04)', substr($this->getCodigoBeneficiario(),0, 4));

		$str = join('', $data);

		return $str.= '.' . Util::format('9(01)', $this->getDV($str));
	}

	public function getSegundoGrupo() {
		$data = array();
		$data[] = Util::format('9(03)', substr($this->getCodigoBeneficiario(),4));
		$data[] = Util::format('9(07)', substr($this->getNossoNumero(), 0, 7));
		
		$str = join('',$data);
		
		return $str.= '.' . Util::format('9(01)', $this->getDV($str));
	}

	public function getTerceiroGrupo() {
		$data = array();
		//$data[] = Util::format('9(06)', substr($this->getNossoNumero(), 6, 6));

		
		$data[] = substr($this->getBarCode()->getCampoLivre(),15,10);

		//$data[] = Util::format('9(01)', 0);
		//$data[] = Util::format('9(03)', $this->getBarCode()->getTipoModalidadeCarteira());
		
		$str = join('', $data);
		
		//return $str.= '.' . Util::format('9(01)', $this->getDV($str));
		return $str.= '.' . Util::format('9(01)', Util::modulo10($str));
	}

	public function getQuartoGrupo() {
		return $this->getBarCode()->getDV();
	}

	public function getQuintoGrupo() {
		$data = array();
		$data[] = Util::format('9(04)', $this->getBarCode()->getFatorVencimento());
		$data[] = Util::format('9(10)', $this->getBarCode()->getValorNominal());

		return join($data);
	}

	public function toString() {
		try {
			$data = array();
			$data[] = $this->getPrimeiroGrupo();
			$data[] = $this->getSegundoGrupo();
			$data[] = $this->getTerceiroGrupo();
			$data[] = $this->getQuartoGrupo();
			$data[] = $this->getQuintoGrupo();

			return join(' ',$data);

		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function __toString() {
		return $this->toString();
	}
}