<?php

namespace ES\Controller;

class LogoutController extends BaseController
{
	public function LogoutAction(): void
	{
		session_start();
		session_destroy();
		header('Location: /login/');
	}
}
