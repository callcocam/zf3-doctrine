@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../vendor/zfcampus/zf-development-mode/bin/zf-development-mode
php "%BIN_TARGET%" %*
