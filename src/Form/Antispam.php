<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadeYourDay\RockSolidAntispam\Form;

use Contao\Form;
use Contao\Input;
use Contao\Widget;

/**
 * Antispam hooks
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */
class Antispam
{
	/**
	 * loadFormField hook
	 *
	 * replaces the captcha widget with the invisible antispam widget
	 *
	 * @param  Widget  $widget form field widget object
	 * @param  string  $formId form id
	 * @param  array   $data   form data
	 * @param  Form    $form   form object
	 * @return Widget
	 */
	public function loadFormField($widget, $formId, $data, $form)
	{
		if ($widget instanceof Captcha) {

			$antispamField = new AntispamField(array(
				'id' => $widget->id,
				'pid' => $widget->pid,
				'tableless' => $widget->tableless,
			));

			if (Input::post('FORM_SUBMIT') == $formId) {
				$antispamField->validate();
			}
			if (! $antispamField->hasErrors()) {
				// switch to the invisible honeypot field
				$widget = $antispamField;
			}

		}

		return $widget;
	}
}
