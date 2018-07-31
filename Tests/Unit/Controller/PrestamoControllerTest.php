<?php
namespace Gabriel\Biblio\Tests\Unit\Controller;

/**
 * Test case.
 */
class PrestamoControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Gabriel\Biblio\Controller\PrestamoController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Gabriel\Biblio\Controller\PrestamoController::class)
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
    public function listActionFetchesAllPrestamosFromRepositoryAndAssignsThemToView()
    {

        $allPrestamos = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $prestamoRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\PrestamoRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $prestamoRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPrestamos));
        $this->inject($this->subject, 'prestamoRepository', $prestamoRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('prestamos', $allPrestamos);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPrestamoToView()
    {
        $prestamo = new \Gabriel\Biblio\Domain\Model\Prestamo();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('prestamo', $prestamo);

        $this->subject->showAction($prestamo);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPrestamoToPrestamoRepository()
    {
        $prestamo = new \Gabriel\Biblio\Domain\Model\Prestamo();

        $prestamoRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\PrestamoRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $prestamoRepository->expects(self::once())->method('add')->with($prestamo);
        $this->inject($this->subject, 'prestamoRepository', $prestamoRepository);

        $this->subject->createAction($prestamo);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPrestamoToView()
    {
        $prestamo = new \Gabriel\Biblio\Domain\Model\Prestamo();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('prestamo', $prestamo);

        $this->subject->editAction($prestamo);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPrestamoInPrestamoRepository()
    {
        $prestamo = new \Gabriel\Biblio\Domain\Model\Prestamo();

        $prestamoRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\PrestamoRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $prestamoRepository->expects(self::once())->method('update')->with($prestamo);
        $this->inject($this->subject, 'prestamoRepository', $prestamoRepository);

        $this->subject->updateAction($prestamo);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPrestamoFromPrestamoRepository()
    {
        $prestamo = new \Gabriel\Biblio\Domain\Model\Prestamo();

        $prestamoRepository = $this->getMockBuilder(\Gabriel\Biblio\Domain\Repository\PrestamoRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $prestamoRepository->expects(self::once())->method('remove')->with($prestamo);
        $this->inject($this->subject, 'prestamoRepository', $prestamoRepository);

        $this->subject->deleteAction($prestamo);
    }
}
