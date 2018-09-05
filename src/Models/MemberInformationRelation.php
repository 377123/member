<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <heshudong@ibenchu.com>
 * @copyright (c) 2017, notadd.com
 * @datetime 2017-05-04 18:48
 */
namespace Notadd\Member\Models;

use Notadd\Foundation\Database\Model;

/**
 * Class MemberInformationRelation.
 */
class MemberInformationRelation extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'group_id',
        'information_id',
    ];

    /**
     * @var string
     */
    protected $table = 'member_information_relations';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(MemberInformationGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function information()
    {
        return $this->belongsTo(MemberInformation::class);
    }
}
