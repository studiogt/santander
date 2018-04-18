<?php 

namespace Santander;

class Util {
	public static function str_pad($input, $pad_length, $pad_string, $pad_style = STR_PAD_RIGHT, $encoding = 'UTF-8') {
		return str_pad($input, strlen($input)-mb_strlen($input,$encoding)+$pad_length, $pad_string, $pad_style); 
	}

	public static function remover_acentos($str) {
		$foreign_characters = array(
			'/ä|æ|ǽ/' => 'ae',
			'/ö|œ/' => 'oe',
			'/ü/' => 'ue',
			'/Ä/' => 'Ae',
			'/Ü/' => 'Ue',
			'/Ö/' => 'Oe',
			'/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
			'/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
			'/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
			'/ç|ć|ĉ|ċ|č/' => 'c',
			'/Ð|Ď|Đ/' => 'Dj',
			'/ð|ď|đ/' => 'dj',
			'/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
			'/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
			'/Ĝ|Ğ|Ġ|Ģ/' => 'G',
			'/ĝ|ğ|ġ|ģ/' => 'g',
			'/Ĥ|Ħ/' => 'H',
			'/ĥ|ħ/' => 'h',
			'/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
			'/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
			'/Ĵ/' => 'J',
			'/ĵ/' => 'j',
			'/Ķ/' => 'K',
			'/ķ/' => 'k',
			'/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
			'/ĺ|ļ|ľ|ŀ|ł/' => 'l',
			'/Ñ|Ń|Ņ|Ň/' => 'N',
			'/ñ|ń|ņ|ň|ŉ/' => 'n',
			'/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
			'/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
			'/Ŕ|Ŗ|Ř/' => 'R',
			'/ŕ|ŗ|ř/' => 'r',
			'/Ś|Ŝ|Ş|Š/' => 'S',
			'/ś|ŝ|ş|š|ſ/' => 's',
			'/Ţ|Ť|Ŧ/' => 'T',
			'/ţ|ť|ŧ/' => 't',
			'/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
			'/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
			'/Ý|Ÿ|Ŷ/' => 'Y',
			'/ý|ÿ|ŷ/' => 'y',
			'/Ŵ/' => 'W',
			'/ŵ/' => 'w',
			'/Ź|Ż|Ž/' => 'Z',
			'/ź|ż|ž/' => 'z',
			'/Æ|Ǽ/' => 'AE',
			'/ß/'=> 'ss',
			'/Ĳ/' => 'IJ',
			'/ĳ/' => 'ij',
			'/Œ/' => 'OE',
			'/ƒ/' => 'f'
		);
		$link = strtolower(preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str));
		$link = preg_replace("/[^a-z0-9]/",' ',$link);
		$link = preg_replace("/\s+/",' ',$link);
		$link = trim($link);
		return $link;
	}

	public static function format($formato, $valor) {
		$pad_style = STR_PAD_LEFT;
		$pad_string = '0';
		$pad_length = 0;
		if (preg_match('/^X\((?P<tamanho>\d+)\)$/', $formato, $matches)) {
			$pad_length = (int)$matches['tamanho'];
			$pad_style = STR_PAD_RIGHT;
			$pad_string = ' ';
			$valor = static::remover_acentos($valor);
		} else if (preg_match('/^9\((?P<inteiro>\d+)\)v[9]?\((?P<decimal>\d+)\)$/', $formato, $matches)) {
			$valor = preg_replace('/[^\d\.\-\,]/','',$valor);
			$inteiro = (int)$matches['inteiro'];
			$decimal = (int)$matches['decimal'];
			$valor = number_format((double)$valor,$decimal,'','');
			$pad_length = $inteiro + $decimal;
		} else if (preg_match('/^9\((?P<tamanho>\d+)\)$/', $formato, $matches)) {			
			$pad_length = (int)$matches['tamanho'];
			$valor = (int)preg_replace('/\D/','',$valor);
		} else {
			throw new \Exception("Formato {$formato} inválido.");
		}

		if (strlen($valor) > $pad_length) {
			if ($pad_style == STR_PAD_RIGHT) {
				$valor = substr(trim($valor), 0, $pad_length);				
			} else {
				$valor = substr(trim($valor), -1 * $pad_length);								
			}
		}

		$valor = $valor."";

		$str = static::str_pad($valor, $pad_length, $pad_string, $pad_style);

		

		return $str;
	}

	public static function parseFormat($format) {
		$inteiro = 0;
		$decimal = 0;
		
		if (preg_match('/^X\((?P<tamanho>\d+)\)$/', $format, $matches)) {						
			$tamanho = (int)$matches['tamanho'];
			$tipo = 'string';
			
		} else if (preg_match('/^9\((?P<inteiro>\d+)\)v[9]?\((?P<decimal>\d+)\)$/', $format, $matches)) {
			$inteiro = (int)$matches['inteiro'];
			$decimal = (int)$matches['decimal'];
			$tamanho = $inteiro + $decimal;

			$tipo = 'decimal';
		} else if (preg_match('/^9\((?P<tamanho>\d+)\)$/', $format, $matches)) {
			$tamanho = (int)$matches['tamanho'];
			$tipo = 'int';
		} else {			
			$tipo = '';
			throw new \Exception("Formato {$format} inválido.");			
		}

		$format = new \stdclass();
		$format->type = $tipo;
		$format->size = $tamanho;
		$format->inteiro = $inteiro;
		$format->decimal = $decimal;

		return $format;
	}

	public static function modulo11($str, $dv = false) {
		$multiplicador = 2;

		$len = strlen($str);

		$soma = 0;

		for($i = $len - 1; $i >= 0; $i-- ) {
			$soma += $str[$i] * $multiplicador;

			$multiplicador++;
			if ($multiplicador > 9) {
				$multiplicador = 2;
			}
		}
		

		$resto = $soma % 11;
		

		switch ($resto) {
			case 10:
				return 1;
				break;
			case 0:
			case 1:
				if ($dv) {
					return 1;
				}
				return 0;
				break;
			default:
				return 11 - $resto;
				break;
		}
	}

	public function modulo10($str) {
		$multiplicador = 2;
		$len = strlen($str);
		$soma = 0;

		for($i = $len - 1; $i >= 0; $i--) {			
			$d = $str[$i];

			$produto = $d * $multiplicador;
			if (9 < $produto) {
				$produto = $produto.'';
				$produto = $produto[0] + $produto[1];
			}

			$soma += $produto;

			$multiplicador = $multiplicador == 2 ? 1 : 2;			
		}

		$resto = $soma % 10;

		if (0 == $resto) {
			return 0;
		}		

		return 10 - $resto;

	}
}