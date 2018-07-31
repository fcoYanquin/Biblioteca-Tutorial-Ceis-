<?php
date_default_timezone_set('America/Santiago');

use Gabriel\Biblio\EID\Util;

/**
 * Servicio EID Ejmplo
 * El servicio esta definido en el archivo de configuración: ext_localconf.php
 *
 * url: mydomain.com/index.php?eID=biblio_prestamo
 * JSON params: {"usr":"","pass":"","action":"list"}
 */

/*
 * Carga de librerias y dependencias TYPO3
 * Código estandar para todos los servicios EID. No modificar.
 */
if (!defined ('PATH_typo3conf')) die ('Access denied.');

\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();

$id = isset($HTTP_GET_VARS['id'])?$HTTP_GET_VARS['id']:0;
header('Content-Type: application/json');

/** @var \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController $TSFE */
$TSFE = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController', $GLOBALS['TYPO3_CONF_VARS'], $id, '0', 1);
$GLOBALS['TSFE'] = $TSFE;
$GLOBALS['TSFE']->initFEuser(); // Get FE User Information
$GLOBALS['TSFE']->fetch_the_id();
$GLOBALS['TSFE']->getPageAndRootline();
$GLOBALS['TSFE']->initTemplate();
$GLOBALS['TSFE']->tmpl->getFileName_backPath = PATH_site;
$GLOBALS['TSFE']->forceTemplateParsing = 1;
$GLOBALS['TSFE']->getConfigArray();
$GLOBALS['TSFE']->register['hello'] = 1;

/** @var \TYPO3\CMS\Extbase\Object\ObjectManager $objectManager */
$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
$persistenceManagerInterface = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\PersistenceManagerInterface');

/*
 * Inicio de logica del servicio
 */
error_log('-- SERVICIO Prestamo --');

/* Obtiene datos en formato JSON */
$headers = apache_request_headers();
$data = file_get_contents('php://input');
$datos = json_decode($data);

/** @var Util $eidUtil */
$eidUtil = new Util();

/* Comprueba el acceso al servicio */

/**
$login = Util::checkUser($datos->usr,$datos->pass);
$session = Util::checkSession();
$apiKey = Util::checkHeaderApiKey($headers['X-API-KEY']);
if ($login != TRUE && $session != TRUE && $apiKey != TRUE) {
    $eidUtil->JSendResponse('fail','no se ha podido acceder al servicio');
    die;
}**/

/** @var \Gabriel\Biblio\Domain\Repository\PrestamoRepository $prestamoRepository */
$prestamoRepository = $objectManager->get('Gabriel\Biblio\Domain\Repository\PrestamoRepository');

if ($datos->action == 'list')
{
    $prestamos = $prestamoRepository->findAll()->toArray();
    $total = count($prestamos);
    $dataResponse = array();
    for( $i = 0; $i < $total; $i++) {
        /** @var \Gabriel\Biblio\Domain\Model\Prestamo $prestamo */
        $prestamo = $prestamos[$i];
        $dataResponse[$i] = $prestamo->_getProperties();
    }

    $eidUtil->JSendResponse('success',$dataResponse);
    die;

}
elseif ($datos->action == 'show')
{
    if( !isset($datos->uid) ) {
        $eidUtil->JSendResponse('fail','no hay uid');
        die;
    }

    /** @var \Gabriel\Biblio\Domain\Model\Prestamo $prestamo */
    $prestamo = $prestamoRepository->findByUid($datos->uid);
    if($prestamo == NULL){
        $eidUtil->JSendResponse('fail',$datos->uid.' no encontrado');
        die;
    }
    $eidUtil->JSendResponse('success',$prestamo->_getProperties());
    die;

}
elseif ($datos->action == 'create')
{
    $libro = NULL;
    if(isset($datos->libro) ) {
        /** @var \Gabriel\Biblio\Domain\Repository\LibroRepository $prestamoRepository */
        $libroRepository = $objectManager->get('Gabriel\Biblio\Domain\Repository\LibroRepository');
        /** @var \Gabriel\Biblio\Domain\Model\Libro $libro */
        $libro = $libroRepository->findByUid($datos->libro);
    }

    $lector = NULL;
    if(isset($datos->lector) ) {
        /** @var \Gabriel\Biblio\Domain\Repository\LectorRepository $prestamoRepository */
        $lectorRepository = $objectManager->get('Gabriel\Biblio\Domain\Repository\LectorRepository');
        /** @var \Gabriel\Biblio\Domain\Model\Lector $lector */
        $lector = $lectorRepository->findByUid($datos->lector);
    }

    /** @var \Gabriel\Biblio\Domain\Model\Prestamo $prestamo */
    $prestamo = $objectManager->get('Gabriel\Biblio\Domain\Model\Prestamo');
    $prestamo->setProperties(
    );

    $prestamoRepository->add($prestamo);
    $persistenceManagerInterface->persistAll();
    $eidUtil->JSendResponse('success', $prestamo->getUid() );

}
elseif ($datos->action == 'update')
{
    if( !isset($datos->uid) ) {
        $eidUtil->JSendResponse('fail','no hay uid');
        die;
    }

    /** @var \Gabriel\Biblio\Domain\Model\Prestamo $prestamo */
    $prestamo = $prestamoRepository->findByUid($datos->uid);
    if($prestamo == NULL){
        $eidUtil->JSendResponse('fail',$datos->uid.' no encontrado');
        die;
    }

    $libro = NULL;
    if(isset($datos->libro) ) {
        /** @var \Gabriel\Biblio\Domain\Repository\LibroRepository $prestamoRepository */
        $libroRepository = $objectManager->get('Gabriel\Biblio\Domain\Repository\LibroRepository');
        /** @var \Gabriel\Biblio\Domain\Model\Libro $libro */
        $libro = $libroRepository->findByUid($datos->libro);
    }

    $lector = NULL;
    if(isset($datos->lector) ) {
        /** @var \Gabriel\Biblio\Domain\Repository\LectorRepository $prestamoRepository */
        $lectorRepository = $objectManager->get('Gabriel\Biblio\Domain\Repository\LectorRepository');
        /** @var \Gabriel\Biblio\Domain\Model\Lector $lector */
        $lector = $lectorRepository->findByUid($datos->lector);
    }

    $prestamo->setProperties(
    );

    $prestamoRepository->update($prestamo);
    $persistenceManagerInterface->persistAll();
    $eidUtil->JSendResponse('success', $prestamo->getUid() );

}
elseif ($datos->action == 'remove')
{
    if( !isset($datos->uid) ) {
        $eidUtil->JSendResponse('fail','no hay uid');
        die;
    }

    /** @var \Gabriel\Biblio\Domain\Model\Prestamo $prestamo */
    $prestamo = $prestamoRepository->findByUid($datos->uid);
    if($prestamo == NULL){
        $eidUtil->JSendResponse('fail',$datos->uid.' no encontrado');
        die;
    }

    $prestamoRepository->remove($prestamo);
    $persistenceManagerInterface->persistAll();
    $eidUtil->JSendResponse('success');

}
else
{
    $eidUtil->JSendResponse('fail','no se ha seleccionado opcion');
    die;
}
