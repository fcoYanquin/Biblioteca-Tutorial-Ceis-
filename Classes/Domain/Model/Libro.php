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
 * Libro
 */
class Libro extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * nombre
     *
     * @var string
     */
    protected $nombre = '';

    /**
     * devuelto
     *
     * @var bool
     */
    protected $devuelto = false;

    /**
     * editorial
     *
     * @var \Gabriel\Biblio\Domain\Model\Editorial
     */
    protected $editorial = null;

    /**
     * autor
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Gabriel\Biblio\Domain\Model\Autor>
     */
    protected $autor = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->autor = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the nombre
     *
     * @return string $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre
     *
     * @param string $nombre
     * @return void
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Returns the devuelto
     *
     * @return bool $devuelto
     */
    public function getDevuelto()
    {
        return $this->devuelto;
    }

    /**
     * Sets the devuelto
     *
     * @param bool $devuelto
     * @return void
     */
    public function setDevuelto($devuelto)
    {
        $this->devuelto = $devuelto;
    }

    /**
     * Returns the boolean state of devuelto
     *
     * @return bool
     */
    public function isDevuelto()
    {
        return $this->devuelto;
    }

    /**
     * Returns the editorial
     *
     * @return \Gabriel\Biblio\Domain\Model\Editorial $editorial
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Sets the editorial
     *
     * @param \Gabriel\Biblio\Domain\Model\Editorial $editorial
     * @return void
     */
    public function setEditorial(\Gabriel\Biblio\Domain\Model\Editorial $editorial)
    {
        $this->editorial = $editorial;
    }

    /**
     * Adds a Autor
     *
     * @param \Gabriel\Biblio\Domain\Model\Autor $autor
     * @return void
     */
    public function addAutor(\Gabriel\Biblio\Domain\Model\Autor $autor)
    {
        $this->autor->attach($autor);
    }

    /**
     * Removes a Autor
     *
     * @param \Gabriel\Biblio\Domain\Model\Autor $autorToRemove The Autor to be removed
     * @return void
     */
    public function removeAutor(\Gabriel\Biblio\Domain\Model\Autor $autorToRemove)
    {
        $this->autor->detach($autorToRemove);
    }

    /**
     * Returns the autor
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Gabriel\Biblio\Domain\Model\Autor> $autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Sets the autor
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Gabriel\Biblio\Domain\Model\Autor> $autor
     * @return void
     */
    public function setAutor(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $autor)
    {
        $this->autor = $autor;
    }
}
