<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    /**
     * Возвращает все активные записи за текущую неделю в виде массива
     * [ День недели => [
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *
     *   ],
     *   День недели => [
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *      [Заголовок рубрики => [Новость],[Новость],...],
     *   ],
     *   ...
     * ]
     *
     * @return array
     */
    public function getNewsByRubrics()
    {
        $date = new \DateTime('monday this week');

        $query = $this->createQueryBuilder('n')
            ->where('n.active = :active')
            ->andWhere('n.created_at BETWEEN :start AND :end')
            ->orderBy('n.created_at', 'desc')
            ->setParameter('active', true)
            ->setParameter('start', $date->format('Y-m-d H:i:s'))
            ->setParameter('end', $date->modify('sun 23:59:59')->format('Y-m-d H:i:s'))
            ->getQuery();

        return $this->toSpecialArray($query);
    }

    /**
     * Списание в архив всех новостей из выбранных рубрик, которые были опубликованы ранее указанной даты.
     *
     * @param string $date
     * @param array $rubrics
     *
     * @return mixed
     */
    public function setToArchive($date, $rubrics)
    {
        $query = $this->createQueryBuilder('n')
            ->set('n.active', ':active')
            ->where('n.created_at < :date')
            ->andWhere('n.rubric IN (:rubrics)')
            ->setParameter('active', false)
            ->setParameter('date', $date)
            ->setParameter('rubrics', $rubrics)
            ->update()
            ->getQuery();

        return $query->execute();
    }

    /**
     * @param Query $query
     *
     * @return array
     */
    private function toSpecialArray(Query $query)
    {
        $tmp = [];

        foreach ($query->getResult() as $item) {
            /** @var Article $item */
            $tmp[$item->getCreated()->format('l')][$item->getRubric()->getTitle()][] = $item;
        }

        return $tmp;
    }
}
