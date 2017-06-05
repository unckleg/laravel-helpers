<?php

/*
 * This file is part of the Laravel Helpers package.
 *
 * (c) Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 * MIT License https://mit-license.org
 *
 */
namespace Unckleg\Helpers\Console;

use Illuminate\Console\Command;

/**
 * Class HelpersCommand
 *
 * @author Djordje Stojiljkovic <djordjestojilljkovic@gmail.com>
 *
 */
class HelpersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name} {--type=true} ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Helper class';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Get arguments
        $helperName = $this->argument('name');
        $type       = $this->option('type');
        $answer     = $this->confirm(
            'Helper with name ' . ucfirst($helperName) . ' will be created. Continue [y|n]?'
        );

        if ($answer === true) {
            $config = $this->getConfig();
            $helpersDir = app_path()  . '/' . $config['directories']['root'] .'/'. $config['directories']['view'];
            $helperPath = $helpersDir . '/' . ucfirst($helperName) . '.php';

            // Check if Helper already exist
            if (file_exists($helperPath)) {
                $this->error('Oops, Helper with name: ' . ucfirst($helperName) . ' already exist.');
                exit();
            }

            // Check if directory exist if not create it
            if (!is_dir($helpersDir)) {
                mkdir($helpersDir, 0777, true);
            }

            if ($this->isWritable($helpersDir) === true) {
                // show some animated progress
                $this->showProgress();

                $fp = fopen($helperPath, "wb");
                fwrite($fp, str_replace(
                    ['{{ class }}', '{{ class_blade }}', '{{ namespace }}'],
                    [ucfirst($helperName), lcfirst($helperName), $this->getViewHelpersNamespace()],
                    file_get_contents(__DIR__.'/stubs/View.stub')
                ));

                $this->info('Helper class: ' . ucfirst($helperName) . ' created successfully. Happy coding!' );
            }
        }
    }


    /**
     * getConfig returns helpers config.
     * If local config is published then it 'll fetch array from there else from vendor directory.
     *
     * @return mixed
     */
    private function getConfig()
    {
        return config('helpers');
    }

    /**
     * getViewHelpersNamspace returns namespace that is configured in app config.
     */
    private function getViewHelpersNamespace()
    {
        $config = config('helpers.directories');

        // directories
        $root   = $config['root'];
        $view   = $config['view'];

        return 'App\\' . $root . '\\' . $view;
    }

    /**
     * isWritable method check if passed directory is writable.
     *
     * @param $helpersDir
     * @return mixed
     */
    private function isWritable($helpersDir)
    {
        if (is_writable($helpersDir)) {
            return true;
        }
        $this->error(
            'Oops, make sure you grant permission for Helpers directory because currently you don\'t have one.'
        ); exit();
    }
    /**
     * showProgress method used to show animated progress during helper creation.
     */
    private function showProgress()
    {
        $this->output->progressStart(3);
        for ($i = 0; $i < 3; $i++) {
            sleep(1);
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
    }
}