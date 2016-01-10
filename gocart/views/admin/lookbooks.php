<?php include('header.php'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};
function create_sortable()
{
	$('#lookbooks_sortable').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		update: function(){
			save_sortable();
		}
	});	
	$('#lookbooks_sortable').sortable('enable');
}

function save_sortable()
{
	serial=$('#lookbooks_sortable').sortable('serialize');
			
	$.ajax({
		url:'<?php echo site_url($this->config->item('admin_folder').'/lookbooks/organize');?>',
		type:'POST',
		data:serial
	});
}
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete_lookbook');?>');
}
//]]>
</script>



<div class="button_set">
	<a href="<?php echo site_url($this->config->item('admin_folder').'/lookbooks/form'); ?>"><?php echo lang('add_new_lookbook');?></a>
</div>

<table class="gc_table" cellspacing="0" cellpboxding="0">
	<thead>
		<tr>
			<th class="gc_cell_left"><?php echo lang('title');?></th>
			<th><?php echo lang('enable_on');?></th>
			<th><?php echo lang('disable_on');?></th>
			<th class="gc_cell_right"></th>
		</tr>
	</thead>
	<?php echo (count($lookbooks) < 1)?'<tr><td style="text-align:center;" colspan="4">'.lang('no_lookbooks').'</td></tr>':''?>

	<?php if($lookbooks):?>
	<tbody id="lookbooks_sortable">
	<?php
	foreach ($lookbooks as $lookbook):

		//clear the dates out if they're all zeros
		if ($lookbook->enable_on == '0000-00-00')
		{
			$enable_test	= false;
			$enable			= '';
		}
		else
		{
			$eo			 	= explode('-', $lookbook->enable_on);
			$enable_test	= $eo[0].$eo[1].$eo[2];
			$enable			= $eo[1].'-'.$eo[2].'-'.$eo[0];
		}

		if ($lookbook->disable_on == '0000-00-00')
		{
			$disable_test	= false;
			$disable		= '';
		}
		else
		{
			$do			 	= explode('-', $lookbook->disable_on);
			$disable_test	= $do[0].$do[1].$do[2];
			$disable		= $do[1].'-'.$do[2].'-'.$do[0];
		}


		$disabled_icon	= '';
		$curDate		= date('Ymd');

		if (($enable_test && $enable_test > $curDate) || ($disable_test && $disable_test <= $curDate))
		{
			$disabled_icon	= '<span style="color:#ff0000;">&bull;</span> ';
		}
		?>
		<tr id="lookbooks-<?php echo $lookbook->id;?>">
			<td><?php echo $disabled_icon.$lookbook->title;?></td>
			<td><?php echo $enable;?></td>
			<td><?php echo $disable;?></td>
			<td class="gc_cell_right list_buttons">
				<a href="<?php echo site_url($this->config->item('admin_folder').'/lookbooks/delete/'.$lookbook->id); ?>" onclick="return areyousure();"><?php echo lang('delete');?></a>
				<a href="<?php echo site_url($this->config->item('admin_folder').'/lookbooks/form/'.$lookbook->id); ?>"><?php echo lang('edit');?></a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<?php endif;?>
</table>
<?php include('footer.php'); ?>