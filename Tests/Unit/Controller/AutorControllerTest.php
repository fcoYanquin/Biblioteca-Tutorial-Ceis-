<?php
namespace Gabriel\Biblio\Tests\Unit\Controller;

/**
 * Test case.
 */
class AutorControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Controller\AutorController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Gabriel\Biblio\Controller\AutorController::class)
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
    public function listActionFetchesAllAutorsFromRepositoryAndAssignsThemToView()
    {

        $allAutors = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $autorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\AutorRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $autorRepository->expects(self::once())->method('findAll')->will(self::returnValue($allAutors));
        $this->inject($this->subject, 'autorRepository', $autorRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('autors', $allAutors);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenAutorToView()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('autor', $autor);

        $this->subject->showAction($autor);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenAutorToAutorRepository()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();

        $autorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\AutorRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $autorRepository->expects(self::once())->method('add')->with($autor);
        $this->inject($this->subject, 'autorRepository', $autorRepository);

        $this->subject->createAction($autor);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenAutorToView()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('autor', $autor);

        $this->subject->editAction($autor);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenAutorInAutorRepository()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();

        $autorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\AutorRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $autorRepository->expects(self::once())->method('update')->with($autor);
        $this->inject($this->subject, 'autorRepository', $autorRepository);

        $this->subject->updateAction($autor);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenAutorFromAutorRepository()
    {
        $autor = new \Gabriel\Biblio\Domain\Model\Autor();

        $autorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\AutorRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $autorRepository->expects(self::once())->method('remove')->with($autor);
        $this->inject($this->subject, 'autorRepository', $autorRepository);

        $this->subject->deleteAction($autor);
    }
}
