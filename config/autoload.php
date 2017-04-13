<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * RockSolid Antispam autload configuration
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */

ClassLoader::addClasses(array(
	'MadeYourDay\\Contao\\Form\\Antispam' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/Antispam.php',
	'MadeYourDay\\Contao\\Form\\AntispamField' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/AntispamField.php',
	'MadeYourDay\\Contao\\Form\\Captcha' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/Captcha.php',
	'MadeYourDay\\Contao\\Form\\CaptchaReplacement' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/CaptchaReplacement.php',
));

$templatesFolder = version_compare(VERSION, '4.0', '>=')
	? 'vendor/madeyourday/contao-rocksolid-antispam/templates'
	: 'system/modules/rocksolid-antispam/templates';

TemplateLoader::addFiles(array(
	'form_rocksolid_antispam' => $templatesFolder,
));