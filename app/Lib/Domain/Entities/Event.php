<?php namespace Cryptic\Wgrpg\Lib\Domain\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Event as EventEntityContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model implements EventEntityContract
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'condition_id_1', 'condition_id_2',
        'condition_id_3', 'trigger_chance', 'trigger_value_1', 'trigger_value_2',
        'trigger_value_3', ];

    /**
     * Additional dates to mutate into instances of \Carbon\Carbon.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
