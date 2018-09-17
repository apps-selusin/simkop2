<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(11, "mmi_cf01_home_php", $Language->MenuPhrase("11", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(3, "mmi_t03_pinjaman", $Language->MenuPhrase("3", "MenuText"), "t03_pinjamanlist.php", -1, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t03_pinjaman'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mmci_Setup", $Language->MenuPhrase("12", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mmi_t01_nasabah", $Language->MenuPhrase("1", "MenuText"), "t01_nasabahlist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t01_nasabah'), FALSE, FALSE);
$RootMenu->AddMenuItem(7, "mmi_t96_employees", $Language->MenuPhrase("7", "MenuText"), "t96_employeeslist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mmi_t97_userlevels", $Language->MenuPhrase("8", "MenuText"), "t97_userlevelslist.php", 12, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(9, "mmi_t98_userlevelpermissions", $Language->MenuPhrase("9", "MenuText"), "t98_userlevelpermissionslist.php", 12, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mmi_t99_audittrail", $Language->MenuPhrase("10", "MenuText"), "t99_audittraillist.php", 12, "", AllowListMenu('{51CA4EA8-8F8C-4E6D-9D3C-6714DAAEE6FC}t99_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
