<?php

// index_
// subj_

?>
<?php if ($t93_logmain->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t93_logmain->TableCaption() ?></h4> -->
<table id="tbl_t93_logmainmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t93_logmain->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t93_logmain->index_->Visible) { // index_ ?>
		<tr id="r_index_">
			<td><?php echo $t93_logmain->index_->FldCaption() ?></td>
			<td<?php echo $t93_logmain->index_->CellAttributes() ?>>
<span id="el_t93_logmain_index_">
<span<?php echo $t93_logmain->index_->ViewAttributes() ?>>
<?php echo $t93_logmain->index_->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t93_logmain->subj_->Visible) { // subj_ ?>
		<tr id="r_subj_">
			<td><?php echo $t93_logmain->subj_->FldCaption() ?></td>
			<td<?php echo $t93_logmain->subj_->CellAttributes() ?>>
<span id="el_t93_logmain_subj_">
<span<?php echo $t93_logmain->subj_->ViewAttributes() ?>>
<?php echo $t93_logmain->subj_->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
