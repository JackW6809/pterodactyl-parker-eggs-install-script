if ! [ -x "$(command -v curl)" ]; then
    apt -y update
    apt install -y curl
fi
cd /var/www/pterodactyl/database/Seeders
rm NestSeeder.php EggSeeder.php
curl -Lo data.zip https://github.com/JackW6809/pterodactyl-parker-eggs-install-script/releases/latest/download/data.zip
unzip -n data.zip
rm data.zip
cd ../../
php artisan migrate --seed --force
