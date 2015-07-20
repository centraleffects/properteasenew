<?php
/**
 * @version        1.6.8
 * @package        Joomla
 * @subpackage     Membership Pro
 * @author         Tuan Pham Ngoc
 * @copyright      Copyright (C) 2012 - 2014 Ossolution Team
 * @license        GNU/GPL, see LICENSE.php
 */
// no direct access
defined( '_JEXEC' ) or die ;
$db = JFactory::getDbo();
OSMembershipHelperJquery::validateForm();
$selectedState = '';
?>

<script type="text/javascript">
	var siteUrl = '<?php echo OSMembershipHelper::getSiteUrl();  ?>';
	
	jQuery(document).ready(function(){
		jQuery( "div#osm-profile-page input" ).addClass( "form-control" );
	});
</script>

<div id="osm-profile-page" class="row-fluid osm-container">
<section>
<form action="" method="post" name="osm_form" id="osm_form" autocomplete="off" enctype="multipart/form-data" class="form form-horizontal">
	<div class="container">
    	<div class="page-header">
            <h1><span class="reg">Account</span> Basics</h1>
            <!--<p class="lead">Bootstrap 3 scaffolding has changed for improved display on mobile devices</p>-->
        </div>
        <div class="row row-eq-height">
        	<?php 
			if ($this->item->user_id) 
			{
			?> 
            <div class="col-lg-3">
            	
                    
                        <div class="inner-addon right-addon">
                        	<p>
                            <input type="text" class="username" placeholder="Enter your Username" value="<?php echo $this->item->username; ?>" disabled="disabled" />
                            </p>
                        </div>
                    	<div class="inner-addon right-addon">
                        	<p>
                            <input type="password" id="password" name="password"  class="password" placeholder="Password"  />
                            </p>
                        </div>
                    
                
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            <?php	
			}#end of user_id if condition	
			
			$fields = $this->form->getFields();
			?>
            <div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['first_name']))
					{
						echo "<p>".$fields['first_name']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['first_name']))
					{
						echo "<p>".$fields['last_name']->input."</p>";
					}
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            
            
            <div class="col-lg-4">
            		<div class="inner-addon right-addon">
                    	<h1 class="change-avatar"><span class="reg">Change Avatar</span></h1>
                        <?php
						if (isset($fields['osm_avatar']))
						{
							echo $fields['osm_avatar']->input;
						}
						?>
                    </div>
            </div>
        </div>
        
        
        <div class="page-header">
            <h1><span class="reg">Here`s your</span> Profile</h1>
            <!--<p class="lead">Bootstrap 3 scaffolding has changed for improved display on mobile devices</p>-->
        </div>
        
        <div class="row row-eq-height">
           <div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['organization']))
					{
						echo "<p>".$fields['organization']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['address']))
					{
						echo "<p>".$fields['address']->input."</p>";
					}
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            <div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['city']))
					{
						echo "<p>".$fields['city']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['zip']))
					{
						echo "<p>".$fields['zip']->input."</p>";
					}
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            <div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['country']))
					{
						echo "<p>".$fields['country']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['state']))
					{
						$selectedState = $fields['state']->value;
						foreach ($fields as $field)
						{  
							if($field->type=="State")
							echo $field->getControlGroup();    						    										
						}
					}
					
					
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1"><p>&nbsp;</p></div>
        </div>
        
        <div class="page-header">
            <h1><span class="reg">More</span> Details</h1>
            <!--<p class="lead">Bootstrap 3 scaffolding has changed for improved display on mobile devices</p>-->
        </div>
        <div class="row row-eq-height">
        	<div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['phone']))
					{
						echo "<p>".$fields['phone']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['email']))
					{
						echo "<p>".$fields['email']->input."</p>";
					}
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            <div class="col-lg-3">
            		<div class="inner-addon right-addon">
                    <?php
                    if (isset($fields['osm_referrer']))
					{
						echo "<p>".$fields['osm_referrer']->input."</p>";
					}
					?>
                    </div>
                    <div class="inner-addon right-addon">
                     <?php
                    if (isset($fields['osm_industry']))
					{
						echo "<p>".$fields['osm_industry']->input."</p>";
					}
					?>
                    </div>
                    
            </div>
            <div class="col-lg-1">
            		<div class="arrow_pointer"></div>
            </div>
            <div class="col-lg-3">
            		<div class="inner-addon right-addon">
            			<input type="submit" id="submit" value=""/>
                    </div>
            </div>
            			
            <?php echo JHtml::_( 'form.token' ); ?>				

        </div>
       
        
    </div>
    	<input type="hidden" name="option" value="com_osmembership" />
        <input type="hidden" name="cid[]" value="<?php echo $this->item->id; ?>" />
        <input type="hidden" name="task" value="update_profile" />
        <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
      </form>
</section>


	
    
    

				
		
</div>		
<div class="clearfix"></div>


<script type="text/javascript">
	OSM.jQuery(function($){
		$(document).ready(function(){
			OSMVALIDATEFORM("#osm_form");
			OSMVALIDATEFORM("#osm_form_renew");
			OSMVALIDATEFORM("#osm_form_update_membership");
			buildStateField('state', 'country', '<?php echo $selectedState; ?>');
		})
	});
</script>
</div>