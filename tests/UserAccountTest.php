<?php

class UserAccountTest extends TestCase
{
    public function testRegister()
    {
        $this->post('v1/user/register');
        $this->assertJson($this->response->getContent());
    }

    public function testVerify()
    {
        $this->post('v1/user/verify');
        $this->assertJson($this->response->getContent());
    }

    public function testForgot()
    {
        $this->post('v1/user/forgot');
        $this->assertJson($this->response->getContent());
    }

    public function testReset()
    {
        $this->post('v1/user/reset');
        $this->assertJson($this->response->getContent());
    }
}
