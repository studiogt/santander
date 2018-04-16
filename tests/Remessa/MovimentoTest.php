<?php

namespace Remessa;

use PHPUnit\Framework\TestCase;

class MovimentoTest extends TestCase {

	public function movimentoProvider() {
		$movimento = new \Remessa\Movimento();
		$movimento->setCnpjCpfBeneficiario('007.550.710-26');
		$movimento->setCodigoAgenciaBeneficiario('');
		$movimento->setContaMovimentoBeneficiario('');
		$movimento->setContaCobrancaBeneficiario('');
		$movimento->setNumeroControleParticipante('1234567890');
		$movimento->setNossoNumero('12345678');
		$movimento->setCodigoCarteira(5);
		$movimento->setCodigoOcorrencia(1);
		$movimento->setSeuNumero('1234567890');
		$movimento->setDataVencimentoTitulo(date('Y-m-d'));
		$movimento->setValorTitulo(12.34);
		$movimento->setCodigoAgenciaCobradora('');
		$movimento->setDataEmissaoTitulo(date('Y-m-d'));
		$movimento->setCnpjCpfPagador('007.550.710-26');
		$movimento->setNomePagador("Lorem Ipsum");
		$movimento->setEnderecoPagador("Almirante Barroso, 735 sala 402");
		$movimento->setBairroPagador("Floresta");
		$movimento->setCepPagador("90220-021");
		$movimento->setMunicipioPagador("Porto Alegre");
		$movimento->setUfPagador('RS');
		$movimento->setComplemento("");
		$movimento->setSequencial(2);

		return array(array($movimento));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCodigoRegistro($movimento) {
		$this->assertEquals(1,mb_strlen($movimento->getCodigoRegistro()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetTipoInscricaoBeneficiario($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getTipoInscricaoBeneficiario()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCnpjCpfBeneficiario($movimento) {
		$this->assertEquals(14,mb_strlen($movimento->getCnpjCpfBeneficiario()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCodigoAgenciaBeneficiario($movimento) {
		$this->assertEquals(4,mb_strlen($movimento->getCodigoAgenciaBeneficiario()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetContaMovimentoBeneficiario($movimento) {
		$this->assertEquals(8,mb_strlen($movimento->getContaMovimentoBeneficiario()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetContaCobrancaBeneficiario($movimento) {
		$this->assertEquals(8,mb_strlen($movimento->getContaCobrancaBeneficiario()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetNumeroControleParticipante($movimento) {
		$this->assertEquals(25,mb_strlen($movimento->getNumeroControleParticipante()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetNossoNumero($movimento) {
		$this->assertEquals(8,mb_strlen($movimento->getNossoNumero()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetDataSegundoDesconto($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getDataSegundoDesconto()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetInformacaoMulta($movimento) {
		$this->assertEquals(1,mb_strlen($movimento->getInformacaoMulta()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetPercentualMultaAtraso($movimento) {
		$this->assertEquals(4,mb_strlen($movimento->getPercentualMultaAtraso()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetUnidadeValorMoedaCorrente($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getUnidadeValorMoedaCorrente()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorTituloOutraUnidade($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorTituloOutraUnidade()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetDataCobrancaMulta($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getDataCobrancaMulta()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCodigoCarteira($movimento) {
		$this->assertEquals(1,mb_strlen($movimento->getCodigoCarteira()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCodigoOcorrencia($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getCodigoOcorrencia()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetSeuNumero($movimento) {
		$this->assertEquals(10,mb_strlen($movimento->getSeuNumero()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetDataVencimentoTitulo($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getDataVencimentoTitulo()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorTitulo($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorTitulo()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetNumeroBancoCobrador($movimento) {
		$this->assertEquals(3,mb_strlen($movimento->getNumeroBancoCobrador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCodigoAgenciaCobradora($movimento) {
		$this->assertEquals(5,mb_strlen($movimento->getCodigoAgenciaCobradora()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetEspecieDocumento($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getEspecieDocumento()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetTipoAceite($movimento) {
		$this->assertEquals(1,mb_strlen($movimento->getTipoAceite()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetDataEmissaoTitulo($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getDataEmissaoTitulo()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetPrimeiraInstrucaoCobranca($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getPrimeiraInstrucaoCobranca()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetSegundaInstrucaoCobranca($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getSegundaInstrucaoCobranca()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorMoraDiaAtraso($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorMoraDiaAtraso()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetDataLimiteConcessaoDesconto($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getDataLimiteConcessaoDesconto()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorDescontoConcedido($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorDescontoConcedido()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorIof($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorIof()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetValorAbatimentoConcedido($movimento) {
		$this->assertEquals(13,mb_strlen($movimento->getValorAbatimentoConcedido()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetTipoInscricaoPagador($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getTipoInscricaoPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCnpjCpfPagador($movimento) {
		$this->assertEquals(14,mb_strlen($movimento->getCnpjCpfPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetNomePagador($movimento) {
		$this->assertEquals(40,mb_strlen($movimento->getNomePagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetEnderecoPagador($movimento) {
		$this->assertEquals(40,mb_strlen($movimento->getEnderecoPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetBairroPagador($movimento) {
		$this->assertEquals(12,mb_strlen($movimento->getBairroPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetCepPagador($movimento) {
		$this->assertEquals(8,mb_strlen($movimento->getCepPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetMunicipioPagador($movimento) {
		$this->assertEquals(15,mb_strlen($movimento->getMunicipioPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetUfPagador($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getUfPagador()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetIdentificadorComplemento($movimento) {
		$this->assertEquals(1,mb_strlen($movimento->getIdentificadorComplemento()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetComplemento($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getComplemento()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetNumeroDiasProtesto($movimento) {
		$this->assertEquals(2,mb_strlen($movimento->getNumeroDiasProtesto()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */
	public function testGetSequencial($movimento) {
		$this->assertEquals(6,mb_strlen($movimento->getSequencial()));
	}

	/**
	 * @dataProvider movimentoProvider
	 */

	public function testToStringSize($movimento) {
		$this->assertEquals(400, mb_strlen($movimento.'','UTF-8'));
	}
}