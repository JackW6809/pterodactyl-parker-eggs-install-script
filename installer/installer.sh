port=$1
if ! [ -x "$(command -v curl)" ]; then
    apt -y update
    apt install -y curl
fi
php artisan p:environment:setup -n --author=test@test.com --url=https://panel.test.com --timezone=Europe/London --cache=file --session=file --queue=sync
php artisan p:environment:database --host=127.0.0.1 --port=$port --database=panel_test --username=root --password=""
php artisan migrate --seed --force
cd database/Seeders
mkdir temp
mv NestSeeder.php EggSeeder.php temp/
curl -Lo data.zip https://github.com/JackW6809/pterodactyl-parker-eggs-install-script/releases/latest/download/data.zip
unzip -n data.zip
rm data.zip
php ../../artisan migrate --seed --force
mv temp/NestSeeder.php temp/EggSeeder.php .
