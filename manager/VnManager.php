<?php

namespace Manager;

use PDO;

class VnManager extends Manager
{
    /**
     * VnManager constructor.
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        parent::__construct('Model\Vietnam', $db);
    }

}