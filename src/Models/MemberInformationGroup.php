<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-04 18:41
 */
namespace Notadd\Member\Models;

use Notadd\Foundation\Database\Model;

/**
 * Class MemberInformationGroup.
 */
class MemberInformationGroup extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
        'show',
    ];

    /**
     * @var string
     */
    protected $table = 'member_information_groups';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function informations()
    {
        return $this->belongsToMany(MemberInformation::class, 'member_information_relations', 'group_id', 'information_id');
    }
}
