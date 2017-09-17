<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewsController extends Controller
{
    /**
     * @Route("/news", name="news")
     * @throws \LogicException
     * @throws \UnexpectedValueException
     */
    public function indexAction()
    {
        $news = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy([], ['created_at' => 'desc'], 5);

        return $this->render('news/index.html.twig', compact('news'));
    }

}
