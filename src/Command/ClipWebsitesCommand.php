<?php

namespace App\Command;

use App\Entity\Website;
use App\Service\WebsiteClipperService\WebsiteScreenShotClipper;
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
    private $clipperService;

    public function __construct(
        ?string $name = null,
        EntityManagerInterface $entityManager,
        WebsiteScreenShotClipper $clipper
    )   {
        $this->entityManager = $entityManager;
        $this->clipperService = $clipper;

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
            )->addOption(
                'num',
                'num',
                InputOption::VALUE_OPTIONAL,
                'Number of records to process'
            )->setHelp('This command allows you to create a website screen shot')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $input->getOption('eid');
        $numRecords = $input->getOption('num');

        $output->writeln(print_r($entity, true));

        if ( is_numeric($entity)) {

            $output->writeln("---- Loading ". $entity . " for capture.");
            $entities = [];
            $entities[] = $this->entityManager->getRepository(Website::class)->find($entity);
        } else {

            $output->writeln("Loading all sites without a screenshot for capture.");
            $output->writeln('');
            $entities = $this->entityManager
                ->getRepository(Website::class)
                ->findSitesNeedingCaptured($numRecords);
        }

        $output->writeln("Attempting to capture ". count($entities) . " Websites.");

        /** @var Website $website */
        foreach ($entities as $website) {

            $url = $website->getWebsiteUrl();
            $output->writeln("Grabbing screenshot of $url");

            try {

                $this->clipperService->clipWebsite($website);

            } catch (\Exception $e) {

                $output->writeln("An exception was thrown while clipping the website");
                $output->write($e->getMessage());
            }

            $output->writeln("Webshot clipped for ". $website->getWebsiteName());
        }
    }
}
