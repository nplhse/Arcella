<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserFixtures manages fixtures for the User entity.
 */
class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * Create and store User fixtures in the database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setPlainPassword($data['plainPassword']);

            $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setEmail($data['email']);
            $user->setRoles($data['roles']);

            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * Returns data for the default User objects we want to create.
     *
     * @return array
     */
    public function getData()
    {
        return
            [
                [
                    'username' => 'admin',
                    'plainPassword' => 'admin',
                    'email' => 'admin@admin.test',
                    'roles' => ['ROLE_ADMIN', 'ROLE_USER'],
                ],
                [
                    'username' => 'foo',
                    'plainPassword' => 'bar',
                    'email' => 'foo@bar.com',
                    'roles' => ['ROLE_USER'],
                ],
            ];
    }
}
