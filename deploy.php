<?php

namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'blogg.kaveh.chas.academy');

// Project repository
set('repository', 'git@github.com:chas-academy/05-dynamisk-webbplats-php-Keejv.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
set('shared_files', ['./config/app.json']);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts
host('ssh.binero.se')
    ->set('deploy_path', '~/{{application}}')
    ->user('226743_deploy')
    ->port(22);

task('deploy:custom_webroot', function() {
    run("cd {{deploy_path}} && ln -sfn {{release_path}} public_html/web");
});

// Tasks
desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// After deploy, fix the symbolic link
after('deploy', 'deploy:custom_webroot');
