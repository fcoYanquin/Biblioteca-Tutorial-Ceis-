<?php
namespace Gabriel\Biblio\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class PrestamoTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Domain\Model\Prestamo
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Gabriel\Biblio\Domain\Model\Prestamo();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getInicioReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getInicio()
        );
    }

    /**
     * @test
     */
    public function setInicioForDateTimeSetsInicio()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setInicio($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'inicio',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFinReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getFin()
        );
    }

    /**
     * @test
     */
    public function setFinForDateTimeSetsFin()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setFin($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'fin',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLibroReturnsInitialValueForLibro()
    {
        self::assertEquals(
            null,
            $this->subject->getLibro()
        );
    }

    /**
     * @test
     */
    public function setLibroForLibroSetsLibro()
    {
        $libroFixture = new \Gabriel\Biblio\Domain\Model\Libro();
        $this->subject->setLibro($libroFixture);

        self::assertAttributeEquals(
            $libroFixture,
            'libro',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLectorReturnsInitialValueForLector()
    {
        self::assertEquals(
            null,
            $this->subject->getLector()
        );
    }

    /**
     * @test
     */
    public function setLectorForLectorSetsLector()
    {
        $lectorFixture = new \Gabriel\Biblio\Domain\Model\Lector();
        $this->subject->setLector($lectorFixture);

        self::assertAttributeEquals(
            $lectorFixture,
            'lector',
            $this->subject
        );
    }
}
