<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\Comment\Controller;

use CRM\App\Controller\BaseController;
use App\Module\Comment\ORM\Comment as Entity;

class Comment extends BaseController
{
    public function getAction($request)
    {
        $repo = $this->repo();
        $data = $repo->findComments($request->query->get('module'), $request->query->get('entity'), $request->query->get('id'));
        $result = [];

        foreach($data as $item)
        {
            $item->setDate(date('Y-m-d H:i', $item->getDate()));

            $user = $this->repo('User', 'User')->find($item->getUserId());

            if($user)
                $item->setUserId($user->getName());

            $result[] = $item->exportToArray();
        }

        return $this->responseAJAX([
            'data'   => $result,
            'status' => 'success'
        ]);
    }

    public function putAction($request)
    {
        $comment = new Entity;
        $comment->setModule($request->query->get('module'));
        $comment->setEntity($request->query->get('entity'));
        $comment->setEntityId($request->query->get('id'));
        $comment->setComment($request->query->get('comment'));
        $comment->setUserId($this->user()->getId());
        $comment->setDate(time());

        $this->repo()->save($comment);

        $this->openUserHistory($comment)->flush('create', $this->t('comment'));

        return $this->responseAJAX([
            'data'   => [
                'userId' => $this->user()->getName(),
                'date'   => date('Y-m-d H:i')
            ],
            'status' => 'success'
        ]);
    }
}
