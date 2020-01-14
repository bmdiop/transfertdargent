<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder= $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $tabrole=['ADMIN_SYSTEM','ADMIN','CAISSIER'];
        for ($i=0; $i < 2; $i++) {
            $role=new Role();
            $role->setLibelle($tabrole[$i]);

            $manager->persist($role);
 
            if ($i == 0) {
                $user= new User();
             
                $user->setEmail("bmdstar05@gmail.com");
                $user->setRoles(['ROLE_'.$tabrole[$i]]);
                $user->setPassword($this->encoder->encodePassword($user, "azerty"));
                $user->setName("bmd");
                $user->setIsActive(true);
                $user->setAdress("arafat");
                $user->setRole($role);

                $manager->persist($user);
            }
        
            $manager->persist($user);

            // $product = new Product();
            // $manager->persist($product);

            $manager->flush();
        }
    }
}
