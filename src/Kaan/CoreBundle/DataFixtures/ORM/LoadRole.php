<?php
namespace Kaan\CoreBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Kaan\UserBundle\Entity\Role;

class LoadRole extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $adminrole = new Role();
        $adminrole->setName('ROLE_ADMIN');
        
        $manager->persist($adminrole);
        $manager->flush();
        
        $this->addReference('role-admin', $adminrole);
        
        $userrole = new Role();
        
        $userrole->setName('ROLE_USER');
        $manager->persist($userrole);
        
        $manager->flush();
        
        $this->addReference('role-user', $userrole);
    }
    
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}