<?php

namespace Skeleton\Common\Models;

/**
 * Contents model.
 *
 * @copyright Copyright (c) 2020 innobotics (https://innobotics.eu)
 * @author Norbert Lakatos <norbert@innobotics.eu>
 */
class ModelBase extends \Phalcon\Mvc\Model
{

    /**
     * Initialize
     */
    public function initialize()
    {
        $this->setWriteConnectionService("dbMaster");

        $this->setReadConnectionService("dbSlave");
    }

}
