<?php
/**
 * @package   T3 Blank
 * @copyright Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Mainbody 1 columns, content only
 */
if(JRequest::getVar('view')=='profile'){
?>

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
<?php } ?>
<div id="t3-mainbody" class="container t3-mainbody">
	<div class="row">

		<!-- MAIN CONTENT -->
		<div id="t3-content" class="t3-content col-xs-12">
			<?php if($this->hasMessage()) : ?>
			<jdoc:include type="message" />
			<?php endif ?>
			<jdoc:include type="component" />
		</div>
		<!-- //MAIN CONTENT -->

	</div>
</div> 