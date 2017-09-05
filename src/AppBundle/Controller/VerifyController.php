<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class VerifyController extends Controller implements TokenAuthenticatedController
{
    /**
     * @Route("/test-verify", name="test-verify")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request)
    {
        return $this->json([
            'test' => 'ok',
            'request' => $request
        ]);
    }
}
