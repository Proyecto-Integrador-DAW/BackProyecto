<?php
    namespace Deployer;

    require 'recipe/laravel.php';

    // Config

    set('repository', 'https://github.com/Proyecto-Integrador-DAW/BackProyecto.git');
    set('branch', 'main');
    set('keep_releases', 3);
    
    // Archivos y directorios compartidos
    add('shared_files', ['.env']);
    add('shared_dirs', ['storage']);
    add('writable_dirs', ['bootstrap/cache', 'storage']);

    // Hosts

    host('13.216.195.181')
        ->set('remote_user', 'deployer')
        ->set('identity_file', '/home/alejandro/Escritorio/Despliegue/scripts/llaves/llave_alex')
        ->set('deploy_path', '/var/www/back/html');

    // Hooks

    task('deploy:backend', function () {
        run('cd {{deploy_path}}/current && composer install --optimize-autoloader');
        run('cd {{deploy_path}}/current && sudo npm install');
        run('cd {{deploy_path}}/current && sudo npm run build');
        run('cd {{deploy_path}}/current && php artisan cache:clear && php artisan config:cache');
    });
    
    task('deploy:permits', function () {
        run('sudo chown -R deployer:www-data {{deploy_path}}');
        run('sudo chmod -R 775 {{deploy_path}}/current/storage {{deploy_path}}/current/bootstrap/cache');
    });
    
    task('deploy:migration', function () {
        run('cd {{deploy_path}}/current && php artisan migrate:refresh --force');
        // run('cd {{deploy_path}}/current && php artisan db:seed');
    });

    task('deploy:swagger', function () {
        run('cd {{deploy_path}}/release && sudo php artisan l5-swagger:generate');
    });

    task('deploy:restartfpm', function () {
        run('sudo systemctl restart php8.3-fpm.service');
    });

    // Hooks de despliegue
    after('deploy:vendors', 'deploy:backend');
    after('deploy:backend', 'deploy:permits');
    after('deploy:permits', 'deploy:migration');
    after('deploy:migration', 'deploy:swagger');
    after('deploy:swagger', 'deploy:restartfpm');

    after('deploy:failed', 'deploy:unlock');
?>