<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use AlfredTime\Time;
use Alfred\Workflows\Workflow;
use AlfredTime\Config;

$workflow = new Workflow();
$config = new Config(getenv('alfred_workflow_data') . '/config.json');
$time = new Time($config);

$query = trim($argv[1]);

$projects = $time->getProjects();

$workflow->result()
    ->arg('')
    ->title('No project')
    ->subtitle('Timer will be created without a project')
    ->type('default')
    ->valid(true);

foreach ($projects as $project) {
    $workflow->result()
        ->arg($project['id'])
        ->title($project['name'])
        ->subtitle('Toggl project')
        ->type('default')
        ->icon('icons/toggl.png')
        ->valid(true);
}

$workflow->filterResults($query);

echo $workflow->output();
