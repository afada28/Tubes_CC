@echo off
echo ========================================
echo Installing Laravel Socialite and Midtrans
echo ========================================

set SSL_CERT_FILE=C:\xampp\php\extras\ssl\cacert.pem
set CURL_CA_BUNDLE=C:\xampp\php\extras\ssl\cacert.pem

cd /d "c:\Pongs\joki tugas web fada\GrahaAlfaAmertha"

echo.
echo Disabling SSL check temporarily...
composer config -g -- disable-tls true
composer config -g -- secure-http false

echo.
echo Updating composer lock file...
composer update --lock --no-interaction

echo.
echo Installing packages...
composer install --no-interaction

echo.
echo Done!
pause
