<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testProperties()
    {
        $username = 'foo';
        $password = 'bar';
        $email = 'foo@bar.com';

        $user = new User();

        $this->assertEquals(null, $user->getId());

        $user->setUsername($username);
        $this->assertEquals($username, $user->getUsername());

        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());

        // See testErasingOfCredentials()
        //$user->setPlainPassword($password);
        //$this->assertEquals($password, $user->getPlainPassword());

        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());

        $roles = ['ROLE_USER'];
        $this->assertEquals($roles, $user->getRoles());

        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $user->setRoles($roles);
        $this->assertEquals($roles, $user->getRoles());

        // Assert return null on currently unused functions
        $this->assertNull($user->getSalt());
    }

    public function testErasingOfCredentials()
    {
        $password = 'bar';

        $user = new User();

        $user->setPlainPassword($password);
        $this->assertEquals($password, $user->getPlainPassword());

        $user->eraseCredentials();
        $this->assertEquals(null, $user->getPlainPassword());
    }
}
