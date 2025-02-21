<?php
    namespace Deployer;

    require 'recipe/laravel.php';

    // Config

    set('repository', 'https://github.com/Proyecto-Integrador-DAW/BackProyecto.git');

    add('shared_files', []);
    add('shared_dirs', []);
    add('writable_dirs', []);

    // Hosts

    host('13.216.195.181')
        ->set('remote_user', 'deployer')
        ->set('deploy_path', '~/Back');

    // Hooks

    after('deploy:failed', 'deploy:unlock');
?>