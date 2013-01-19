<?php
namespace Kaan\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Kaan\UserBundle\Entity\User;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $encoder = new MessageDigestPasswordEncoder('sha512',true,10);
        
        $admin = new User();
        $admin->setUsername('Admin');
        $admin->setEmail('admin@admin.net');
        $admin->setSalt(md5(time()));
        $admin->setPassword($encoder->encodePassword('13871387', $admin->getSalt()));
       
        $admin->addUserRole($this->getReference('role-admin'));
        
        $manager->persist($admin);
        $manager->flush();
        
        $user = new User();
        $user->setUsername('User');
        $user->setEmail('user@user.net');
        $user->setSalt(md5(time()));
        $user->setPassword($encoder->encodePassword('13871387', $user->getSalt()));
        
        $user->addUserRole($this->getReference('role-user'));
        
        $manager->persist($user);
        
        $manager->flush();
        
    }
    
    public function getOrder()
    {
        return 2;
    }
}

?>
