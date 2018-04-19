<?php

namespace Santander;

use Santander\Retorno\Header;
use Santander\Retorno\Movimento;
use Santander\Retorno\Trailer;

class Retorno {
	private $header;
	private $movimentos = array();
	private $trailer;

	public function __construct() {
		$this->setHeader(new Header());
		$this->setTrailer(new Trailer());
	}

	public static function isHeader($line) {
		return preg_match('/^02RETORNO/',$line) && 400 == mb_strlen($line, 'UTF-8');
	}

	public static function isMovimento($line) {
		return preg_match('/^10/',$line) && 400 == mb_strlen($line, 'UTF-8');
	}

	public static function isTrailer($line) {
		return preg_match('/^9201/',$line) && 400 == mb_strlen($line, 'UTF-8');
	}

	public function parseFile($filename) {
		$str = file_get_contents($filename);
		$this->parseString($str);
	}

	public function parseString($str) {
		$lines = preg_replace('/[\r\n]/',"\n",$str);
		$lines = explode("\n", $lines);

		foreach($lines as $line) {
			if (400 != mb_strlen($line, 'UTF-8')) {				
				continue;
			}
			$this->parseLine($line);
		}

		return $this;
	}

	public function parseLine($line) {
		if (static::isHeader($line)) {
			$this->parseHeader($line);
		} else if (static::isMovimento($line)) {
			$this->parseMovimento($line);
		} else if (static::isTrailer($line)) {
			$this->parseTrailer($line);
		} 
		return $this;
	}

	public function parseHeader($line) {
		$this->header->parseLine($line);
		return $this;
	}

	public function parseMovimento($line) {
		$movimento = new Movimento();
		$movimento->parseLine($line);
		$this->addMovimento($movimento);
		return $this;
	}

	public function parseTrailer($line) {
		$this->trailer->parseLine($line);
		return $this;
	}

	public function setHeader($header) {
		$this->header = $header;
		return $this;
	}
	public function getHeader() {
		return $this->header;
	}

	public function setTrailer($trailer) {
		$this->trailer = $trailer;
		return $this;
	}
	public function getTrailer() {
		return $this->trailer;
	}

	public function addMovimento($movimento) {
		$this->movimentos[] = $movimento;
		return $this;
	}
	public function getMovimentos() {
		return $this->movimentos;
	}
}