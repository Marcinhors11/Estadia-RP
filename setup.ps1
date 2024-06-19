Write-Output "Iniciando configuración del proyecto..."

# Instalación de dependencias con Composer
Write-Output "Instalando dependencias con Composer..."
composer install

# Configuración de variables de entorno
Copy-Item .env.example .env
php artisan key:generate

# Ejecución de migraciones y sembrado de datos
php artisan migrate --seed

# Crear enlace simbólico para el almacenamiento
php artisan storage:link

Write-Output "Configuración completa."
