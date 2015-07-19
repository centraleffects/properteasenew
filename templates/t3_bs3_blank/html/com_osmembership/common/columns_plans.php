<?php
/**
 * @version        1.6.8
 * @package        Joomla
 * @subpackage     Membership Pro
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2012-2014 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */
OSMembershipHelperJquery::equalHeights();
if (isset($config->number_columns))
{
    $numberColumns = $config->number_columns ;
}
else
{
    $numberColumns = 3 ;
}
if (!isset($categoryId))
{
    $categoryId = 0;
}
$span = intval(12 / $numberColumns);
?>

<div class="price">
    <div class="t3-content">
        <article class="article-content">
            <div class="block-price">
            <div class="block">
            <h3>Single Report</h3>
            Just <i style="color: #ff5b95;">1</i> Report<br /> Single User<br /> <span class="through-line">Help Desk Support</span><br />
            <p class="pay-month"><span class="light">$</span><span class="blk">59</span> <i>/ month</i></p>
            <p class="blk arrow-down">We do it for you.</p>
            <p class="plus">Add Concierge <span class="blk">(+$40)</span></p>
            </div>
            <div class="block standard">
            <h3>Standard</h3>
            <span class="blk">Unlimited</span> Reports<br /> Single User<br /> Help Desk Support<br />
            <p class="pay-month"><span class="light">$</span><span class="blk">179</span> <i>/ month</i></p>
            <p class="plus">Up Front Cost <span class="blk">(Save $100)</span></p>
            <p class="plus none-border">Annual Prepaid <span class="blk">(Save $358)</span></p>
            </div>
            <div class="block corporate">
            <h3>Corporate</h3>
            <span class="blk">Unlimited</span> Reports<br /> Up to <span class="blk">5 Users</span><br /> Help Desk Support<br />
            <p class="pay-month"><span class="light">$</span><span class="blk">379</span> <i>/ month</i></p>
            <p class="plus">Up Front Cost <span class="blk">(Save $100)</span></p>
            <p class="plus none-border">Annual Prepaid <span class="blk">(Save $758)</span></p>
            </div>
            <a class="sbm-btn" id="btn-getstarted" href="javascript:;;"><span class="blk">Click Here</span> to <span class="blk">Get Started</span></a></div>


            <div class="clearfix">
        </article>
       </div>
</div><!-- end of price -->
<div id="login-popup-price" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
    <div class="modal-content">
        <a title="Close" class="modalCloseImg second simplemodal-close"></a>
    <div class="modal-header">
    <div class="normal-logo"> </div>
    <button class="btn btn-register">Don`t have an <b>account?</b></button></div>
    <div class="modal-body">
    <h3><span class="green blk">Log in</span> to your account</h3>
    <form>
    <div class="btl-error" id="btl-login-error"></div>
    <div class="form-group"><input class="form-control" id="btl-input-username" type="text" name="username"placeholder=" Enter your Username " /></div>
    <div class="form-group"><input class="form-control" id="btl-input-password" type="password" name="password"  placeholder="<?php echo JText::_('MOD_BT_LOGIN_PASSWORD') ?>" /></div>
    <div class="form-group">
    <div class="radio"><label> <input id="btl-checkbox-remember"  type="checkbox" name="remember"
                value="yes" />
                <?php echo JText::_('BT_REMEMBER_ME'); ?> </label><!-- <a href="#">Forgot?</a> -->
        <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
        <?php echo JText::_('BT_FORGOT_YOUR_PASSWORD'); ?></a>
    </div>
    </div>
    <div class="form-group">
    <p>By logging in, you agree to our <a href="#">Privacy Policy</a> and <a href="#">Terms of Use.</a></p>
    </div>
    <div class="form-group last-group">
        <button class="btn btn-sbm" type="submit" onclick="return loginAjax()" ><?php echo JText::_('JLOGIN') ?></button>
        <input type="hidden" name="option" value="com_users" />
        <input type="hidden" name="task" value="user.login" /> 
        <input type="hidden" name="return" id="btl-return"  value="<?php echo $return; ?>" />
        <?php echo JHtml::_('form.token');?>
    </div>
    </form></div>
    </div>
    </div>
</div><!-- end of login pop -->
<?php

$i = 0;
$numberPlans = count($items);
foreach ($items as $item)
{
	$i++;   
    $Itemid = OSMembershipHelperRoute::getPlanMenuId($item->id, $categoryId, $Itemid);
    if ($item->thumb)
    {
        $imgSrc = JUri::base().'media/com_osmembership/'.$item->thumb ;
    }
    $url = JRoute::_('index.php?option=com_osmembership&view=plan&catid='.$categoryId.'&id='.$item->id.'&Itemid='.$Itemid);
    if ($config->use_https)
    {
    	$signUpUrl = JRoute::_(OSMembershipHelperRoute::getSignupRoute($item->id, $Itemid), false, 1);        
    }
    else
    {
    	$signUpUrl = JRoute::_(OSMembershipHelperRoute::getSignupRoute($item->id, $Itemid));        
    }    	
    ?>
    <div class="osm-item-wrapper span<?php echo $span; ?>">
    	<div class="osm-item-heading-box clearfix">
    		<h2 class="osm-item-title">
    			<a href="<?php echo $url; ?>" title="<?php echo $item->title; ?>">
                	<?php echo $item->title; ?>
            	</a>
    		</h2>
    	</div>
    	<div class="osm-item-description clearfix">    		
	    		<?php
	    		if ($item->thumb)
	    		{
	    		?>	    		            
	    			<img src="<?php echo $imgSrc; ?>" class="osm-thumb-left img-polaroid" />    		            
	    		<?php
	    		} 
	    		if (!$item->short_description)
	    		{
	    			$item->short_description = $item->description;
	    		}
	    		?>
	    		<div class="osm-item-description-text"><?php echo $item->short_description; ?></div>	    		
	    		 <div class="osm-taskbar clearfix">
					<ul>
						<?php
						if (OSMembershipHelper::canSubscribe($item))
						{
						?>
							<li>
								<a href="<?php echo $signUpUrl; ?>" class="btn btn-primary">
									<?php echo JText::_('OSM_SIGNUP'); ?>
								</a>
							</li>
						<?php
						}
						?>
						<li>
							<a href="<?php echo $url; ?>" class="btn">
								<?php echo JText::_('OSM_DETAILS'); ?>
							</a>
						</li>
					</ul>	
			</div>		    		
    	</div>
    </div>
    <?php
    if ($i % $numberColumns == 0 && $i < $numberPlans)
    {
    ?>
    	</div>
    	<div class="clearfix">
    <?php
    }        
}
?>
</div>
<script type="text/javascript">
    OSM.jQuery(function($) {
        $(document).ready(function() {
            $(".osm-item-description-text").equalHeights(130);
        });
        $('#btn-getstarted').click(function(){
            jQuery('#login-popup-price').modal('show');
            setTimeout(function(){
                jQuery('.modal-backdrop, .simplemodal-container .modalCloseImg:not(\'.second\')').remove();
            },900);
        });
    });
</script>