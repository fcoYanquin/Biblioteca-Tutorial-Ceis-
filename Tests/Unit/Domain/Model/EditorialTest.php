<?php
namespace Gabriel\Biblio\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class EditorialTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Domain\Model\Editorial
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Gabriel\Biblio\Domain\Model\Editorial();
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
}
