<?php

namespace Retorno;

use Util;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase {

	public function testExpre() {
		$header = new \Retorno\Header();
		$regexp = $header->getRegexp();		

		$this->assertEquals('/^(?P<codigo_registro>\d{1})(?P<codigo_remessa>\d{1})(?P<literal_transmissao>.{7})(?P<codigo_servico>\d{2})(?P<literal_servico>.{15})(?P<codigo_agencia_beneficiario>\d{4})(?P<conta_movimento_beneficiario>\d{8})(?P<conta_cobranca_beneficiario>\d{8})(?P<nome_beneficiario>.{30})(?P<codigo_banco>\d{3})(?P<nome_banco>.{15})(?P<data_movimento>\d{6})(?P<densidade_gravacao>\d{8})(?P<brancos_109_385>.{277})(?P<sigla_empresa_sistema>.{4})(?P<brancos_390_391>.{2})(?P<numero_versao>\d{3})(?P<sequencial>\d{6})$/u', $regexp);
	}

	public function lineProvider() {
		$line = Util::format('9(001)',0);
		$line .= Util::format('9(001)',2);
		$line .= Util::format('X(007)','RETORNO');
		$line .= Util::format('9(002)',1);
		$line .= Util::format('X(015)','COBRANÇA');
		$line .= Util::format('9(004)', 1234);
		$line .= Util::format('9(008)', 12345678);
		$line .= Util::format('9(008)', 87654321);
		$line .= Util::format('X(030)', 'LOREM IPSUM');
		$line .= Util::format('9(003)', 33);
		$line .= Util::format('X(015)', 'SANTANDER');
		$line .= Util::format('9(006)', date('dmy'));
		$line .= Util::format('9(008)', 1600);
		$line .= Util::format('X(277)', ' ');
		$line .= Util::format('X(004)', 'SIGL');
		$line .= Util::format('X(002)', ' ');
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

		$header = new \Retorno\Header();
		$header->parseLine($line);

		$this->assertEquals(0, $header->getCodigoRegistro());
		$this->assertEquals(2, $header->getCodigoRemessa());
		$this->assertEquals('RETORNO', $header->getLiteralTransmissao());
		$this->assertEquals(1, $header->getCodigoServico());
		$this->assertEquals('COBRANÇA', $header->getLiteralServico());
		$this->assertEquals(1234, $header->getCodigoAgenciaBeneficiario());
		$this->assertEquals(12345678, $header->getContaMovimentoBeneficiario());
		$this->assertEquals(87654321, $header->getContaCobrancaBeneficiario());
		$this->assertEquals('LOREM IPSUM', $header->getNomeBeneficiario());
		$this->assertEquals(33, $header->getCodigoBanco());
		$this->assertEquals('SANTANDER', $header->getNomeBanco());
		$this->assertEquals(date('Y-m-d'), $header->getDataMovimento());
		$this->assertEquals(1600, $header->getDensidadeGravacao());
		$this->assertEquals('SIGL', $header->getSiglaEmpresaSistema());
		$this->assertEquals(217, $header->getNumeroVersao());
		$this->assertEquals(1, $header->getSequencial());

	}
}