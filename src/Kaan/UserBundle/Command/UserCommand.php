<?php

namespace Kaan\UserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Kaan\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class UserCommand extends Command {

    protected function configure() {
        $this
                ->setName('kaanuser:create')
                ->setDescription('Generate New User')
                ->addArgument(
                        'admin', InputArgument::OPTIONAL, 'Your last name?'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $username = $dialog->ask(
                $output, 'Username:'
        );

        $email = $dialog->ask(
                $output, 'Email:'
        );
        $password = $dialog->ask(
                $output, 'Password:'
        );
        if ($username && $email && $password) {
            $em = $this->getApplication()->getKernel()->getContainer()->get('doctrine')->getEntityManager();
            $user = new User();
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setSalt(md5(time()));
            $encoder = new MessageDigestPasswordEncoder('sha512', true, 10);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $em->persist($user);
            $em->flush();
            
            
            $output->writeln('<fg=green>' . $username . ' Oluşturuldu</fg=green>');
        } else {
            $output->writeln('<fg=red>Eksik Parametre</fg=red>');
        }
    }

}