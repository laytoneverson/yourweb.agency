<?php

namespace App\Command;

use App\Entity\Website;
use App\Service\WebsiteScreenShotClipper;
use Doctrine\ORM\EntityManagerInterface;
use function is_numeric;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ClipWebsitesCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var WebsiteScreenShotClipper
     */
    private $clipper;

    public function __construct(
        ?string $name = null,
        EntityManagerInterface $entityManager,
        WebsiteScreenShotClipper $clipper
    )   {
        $this->entityManager = $entityManager;
        $this->clipper = $clipper;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setName('app:clip-websites')
            ->setDescription(
                'Creates a screen shot of a Website.'
            )->addOption(
                'eid',
                'eid',
                InputOption::VALUE_OPTIONAL,
                'Website Entity ID. Blank for all',
                null
            )->setHelp('This command allows you to create a website screen shot')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getOption('eid');
        $output->writeln(print_r($entity, true));

        if ( is_numeric($entity)) {
            $output->writeln("---- Loading ". $entity . " for capture.");
            $entities = [];
            $entities[] = $this->entityManager->getRepository(Website::class)->find($entity);
        } else {
            $output->writeln("---- Loading all sites without a screenshot for capture.");
            $entities = $this->entityManager
                ->getRepository(Website::class)
                ->findSitesNeedingCaptured();
        }

        $output->writeln("-> Beginning to capture ". count($entities) . "Websites.");
        /** @var Website $website */
        foreach ($entities as $website) {
            $url = $website->getWebsiteUrl();
            $output->writeln("Loading screenshot for $url");
            try {
                $this->clipper->clipWebsite($website);
            } catch (\Exception $e) {
                $output->writeln("An exception was thrown while clipping the website");
                $output->write($e->getMessage());
            }
        }
    }
}
