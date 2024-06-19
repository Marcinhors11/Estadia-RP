Write-Output "Iniciando configuraci�n del proyecto..."

# Instalaci�n de dependencias con Composer
Write-Output "Instalando dependencias con Composer..."
composer install

# Configuraci�n de variables de entorno
Copy-Item .env.example .env
php artisan key:generate

# Crear enlace simb�lico para el almacenamiento
php artisan storage:link

Write-Output "Configuraci�n completa."
