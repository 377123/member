<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-14 16:23
 */
namespace Notadd\Member\Handlers\Administration\Notification;

use Notadd\Foundation\Member\Member;
use Notadd\Foundation\Routing\Abstracts\Handler;
use Notadd\Member\Notifications\CommonNotify;

/**
 * Class SendHandler.
 */
class SendHandler extends Handler
{
    public function execute()
    {
        $this->validate($this->request, [
            'content' => 'required',
            'title' => 'required',
            'users' => 'required',
            'way' => 'required',
        ], [
            'content.required' => '必须填写消息内容！',
            'title.required' => '必须填写消息标题！',
            'users.required' => '必须选择用户！',
            'way.required' => '必须选择发送方式！',
        ]);
        $users = collect($this->request->input('users'));
        if ($users->isEmpty()) {
            $this->withCode(500)->withError('发送用户列表为空！');
        } else {
            $users->transform(function ($id) {
                if (Member::query()->where('id', $id)->count()) {
                    return Member::query()->find($id);
                } else {
                    return Member::query()->find(1);
                }
            });
            $users->each(function (Member $user) {
                $user->notify(new CommonNotify([
                    'content' => $this->request->input('content'),
                    'title' => $this->request->input('title'),
                ]));
            });
            $this->withCode(200)->withMessage('');
        }
    }
}
