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
	'MadeYourDay\\RockSolidAntispam\\Form\\Antispam' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/Antispam.php',
	'MadeYourDay\\RockSolidAntispam\\Form\\AntispamField' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/AntispamField.php',
	'MadeYourDay\\RockSolidAntispam\\Form\\Captcha' => 'system/modules/rocksolid-antispam/src/MadeYourDay/Contao/Form/Captcha.php',
));

TemplateLoader::addFiles(array(
	'form_rocksolid_antispam' => 'vendor/madeyourday/contao-rocksolid-antispam/templates',
));
