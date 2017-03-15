<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * RockSolid Antispam configuration
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */

$GLOBALS['TL_FFL']['rocksolid_antispam'] = 'MadeYourDay\\RockSolidAntispam\\Form\\Captcha';

$GLOBALS['TL_HOOKS']['loadFormField'][] = array('MadeYourDay\\RockSolidAntispam\\Form\\Antispam', 'loadFormField');
