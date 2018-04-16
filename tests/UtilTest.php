<?php

use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase {

	public function testFormatNumeric() {
		$this->assertEquals('00001', \Util::format('9(005)',1));
		$this->assertEquals(strlen('00001'), strlen(\Util::format('9(005)',1).''));
	}

	public function testFormatFloat() {
		$this->assertEquals('0000170', \Util::format('9(005)v(002)',1.7));
		$this->assertEquals(strlen('0000170'), strlen(\Util::format('9(005)v(2)',1.7).''));
	}

	public function testFormatString() {
		$this->assertEquals("A    ", \Util::format('X(005)','A'));
		$this->assertEquals(strlen("A    "), strlen(\Util::format('X(005)','A')));
	}

	public function testFormatOversizeString() {
		$this->assertEquals("AAAAA", \Util::format('X(005)','AAAAAA'));
		$this->assertEquals(strlen("AAAAA"), strlen(\Util::format('X(005)','AAAAAAA')));
	}

	public function testFormatOversizeNumeric() {
		$this->assertEquals("12345", \Util::format('9(005)','112345'));
		$this->assertEquals(strlen("12345"), strlen(\Util::format('9(005)','112345')));
	}

	public function testFormatOversizeFloat() {
		$this->assertEquals("12345", \Util::format('9(005)','1123.45'));
		$this->assertEquals(strlen("12345"), strlen(\Util::format('9(005)','1123.45')));
	}

	public function testModulo11() {
		$this->assertEquals(2, \Util::modulo11('566612457800'));
	}

	public function testModulo10() {
		$this->assertEquals(7, \Util::modulo10('033990282'));
	}
}