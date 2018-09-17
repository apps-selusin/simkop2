<?php

// NoKontrak
// TglKontrak
// nasabah_id
// Pinjaman
// LamaAngsuran
// Bunga
// Denda
// DispensasiDenda
// AngsuranPokok
// AngsuranBunga
// AngsuranTotal
// NoKontrakRefTo

?>
<?php if ($t03_pinjaman->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t03_pinjaman->TableCaption() ?></h4> -->
<table id="tbl_t03_pinjamanmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t03_pinjaman->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t03_pinjaman->NoKontrak->Visible) { // NoKontrak ?>
		<tr id="r_NoKontrak">
			<td><?php echo $t03_pinjaman->NoKontrak->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->NoKontrak->CellAttributes() ?>>
<span id="el_t03_pinjaman_NoKontrak">
<span<?php echo $t03_pinjaman->NoKontrak->ViewAttributes() ?>>
<?php echo $t03_pinjaman->NoKontrak->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->TglKontrak->Visible) { // TglKontrak ?>
		<tr id="r_TglKontrak">
			<td><?php echo $t03_pinjaman->TglKontrak->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->TglKontrak->CellAttributes() ?>>
<span id="el_t03_pinjaman_TglKontrak">
<span<?php echo $t03_pinjaman->TglKontrak->ViewAttributes() ?>>
<?php echo $t03_pinjaman->TglKontrak->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->nasabah_id->Visible) { // nasabah_id ?>
		<tr id="r_nasabah_id">
			<td><?php echo $t03_pinjaman->nasabah_id->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->nasabah_id->CellAttributes() ?>>
<span id="el_t03_pinjaman_nasabah_id">
<span<?php echo $t03_pinjaman->nasabah_id->ViewAttributes() ?>>
<?php echo $t03_pinjaman->nasabah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Pinjaman->Visible) { // Pinjaman ?>
		<tr id="r_Pinjaman">
			<td><?php echo $t03_pinjaman->Pinjaman->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Pinjaman->CellAttributes() ?>>
<span id="el_t03_pinjaman_Pinjaman">
<span<?php echo $t03_pinjaman->Pinjaman->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Pinjaman->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->LamaAngsuran->Visible) { // LamaAngsuran ?>
		<tr id="r_LamaAngsuran">
			<td><?php echo $t03_pinjaman->LamaAngsuran->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->LamaAngsuran->CellAttributes() ?>>
<span id="el_t03_pinjaman_LamaAngsuran">
<span<?php echo $t03_pinjaman->LamaAngsuran->ViewAttributes() ?>>
<?php echo $t03_pinjaman->LamaAngsuran->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Bunga->Visible) { // Bunga ?>
		<tr id="r_Bunga">
			<td><?php echo $t03_pinjaman->Bunga->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Bunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_Bunga">
<span<?php echo $t03_pinjaman->Bunga->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Bunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->Denda->Visible) { // Denda ?>
		<tr id="r_Denda">
			<td><?php echo $t03_pinjaman->Denda->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->Denda->CellAttributes() ?>>
<span id="el_t03_pinjaman_Denda">
<span<?php echo $t03_pinjaman->Denda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->Denda->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->DispensasiDenda->Visible) { // DispensasiDenda ?>
		<tr id="r_DispensasiDenda">
			<td><?php echo $t03_pinjaman->DispensasiDenda->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->DispensasiDenda->CellAttributes() ?>>
<span id="el_t03_pinjaman_DispensasiDenda">
<span<?php echo $t03_pinjaman->DispensasiDenda->ViewAttributes() ?>>
<?php echo $t03_pinjaman->DispensasiDenda->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranPokok->Visible) { // AngsuranPokok ?>
		<tr id="r_AngsuranPokok">
			<td><?php echo $t03_pinjaman->AngsuranPokok->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->AngsuranPokok->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranPokok">
<span<?php echo $t03_pinjaman->AngsuranPokok->ViewAttributes() ?>>
<?php echo $t03_pinjaman->AngsuranPokok->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranBunga->Visible) { // AngsuranBunga ?>
		<tr id="r_AngsuranBunga">
			<td><?php echo $t03_pinjaman->AngsuranBunga->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->AngsuranBunga->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranBunga">
<span<?php echo $t03_pinjaman->AngsuranBunga->ViewAttributes() ?>>
<?php echo $t03_pinjaman->AngsuranBunga->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->AngsuranTotal->Visible) { // AngsuranTotal ?>
		<tr id="r_AngsuranTotal">
			<td><?php echo $t03_pinjaman->AngsuranTotal->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->AngsuranTotal->CellAttributes() ?>>
<span id="el_t03_pinjaman_AngsuranTotal">
<span<?php echo $t03_pinjaman->AngsuranTotal->ViewAttributes() ?>>
<?php echo $t03_pinjaman->AngsuranTotal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_pinjaman->NoKontrakRefTo->Visible) { // NoKontrakRefTo ?>
		<tr id="r_NoKontrakRefTo">
			<td><?php echo $t03_pinjaman->NoKontrakRefTo->FldCaption() ?></td>
			<td<?php echo $t03_pinjaman->NoKontrakRefTo->CellAttributes() ?>>
<span id="el_t03_pinjaman_NoKontrakRefTo">
<span<?php echo $t03_pinjaman->NoKontrakRefTo->ViewAttributes() ?>>
<?php echo $t03_pinjaman->NoKontrakRefTo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
