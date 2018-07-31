<?php

namespace Gabriel\Biblio\Controller;

ini_set('include_path', ini_get('include_path') . ';PHPExcel/');
/** PHPExcel */
include('PHPExcel.php');
/** PHPExcel_Writer_Excel2007 */
include('PHPExcel/Writer/Excel2007.php');
/***
 *
 * This file is part of the "Biblioteca" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

//
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * LectorController
 */
class LectorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * lectorRepository
     *
     * @var \Gabriel\Biblio\Domain\Repository\LectorRepository
     * @inject
     */
    protected $lectorRepository = null;

    /**
     * frontendUserGroupRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository
     * @inject
     */
    protected $frontendUserGroupRepository = null;

    /**
     * feUserLectorRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $feUserLectorRepository = null;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $lectors = $this->lectorRepository->findAll();
        $this->view->assign('lectors', $lectors);
    }

    /**
     * action show
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $lector
     * @return void
     */
    public function showAction(\Gabriel\Biblio\Domain\Model\Lector $lector)
    {
        $this->view->assign('lector', $lector);
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        $tmp = 1;
    }

    /**
     * action create
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $newLector
     * @return void
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */

    public function createAction(\Gabriel\Biblio\Domain\Model\Lector $newLector)
    {
        error_log("Action create");
        $argumentos = $this->request->getArguments();
        error_log("Argunentos: " . json_encode($argumentos));

        /** @var FrontendUserGroup $grupo */
        $grupo = $this->frontendUserGroupRepository->findByUid(1);

        //Instantiate and create new FrontendUser
        $nuevoFeUser = new FrontendUser();
        $nuevoFeUser->setPid(2);
        $nuevoFeUser->addUsergroup($grupo);
        $nuevoFeUser->setUsername($newLector->getNombre());
        $nuevoFeUser->setName($newLector->getNombre());
        $nuevoFeUser->setPassword($newLector->getPassword());

        $newLector->setFeUserLector($nuevoFeUser);

        $this->hashPassword($nuevoFeUser, $this->settings['new']['misc']['passwordSave']);
        $this->feUserLectorRepository->add($nuevoFeUser);
        $this->lectorRepository->add($newLector);


        $tmp = 1;
        $this->redirect('list');
    }

    /**
     * action edit
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $lector
     * @ignorevalidation $lector
     * @return void
     */
    public function editAction(\Gabriel\Biblio\Domain\Model\Lector $lector)
    {
        $this->view->assign('lector', $lector);
        $tmp = 1;
    }

    /**
     * action update
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $lector
     * @return void
     */
    public function updateAction(\Gabriel\Biblio\Domain\Model\Lector $lector)
    {

        $editfeUserlector = $lector->getFeUserLector();
        $editfeUserlector->setUsername($lector->getNombre());
        $this->hashPassword($lector->getFeUserLector(), $this->settings['new']['misc']['passwordSave']);
        $this->feUserLectorRepository->update($editfeUserlector);

        //$this->addFlashMessage('Registro Actualizado Correctamente', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->lectorRepository->update($lector);
        $tmp = 1;
        $this->redirect('list');
    }

    /**
     * action delete
     *
     * @param \Gabriel\Biblio\Domain\Model\Lector $lector
     * @return void
     */
    public function deleteAction(\Gabriel\Biblio\Domain\Model\Lector $lector)
    {
        error_log("Delete action");
        if ($lector->getFeUserLector() != null) {
            $feUserLector = $lector->getFeUserLector();
            $this->feUserLectorRepository->remove($feUserLector);
            error_log('Removiendo usuario typo3');
        }

        //$this->addFlashMessage('Registro Eliminado Correctamente', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->lectorRepository->remove($lector);
        $this->redirect('list');
    }

    /**
     * @param FrontendUser $user
     * @param $method
     */
    private function hashPassword($user, $method)
    {
        switch ($method) {
            case 'md5':
                $user->setPassword(md5($user->getPassword()));
                break;
            case 'sha1':
                $user->setPassword(sha1($user->getPassword()));
                break;
            default:
                if (ExtensionManagementUtility::isLoaded('saltedPasswords')) {
                    if (SaltedPasswordsUtility::isUsageEnabled('FE')) {
                        $objInstanceSaltedPw = SaltFactory::getSaltingInstance();
                        $user->setPassword($objInstanceSaltedPw->getHashedPassword($user->getPassword()));

                    }
                }
        }
    }

    public function getErrorFlashMessage()
    {
        return 'Ocurrio un error, verifique los datos ingresados e intente nuevamente.';
    }

    /**
     * action search
     *
     * @return void
     */
    public function searchAction()
    {
        $searchTerm = $this->request->getArgument('searchTerm');
        if ($this->request->hasArgument('limpiar')) {
            $this->redirect('list');
        }
        $lectors = $this->lectorRepository->findByLike($searchTerm);
        $this->view->setTemplatePathAndFilename(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('biblio') . 'Resources/Private/Templates/Lector/List.html');
        $this->view->assign('lectors', $lectors);
        $this->view->assign('searchTerm', $searchTerm);
    }

    /**
     * action generarExcel
     *
     * @return void
     */
    public function generateExcelAction()
    {
        ob_clean();
        $noInfo = '-';
        $name = 'Lectors';
        //Crear el nuevo objeto PHPExcel
        $excel = new \PHPExcel();
        $sFecha = date('d-m-Y_H:i:s');
        // Propiedades
        $excel->getProperties()->setCreator('Extension Builder');
        $excel->getProperties()->setLastModifiedBy('Extension Builder');
        $excel->getProperties()->setTitle('Reporte_' . $name . '_' . $sFecha);
        $excel->getProperties()->setSubject('Extension Builder');
        $excel->getProperties()->setDescription('Extension Builder');
        //Añadir datos
        $excel->setActiveSheetIndex();
        //Escribir cabecera
        $excel->getActiveSheet()->SetCellValue(\PHPExcel_Cell::stringFromColumnIndex(0) . '1', 'Nombre');
        $excel->getActiveSheet()->SetCellValue(\PHPExcel_Cell::stringFromColumnIndex(1) . '1', 'Rut');
        $lectors = $this->lectorRepository->findAll();
        $excelRowCounter = 2;
        foreach ($lectors as $lector) {
            $excel->getActiveSheet()->SetCellValue(\PHPExcel_Cell::stringFromColumnIndex(0) . $excelRowCounter, empty($lector->getNombre()) ? $noInfo : $lector->getNombre());
            $excel->getActiveSheet()->SetCellValue(\PHPExcel_Cell::stringFromColumnIndex(1) . $excelRowCounter, empty($lector->getRut()) ? $noInfo : $lector->getRut());
            $excelRowCounter++;
        }
        //Cambiar el nombre de la hoja
        $excel->getActiveSheet()->setTitle('Reporte');
        // We'll be outputting an excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Reporte_' . $name . '_' . $sFecha . '.xlsx"');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        $headers = [
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Cache-Control' => 'post-check=0, pre-check=0',
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="Reporte_' . $name . '_' . $sFecha . '.xlsx"',
            'Content-Transfer-Encoding' => 'binary',
            'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT'
        ];
        foreach ($headers as $header => $data) {
            $this->response->setHeader($header, $data);
        }
        $this->response->sendHeaders();
        // Write file to the browser
        ob_end_clean();
        $objWriter = new \PHPExcel_Writer_Excel2007($excel);
        $objWriter->save('php://output');
        die;
    }

    /**
     * action generateCSV
     *
     * @return void
     */
    public function generateCSVAction()
    {
        ob_clean();
        $noInfo = '-';
        $name = 'Lectors';
        $sFecha = date('d-m-Y_H:i:s');
        // We'll be outputting an CSV file
        header('Content-type: text/csv');
        header('Content-Disposition: attachment;filename="Reporte_' . $name . '_' . $sFecha . '.csv"');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Expires: 0');
        $headers = [
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Cache-Control' => 'post-check=0, pre-check=0',
            'Content-Description' => 'File Transfer',
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Reporte_' . $name . '_' . $sFecha . '.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'Last-Modified' => gmdate('D, d M Y H:i:s') . ' GMT'
        ];
        foreach ($headers as $header => $data) {
            $this->response->setHeader($header, $data);
        }
        $this->response->sendHeaders();
        // Write file to the browser
        ob_end_clean();
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        //Escribir cabecera
        fputcsv($output, [
            'Nombre',
            'Rut'
        ]);
        $lectors = $this->lectorRepository->findAll();
        foreach ($lectors as $lector) {
            fputcsv($output, [
                empty($lector->getNombre()) ? $noInfo : $lector->getNombre(),
                empty($lector->getRut()) ? $noInfo : $lector->getRut()
            ]);
        }
        die;
    }

    /**
     * action cargarCSV
     *
     * @return void
     */
    public function cargarCSVAction()
    {
        if ($this->request->hasArgument('resultado')) {
            $this->view->assign('resultado', $this->request->getArgument('resultado'));
        }
    }

    /**
     * action procesarCSV
     *
     * @return void
     */
    public function procesarCSVAction()
    {
        $archivoCSV = $_FILES['archivoCSV'];
        $resultado = new \stdClass();
        switch ($archivoCSV['error']) {
            case 0:    //Si el archivo tiene extension csv se procesara
                if (strtolower(array_pop(explode('.', $archivoCSV['name']))) == 'csv') {
                    $resultado = $this->guardarCSVAction($archivoCSV['tmp_name']);
                    if (!$resultado->error) {
                        $resultado->mensaje = 'Cargado con éxito';
                    }
                } else {
                    $resultado->error = true;
                    $resultado->mensaje = 'El archivo debe ser de tipo CSV.';
                }
                break;
            case 4:
                $resultado->error = true;
                $resultado->mensaje = 'Debe seleccionar un archivo para cargar.';
                break;
        }
        $args = ['resultado' => $resultado];
        $this->forward('cargarCSV', NULL, NULL, $args);
    }

    /**
     * guardarCSVAction
     *
     * @param $archivoCSV
     */
    private function guardarCSVAction($archivoCSV)
    {
        $resultado = new \stdClass();
        $resultado->error = false;
        $csvFile = $archivoCSV;
        ini_set('auto_detect_line_endings', true);
        //set_time_limit(0);
        $current_row = 1;
        $delimiter = $this->getDelimiter($archivoCSV);
        $count = 2;
        //Valida el delimitador de los campos
        if ($delimiter != false) {
            $handle = fopen($csvFile, 'r');
            //Verifica si se cargo el archivo
            if ($handle) {
                $arrayRegistros = [];
                while (($data = fgetcsv($handle, null, $delimiter)) !== FALSE) {
                    $campoVacio = false;
                    $campoInvalido = false;
                    $number_of_fields = count($data);
                    //Valida la cantidad de campos
                    if ($number_of_fields == $count) {
                        if ($current_row == 1) {
                            //Header line
                            for ($c = '0'; $c < $number_of_fields; $c++) {
                                $header_array[$c] = trim(utf8_encode($data[$c]));
                            }
                        } else {
                            //Data line
                            $data_array = [];
                            for ($c = '0'; $c < $number_of_fields; $c++) {
                                //Valida que no existe ningun campo vacio
                                if (empty($data[$c])) {
                                    $campoVacio = true;
                                    $resultado->error = true;
                                    $resultado->mensaje .= 'La columna ' . $header_array[$c] . ' de la fila ' . $current_row . ' esta vacia.<br>';
                                }
                                $data_array[$c] = utf8_encode($data[$c]);
                            }
                            if (!$campoVacio && !$campoInvalido) {
                                $nuevoRegistro = new \Gabriel\Biblio\Domain\Model\Lector();
                                $nuevoRegistro->setNombre($data_array[0]);
                                $nuevoRegistro->setRut($data_array[1]);
                                if (!$resultado->error) {
                                    array_push($arrayRegistros, $nuevoRegistro);
                                }
                            }
                        }
                    } else {
                        $resultado->error = true;
                        $resultado->mensaje .= 'La cantidad de campos en el archivo no es la esperada. ' . 'Verifique la línea ' . $current_row . '<br>';
                    }
                    $current_row++;
                }
                fclose($handle);
            }
        } else {
            $resultado->error = true;
            $resultado->mensaje = 'El delimitador del archivo es no válido. Debe ser , ó ;';
        }
        if (!$resultado->error) {
            foreach ($arrayRegistros as $registro) {
                $this->lectorRepository->add($registro);
            }
        }
        return $resultado;
    }

    /**
     * getDelimiter
     * Try to detect the delimiter character on a CSV file, by reading the first row.
     *
     * @param mixed $file
     * @access public
     * @return string
     */
    private function getDelimiter($file)
    {
        $delimiter = false;
        $line = '';
        if ($f = fopen($file, 'r')) {
            $line = fgets($f);
            // read until first newline
            fclose($f);
        }
        if (strpos($line, ';') !== FALSE && strpos($line, ',') === FALSE) {
            $delimiter = ';';
        } else {
            if (strpos($line, ',') !== FALSE && strpos($line, ';') === FALSE) {
                $delimiter = ',';
            } else {

            }
        }
        return $delimiter;
    }
}
