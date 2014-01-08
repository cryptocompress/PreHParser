<?php

namespace PreHParser;

define('T_TOKEN', 999);

class Loader {

	static public function register() {
		foreach (spl_autoload_functions() as $callback) {
			if ($callback[0] instanceof \Composer\Autoload\ClassLoader) {
				$loader = new self($callback[0]);
				spl_autoload_register(array($loader, 'loadClass'), true, true);
				$callback[0]->unregister();
				return $loader;
			}
		}

		throw new \Exception('Composer class loader not found!');
	}

	private $loader;

	public function __construct($loader) {
		$this->loader = $loader;
	}

	public function loadClass($class) {
		if ($file = $this->loader->findFile($class)) {
			$fileTmp = $file . '.PreHParse';
			eval($this->tokenize($file));
			return true;
		}
	}

	private function tokenize($file) {
		$fileOut = '';
		$names	= array_flip(get_defined_constants(true)['tokenizer']);
		$names[T_TOKEN] = 'T_TOKEN';
		$fileIn	= file_get_contents($file);
		$tokens	= token_get_all($fileIn);
		$startClassDef = false;
		$classDef = '';

		$count = count($tokens);
		for ($idx = 0; $idx < $count; $idx++) {
			if (is_string($tokens[$idx])) {
				$tokens[$idx] = array(T_TOKEN, $tokens[$idx]);
			}

			list($id, $text) = $tokens[$idx];

			if ($startClassDef && $id != T_TOKEN) {
				$classDef .= $text;
				continue;
			}

			switch ($id) {
				case T_OPEN_TAG:
					continue;

				case T_CLASS:
					$startClassDef = true;
					continue;

				case T_VARIABLE:
					if ($tokens[$idx + 0][0] == T_VARIABLE && $tokens[$idx + 1][0] == T_WHITESPACE && $tokens[$idx + 2][0] == T_STRING) {
						$var	= $tokens[$idx + 0];
						$tokens[$idx + 0] = $tokens[$idx + 2];
						$tokens[$idx + 2] = $var;
						$idx--;
						continue;
					}

				case T_TOKEN:
					if ($startClassDef && $text == '{') {
						$fileOut .= $this->parseClassDef($classDef);
						$startClassDef = false;
						continue;
					}

				default:
					if (!$startClassDef) {
						$fileOut .= $text;
					}
					break;
			}

		}

		return $fileOut;
	}

	public function parseClassDef($classDef) {
		$out = 'class ';

		if (false !== strpos($classDef, 'implements') || false !== strpos($classDef, 'extends')) {
			return $out . $classDef . ' {';
		}

		$classDef		= explode(' ', trim($classDef));
		$nameClass		= array_shift($classDef);
		$classes		= array();
		$interfaces		= array();

		foreach ($classDef as $entry) {
// 			if (interface_exists($entry, true)) {
				$interfaces[] = $entry;
// 			} else if (class_exists($entry, true)) {
// 				$classes[] = $entry;
// 			} else {
// 				Throw new \Exception('Unknown interface or class [' . $entry . ']!');
// 			}
		}

		$out .= $nameClass;

		if (!empty($classes)) {
			$out .= ' extends ' . implode(', ', $classes);
		}

		if (!empty($interfaces)) {
			$out .= ' implements ' . implode(', ', $interfaces);
		}

		return $out . ' {';
	}

}
