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
use Symfony\Component\Workflow\Transition;

/**
 * Class MemberNotification.
 */
class MemberNotification extends Entity
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
        return 'member.notification';
    }

    /**
     * @return array
     */
    public function places()
    {
        return [
            'launch',
            'launched',
            'review',
            'reviewed',
            'publish',
            'published',
        ];
    }

    /**
     * @return array
     */
    public function transitions()
    {
        return [
            new Transition('launch', 'launch', 'launched'),
            new Transition('wait_to_review', 'launched', 'review'),
            new Transition('review', 'review', 'reviewed'),
            new Transition('wait_to_publish', 'reviewed', 'publish'),
            new Transition('publish', 'publish', 'published'),
        ];
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
