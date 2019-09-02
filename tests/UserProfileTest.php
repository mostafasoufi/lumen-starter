<?php

class UserProfileTest extends TestCase
{
    public function testGetProfile()
    {
        $this->get('v1/user/profile');

        $this->assertJson($this->response->getContent());
    }

    public function testUpdateProfile()
    {
        $this->put('v1/user/profile');

        $this->assertJson($this->response->getContent());
    }

    public function testChangePassword()
    {
        $this->put('v1/user/password');

        $this->assertJson($this->response->getContent());
    }
}
