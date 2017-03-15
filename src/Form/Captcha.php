<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadeYourDay\Contao\Form;

/**
 * Captcha field
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */
class Captcha extends \FormCaptcha
{
	public function __get($key)
	{
		if (
			$key === 'type'
			&& $this->arrConfiguration[$key] === 'rocksolid_antispam'
		) {
			// Improves compatibility with other contao extensions
			return 'captcha';
		}

		return parent::__get($key);
	}
}
