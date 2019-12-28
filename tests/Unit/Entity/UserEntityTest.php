<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testProperties()
    {
        $username = 'foo';
        $password = 'bar';
        $email = 'foo@bar.com';
        $roles = ['ROLE_USER'];

        $user = new User();

        $this->assertEquals(null, $user->getId());

        $user->setUsername($username);
        $this->assertEquals($username, $user->getUsername());

        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());

        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());

        $this->assertEquals($roles, $user->getRoles());
    }
}
