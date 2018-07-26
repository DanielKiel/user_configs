<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 26.07.18
 * Time: 11:38
 */

namespace Dion\UserConfig\Traits;


use Dion\UserConfig\UserConfig;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasUserConfig
{
    /**
     * @return HasOne
     */
    public function _config(): HasOne
    {
        return $this->hasOne(UserConfig::class, 'users_id');
    }
}