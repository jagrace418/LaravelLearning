<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * A helper function to sign in for tests
     * @param null $user
     */
    protected function signIn($user = null)
    {
        $this->actingAs($user ?: factory('App\User')->create());
    }
}
