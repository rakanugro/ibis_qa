<?php

	if(!isset($results)){$results = array();}
	if(!isset($selected)){$selected = '';}
	if(!isset($name_assigned)){$name_assigned = '';}
	if(!isset($class_assigned)){$class_assigned = '';}
	
?>
<style>
input[type=radio][disabled] + label {
    color: #ccc;
	cursor:not-allowed;
}
</style>	

																		<div class="radio-inline hidden"></div><!-- style fix, don't delete -->
																	<?php	
																		foreach ($results as $b){
																	?>	
																		<div class="radio radio-inline 
																		<?php
																			if ($b['ENABLED'] != 'Y'){
																		?> 
																				disabled 
																		<?php
																			}
																			if($b['VALUE'] == $selected){
																		?> 
																				active 
																		<?php }?>
																		">
																			<input type="radio" name="<?php echo $name_assigned?>" id="radio-<?php echo $name_assigned?>-<?php echo $b['VALUE'];?>" value="<?php echo $b['VALUE'];?>" 
																			<?=$disabled?>
																			<?php
																				if ($b['ENABLED'] != 'Y'){
																			?> 
																				disabled 
																			<?php
																				}
																				if($b['VALUE'] == $selected){
																			?> 
																					checked="checked" 
																			<?php }?>
																			/>
																			<label for="radio-<?php echo $name_assigned?>-<?php echo $b['VALUE'];?>">
																				<?php echo $b['TEXT'];?>
																			</label>
																		</div>
																	<?php }?>	