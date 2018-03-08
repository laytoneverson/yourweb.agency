<?php

namespace App\Controller;

use App\Service\OutboundLinkService;
use function GuzzleHttp\Promise\exception_for;
use http\Env\Request;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ExitLinkController extends Controller
{

    /**
     * @var OutboundLinkService
     */
    private $outboundLinkService;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(OutboundLinkService $outboundLinkService, LoggerInterface $logger)
    {
        $this->outboundLinkService = $outboundLinkService;
        $this->logger = $logger;
    }

    /**
     * @Route("/go-to/{outboundLinkUrlId}", name="exit_link")
     */
    public function goToLinkAction($outboundLinkUrlId)
    {
        try {
            $exitLink = $this->outboundLinkService->handleExitClick($outboundLinkUrlId);
        } catch (\Exception $e) {
            $this->logger->error('Unable to find exitLink', $e);

            return $this->redirectToRoute('exit_link_error');
        }

        return new RedirectResponse($exitLink->getLinkUrl(), 301);
    }

    /**
     * @Route("/we-have-an-error/outbound-link", name="exit_link_error")
     */
    public function linkError()
    {
        return $this->renderView('pages/error.html.twig', [
            'errorMessage' => 'We were unable to send you off. Please let us know there is a problem.'
        ]);
    }
}
