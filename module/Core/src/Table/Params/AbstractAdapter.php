<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Core\Table\Params;

use Core\Table\AbstractCommon;
use Core\Table\Config;

abstract class AbstractAdapter extends AbstractCommon
{

    /**
     * Get configuration of table
     *
     * @return \Core\Table\Options\ModuleOptions
     * @throws \Exception
     */
    public function getOptions()
    {
        return $this->getTable()->getOptions();
    }
}
