<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('hello@donkeycode.com');
        $password = $this->encoder->encodePassword($user, 'demo');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}
