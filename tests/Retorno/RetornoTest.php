<?php

namespace Retorno;

use Util;
use PHPUnit\Framework\TestCase;



class RetornoTest extends TestCase {

	
	public function headerLineProvider() {
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
	 * @dataProvider headerLineProvider
	 */
	public function testHeader($line) {
		$retorno = new \Retorno();
		$retorno->parseString($line);
		$header = $retorno->getHeader();


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

	public function trailerLineProvider() {
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
	 * @dataProvider trailerLineProvider
	 */
	public function testTrailer($line = '') {


		$retorno = new \Retorno();
		$retorno->parseString($line);
		$trailer = $retorno->getTrailer();


		$this->assertEquals(9, $trailer->getCodigoRegistro());
		$this->assertEquals(2, $trailer->getCodigoRemessa());
		$this->assertEquals(1, $trailer->getCodigoServico());

		$this->assertEquals(33, $trailer->getCodigoBanco());


		$this->assertEquals(217, $trailer->getNumeroVersao());
		$this->assertEquals(1, $trailer->getSequencial());
	}

	public function movimentoLineProvider() {
		$line =  Util::format('9(001)', 1);//codigo_registro
		$line .= Util::format('9(002)', 1);//tipo_inscricao_beneficiario
		$line .= Util::format('9(014)', '007.550.710-26');//cnpj_cpf_beneficiario
		$line .= Util::format('9(004)', '4056');//codigo_agencia_beneficiario
		$line .= Util::format('9(008)', '095674');//conta_movimento_beneficiario
		$line .= Util::format('9(008)', '095674');//conta_cobranca_beneficiario
		$line .= Util::format('X(025)', '1234567890');//numero_controle_participante
		$line .= Util::format('9(008)', '12345678');//nosso_numero
		$line .= Util::format('X(037)', '');//brancos_071_107
		$line .= Util::format('9(001)', 5);//codigo_carteira
		$line .= Util::format('9(002)', '06');//codigo_ocorrencia
		$line .= Util::format('9(006)', date('dmy'));//data_ocorrencia
		$line .= Util::format('X(010)', '1234567890');//seu_numero
		$line .= Util::format('9(008)', '12345678');//nosso_numero_127_134
		$line .= Util::format('9(002)', 0);//codigo_original_remessa
		$line .= Util::format('X(003)', '001');//codigo_erro_1
		$line .= Util::format('X(003)', '002');//codigo_erro_2
		$line .= Util::format('X(003)', '003');//codigo_erro_3
		$line .= Util::format('X(001)', '');//brancos_146_146
		$line .= Util::format('9(006)', date('dmy'));//data_vencimento_titulo
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_titulo_moeda_corrente
		$line .= Util::format('9(003)', 33);//numero_banco_cobrador
		$line .= Util::format('9(005)', '4056');//codigo_agencia_recebedora
		$line .= Util::format('9(002)', '01');//especie_documento
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_tarifa_cobrada
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_outras_despesas
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_juros_atraso
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_iof_devido
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_abatimento_concedido
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_desconto_concedido
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_total_recebido
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_juros_mora
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_outros_creditos
		$line .= Util::format('X(001)', '');//branco_293_293
		$line .= Util::format('X(001)', 'N');//codigo_aceite
		$line .= Util::format('X(001)', '');//branco_295_295
		$line .= Util::format('9(006)', date('dmy'));//data_credito
		$line .= Util::format('X(036)', 'LOREM IPSUM');//nome_pagador
		$line .= Util::format('X(001)', 'I');//identificador_complemento
		$line .= Util::format('X(002)', '00');//unidade_moeda_corrente
		$line .= Util::format('9(008)v9(5)', 12.34);//valor_titulo_outra_unidade
		$line .= Util::format('9(008)v9(5)', 12.34);//valor_iof_outra_unidade
		$line .= Util::format('9(011)v9(2)', 12.34);//valor_debito_credito
		$line .= Util::format('X(001)', 'C');//debito_credito
		$line .= Util::format('X(003)', '');//brancos_381_383
		$line .= Util::format('9(002)', 1);//complemento
		$line .= Util::format('X(004)', 'SIGL');//sigla_empresa_sistema
		$line .= Util::format('X(002)', '');//brancos_390_391
		$line .= Util::format('9(003)', 217);//numero_versao
		$line .= Util::format('9(006)', 2);//sequencial
		
		return array(
			array($line)
		);
	}


	/**
	 * @dataProvider movimentoLineProvider
	 */
	public function testMovimento($line) {
		$retorno = new \Retorno();
		$retorno->parseString($line);

		$movimentos = $retorno->getMovimentos();



		foreach($movimentos as $movimento) {
			$this->assertEquals(1, $movimento->getCodigoRegistro());
			$this->assertEquals(1, $movimento->getTipoInscricaoBeneficiario());

			$this->assertEquals('00755071026', $movimento->getCnpjCpfBeneficiario());
			$this->assertEquals(4056, $movimento->getCodigoAgenciaBeneficiario());
			$this->assertEquals(95674, $movimento->getContaMovimentoBeneficiario());
			$this->assertEquals(95674, $movimento->getContaCobrancaBeneficiario());
			$this->assertEquals('1234567890', $movimento->getNumeroControleParticipante());
			$this->assertEquals(5, $movimento->getCodigoCarteira());
			$this->assertEquals(6, $movimento->getCodigoOcorrencia());
			$this->assertEquals(date('Y-m-d'), $movimento->getDataOcorrencia());
			$this->assertEquals('1234567890', $movimento->getSeuNumero());
			$this->assertEquals(12345678, $movimento->getNossoNumero());
			$this->assertEquals(0, $movimento->getCodigoOriginalRemessa());
			$this->assertEquals('001', $movimento->getCodigoErro1());
			$this->assertEquals('002', $movimento->getCodigoErro2());
			$this->assertEquals('003', $movimento->getCodigoErro3());
			$this->assertEquals(date('Y-m-d'), $movimento->getDataVencimentoTitulo());
			$this->assertEquals(12.34, $movimento->getValorTituloMoedaCorrente());
			$this->assertEquals(33, $movimento->getNumeroBancoCobrador());
			$this->assertEquals(4056, $movimento->getCodigoAgenciaRecebedora());
			$this->assertEquals(1, $movimento->getEspecieDocumento());
			$this->assertEquals(12.34, $movimento->getValorTarifaCobrada());
			$this->assertEquals(12.34, $movimento->getValorOutrasDespesas());
			$this->assertEquals(12.34, $movimento->getValorJurosAtraso());
			$this->assertEquals(12.34, $movimento->getValorIofDevido());
			$this->assertEquals(12.34, $movimento->getValorAbatimentoConcedido());
			$this->assertEquals(12.34, $movimento->getValorDescontoConcedido());
			$this->assertEquals(12.34, $movimento->getValorTotalRecebido());
			$this->assertEquals(12.34, $movimento->getValorJurosMora());
			$this->assertEquals(12.34, $movimento->getValorOutrosCreditos());
			$this->assertEquals('N', $movimento->getCodigoAceite());
			$this->assertEquals(date('Y-m-d'), $movimento->getDataCredito());
			$this->assertEquals('LOREM IPSUM', $movimento->getNomePagador());
			$this->assertEquals('I', $movimento->getIdentificadorComplemento());
			$this->assertEquals('00', $movimento->getUnidadeMoedaCorrente());
			$this->assertEquals(12.34, $movimento->getValorTituloOutraUnidade());
			$this->assertEquals(12.34, $movimento->getValorIofOutraUnidade());
			$this->assertEquals(12.34, $movimento->getValorDebitoCredito());
			$this->assertEquals('C', $movimento->getDebitoCredito());
			$this->assertEquals(1, $movimento->getComplemento());
			$this->assertEquals('SIGL', $movimento->getSiglaEmpresaSistema());
			$this->assertEquals(217, $movimento->getNumeroVersao());
			$this->assertEquals(2, $movimento->getSequencial());
		}
	}

}