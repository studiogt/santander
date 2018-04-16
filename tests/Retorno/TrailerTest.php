<?php

namespace Tests\Retorno;

use Util;
use PHPUnit\Framework\TestCase;

class TrailerTest extends TestCase {

	public function testExpre() {
		$trailer = new \Retorno\Trailer();
		$regexp = $trailer->getRegexp();		

		$this->assertEquals('/^(?P<codigo_registro>\d{1})(?P<codigo_remessa>\d{1})(?P<codigo_servico>\d{2})(?P<codigo_banco>\d{3})(?P<brancos_008_017>.{10})(?P<qtd_registros_simples>\d{8})(?P<valor_titulos_simples>\d{14})(?P<numero_aviso_simples>\d{8})(?P<brancos_048_057>.{10})(?P<zeros_058_087>\d{30})(?P<brancos_088_097>.{10})(?P<qtd_registros_caucionada>\d{8})(?P<valor_titulos_caucionada>\d{14})(?P<numero_aviso_caucionada>\d{8})(?P<brancos_128_137>.{10})(?P<qtd_registros_descontada>\d{8})(?P<valor_titulos_descontada>\d{14})(?P<numero_aviso_descontada>\d{8})(?P<brancos_168_391>.{224})(?P<numero_versao>\d{3})(?P<sequencial>\d{6})$/u', $regexp);
	}

	public static function lineProvider() {
		$line = Util::format('9(001)',9);
		$line .= Util::format('9(001)',2);		
		$line .= Util::format('9(002)',1);

		
		$line .= Util::format('9(003)', 33);
		$line .= Util::format('X(010)', ' ');

		$line .= Util::format('9(008)', 1);
		$line .= Util::format('9(012)v9(2)', 12.34);
		$line .= Util::format('9(008)', 5);

		$line .= Util::format('X(010)', ' ');
		$line .= Util::format('9(030)', 0);
		$line .= Util::format('X(010)', ' ');

		$line .= Util::format('9(008)', 1);
		$line .= Util::format('9(012)v9(2)', 12.34);
		$line .= Util::format('9(008)', 5);

		$line .= Util::format('X(010)', ' ');

		$line .= Util::format('9(008)', 1);
		$line .= Util::format('9(012)v9(2)', 12.34);
		$line .= Util::format('9(008)', 5);

		$line .= Util::format('X(224)', ' ');


		$line .= Util::format('9(003)', 217);
		$line .= Util::format('9(006)', 1);
		
		return array(
			array($line)
		);
	}

	/**
	 * @dataProvider lineProvider
	 */
	public function testParse($line) {

		$trailer = new \Retorno\Trailer();
		$trailer->parseLine($line);

		$this->assertEquals(9, $trailer->getCodigoRegistro());
		$this->assertEquals(2, $trailer->getCodigoRemessa());
		$this->assertEquals(1, $trailer->getCodigoServico());

		$this->assertEquals(33, $trailer->getCodigoBanco());


		$this->assertEquals(217, $trailer->getNumeroVersao());
		$this->assertEquals(1, $trailer->getSequencial());

	}
}