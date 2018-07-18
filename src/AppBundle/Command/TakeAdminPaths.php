<?php

namespace AppBundle\Command;

use FOS\UserBundle\Model\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Router;


class TakeAdminPaths extends Command
{

    private $userManager;
    private $router;
    public function __construct(UserManager $userManager,Router $router)
    {
        $this->userManager = $userManager;
        $this->router = $router;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('admin:take-paths')
            ->setDescription('Takes All Paths From Sonata Admin')
            ->setHelp('This command allows you to take all paths from sonata admin')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Admin Paths Taker',
            '============'
        ]);

        dump($this->router->getRouteCollection());

    }
}