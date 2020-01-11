<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $id = random_int(1, 1000);

        $username = 'user'.$id;
        $email = 'user'.$id.'test.com';
        $password = 'password';

        $client = self::createClient();
        $client->followRedirects(true);

        // Check if the login form can be accessed
        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton('Register')->form();

        // set some values
        $form['user_registration[username]'] = $username;
        $form['user_registration[email]'] = $email;
        $form['user_registration[plainPassword][first]'] = $password;
        $form['user_registration[plainPassword][second]'] = $password;

        // submit the form
        $crawler = $client->submit($form);

        $response = $client->getResponse()->getContent();

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Logged in as: '.$username, $response);
    }
}
