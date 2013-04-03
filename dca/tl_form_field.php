<?php
/*
 * Copyright MADE/YOUR/DAY OG <mail@madeyourday.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * RockSolid Antispam form field DCA
 *
 * @author Martin Auswöger <martin@madeyourday.net>
 */

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['rocksolid_antispam'] = preg_replace('(\\{submit_legend\\}[^;]+(?:;|$))i', '', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['captcha']);
