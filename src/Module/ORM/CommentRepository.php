<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\Comment\ORM;

use CRM\ORM\Repository;

class CommentRepository extends Repository
{
    public $dbTable = '#__comment';

    public function findComments($module, $entity, $entityId)
    {
        return $this->selectQuery('SELECT *
            FROM #__comment
            WHERE
                    `module`   = :module
                AND `entity`   = :entity
                AND `entityId` = :entityId
            ORDER BY date DESC', [
                ':module'   => $module,
                ':entity'   => $entity,
                ':entityId' => $entityId
            ]);
    }
}
