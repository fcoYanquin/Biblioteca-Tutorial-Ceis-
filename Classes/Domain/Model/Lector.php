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
 * Lector
 */
class Lector extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * nombre
     *
     * @var string
     */
    protected $nombre = '';

    /**
     * rut
     *
     * @var string
     */
    protected $rut = '';

    /**
     * password
     *
     * @var string
     * @validate NotEmpty
     */
    protected $password = '';

    /**
     * feUserLector
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    protected $feUserLector = null;

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
     * Returns the rut
     *
     * @return string $rut
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Sets the rut
     *
     * @param string $rut
     * @return void
     */
    public function setRut($rut)
    {
        $this->rut = $rut;
    }

    /**
     * Returns the password
     *
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Returns the feUserLector
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUserLector
     */
    public function getFeUserLector()
    {
        return $this->feUserLector;
    }

    /**
     * Sets the feUserLector
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUserLector
     * @return void
     */
    public function setFeUserLector(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUserLector)
    {
        $this->feUserLector = $feUserLector;
    }
}
