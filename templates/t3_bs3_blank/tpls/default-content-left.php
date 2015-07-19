<?php
/** 
 *------------------------------------------------------------------------------
 * @package       T3 Framework for Joomla!
 *------------------------------------------------------------------------------
 * @copyright     Copyright (C) 2004-2013 JoomlArt.com. All Rights Reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @authors       JoomlArt, JoomlaBamboo, (contribute to this project at github 
 *                & Google group to become co-author)
 * @Google group: https://groups.google.com/forum/#!forum/t3fw
 * @Link:         http://t3-framework.org 
 *------------------------------------------------------------------------------
 */


defined('_JEXEC') or die;
?>

<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>"
	  class='<jdoc:include type="pageclass" />'>

<head>
	<jdoc:include type="head" />
	<?php $this->loadBlock('head') ?>
</head>

<body>

<div class="t3-wrapper"> <!-- Need this wrapper for off-canvas menu. Remove if you don't use of-canvas -->

  <div class="head-top">
    <div class="container">
      <?php $this->loadBlock('header') ?>
     <!--  <!?php $this->loadBlock('mainnav') ?> -->
    </div>
  </div>
  <nav class="tabs-top">
  	<div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#profile-page" data-toggle="tab"><?php echo JText::_('OSM_EDIT_PROFILE');?></a></li>
            <li><a href="#my-subscriptions-page" data-toggle="tab"><?php echo JText::_('OSM_MY_SUBSCRIPTIONS');?></a></li>
            <li><a href="#subscription-history-page" data-toggle="tab"><?php echo JText::_('OSM_SUBSCRIPTION_HISTORY');?></a></li>
            <li><a href="#upgrade-page" data-toggle="tab"><?php echo JText::_('OSM_UPGRADE_PROFILE_BUTTON');?></a></li>	
            <?php 
                if (count($this->plugins)) 
                {
                    $count = 0 ;
                    foreach ($this->plugins as $plugin) 
                    {
                        $title  = $plugin['title'] ;
                        $count++ ;
                    ?>
                        <li><a href="#<?php echo 'tab_'.$count;  ?>" data-toggle="tab"><?php echo $title;?></a></li>
                    <?php							
                    }
                }
            ?>
                                    
        </ul>
    </div>
  </nav>
  <?php if ($this->countModules('slideshow')) : ?>
  <!-- slideshow -->
  <div id="slideshow" class="slideshow">
    <jdoc:include type="modules" name="slideshow" style="raw" />
  </div>
  <!-- //slideshow -->
<?php endif ?>
  <?php $this->loadBlock('spotlight-1') ?>

  <?php $this->loadBlock('mainbody-content-left') ?>

  <?php $this->loadBlock('spotlight-2') ?>

  <?php $this->loadBlock('navhelper') ?>

  <?php $this->loadBlock('footer') ?>

</div>

</body>

</html>