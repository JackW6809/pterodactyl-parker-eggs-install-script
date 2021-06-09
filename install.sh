cd /var/www/pterodactyl/database/Seeders
rm NestSeeder.php
wget https://github.com/JackW6809/pterodactyl-parker-eggs-install-script/releases/latest/download/data.zip
unzip -n master.zip
rm data.zip
cd ../../
php artisan migrate --seed --force
