<?php
/**
 * Created by PhpStorm.
 * User: dk
 * Date: 26.07.18
 * Time: 11:27
 */

use App\User;
use Dion\UserConfig\UserConfig;

class ConfigDecryptEncryptTest extends \Tests\TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations, \Illuminate\Foundation\Testing\WithoutMiddleware;

    public function test_decrypt()
    {
        $user = User::create([
            'name' => 'me',
            'email' => 'me',
            'password' => 'me'
        ]);

        $this->actingAs($user);

        $originalData = [ 'password' => 'myPassword'];

        $userConfig = UserConfig::create([
            'users_id' => $user->id,
            'data' => $originalData
        ]);

        $this->assertEquals($originalData, $userConfig->fresh()->data);

        $dbLoaded = DB::table('user_configs')->first();

        $this->assertTrue(is_string($dbLoaded->data));

        $this->assertNotEquals($originalData,$dbLoaded->data);

        $this->assertEquals('myPassword', user_config('password'));
    }

    public function test_trait()
    {
        $user = User::create([
            'name' => 'me',
            'email' => 'me',
            'password' => 'me'
        ]);

        if (! method_exists($user, '_config')) {
            print_r( "\n\n trait is not setted to test  \n\n" );

            return;
        }

        $this->actingAs($user);

        $originalData = [ 'password' => 'myPassword'];

        $user->_config()->create(['data' => $originalData]);

        $dbLoaded = DB::table('user_configs')->first();

        $this->assertTrue(is_string($dbLoaded->data));

        $this->assertNotEquals($originalData,$dbLoaded->data);

        $this->assertEquals('myPassword', user_config('password'));

        $this->assertEquals('defaultValue', user_config('notFoundableKey', 'defaultValue'));

        $updatedData = [ 'password' => 'myPasswordUpdated'];

        $user->_config->update(['data' => $updatedData]);

        $this->assertEquals('myPasswordUpdated', user_config('password'));
    }
}
