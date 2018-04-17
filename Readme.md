#Santander

##Instalação
Adicione o repositório e a lista de dependencias

```json
{
	"repositories": [
    	{
			"url": "https://github.com/studiogt/santander",
			"type": "vcs"
    	}
    ],
    "require": {
    	"studiogt/santander": "*"
    }
}
```

então atualize o projeto via composer:

```bash
$> composer install
```

##Forma de usar

###Gerar um boleto em pdf

```php
<?php

require 'vendor/autoload.php';
	
$boleto = new \Boleto();

$beneficiario = $boleto->getBeneficiario();
$beneficiario->getDadosBancarios()
					->setAgencia('4792')						
				->getBanco()->setCodigo('033');
$beneficiario->getEndereco()
				->setLogradouro("Almirante Barroso")
				->setNumero('735 sala 402')
				->setBairro('Floresta')
				->setCidade('Porto Alegre')
				->setCEP('90220-021')
				->setUF('RS');
$beneficiario->setNome("Fulano de Tal");
$beneficiario->getDocumento()
				->setNumero('120.525.790-01');					


$pagador = $boleto->getPagador();
$pagador->setNome("Fulano de Tal")
		->getDocumento()
				->setNumero('706.707.110-04');
$pagador->getEndereco()
				->setLogradouro("Almirante Barroso")
				->setNumero('735 sala 402')
				->setBairro('Floresta')
				->setCidade('Porto Alegre')
				->setCEP('90220-021')
				->setUF('RS');

$boleto->setVencimento('2028-01-04');
$boleto->setValor(273.71);
$boleto->setCodigoBeneficiario(282033);
$boleto->setNossoNumero(5666124578002);

header("Content-type: application/pdf");
echo $boleto->renderPDF();

```