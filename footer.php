<?php if (@$gsExport == "") { ?>
<?php if (@!$gbSkipHeaderFooter) { ?>
				<!-- right column (end) -->
				<?php if (isset($gTimer)) $gTimer->Stop() ?>
			</div>
		</div>
	</div>
	<!-- content (end) -->
	<!-- footer (begin) --><!-- ** Note: Only licensed users are allowed to remove or change the following copyright statement. ** -->
	<div id="ewFooterRow" class="ewFooterRow">	
		<div class="ewFooterText"><?php echo $Language->ProjectPhrase("FooterText") ?></div>
		<!-- Place other links, for example, disclaimer, here -->		
	</div>
	<!-- footer (end) -->	
</div>
<?php } ?>
<!-- modal dialog -->
<div id="ewModalDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- modal lookup dialog -->
<div id="ewModalLookupDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- add option dialog -->
<div id="ewAddOptDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("AddBtn") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- email dialog -->
<div id="ewEmailDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div>
<div class="modal-body">
<?php include_once "ewemail13.php" ?>
</div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("SendEmailBtn") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("MessageOK") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
jQuery.get("<?php echo $EW_RELATIVE_PATH ?>phpjs/userevt13.js");
</script>
<script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");
// Write your global startup script here
// document.write("page loaded");
	// Table 't03_pinjaman' Field 'Pinjaman'

	$('[data-table=t03_pinjaman][data-field=x_Pinjaman]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["LamaAngsuran"].val());
				var bunga = parseFloat($row["Bunga"].val());
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["AngsuranPokok"].val(angsuran_pokok);
				$row["AngsuranBunga"].val(angsuran_bunga);
				$row["AngsuranTotal"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'LamaAngsuran'
	$('[data-table=t03_pinjaman][data-field=x_LamaAngsuran]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["LamaAngsuran"].val());
				var bunga = parseFloat($row["Bunga"].val());
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["AngsuranPokok"].val(angsuran_pokok);
				$row["AngsuranBunga"].val(angsuran_bunga);
				$row["AngsuranTotal"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'Bunga'
	$('[data-table=t03_pinjaman][data-field=x_Bunga]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var lama_angsuran = parseFloat($row["LamaAngsuran"].val());
				var bunga = parseFloat($row["Bunga"].val());
				var angsuran_pokok = pinjaman / lama_angsuran;
				var angsuran_bunga = pinjaman * (bunga / 100);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["AngsuranPokok"].val(angsuran_pokok);
				$row["AngsuranBunga"].val(angsuran_bunga);
				$row["AngsuranTotal"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'AngsuranPokok'
	$('[data-table=t03_pinjaman][data-field=x_AngsuranPokok]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var angsuran_pokok_asli = $row["AngsuranPokok"].val();
				var angsuran_pokok_clean = angsuran_pokok_asli.replace(/,/g, '');
				var angsuran_pokok = parseFloat(angsuran_pokok_clean);
				var angsuran_bunga_asli = $row["AngsuranBunga"].val();
				var angsuran_bunga_clean = angsuran_bunga_asli.replace(/,/g, '');
				var angsuran_bunga = parseFloat(angsuran_bunga_clean);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["AngsuranTotal"].val(angsuran_total);
			}
		}
	);

	// Table 't03_pinjaman' Field 'AngsuranBunga'
	$('[data-table=t03_pinjaman][data-field=x_AngsuranBunga]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var angsuran_pokok_asli = $row["AngsuranPokok"].val();
				var angsuran_pokok_clean = angsuran_pokok_asli.replace(/,/g, '');
				var angsuran_pokok = parseFloat(angsuran_pokok_clean);
				var angsuran_bunga_asli = $row["AngsuranBunga"].val();
				var angsuran_bunga_clean = angsuran_bunga_asli.replace(/,/g, '');
				var angsuran_bunga = parseFloat(angsuran_bunga_clean);
				var angsuran_total = angsuran_pokok + angsuran_bunga;
				$row["AngsuranTotal"].val(angsuran_total);
				var pinjaman_asli = $row["Pinjaman"].val();
				var pinjaman_clean = pinjaman_asli.replace(/,/g, '');
				var pinjaman = parseFloat(pinjaman_clean);
				var bunga_asli = (angsuran_bunga / pinjaman) * 100;
				var bunga = bunga_asli.toFixed(2);
				$row["Bunga"].val(bunga);
			}
		}
	);

	// Table 't04_angsuran' Field 'pinjamantitipan_id'
	$('[data-table=t04_angsuran][data-field=x_pinjamantitipan_id]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				$row["Bayar_Titipan"].val($row["pinjamantitipan_id"].find("option:selected").text());

				// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);
				$row["Bayar_Titipan"].val(titipan);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);
			}
		}
	);

	// Table 't04_angsuran' Field 'TotalDenda'
	$('[data-table=t04_angsuran][data-field=x_TotalDenda]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();

				// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);
			}
		}
	);

	// Table 't04_angsuran' Field 'Bayar_Titipan'
	$('[data-table=t04_angsuran][data-field=x_Bayar_Titipan]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();

				// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);
			}
		}
	);

	// Table 't04_angsuran' Field 'Bayar_Non_Titipan'
	$('[data-table=t04_angsuran][data-field=x_Bayar_Non_Titipan]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();

				// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);
			}
		}
	);

	// Table 't04_angsuran' Field 'Bayar_Non_Titipan'
	$('[data-table=t04_angsuran][data-field=x_Bayar_Non_Titipan]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();

				// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);
			}
		}
	);
</script>
<?php } ?>
</body>
</html>
