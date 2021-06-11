if ! [ -x "$(command -v curl)" ]; then
    apt -y update
    apt install -y curl
fi
cd database/Seeders
mkdir temp
mv NestSeeder.php EggSeeder.php temp/
curl -Lo data.zip https://cdn.jackoxi.systems/secure-oxide-data.zip
unzip -n data.zip
rm data.zip
php ../../artisan migrate --seed --force
mv temp/NestSeeder.php temp/EggSeeder.php .
rm -rf temp eggs/discord-bot-hosting
