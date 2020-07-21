<?php

	if(!isset($results)){$results = array();}
	if(!isset($selected) || !is_array($selected)){$selected = array();}
	if(!isset($name_assigned)){$name_assigned = '';}
	if(!isset($class_assigned)){$class_assigned = '';}
?>
<style>
input[type=checkbox][disabled] + label {
    color: #ccc;
	cursor:not-allowed;
}
</style>	
																	<?
																		foreach ($results as $b){
																	?>																	
																			<div class="checkbox-nice checkbox-inline 
																			<?php
																			if ($b['ENABLED'] != 'Y'){
																			?>
																				disabled 
																			<?php
																			}
																			if(in_array($b['VALUE'], $selected)){?> 
																				active 
																			<?php }?>
																			">
																				<input type="checkbox" name="<?php echo $name_assigned;?>" id="checkbox-<?php echo $name_assigned;?>-<?php echo $b['VALUE'];?>" value="<?php echo $b['VALUE'];?>" 
																				<?=$disabled?>
																				<?php
																				if ($b['ENABLED'] != 'Y'){
																				?> 
																					disabled 
																				<?php
																				}
																				if(in_array($b['VALUE'], $selected)){?> 
																					checked="checked" 
																				<?php }?>
																				
																				<?php echo $custom?>
																				/>
																				<label for="checkbox-<?php echo $name_assigned;?>-<?php echo $b['VALUE'];?>">
																					<?php echo $b['TEXT'];?>
																				</label>
																			</div>
																	<?php }?>