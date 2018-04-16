<?php

namespace Remessa;

use PHPUnit\Framework\TestCase;

class RemessaTest extends TestCase {

	public function remessaProvider() {
		$remessa = new \Remessa();
		$remessa->getBeneficiario()
					->setNome("TESTE STUDIOGT")
					->getDocumento()
						->setNumero('007.550.710-26')
					;
		$remessa->getBeneficiario()
					->getEndereco()
						->setCEP('90220-021')
						->setLogradouro("Almirante Barroso, 735 sala 402")
						->setBairro('Floresta')
						->setCidade('Porto Alegre')
						->setUF('RS');
		$remessa->getBeneficiario()
					->getDadosBancarios()
						->setAgencia('0923')
						->setConta('130010375')
						->setCarteira(5)
						->getBanco()
							->setCodigo(33)
							->setNome('SANTANDER');
		$remessa->getHeader()
					->setCodigoTransmissao('09230953670101300103')
					->setDataGravacao(date('Y-m-d'))
					->addMensagem("Mensagem 1")
					->addMensagem("Mensagem 2")
					->addMensagem("Mensagem 3")
					->addMensagem("Mensagem 4")
					->addMensagem("Mensagem 5");

		$movimento = new \Remessa\Movimento();

		$movimento->setNumeroControleParticipante('1234567890');
		$movimento->setNossoNumero('12345678');
		$movimento->setCodigoOcorrencia(1);
		$movimento->setSeuNumero('1234567890');
		$movimento->setDataVencimentoTitulo(date('Y-m-d'));
		$movimento->setValorTitulo(12.34);
		$movimento->setDataEmissaoTitulo(date('Y-m-d'));
		$movimento->setCnpjCpfPagador('007.550.710-26');
		$movimento->setNomePagador("Lorem Ipsum");
		$movimento->setEnderecoPagador("Almirante Barroso, 735 sala 402");
		$movimento->setBairroPagador("Floresta");
		$movimento->setCepPagador("90220-021");
		$movimento->setMunicipioPagador("Porto Alegre");
		$movimento->setUfPagador('RS');
		$movimento->setComplemento("");		

		$remessa->addMovimento($movimento);


		return array(
			array($remessa)
		);
	}

	/**
	 * @dataProvider remessaProvider
	 */
	public function testLines($remessa) {
		$lines = str_replace("\r\n","\n", $remessa);
		$lines = explode("\n", $lines);
		
		
		$this->assertEquals(3, count($lines));
		foreach($lines as $line) {
			$this->assertEquals(400, mb_strlen($line,'UTF-8'));
		}
	}

	
}