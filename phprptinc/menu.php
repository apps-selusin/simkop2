<!-- Begin Main Menu -->
<div class="ewMenu">
<?php $RootMenu = new crMenu(EWR_MENUBAR_ID); ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(10, "mi_t99_audittrail", $ReportLanguage->Phrase("SimpleReportMenuItemPrefix") . $ReportLanguage->MenuPhrase("10", "MenuText") . $ReportLanguage->Phrase("SimpleReportMenuItemSuffix"), "t99_audittrailrpt.php", -1, "", TRUE, FALSE);
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
