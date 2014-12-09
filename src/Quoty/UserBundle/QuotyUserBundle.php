<?php

namespace Quoty\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class QuotyUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
