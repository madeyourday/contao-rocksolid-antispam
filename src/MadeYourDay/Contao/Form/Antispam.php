<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadeYourDay\Contao\Form;

/**
 * Antispam hooks
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */
class Antispam
{
	public function loadFormField($widget, $formId, $data, $form)
	{
		if ($widget instanceof Captcha) {
			$antispamField = new AntispamField(array(
				'id' => $widget->id,
				'pid' => $widget->pid,
				'tableless' => $widget->tableless,
			));
			if (\Input::post('FORM_SUBMIT') == $formId) {
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
