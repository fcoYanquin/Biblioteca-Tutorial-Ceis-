<?php
namespace Gabriel\Biblio\Tests\Unit\Controller;

/**
 * Test case.
 */
class LibroControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Controller\LibroController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Gabriel\Biblio\Controller\LibroController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllLibrosFromRepositoryAndAssignsThemToView()
    {

        $allLibros = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $libroRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LibroRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $libroRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLibros));
        $this->inject($this->subject, 'libroRepository', $libroRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('libros', $allLibros);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLibroToView()
    {
        $libro = new \Gabriel\Biblio\Domain\Model\Libro();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('libro', $libro);

        $this->subject->showAction($libro);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLibroToLibroRepository()
    {
        $libro = new \Gabriel\Biblio\Domain\Model\Libro();

        $libroRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LibroRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $libroRepository->expects(self::once())->method('add')->with($libro);
        $this->inject($this->subject, 'libroRepository', $libroRepository);

        $this->subject->createAction($libro);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLibroToView()
    {
        $libro = new \Gabriel\Biblio\Domain\Model\Libro();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('libro', $libro);

        $this->subject->editAction($libro);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLibroInLibroRepository()
    {
        $libro = new \Gabriel\Biblio\Domain\Model\Libro();

        $libroRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LibroRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $libroRepository->expects(self::once())->method('update')->with($libro);
        $this->inject($this->subject, 'libroRepository', $libroRepository);

        $this->subject->updateAction($libro);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLibroFromLibroRepository()
    {
        $libro = new \Gabriel\Biblio\Domain\Model\Libro();

        $libroRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LibroRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $libroRepository->expects(self::once())->method('remove')->with($libro);
        $this->inject($this->subject, 'libroRepository', $libroRepository);

        $this->subject->deleteAction($libro);
    }
}
