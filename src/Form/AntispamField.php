<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadeYourDay\RockSolidAntispam\Form;

/**
 * Antispam field
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */
class AntispamField extends \Widget
{
	/**
	 * @var string template
	 */
	protected $strTemplate = 'form_rocksolid_antispam';

	/**
	 * @var boolean for attribute indicator
	 */
	protected $blnForAttribute = true;

	/**
	 * @var array field names for the antispam fields
	 */
	protected $names = array();

	/**
	 * @var array field values for the antispam fields
	 */
	protected $values = array();

	/**
	 * constructor
	 *
	 * @param array|null $attributes
	 */
	public function __construct($attributes = null)
	{
		parent::__construct($attributes);

		$this->names[0] = 'email';
		$this->values[0] = '';

		$this->names[1] = 'url';
		$this->values[1] = '';

		$this->names[2] = static::getRandomString();
		$this->values[2] = static::getRandomString();

		$fields = \Database::getInstance()
			->prepare("SELECT name FROM tl_form_field WHERE pid = ?")
			->execute($this->pid);

		if ($fields) {

			$fields = $fields->fetchEach('name');

			// check if the field name already exists in the form
			$count = 2;
			while (in_array($this->names[0], $fields)) {
				$this->names[0] = 'email-' . $count;
				$count++;
			}

			// check if the field name already exists in the form
			$count = 2;
			while (in_array($this->names[1], $fields)) {
				$this->names[1] = 'url-' . $count;
				$count++;
			}

		}
	}

	/**
	 * Validate the input and set the value
	 */
	public function validate()
	{
		$sessionData = $this->Session->get('rocksolid_antispam_' . $this->strId);

		if (
			! is_array($sessionData) ||
			\Input::post($sessionData['names'][0]) !== $sessionData['values'][0] ||
			\Input::post($sessionData['names'][1]) !== $sessionData['values'][1] ||
			\Input::post($sessionData['names'][2]) !== $sessionData['values'][2] ||
			$sessionData['time'] > (time() - 3)
		) {
			$this->addError('failed');
			$this->Session->set('rocksolid_antispam_' . $this->strId, '');
		}
	}

	/**
	 * generates the label
	 *
	 * @return string
	 */
	public function generateLabel()
	{
		$this->strLabel = $GLOBALS['TL_LANG']['FFL']['rocksolid_antispam']['label'];
		return parent::generateLabel();
	}

	/**
	 * generates the antispam fields
	 *
	 * @return string
	 */
	public function generate()
	{
		$this->setSessionData();

		$html = sprintf(
			'<input type="text" name="%s" id="%s" class="%s" value="%s"%s%s',
			$this->names[0],
			'ctrl_' . $this->strId,
			trim('rsas-field ' . $this->strClass),
			specialchars($this->values[0]),
			$this->getAttributes(),
			$this->strTagEnding
		);

		$html .= str_replace(
			'"ctrl_' . $this->strId . '"',
			'"ctrl_' . $this->strId . '_2"',
			$this->generateLabel()
		);

		$html .= sprintf(
			'<input type="text" name="%s" id="%s" class="%s" value="%s"%s%s',
			$this->names[1],
			'ctrl_' . $this->strId . '_2',
			trim('rsas-field ' . $this->strClass),
			specialchars($this->values[1]),
			$this->getAttributes(),
			$this->strTagEnding
		);

		$html .= str_replace(
			'"ctrl_' . $this->strId . '"',
			'"ctrl_' . $this->strId . '_3"',
			$this->generateLabel()
		);

		// swap field name and value (javascript swaps it back in the frontend)
		$html .= sprintf(
			'<input type="text" name="%s" id="%s" class="%s" value="%s"%s%s',
			$this->values[2],
			'ctrl_' . $this->strId . '_3',
			trim('rsas-field ' . $this->strClass),
			specialchars($this->names[2]),
			$this->getAttributes(),
			$this->strTagEnding
		);
		$html .= '<script>(function(){' .
			'var a=document.getElementById(\'ctrl_' . $this->strId . '_3\'),' .
			'b=a.value;' .
			'a.value=a.name;' .
			'a.name=b' .
			'})()</script>';

		return $html;
	}

	/**
	 * stores field names, field values and the current time in the session
	 */
	protected function setSessionData()
	{
		// Don't update the session for search indexing requests
		if (\Environment::get('HttpIndexPage')) {
			return;
		}
		$this->Session->set('rocksolid_antispam_' . $this->strId, array(
			'names' => $this->names,
			'values' => $this->values,
			'time' => time(),
		));
	}

	/**
	 * returns a 22 characters long random base 64 [A-Za-z0-9\-_] string
	 *
	 * @return string random base64 string
	 */
	protected static function getRandomString() {
		return rtrim(strtr(base64_encode(pack(
			'n8',
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535),
			mt_rand(0,65535)
		)), '+/', '-_'), '=');
	}
}
