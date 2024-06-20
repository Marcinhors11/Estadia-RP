Write-Output "Iniciando configuracion del proyecto..."

# Instalacion de dependencias con Composer
Write-Output "Instalando dependencias con Composer..."
composer install

# Configuracion de variables de entorno
Copy-Item .env.example .env
php artisan key:generate

# Crear enlace simbolico para el almacenamiento
php artisan storage:link

Write-Output "Configuracion completa."
