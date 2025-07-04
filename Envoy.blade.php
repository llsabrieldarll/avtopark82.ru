@servers(['avtopark82' => 'eldar@avtopark82.ru'])

@task('deploy', ['on' => 'avtopark82'])
    cd /home/eldar/avtopark82.ru
    set -e
    echo "Deploying..."
    git pull origin master
    php artisan down
    composer install --no-dev --optimize-autoloader
    php artisan migrate --force
    php artisan config:cache
    php artisan event:cache
    php artisan route:cache
    php artisan view:cache
    npm install
    npm run build
    php artisan up
    echo "Done!"
@endtask
