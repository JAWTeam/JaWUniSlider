<?php
/**
 * @file        default.php
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

// Get params. You can set'em manually
$slideShow          = $params->get('slideShow', 'camera');

$moduleWidth		= $params->get('moduleWidth', '100%');
$maxWidth			= $params->get('maxWidth', '100%');
$moduleHeight		= $params->get('moduleHeight', '50%');
$resizeImage		= $params->get('resizeImage', 1);
$imageWidth			= $params->get('imageWidth', '600');
$imageHeight		= $params->get('imageHeight', '300');
$displayCaptions	= $params->get('displayCaptions', 0);

$thumbnails			= $params->get('thumbnails', 1);
$thumbnailWidth		= $params->get('thumbnailWidth', '100');
$thumbnailHeight	= $params->get('thumbnailHeight', '75');

$duration			= $params->get('duration', 7000);

$pauseHover			= $params->get('pauseHover', 1);
$pauseOnClick		= $params->get('pauseOnClick', 1);

// DOM params
$domModuleWrapperId = 'jaw-slider-wrapper-'.$module->id;
$domModuleId = 'jaw-slider-'.$module->id;

$doc = JFactory::getDocument();
$doc->addScript('modules/mod_jawunislider/assets/jquery.mobile.customized.min.js', 'text/javascript');
$doc->addScript('modules/mod_jawunislider/assets/jquery.easing.1.3.js', 'text/javascript');
$doc->addScript('modules/mod_jawunislider/assets/jawunislider.js', 'text/javascript');

switch($slideShow) {
    case 'camera':
    default: {
        $doc->addScript('modules/mod_jawunislider/assets/camera.js', 'text/javascript');
        $doc->addStyleSheet('modules/mod_jawunislider/assets/camera.css');

        $slideShowWrapperClass = 'jaw-camera-slider';
        $slideShowSliderClass = 'camera_wrap';
        break;
    }
}

$doc->addStyleSheet('modules/mod_jawunislider/assets/jawunislider.css');

$timthumb = JURI::base() . 'modules/mod_jawunislider/libs/timthumb.php?a=c&q=99&z=0';

?>
<style type="text/css">
    #<?php echo $domModuleWrapperId; ?> {
        width: <?php echo $moduleWidth; ?>;
        max-width: <?php echo $maxWidth; ?>;
        clear: both;
    }
</style>

<div id="<?php echo $domModuleWrapperId; ?>" class="<?php echo $slideShowWrapperClass; ?>">
    <div id="<?php echo $domModuleId; ?>" class="<?php echo $slideShowSliderClass; ?>">
        <?php foreach($slides as $slide) : ?>
            <?php
            $image = $slide->image;
            $bigImage   = $image;
            if($resizeImage) $bigImage = $timthumb . '&w=' . $imageWidth . '&h=' . $imageHeight . '&src=' . $image;
            $thumbImage = $timthumb . '&w=' . $thumbnailWidth . '&h=' . $thumbnailHeight . '&src=' . $image;
            ?>
            <div data-thumb="<?php echo $thumbImage; ?>" data-src="<?php echo $bigImage; ?>">
                <?php echo ($displayCaptions) ? $slide->text : ''; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
<?php
switch($slideShow) {
    case 'camera':
    default: {
?>
        jQuery('#<?php echo $domModuleWrapperId; ?>').camera({
            loader				: '<?php echo $loaderStyle; ?>',
            barDirection		: '<?php echo $barDirection; ?>',
            barPosition			: '<?php echo $barPosition; ?>',
            fx					: '<?php echo $fx; ?>',
            piePosition			: '<?php echo $piePosition; ?>',
            height				: '<?php echo $moduleHeight; ?>',
            hover				: <?php echo ($pauseHover) ? 'true' : 'false'; ?>,
            navigation			: <?php echo ($navigation) ? 'true' : 'false'; ?>,
            navigationHover		: <?php echo ($navigationHover) ? 'true' : 'false'; ?>,
            pagination			: <?php echo ($pagination) ? 'true' : 'false'; ?>,
            playPause			: <?php echo ($playPause) ? 'true' : 'false'; ?>,
            pauseOnClick		: <?php echo ($pauseOnClick) ? 'true' : 'false'; ?>,
            thumbnails			: <?php echo ($thumbnails) ? 'true' : 'false'; ?>,
            time				: <?php echo $duration; ?>,
            transPeriod			: <?php echo $transPeriod; ?>
        });
<?php
    }
}
?>
    });
</script>