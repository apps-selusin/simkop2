<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(11, "mi_cf01_home_php", $Language->MenuPhrase("11", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(3, "mi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", -1, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t03_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mci_Setup", $Language->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t01_nasabah'), FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mi_t96_employees", $Language->MenuPhrase("7", "MenuText"), "t96_employeeslist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mi_t97_userlevels", $Language->MenuPhrase("8", "MenuText"), "t97_userlevelslist.php", 12, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(10014, "mi_t94_log", $Language->MenuPhrase("10014", "MenuText"), "t94_loglist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t94_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(10011, "mci_List", $Language->MenuPhrase("10011", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(10010, "mri_t995faudittrail", $Language->MenuPhrase("10010", "MenuText"), "t99_audittrailrpt.php", 10011, "{1F354293-F296-4B13-80A8-520A61B09C85}", AllowListMenu('{1F354293-F296-4B13-80A8-520A61B09C85}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(10013, "mi_cf02_cfu_php", $Language->MenuPhrase("10013", "MenuText"), "cf02_cfu.php", -1, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}cf02_cfu.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
