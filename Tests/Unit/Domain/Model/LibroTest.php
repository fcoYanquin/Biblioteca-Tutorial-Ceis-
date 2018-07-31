<?php
namespace Gabriel\Biblio\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class LibroTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Domain\Model\Libro
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Gabriel\Biblio\Domain\Model\Libro();
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
    public function getDevueltoReturnsInitialValueForBool()
    {
        self::assertSame(
            false,
            $this->subject->getDevuelto()
        );
    }

    /**
     * @test
     */
    public function setDevueltoForBoolSetsDevuelto()
    {
        $this->subject->setDevuelto(true);

        self::assertAttributeEquals(
            true,
            'devuelto',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEditorialReturnsInitialValueForEditorial()
    {
        self::assertEquals(
            null,
            $this->subject->getEditorial()
        );
    }

    /**
     * @test
     */
    public function setEditorialForEditorialSetsEditorial()
    {
        $editorialFixture = new \Gabriel\Biblio\Domain\Model\Editorial();
        $this->subject->setEditorial($editorialFixture);

        self::assertAttributeEquals(
            $editorialFixture,
            'editorial',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getAutorReturnsInitialValueForAutor()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getAutor()
        );
    }

    /**
     * @test
     */
    public function setAutorForObjectStorageContainingAutorSetsAutor()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();
        $objectStorageHoldingExactlyOneAutor = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneAutor->attach($autor);
        $this->subject->setAutor($objectStorageHoldingExactlyOneAutor);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneAutor,
            'autor',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addAutorToObjectStorageHoldingAutor()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();
        $autorObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $autorObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($autor));
        $this->inject($this->subject, 'autor', $autorObjectStorageMock);

        $this->subject->addAutor($autor);
    }

    /**
     * @test
     */
    public function removeAutorFromObjectStorageHoldingAutor()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();
        $autorObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $autorObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($autor));
        $this->inject($this->subject, 'autor', $autorObjectStorageMock);

        $this->subject->removeAutor($autor);
    }
}
