<?php

namespace Santander\Remessa;

use Santander\Util;
use Santander\Pessoa;

class Movimento {

	private $beneficiario;
	public function setBeneficiario(Pessoa $beneficiario) {
		$this->beneficiario = $beneficiario;
		return $this;
	}
	public function getBeneficiario() {
		return $this->beneficiario;
	}
	
	private $pagador;
	public function setPagador(Pessoa $pagador) {
		$this->pagador = $pagador;
		return $this;
	}
	public function getPagador() {
		return $this->pagador;
	}

	public function __construct() {
		$this->setBeneficiario(new Pessoa());
		$this->setPagador(new Pessoa());

		$this->setCodigoRegistro(1);
		$this->setDataSegundoDesconto('');
		$this->setInformacaoMulta(0);
		$this->setPercentualMultaAtraso(0.0);
		$this->setUnidadeValorMoedaCorrente(0);
		$this->setValorTituloOutraUnidade(0.0);
		$this->setDataCobrancaMulta('');
		$this->setCodigoCarteira(5);
		$this->setCodigoOcorrencia(1);
		$this->setNumeroBancoCobrador(33);
		$this->setCodigoAgenciaCobradora(0);
		$this->setEspecieDocumento(1);
		$this->setTipoAceite('N');
		$this->setPrimeiraInstrucaoCobranca(2);
		$this->setSegundaInstrucaoCobranca(0);
		$this->setValorMoraDiaAtraso(0.0);
		$this->setDataLimiteConcessaoDesconto('');
		$this->setValorDescontoConcedido(0.0);
		$this->setValorIof(0.0);
		$this->setValorAbatimentoConcedido(0.0);
		$this->setNumeroDiasProtesto(0);
		$this->setIdentificadorComplemento('I');
	}

	//001-001: 9(001)
	private $codigo_registro;
	public function setCodigoRegistro($codigo_registro = 1) {
		$this->codigo_registro = Util::format('9(001)',$codigo_registro);
	}
	public function getCodigoRegistro() {
		return $this->codigo_registro;
	}

	//002-003: 9(002)
	/*
	 * 01 = CPF
	 * 02 = CNPJ
	 */
	private $tipo_inscricao_beneficiario;
	public function setTipoInscricaoBeneficiario($tipo_inscricao_beneficiario) {
		$this->getBeneficiario()->getDocumento()->setTipo($tipo_inscricao_beneficiario);
		return $this;
	}
	public function getTipoInscricaoBeneficiario() {
		return Util::format('9(002)', $this->getBeneficiario()->getDocumento()->getTipo());		
	}

	//004-017: 9(014)
	private $cpnj_cpf_beneficiario;
	public function setCnpjCpfBeneficiario($cpnj_cpf_beneficiario) {
		$this->getBeneficiario()->getDocumento()->setNumero($cpnj_cpf_beneficiario);
		return $this;
	}
	public function getCnpjCpfBeneficiario() {
		return Util::format('9(014)', $this->getBeneficiario()->getDocumento()->getNumero());
	}

	//018-021: 9(004)
	private $codigo_agencia_beneficiario;
	public function setCodigoAgenciaBeneficiario($codigo_agencia_beneficiario) {
		$this->getBeneficiario()->getDadosBancarios()->setAgencia($codigo_agencia_beneficiario);
		return $this;
	}
	public function getCodigoAgenciaBeneficiario() {
		return Util::format('9(004)', $this->getBeneficiario()->getDadosBancarios()->getAgencia());
	}

	//022-029: 9(008)
	private $conta_movimento_beneficiario;
	public function setContaMovimentoBeneficiario($conta_movimento_beneficiario) {
		$this->getBeneficiario()->getDadosBancarios()->setContaMovimento($conta_movimento_beneficiario);
		return $this;
	}
	public function getContaMovimentoBeneficiario() {
		return Util::format('9(008)', $this->getBeneficiario()->getDadosBancarios()->getContaMovimento());		
	}

	//030-037: 9(008)
	private $conta_cobranca_beneficiario;
	public function setContaCobrancaBeneficiario($conta_cobranca_beneficiario) {
		$this->getBeneficiario()->getDadosBancarios()->setContaCobranca($conta_cobranca_beneficiario);
		return $this;
	}
	public function getContaCobrancaBeneficiario() {
		return Util::format('9(008)', $this->getBeneficiario()->getDadosBancarios()->getContaCobranca());
	}

	//038-062: X(025)
	private $numero_controle_participante;
	public function setNumeroControleParticipante($numero_controle_participante) {
		$this->numero_controle_participante = Util::format('X(025)', $numero_controle_participante);
	}
	public function getNumeroControleParticipante() {
		return $this->numero_controle_participante;
	}

	//063-070: 9(008)
	private $nosso_numero;
	public function setNossoNumero($nosso_numero) {
		$this->nosso_numero = Util::format('9(008)', $nosso_numero);
	}
	public function getNossoNumero() {
		return $this->nosso_numero;
	}

	//071-076: 9(006)
	private $data_segundo_desconto;
	public function setDataSegundoDesconto($data_segundo_desconto = '') {
		if ('' != $data_segundo_desconto) {
			$data_segundo_desconto = date('dmy',strtotime($data_segundo_desconto));
		}
		$this->data_segundo_desconto = Util::format('9(006)',$data_segundo_desconto);
	}
	public function getDataSegundoDesconto() {
		return $this->data_segundo_desconto;
	}

	//077-077: X(001)
	//branco

	//078-078: 9(001)

	// 4 = com multa
	// 0 = sem multa
	private $informacao_multa;
	public function setInformacaoMulta($informacao_multa = 0) {
		$this->informacao_multa = Util::format('9(001)',$informacao_multa);
	}
	public function getInformacaoMulta() {
		return $this->informacao_multa;
	}

	//079-082: 9(2)v9(2)
	private $percentual_multa_atraso;
	public function setPercentualMultaAtraso($percentual_multa_atraso = 0.0) {
		$this->percentual_multa_atraso = Util::format('9(2)v9(2)', $percentual_multa_atraso);
	}
	public function getPercentualMultaAtraso() {
		return $this->percentual_multa_atraso;
	}

	//083-084: 9(002)
	private $unidade_valor_moeda_corrente;
	public function setUnidadeValorMoedaCorrente($unidade_valor_moeda_corrente = 0) {
		$this->unidade_valor_moeda_corrente = Util::format('9(002)', $unidade_valor_moeda_corrente);
	}
	public function getUnidadeValorMoedaCorrente() {
		return $this->unidade_valor_moeda_corrente;
	}

	//085-097: 9(8)v9(5)
	private $valor_titulo_outra_unidade;
	public function setValorTituloOutraUnidade($valor_titulo_outra_unidade = 0.0) {
		$this->valor_titulo_outra_unidade = Util::format('9(8)v9(5)', $valor_titulo_outra_unidade);
	}
	public function getValorTituloOutraUnidade() {
		return $this->valor_titulo_outra_unidade;
	}

	//098-101: X(004)
	//brancos

	//102-107: 9(006)
	private $data_cobranca_multa;
	public function setDataCobrancaMulta($data_cobranca_multa = '') {
		if ('' != $data_cobranca_multa) {
			$data_cobranca_multa = date('dmy',strtotime($data_cobranca_multa));
		}

		$this->data_cobranca_multa = Util::format('9(006)',$data_cobranca_multa);
	}
	public function getDataCobrancaMulta() {
		return $this->data_cobranca_multa;
	}

	//108-108: 9(001)
	/*
	 * 1 = eletronica com registro
	 * 3 = penhor eletronica
	 * 5 = rápida com registor (boleto emitido pelo cliente)
	 * 6 = penhor rápida
	 * 7 = desconto eletronico
	 */
	private $codigo_carteira;
	public function setCodigoCarteira($codigo_carteira = 5) {
		$this->getBeneficiario()->getDadosBancarios()->setCarteira($codigo_carteira);
		return $this;
	}
	public function getCodigoCarteira() {
		return Util::format('9(001)', $this->getBeneficiario()->getDadosBancarios()->getCarteira());
	}

	//109-110: 9(002)
	/*
	 * 01 = entrada de título
	 * 02 = baixa de título
	 * 04 = concessão de abatimento
	 * 05 = cancelamento de abatimento
	 * 06 = alteração de vencimento
	 * 07 = alteração do número da conta benefíciário
	 * 08 = alteração do seu número
	 * 09 = protestar
	 * 18 = sustar protesto (após início do ciclo de protesto)
	 * 98 = não protestar (antes do início do ciclo de protesto)
	 */
	private $codigo_ocorrencia;
	public function setCodigoOcorrencia($codigo_ocorrencia = 1) {
		$this->codigo_ocorrencia = Util::format('9(002)', $codigo_ocorrencia);
	}
	public function getCodigoOcorrencia() {
		return $this->codigo_ocorrencia;
	}

	//111-120: X(010)
	private $seu_numero;
	public function setSeuNumero($seu_numero) {
		$this->seu_numero = Util::format('X(010)', $seu_numero);
	}
	public function getSeuNumero() {
		return $this->seu_numero;
	}

	//121-126: 9(006)
	private $data_vencimento_titulo;
	public function setDataVencimentoTitulo($data_vencimento_titulo) {
		$data_vencimento_titulo = date('dmy',strtotime($data_vencimento_titulo));
		$this->data_vencimento_titulo = Util::format('9(006)',$data_vencimento_titulo);
	}
	public function getDataVencimentoTitulo() {
		return $this->data_vencimento_titulo;
	}

	//127-139: 9(011)v9(2)
	private $valor_titulo;
	public function setValorTitulo($valor_titulo) {
		$this->valor_titulo = Util::format('9(11)v9(2)',$valor_titulo);
	}
	public function getValorTitulo() {
		return $this->valor_titulo;
	}

	//140-142: 9(003)
	private $numero_banco_cobrador;
	public function setNumeroBancoCobrador($numero_banco_cobrador = 33) {
		$this->getBeneficiario()->getDadosBancarios()->getBanco()->setCodigo($numero_banco_cobrador);
		return $this;
	}
	public function getNumeroBancoCobrador() {
		return Util::format('9(003)', $this->getBeneficiario()->getDadosBancarios()->getBanco()->getCodigo());
	}

	//143-147: 9(005)
	private $codigo_agencia_cobradora;
	public function setCodigoAgenciaCobradora($codigo_agencia_cobradora) {
		$this->getBeneficiario()->getDadosBancarios()->setAgencia($codigo_agencia_cobradora);
		return $this;
	}
	public function getCodigoAgenciaCobradora() {
		return Util::format('9(005)', $this->getBeneficiario()->getDadosBancarios()->getAgencia());		
	}

	//148-149: 9(002)
	/*
	 * 01 = duplicata
	 * 02 = nota promissória
	 * 03 = apólice / nota de seguro
	 * 05 = recibo
	 * 06 = duplicata de serviço
	 * 07 = letra de cambio
	 * 08 = bdp - boleto de proposta
	 * 19 = bcc - boleto cartão de crédito
	 */
	private $especie_documento;
	public function setEspecieDocumento($especie_documento) {
		$this->especie_documento = Util::format('9(002)', $especie_documento);
	}
	public function getEspecieDocumento() {
		return $this->especie_documento;
	}

	//150-150: X(001)
	private $tipo_aceite;
	public function setTipoAceite($tipo_aceite = 'N') {
		$this->tipo_aceite = Util::format('X(001)', $tipo_aceite);
	}
	public function getTipoAceite() {
		return $this->tipo_aceite;
	}

	//151-156: 9(006)
	private $data_emissao_titulo;
	public function setDataEmissaoTitulo($data_emissao_titulo) {
		$data_emissao_titulo = date('dmy', strtotime($data_emissao_titulo));
		$this->data_emissao_titulo = Util::format('9(006)', $data_emissao_titulo);
	}
	public function getDataEmissaoTitulo() {
		return $this->data_emissao_titulo;
	}

	//157-158: 9(002);
	/*
	 * 00 = não há instruções
	 * 02 = baixar após quinze dias do vencimento
	 * 03 = baixar após 30 dias do venciemnto
	 * 04 = não baixar
	 * 06 = protestar (vide posição 392/393)
	 * 07 = não protestar
	 * 08 = não cobrar juros de mora
	 */
	private $primeira_instrucao_cobranca;
	public function setPrimeiraInstrucaoCobranca($primeira_instrucao_cobranca = 0) {
		$this->primeira_instrucao_cobranca = Util::format('9(002)', $primeira_instrucao_cobranca);
	}
	public function getPrimeiraInstrucaoCobranca() {
		return $this->primeira_instrucao_cobranca;
	}

	//159-160: 9(002);
	/*
	 * 00 = não há instruções
	 * 02 = baixar após quinze dias do vencimento
	 * 03 = baixar após 30 dias do venciemnto
	 * 04 = não baixar
	 * 06 = protestar (vide posição 392/393)
	 * 07 = não protestar
	 * 08 = não cobrar juros de mora
	 */
	private $segunda_instrucao_cobranca;
	public function setSegundaInstrucaoCobranca($segunda_instrucao_cobranca = 0) {
		$this->segunda_instrucao_cobranca = Util::format('9(002)', $segunda_instrucao_cobranca);
	}
	public function getSegundaInstrucaoCobranca() {
		return $this->segunda_instrucao_cobranca;
	}

	//161-173: 9(011)v9(2)
	private $valor_mora_dia_atraso;
	public function setValorMoraDiaAtraso($valor_mora_dia_atraso = 0.0) {
		$this->valor_mora_dia_atraso = Util::format('9(011)v9(2)', $valor_mora_dia_atraso);
	}
	public function getValorMoraDiaAtraso() {
		return $this->valor_mora_dia_atraso;
	}

	//174-179: 9(006)

	private $data_limite_concessao_desconto;
	public function setDataLimiteConcessaoDesconto($data_limite_concessao_desconto = '') {
		if ('' != $data_limite_concessao_desconto) {
			$data_limite_concessao_desconto = date('ymd', strtotime($data_limite_concessao_desconto));
		}
		$this->data_limite_concessao_desconto = Util::format('9(006)', $data_limite_concessao_desconto);
	}
	public function getDataLimiteConcessaoDesconto() {
		return $this->data_limite_concessao_desconto;
	}

	//180-192: 9(011)v9(2)
	private $valor_desconto_cencedido;
	public function setValorDescontoConcedido($valor_desconto_cencedido = 0.0) {
		$this->valor_desconto_cencedido = Util::format('9(011)v9(2)', $valor_desconto_cencedido);
	}
	public function getValorDescontoConcedido() {
		return $this->valor_desconto_cencedido;
	}

	//193-205: 9(8)v9(5)
	private $valor_iof;
	public function setValorIof($valor_iof = 0.0) {
		$this->valor_iof = Util::format('9(8)v9(5)', $valor_iof);
	}
	public function getValorIof() {
		return $this->valor_iof;
	}

	//206-218: 9(011)v9(2)
	private $valor_abatimento_concedido;
	public function setValorAbatimentoConcedido($valor_abatimento_concedido = 0.0) {
		$this->valor_abatimento_concedido = Util::format('9(011)v9(2)', $valor_abatimento_concedido);
	}
	public function getValorAbatimentoConcedido() {
		return $this->valor_abatimento_concedido;
	}

	//219-220: 9(002)
	/*
	 * 01 = CPF
	 * 02 = CNPJ
	 */
	private $tipo_inscricao_pagador;
	public function setTipoInscricaoPagador($tipo_inscricao_pagador = 1) {
		$this->getPagador()->getDocumento()->setTipo($tipo_inscricao_pagador);
		return $this;
	}
	public function getTipoInscricaoPagador() {
		return Util::format('9(002)', $this->getPagador()->getDocumento()->getTipo());
	}

	//221-234: 9(014)
	private $cnpj_cpf_pagador;
	public function setCnpjCpfPagador($cnpj_cpf_pagador) {
		$this->getPagador()->getDocumento()->setNumero($cnpj_cpf_pagador);
		return $this;
	}
	public function getCnpjCpfPagador() {
		return Util::format('9(014)', $this->getPagador()->getDocumento()->getNumero());
	}

	//235-274: X(040)
	private $nome_pagador;
	public function setNomePagador($nome_pagador) {
		$this->getPagador()->setNome($nome_pagador);
		return $this;
	}
	public function getNomePagador() {
		return Util::format('X(040)', $this->getPagador()->getNome());
	}

	//275-314: X(040)
	private $endereco_pagador;
	public function setEnderecoPagador($endereco_pagador) {
		$this->getPagador()->getEndereco()->setLogradouro($endereco_pagador);
		return $this;
	}
	public function getEnderecoPagador() {
		return Util::format('X(040)', $this->getPagador()->getEndereco()->getLogradouro());
	}

	//315-326: X(012)
	private $bairro_pagador;
	public function setBairroPagador($bairro_pagador) {
		$this->getPagador()->getEndereco()->setBairro($bairro_pagador);
		return $this;
	}
	public function getBairroPagador() {
		return Util::format("X(012)", $this->getPagador()->getEndereco()->getBairro());
	}

	//327-334: 9(008)
	private $cep_pagador;
	public function setCepPagador($cep_pagador) {
		$this->getPagador()->getEndereco()->setCEP($cep_pagador);
		return $this;
	}
	public function getCepPagador() {
		return Util::format('9(008)',$this->getPagador()->getEndereco()->getCEP());
	}

	//335-349: X(015)
	private $municipio_pagador;
	public function setMunicipioPagador($municipio_pagador) {
		$this->getPagador()->getEndereco()->setCidade($municipio_pagador);
		return $this;
	}
	public function getMunicipioPagador() {
		return Util::format('X(015)', $this->getPagador()->getEndereco()->getCidade());		
	}

	//350-351: X(002)
	private $uf_pagador;
	public function setUfPagador($uf) {
		$this->getPagador()->getEndereco()->setUF($uf);
		return $this;
	}
	public function getUfPagador() {
		return Util::format('X(002)', $this->getPagador()->getEndereco()->getUF());		
	}

	//352-382: X(031)
	//brancos

	//383-383: X(001)
	private $identificador_complemento;
	public function setIdentificadorComplemento($identificador_complemento) {
		$this->identificador_complemento = Util::format('X(001)', $identificador_complemento);
	}
	public function getIdentificadorComplemento() {
		return $this->identificador_complemento;
	}

	//384-385: 9(002)
	private $complemento;
	public function setComplemento($complemento) {
		$this->complemento = Util::format('X(002)',$complemento);

	}
	public function getComplemento() {
		return $this->complemento;
	}

	//386-391: X(006)
	//brancos

	//392-293: 9(002)
	private $numero_dias_protesto;
	public function setNumeroDiasProtesto($numero_dias_protesto) {
		$this->numero_dias_protesto = Util::format('9(002)', $numero_dias_protesto);
	}
	public function getNumeroDiasProtesto() {
		return $this->numero_dias_protesto;
	}

	//394-394: X(001)
	//branco

	//395-400: 9(006)
	private $sequencial;
	public function setSequencial($sequencial = 0) {
		$this->sequencial = Util::format('9(006)',$sequencial);
	}
	public function getSequencial() {
		return $this->sequencial;
	}

	public function __toString() {

		error_log("cpf/cnpj: ".$this->getCnpjCpfBeneficiario().' - '.$this->getTipoInscricaoBeneficiario());

		$dados = array();
		$dados[] = $this->getCodigoRegistro();
		$dados[] = $this->getTipoInscricaoBeneficiario();
		$dados[] = $this->getCnpjCpfBeneficiario();
		$dados[] = $this->getCodigoAgenciaBeneficiario();
		$dados[] = $this->getContaMovimentoBeneficiario();
		$dados[] = $this->getContaCobrancaBeneficiario();
		$dados[] = $this->getNumeroControleParticipante();
		$dados[] = $this->getNossoNumero();
		$dados[] = $this->getDataSegundoDesconto();
		$dados[] = Util::format("X(001)","");
		$dados[] = $this->getInformacaoMulta();
		$dados[] = $this->getPercentualMultaAtraso();
		$dados[] = $this->getUnidadeValorMoedaCorrente();
		$dados[] = $this->getValorTituloOutraUnidade();
		$dados[] = Util::format('X(004)',' ');
		$dados[] = $this->getDataCobrancaMulta();
		$dados[] = $this->getCodigoCarteira();
		$dados[] = $this->getCodigoOcorrencia();
		$dados[] = $this->getSeuNumero();
		$dados[] = $this->getDataVencimentoTitulo();
		$dados[] = $this->getValorTitulo();
		$dados[] = $this->getNumeroBancoCobrador();
		$dados[] = $this->getCodigoAgenciaCobradora();
		$dados[] = $this->getEspecieDocumento();
		$dados[] = $this->getTipoAceite();
		$dados[] = $this->getDataEmissaoTitulo();
		$dados[] = $this->getPrimeiraInstrucaoCobranca();
		$dados[] = $this->getSegundaInstrucaoCobranca();
		$dados[] = $this->getValorMoraDiaAtraso();
		$dados[] = $this->getDataLimiteConcessaoDesconto();
		$dados[] = $this->getValorDescontoConcedido();
		$dados[] = $this->getValorIof();
		$dados[] = $this->getValorAbatimentoConcedido();
		$dados[] = $this->getTipoInscricaoPagador();
		$dados[] = $this->getCnpjCpfPagador();
		$dados[] = $this->getNomePagador();
		$dados[] = $this->getEnderecoPagador();
		$dados[] = $this->getBairroPagador();
		$dados[] = $this->getCepPagador();
		$dados[] = $this->getMunicipioPagador();
		$dados[] = $this->getUfPagador();
		$dados[] = Util::format('X(31)',' ');
		$dados[] = $this->getIdentificadorComplemento();
		$dados[] = $this->getComplemento();
		$dados[] = Util::format('X(006)',' ');
		$dados[] = $this->getNumeroDiasProtesto();
		$dados[] = Util::format('X(1)',' ');
		$dados[] = $this->getSequencial();

		return join('', $dados);
	}
}