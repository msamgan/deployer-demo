<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/msamgan/deployer-demo.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts
host('146.190.32.125')
    ->set('remote_user', 'msamgan_deployer')
    ->set('deploy_path', '~/htdocs/deployer.msamgan.com');

task('optimize', function () {
    cd('{{release_path}}');
    run('php artisan optimize');
});

task('clearCache', function () {
    cd('{{current_path}}');
    run('php artisan cache:clear');
});

after('deploy:symlink', 'optimize');

// Hooks

after('deploy:failed', 'deploy:unlock');
