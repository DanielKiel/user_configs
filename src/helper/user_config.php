<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 17.05.17
 * Time: 09:37
 */

if (! function_exists('user_config')) {
    //use it to get array clean of some stdClass objects, for example on incoming inputs
    function user_config(string $key, $default = null) {
        if (auth()->guest()) {
            return $default;
        }

        $user = auth()->user()->fresh();

        if (! method_exists($user, '_config')) {
            $configObject = \Dion\UserConfig\UserConfig::find($user->id);
        }
        else {
            $configObject = $user->_config;
        }

        if (! $configObject instanceof \Dion\UserConfig\UserConfig) {
            return $default;
        }

        return array_get($configObject->data, $key, $default);
    }
}