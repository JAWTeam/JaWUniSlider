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

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
require_once dirname(__FILE__) . DS.'helper.php';

$slidesSource = $params->get('slidesSource', 'imagesPath');
switch($slidesSource){
    case 'imagesPath':
    default: {
        $imagesPath = $params->get('imagesPath', 'images'.DS.'stories');
        $slides = modJaWUniSliderHelper::getImagesPath($imagesPath);
        break;
    }
}

modJaWUniSliderHelper::prepareSlides($slides);

// display layout
require JModuleHelper::getLayoutPath('mod_jawunislider', $params->get('layout', 'default'));
