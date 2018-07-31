<?php
namespace Gabriel\Biblio\Tests\Unit\Controller;

/**
 * Test case.
 */
class LectorControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Controller\LectorController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Gabriel\Biblio\Controller\LectorController::class)
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
    public function listActionFetchesAllLectorsFromRepositoryAndAssignsThemToView()
    {

        $allLectors = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $lectorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LectorRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $lectorRepository->expects(self::once())->method('findAll')->will(self::returnValue($allLectors));
        $this->inject($this->subject, 'lectorRepository', $lectorRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('lectors', $allLectors);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenLectorToView()
    {
        $lector = new \Gabriel\Biblio\Domain\Model\Lector();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('lector', $lector);

        $this->subject->showAction($lector);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenLectorToLectorRepository()
    {
        $lector = new \Gabriel\Biblio\Domain\Model\Lector();

        $lectorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LectorRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $lectorRepository->expects(self::once())->method('add')->with($lector);
        $this->inject($this->subject, 'lectorRepository', $lectorRepository);

        $this->subject->createAction($lector);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenLectorToView()
    {
        $lector = new \Gabriel\Biblio\Domain\Model\Lector();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('lector', $lector);

        $this->subject->editAction($lector);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenLectorInLectorRepository()
    {
        $lector = new \Gabriel\Biblio\Domain\Model\Lector();

        $lectorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LectorRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $lectorRepository->expects(self::once())->method('update')->with($lector);
        $this->inject($this->subject, 'lectorRepository', $lectorRepository);

        $this->subject->updateAction($lector);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenLectorFromLectorRepository()
    {
        $lector = new \Gabriel\Biblio\Domain\Model\Lector();

        $lectorRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\LectorRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $lectorRepository->expects(self::once())->method('remove')->with($lector);
        $this->inject($this->subject, 'lectorRepository', $lectorRepository);

        $this->subject->deleteAction($lector);
    }
}
