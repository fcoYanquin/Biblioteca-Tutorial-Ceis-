<?php
namespace Gabriel\Biblio\Domain\Model;

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

/**
 * Prestamo
 */
class Prestamo extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * inicio
     *
     * @var \DateTime
     */
    protected $inicio = null;

    /**
     * fin
     *
     * @var \DateTime
     */
    protected $fin = null;

    /**
     * libro
     *
     * @var \Gabriel\Biblio\Domain\Model\Libro
     */
    protected $libro = null;

    /**
     * lector
     *
     * @var \Gabriel\Biblio\Domain\Model\Lector
     */
    protected $lector = null;

    /**
     * Returns the inicio
     *
     * @return \DateTime $inicio
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Sets the inicio
     *
     * @param \DateTime $inicio
     * @return void
     */
    public function setInicio(\DateTime $inicio)
    {
        $this->inicio = $inicio;
    }

    /**
     * Returns the fin
     *
     * @return \DateTime $fin
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Sets the fin
     *
     * @param \DateTime $fin
     * @return void
     */
    public function setFin(\DateTime $fin)
    {
        $this->fin = $fin;
    }

    /**
     * Returns the libro
     *
     * @return \Gabriel\Biblio\Domain\Model\Libro $libro
     */
    public function getLibro()
    {
        return $this->libro;
    }

    /**
     * Sets the libro
     *
     * @param \Gabriel\Biblio\Domain\Model\Libro $libro
     * @return void
     */
    public function setLibro(\Gabriel\Biblio\Domain\Model\Libro $libro)
    {
        $this->libro = $libro;
    }

    /**
     * Returns the lector
     *
     * @return \Gabriel\Biblio\Domain\Model\Lector $lector
     */
    public function getLector()
    {
        return $this->lector;
    }

    /**
     * Sets the lector
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $lector
     * @return void
     */
    public function setLector(\Gabriel\Biblio\Domain\Model\Lector $lector)
    {
        $this->lector = $lector;
    }
}
