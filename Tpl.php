<?php

class Tpl {
	private static Tpl $instance;
	private array $data;

	public static function getInstance(): Tpl {
		if (empty(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		$this->data = [];
	}

	public function __get(string $key) {
		return $this->data[$key];
	}

	public function __set(string $key, $value): void {
		$this->data[$key] = $value;
	}

	public function __isset(string $key) : bool  {
		return isset($this->data[$key]);
	}
}
