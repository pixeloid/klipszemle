<?php

namespace Pixeloid\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PixeloidUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
