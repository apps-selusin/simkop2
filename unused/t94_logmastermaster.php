<?php

// id
// index_
// subject

?>
<?php if ($t94_logmaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t94_logmaster->TableCaption() ?></h4> -->
<table id="tbl_t94_logmastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t94_logmaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t94_logmaster->id->Visible) { // id ?>
		<tr id="r_id">
			<td><?php echo $t94_logmaster->id->FldCaption() ?></td>
			<td<?php echo $t94_logmaster->id->CellAttributes() ?>>
<span id="el_t94_logmaster_id">
<span<?php echo $t94_logmaster->id->ViewAttributes() ?>>
<?php echo $t94_logmaster->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t94_logmaster->index_->Visible) { // index_ ?>
		<tr id="r_index_">
			<td><?php echo $t94_logmaster->index_->FldCaption() ?></td>
			<td<?php echo $t94_logmaster->index_->CellAttributes() ?>>
<span id="el_t94_logmaster_index_">
<span<?php echo $t94_logmaster->index_->ViewAttributes() ?>>
<?php echo $t94_logmaster->index_->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t94_logmaster->subject->Visible) { // subject ?>
		<tr id="r_subject">
			<td><?php echo $t94_logmaster->subject->FldCaption() ?></td>
			<td<?php echo $t94_logmaster->subject->CellAttributes() ?>>
<span id="el_t94_logmaster_subject">
<span<?php echo $t94_logmaster->subject->ViewAttributes() ?>>
<?php echo $t94_logmaster->subject->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
