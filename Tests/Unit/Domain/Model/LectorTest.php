<?php
namespace Gabriel\Biblio\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class LectorTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Domain\Model\Lector
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Gabriel\Biblio\Domain\Model\Lector();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNombreReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getNombre()
        );
    }

    /**
     * @test
     */
    public function setNombreForStringSetsNombre()
    {
        $this->subject->setNombre('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'nombre',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getRutReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getRut()
        );
    }

    /**
     * @test
     */
    public function setRutForStringSetsRut()
    {
        $this->subject->setRut('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'rut',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPasswordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPassword()
        );
    }

    /**
     * @test
     */
    public function setPasswordForStringSetsPassword()
    {
        $this->subject->setPassword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'password',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFeUserLectorReturnsInitialValueForFrontendUser()
    {
    }

    /**
     * @test
     */
    public function setFeUserLectorForFrontendUserSetsFeUserLector()
    {
    }
}
