<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test-news/{count}", name="test-news", requirements={"count" : "\d+"})
     * @param $count
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function testNewsAction($count)
    {
        return $this->render('default/test-news.html.twig', [
            'news' => $this->getNews($count)
        ]);
    }

    /**
     * Возращает фейковый массив c новостями
     * @param int $size
     * @return array
     */
    protected function getNews(int $size = 10): array
    {
        return array_map(function ($v) {
            return ['id' => $v, 'title' => 'Заголовок #' . $v, 'content' => 'Текст новости #' . $v];
        }, range(1, $size));
    }
}
