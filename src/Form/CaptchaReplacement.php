<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadeYourDay\RockSolidAntispam\Form;

/**
 * Captcha field to be used as a replacement for FormCaptcha
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */
class CaptchaReplacement extends \FormCaptcha
{
	/**
	 * @var string template
	 */
	protected $strTemplate = 'form_rocksolid_antispam';

	/**
	 * @var AntispamField
	 */
	private $antispamField = null;

	/**
	 * {@inheritdoc}
	 */
	public function __construct($attributes = null)
	{
		$this->antispamField = new AntispamField($attributes);

		parent::__construct($attributes);
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate()
	{
		if ($this->antispamField) {

			$this->antispamField->validate();

			// Switch to the regular captcha field if the honeypot fails
			if ($this->antispamField->hasErrors()) {
				$this->antispamField = null;
				$this->strTemplate = 'form_captcha';
				return parent::validate();
			}

		}
		else {
			return parent::validate();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function parse($attributes = null)
	{
		if ($this->antispamField) {
			return $this->antispamField->parse($attributes);
		}

		return parent::parse($attributes);
	}

	/**
	 * {@inheritdoc}
	 */
	public function generateLabel()
	{
		if ($this->antispamField) {
			return $this->antispamField->generateLabel();
		}

		return parent::generateLabel();
	}


	/**
	 * {@inheritdoc}
	 */
	public function generate()
	{
		if ($this->antispamField) {
			return $this->antispamField->generate();
		}

		return parent::generate();
	}
}
