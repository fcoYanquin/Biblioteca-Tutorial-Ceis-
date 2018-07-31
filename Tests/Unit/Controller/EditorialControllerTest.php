<?php
namespace Gabriel\Biblio\Tests\Unit\Controller;

/**
 * Test case.
 */
class EditorialControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Controller\EditorialController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Gabriel\Biblio\Controller\EditorialController::class)
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
    public function listActionFetchesAllEditorialsFromRepositoryAndAssignsThemToView()
    {

        $allEditorials = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $editorialRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\EditorialRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $editorialRepository->expects(self::once())->method('findAll')->will(self::returnValue($allEditorials));
        $this->inject($this->subject, 'editorialRepository', $editorialRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('editorials', $allEditorials);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenEditorialToView()
    {
        $editorial = new \Gabriel\Biblio\Domain\Model\Editorial();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('editorial', $editorial);

        $this->subject->showAction($editorial);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenEditorialToEditorialRepository()
    {
        $editorial = new \Gabriel\Biblio\Domain\Model\Editorial();

        $editorialRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\EditorialRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $editorialRepository->expects(self::once())->method('add')->with($editorial);
        $this->inject($this->subject, 'editorialRepository', $editorialRepository);

        $this->subject->createAction($editorial);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenEditorialToView()
    {
        $editorial = new \Gabriel\Biblio\Domain\Model\Editorial();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('editorial', $editorial);

        $this->subject->editAction($editorial);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenEditorialInEditorialRepository()
    {
        $editorial = new \Gabriel\Biblio\Domain\Model\Editorial();

        $editorialRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\EditorialRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $editorialRepository->expects(self::once())->method('update')->with($editorial);
        $this->inject($this->subject, 'editorialRepository', $editorialRepository);

        $this->subject->updateAction($editorial);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenEditorialFromEditorialRepository()
    {
        $editorial = new \Gabriel\Biblio\Domain\Model\Editorial();

        $editorialRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\EditorialRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $editorialRepository->expects(self::once())->method('remove')->with($editorial);
        $this->inject($this->subject, 'editorialRepository', $editorialRepository);

        $this->subject->deleteAction($editorial);
    }
}
