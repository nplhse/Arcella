<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginLogout()
    {
        $username = 'foo';
        $password = 'bar';

        $client = self::createClient();
        $client->followRedirects(true);

        // Check if the login form can be accessed
        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton('Login')->form();

        // set some values
        $form['security_login[username]'] = $username;
        $form['security_login[password]'] = $password;

        // submit the form
        $crawler = $client->submit($form);

        $response = $client->getResponse()->getContent();

        var_dump($response);

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Logged in as: '.$username, $response);

        // Step 2: Logout (because of Auto-Login after Registration)
        $crawler = $client->request('GET', '/logout');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Login")')->count());
    }
}
