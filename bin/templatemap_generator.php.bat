@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/zendframework/zend-view/bin/templatemap_generator.php
php "%BIN_TARGET%" %*
