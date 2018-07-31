<?php

namespace Gabriel\Biblio\Domain\Repository;

/***
 *
 * This file is part of the "Biblioteca" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;

/**
 * The repository for Libros
 */
class LibroRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param $searchTerm
     */
    public function findByLike($searchTerm)
    {
        $query = $this->createQuery();
        $query->matching($query->logicalOr($query->like('nombre', '%' . $searchTerm . '%'), $query->like('devuelto', '%' . $searchTerm . '%'), $query->like('editorial', '%' . $searchTerm . '%'), $query->like('autor', '%' . $searchTerm . '%')));
        return $query->execute();
    }

    public function findByNombre($searchTerm)
    {


        $query = $this->createQuery();
        try {
            $query->matching($query->like("nombre", "%" . $searchTerm . "%"));
        } catch (InvalidQueryException $e) {
            error_log($e->getMessage());
        }
        return $query->execute();



    }
}
