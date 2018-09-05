<?php
/**
 * This file is part of Notadd.
 *
 * @author Qiyueshiyi <qiyueshiyi@outlook.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-04-19 14:07
 */
namespace Notadd\Member\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class VerificationTokenGenerated.
 */
class VerificationTokenGenerated extends Mailable
{
    /**
     * Member instance
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $user;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $from;

    /**
     * @var string
     */
    public $name;

    /**
     * VerificationTokenGenerated constructor.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param                                            $token
     * @param null                                       $subject
     * @param null                                       $from
     * @param null                                       $name
     */
    public function __construct(
        Authenticatable $user,
        $token,
        $subject = null,
        $from = null,
        $name = null
    )
    {
        $this->user    = $user;
        $this->from    = $from;
        $this->name    = $name;
        $this->token   = $token;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (! empty($this->from)) {
            $this->from($this->from, $this->name);
        }

        $this->subject(empty($this->subject) ? '邮箱激活' : $this->subject)
            ->view('member::email.user_email_verification');

        return $this;
    }
}
