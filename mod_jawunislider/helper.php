<?php
/**
 * @file        helper.php
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

jimport('joomla.filesystem.folder');

class modJaWUniSliderHelper {

    public function getImagesPath($imagesPath, $filter = array('.png','.gif','.jpg')){

        $slides = array();

        if(!JFolder::exists($imagesPath)) {

            $first = substr($imagesPath, 0, 1);
            if($first == "\\" || $first == "/") {
                $imagesPath = substr($imagesPath, 1);
            }
            $rootPath = JPATH_ROOT.'/'.$imagesPath;

            if(!JFolder::exists($rootPath)) {
                return false;
            }
        } else {
            $rootPath = $imagesPath;
        }

        // Prepare filter regular expression
        if(!empty($filter)) {
            $filter = str_replace('.', '\.', $filter);
            $filter = str_replace('*', '.', $filter);
            $filterReg = implode('|', $filter);
        } else {
            $filterReg = '.';
        }

        $files  = JFolder::files($rootPath, $filterReg);
        if(!count($files)) return;

        foreach($files as $fileName){
            $slides[] = (object) array(
                'path' => $imagesPath.'/',
                'rootPath' => $rootPath.'/',
                'fileName'	=> $fileName,
                'text'	=> $fileName, //@todo проверить в медиа библиотеке и подгрузить текст/alt если есть
                'image' => JURI::base().$imagesPath.'/'.$fileName,
            );
        }
        return $slides;
    }

    public function prepareSlides(&$slides) {

        foreach ($slides as $key => $slide) {
            $slides[$key]->image = (strpos($slide->image, 'http://') === false) ? JURI::base() . $slide->image : $slide->image;
        }

    }

}