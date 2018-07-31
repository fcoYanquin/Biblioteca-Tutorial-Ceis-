<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Gabriel.Biblio',
            'Editorial',
            [
                'Editorial' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ],
            // non-cacheable actions
            [
                'Editorial' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Gabriel.Biblio',
            'Libro',
            [
                'Libro' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ],
            // non-cacheable actions
            [
                'Libro' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Gabriel.Biblio',
            'Autor',
            [
                'Autor' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ],
            // non-cacheable actions
            [
                'Autor' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Gabriel.Biblio',
            'Lector',
            [
                'Lector' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ],
            // non-cacheable actions
            [
                'Lector' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Gabriel.Biblio',
            'Prestamo',
            [
                'Prestamo' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ],
            // non-cacheable actions
            [
                'Prestamo' => 'list, show, new, create, edit, update, delete, search, generateExcel, generateCSV'
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    editorial {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('biblio') . 'Resources/Public/Icons/user_plugin_editorial.svg
                        title = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_editorial
                        description = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_editorial.description
                        tt_content_defValues {
                            CType = list
                            list_type = biblio_editorial
                        }
                    }
                    libro {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('biblio') . 'Resources/Public/Icons/user_plugin_libro.svg
                        title = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_libro
                        description = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_libro.description
                        tt_content_defValues {
                            CType = list
                            list_type = biblio_libro
                        }
                    }
                    autor {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('biblio') . 'Resources/Public/Icons/user_plugin_autor.svg
                        title = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_autor
                        description = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_autor.description
                        tt_content_defValues {
                            CType = list
                            list_type = biblio_autor
                        }
                    }
                    lector {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('biblio') . 'Resources/Public/Icons/user_plugin_lector.svg
                        title = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_lector
                        description = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_lector.description
                        tt_content_defValues {
                            CType = list
                            list_type = biblio_lector
                        }
                    }
                    prestamo {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('biblio') . 'Resources/Public/Icons/user_plugin_prestamo.svg
                        title = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_prestamo
                        description = LLL:EXT:biblio/Resources/Private/Language/locallang_db.xlf:tx_biblio_domain_model_prestamo.description
                        tt_content_defValues {
                            CType = list
                            list_type = biblio_prestamo
                        }
                    }
                }
                show = *
            }
       }'
    );
    }
);

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['biblio_editorial'] = 'EXT:biblio/Classes/EID/EditorialEID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['biblio_libro'] = 'EXT:biblio/Classes/EID/LibroEID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['biblio_lector'] = 'EXT:biblio/Classes/EID/LectorEID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['biblio_autor'] = 'EXT:biblio/Classes/EID/AutorEID.php';
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['biblio_prestamo'] = 'EXT:biblio/Classes/EID/PrestamoEID.php';
