<?php

namespace Skeleton\Modules\Cli\Tasks;

/**
 * Main task.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */
class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo 'Use: pp [OPTIONS][FUNCTION][PARAMETERS]' . PHP_EOL;
        echo '' . PHP_EOL;
        echo 'For more information about this command type --help for more:' . PHP_EOL;
        echo ' --help        show help' . PHP_EOL;
    }

}
