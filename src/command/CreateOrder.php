<?php

namespace BadpersonOrder\command;

use think\console\Input;
use think\console\Output;
use think\migration\command\Migrate;

class CreateOrder extends Migrate
{

    protected function configure()
    {
        $this->setName('CreateOrder')
             ->setDescription('Create a new order migration');
    }

    protected function execute(Input $input, Output $output)
    {
        $path = $this->getPath();

        if (!file_exists($path)) {
            if ($this->output->confirm($this->input, 'Create migrations directory? [y]/n')) {
                mkdir($path, 0755, true);
            }
        }

        $this->verifyMigrationDirectory($path);

        $path      = realpath($path);

        $all_file = [
            'order' => __DIR__ . '/order.stub',
            'order_info' => __DIR__ . '/order_info.stub'
        ];

        foreach ($all_file as $k => $v) {

            $fileName = date('YmdHis').rand(100,999).'_'.$k.'.php';
            $filePath = $path . DIRECTORY_SEPARATOR . $fileName;

            if (is_file($filePath)) {
                throw new \InvalidArgumentException(sprintf('The file "%s" already exists', $filePath));
            }

            // Load the alternative template if it is defined.
            $contents = file_get_contents($v);

            // inject the class names appropriate to this migration

            if (false === file_put_contents($filePath, $contents)) {
                throw new \RuntimeException(sprintf('The file "%s" could not be written to', $path));
            }

            $output->writeln('<info>created</info> .' . str_replace(getcwd(), '', $filePath));
        }
    }
}

