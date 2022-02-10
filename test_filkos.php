<?php /** @noinspection AutoloadingIssuesInspection */

/** @noinspection PhpUndefinedFieldInspection */

class ShortLinks {

	public const FILE_HTML = __DIR__ . '/Test_Filkos_html.php';
	private Tpl $tpl;

	/**
	 * @throws Exception
	 */
	public function __construct() {
		$this->tpl = Tpl::getInstance();
		$this->tpl->is_error = false;
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->act_post();
			return;
		}

		$this->act_get();
	}

	/**
	 * @throws Exception
	 */
	private function act_post(): void {
		$this->tpl->tokenForm = $this->generateToken();
		if ($_SESSION['token_form'] !== $_POST['token_form']) {
			$this->tpl->error = 'Неверная форма';
			$this->tpl->is_error = true;
			include_once self::FILE_HTML;
			return;
		}
		$this->tpl->shortLink = bin2hex(random_bytes(10));
		$_SESSION['links'][] = [
				'original' => $_POST['link'],
				'short' => $this->tpl->shortLink
			];
		$this->tpl->is_error = false;

		include_once self::FILE_HTML;
	}

	private function act_get(): void {
		$uri = $_SERVER['REQUEST_URI'];
		$uri = trim($uri, '/');
		foreach ($_SESSION['links'] as $link) {
			if ($link['short'] === $uri) {
				http_redirect($link['original']);
				return;
			}
		}

		$this->tpl->tokenForm = $this->generateToken();
		include_once self::FILE_HTML;
	}

	private function generateToken(): string {
		$tokenForm = sha1(time());
		$_SESSION['token_form'] = $tokenForm;
		return $tokenForm;
	}
}

