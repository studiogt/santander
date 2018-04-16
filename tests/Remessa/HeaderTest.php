<?php

namespace Remessa;

use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase {

	public function headerProvider() {
		$codigo_transmissao = "01234568901234567890";
		$nome_beneficiario = "NOME DO BENEFICIARIO          ";
		$header = new \Remessa\Header($codigo_transmissao, $nome_beneficiario,date('Y-m-d'));

		$data = date('dmy');

		$mensagem1 = "mensagem______________________________________1";
		$mensagem2 = "mensagem______________________________________2";
		$mensagem3 = "mensagem______________________________________3";
		$mensagem4 = "mensagem______________________________________4";
		$mensagem5 = "mensagem______________________________________5";

		$header->addMensagem($mensagem1);
		$header->addMensagem($mensagem2);
		$header->addMensagem($mensagem3);
		$header->addMensagem($mensagem4);
		$header->addMensagem($mensagem5);

		return array(
			array($header)
		);
	}

	/**
	 * @dataProvider headerProvider
	 */
	public function testToStringSize($header) {
		$this->assertEquals(400, mb_strlen($header.'','UTF-8'));
	}

	/**
	  * @depends testToStringSize
	  * @dataProvider headerProvider
	  */
	public function testToStringContent($header) {
		$codigo_transmissao = "01234568901234567890";
		$nome_beneficiario = "NOME DO BENEFICIARIO          ";
		$data = date('dmy');

		$mensagem1 = "mensagem______________________________________1";
		$mensagem2 = "mensagem______________________________________2";
		$mensagem3 = "mensagem______________________________________3";
		$mensagem4 = "mensagem______________________________________4";
		$mensagem5 = "mensagem______________________________________5";
		$this->assertEquals("01REMESSA01COBRANÇA       {$codigo_transmissao}{$nome_beneficiario}033SANTANDER      {$data}0000000000000000{$mensagem1}{$mensagem2}{$mensagem3}{$mensagem4}{$mensagem5}                                        217000001", $header.'');
	}

}