<?php

namespace Remessa;

use PHPUnit\Framework\TestCase;

class TrailerTest extends TestCase {

	public function trailerProvider() {
		$documentos  = 15;
		$valor = 123.45;
		$sequencial = 3;
		$trailer = new \Remessa\Trailer($documentos, $valor, $sequencial);

		return array(
			array($trailer)
		);
	}

	/**
	 * @dataProvider trailerProvider
	 */
	public function testToStringSize($trailer) {
		$this->assertEquals(400, mb_strlen($trailer.'','UTF-8'));
	}

	/**
	 * @dataProvider trailerProvider
	 */
	public function testToString($trailer) {
		$this->assertEquals("9000015000000001234500000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000003", $trailer.'');
	}

}