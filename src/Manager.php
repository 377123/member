<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2016, notadd.com
 * @datetime 2016-11-02 10:24
 */
namespace Notadd\Member;

use Notadd\Foundation\Member\Abstracts\Manager as AbstractManager;
use Notadd\Foundation\Member\Member;

/**
 * Class Manager.
 */
class Manager extends AbstractManager
{
    /**
     * Delete a member.
     *
     * @param int  $id
     * @param bool $force
     *
     * @return bool|mixed|null
     */
    public function delete(int $id, $force = false)
    {
        $member = Member::query()->find($id);
        if ($member) {
            return $force ? $member->forceDelete() : $member->delete();
        } else {
            return false;
        }
    }

    /**
     * Find a member.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function find(int $id)
    {
        return Member::query()->find($id);
    }

    /**
     * Store a member.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data)
    {
        return Member::query()->create($data);
    }

    /**
     * Update a member.
     *
     * @param int   $id
     * @param array $data
     * @param bool  $force
     *
     * @return mixed
     */
    public function update(int $id, array $data, $force = false)
    {
        $member = Member::query()->find($id);
        if ($member) {
            return $force ? $member->updateOrCreate($data) : $member->update($data);
        } else {
            return false;
        }
    }
}
