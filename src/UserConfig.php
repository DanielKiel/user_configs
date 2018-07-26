<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 26.07.18
 * Time: 11:34
 */

namespace Dion\UserConfig;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserConfig extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'users_id', 'data'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];

    protected $attributes = [
        'data' => '{}'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    /**
     * @param $value
     * @return string
     */
    public function getDataAttribute($value)
    {
        if (empty($value) || $value == '{}') {
            return null;
        }

        return decrypt($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function setDataAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['data'] = json_encode(encrypt($value));
    }
}