<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-06-01 18:48
 */
namespace Notadd\Member\Flows;

use Notadd\Foundation\Flow\Abstracts\Entity;
use Symfony\Component\Workflow\Event\GuardEvent;

/**
 * Class MemberPermission.
 */
class MemberPermission extends Entity
{
    /**
     * @return array
     */
    public function events()
    {
        return [];
    }

    /**
     * @return string
     */
    public function name()
    {
        return 'member.permission';
    }

    /**
     * @return array
     */
    public function places()
    {
        return [];
    }

    /**
     * @return array
     */
    public function transitions()
    {
        return [];
    }

    /**
     * Guard a transition.
     *
     * @param \Symfony\Component\Workflow\Event\GuardEvent $event
     */
    public function guard(GuardEvent $event)
    {
        // TODO: Implement guard() method.
    }
}
