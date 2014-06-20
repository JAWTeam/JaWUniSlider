<?php
/**
 * @file        mod_jawunislider.php
 * @description
 *
 * PHP Version  5.3.13
 *
 * @package 
 * @category
 * @plugin URI
 * @copyright   2014, Vadim Pshentsov. All Rights Reserved.
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @author      Vadim Pshentsov <pshentsoff@gmail.com> 
 * @link        http://pshentsoff.ru Author's homepage
 * @link        http://blog.pshentsoff.ru Author's blog
 *
 * @created     20.06.14
 */

defined('_JEXEC') or die;

require_once dirname(__FILE__) . '/helper.php';

// get params

// display layout
require JModuleHelper::getLayoutPath('mod_jawunislider', $params->get('layout', 'default'));
