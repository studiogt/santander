<?php

namespace Retorno;

use Util;
use PHPUnit\Framework\TestCase;

class MovimentoTest extends TestCase {

	public function testExpre() {
		$movimento = new \Retorno\Movimento();
		$regexp = $movimento->getRegexp();		

		$this->assertEquals('/^(?P<codigo_registro>\d{1})(?P<tipo_inscricao_beneficiario>\d{2})(?P<cnpj_cpf_beneficiario>\d{14})(?P<codigo_agencia_beneficiario>\d{4})(?P<conta_movimento_beneficiario>\d{8})(?P<conta_cobranca_beneficiario>\d{8})(?P<numero_controle_participante>.{25})(?P<nosso_numero>\d{8})(?P<brancos_071_107>.{37})(?P<codigo_carteira>\d{1})(?P<codigo_ocorrencia>\d{2})(?P<data_ocorrencia>\d{6})(?P<seu_numero>.{10})(?P<nosso_numero_127_134>\d{8})(?P<codigo_original_remessa>\d{2})(?P<codigo_erro_1>.{3})(?P<codigo_erro_2>.{3})(?P<codigo_erro_3>.{3})(?P<brancos_146_146>.{1})(?P<data_vencimento_titulo>\d{6})(?P<valor_titulo_moeda_corrente>\d{13})(?P<numero_banco_cobrador>\d{3})(?P<codigo_agencia_recebedora>\d{5})(?P<especie_documento>\d{2})(?P<valor_tarifa_cobrada>\d{13})(?P<valor_outras_despesas>\d{13})(?P<valor_juros_atraso>\d{13})(?P<valor_iof_devido>\d{13})(?P<valor_abatimento_concedido>\d{13})(?P<valor_desconto_concedido>\d{13})(?P<valor_total_recebido>\d{13})(?P<valor_juros_mora>\d{13})(?P<valor_outros_creditos>\d{13})(?P<branco_293_293>.{1})(?P<codigo_aceite>.{1})(?P<branco_295_295>.{1})(?P<data_credito>\d{6})(?P<nome_pagador>.{36})(?P<identificador_complemento>.{1})(?P<unidade_moeda_corrente>.{2})(?P<valor_titulo_outra_unidade>\d{13})(?P<valor_iof_outra_unidade>\d{13})(?P<valor_debito_credito>\d{13})(?P<debito_credito>.{1})(?P<brancos_381_383>.{3})(?P<complemento>\d{2})(?P<sigla_empresa_sistema>.{4})(?P<brancos_390_391>.{2})(?P<numero_versao>\d{3})(?P<sequencial>\d{6})$/u', $regexp);
	}

	public function lineProvider() {
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
	 * @dataProvider lineProvider
	 */
	public function testParse($line) {

		$movimento = new \Retorno\Movimento();
		$movimento->parseLine($line);

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