<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Gabriel.Biblio',
            'Editorial',
            'biblioteca editorial plugin'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Gabriel.Biblio',
            'Libro',
            'biblioteca libro plugin'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Gabriel.Biblio',
            'Autor',
            'biblioteca autor plugin'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Gabriel.Biblio',
            'Lector',
            'biblioteca lector plugin'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Gabriel.Biblio',
            'Prestamo',
            'biblioteca prestamo plugin'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('biblio', 'Configuration/TypoScript', 'Biblioteca');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_biblio_domain_model_editorial', 'EXT:biblio/Resources/Private/Language/locallang_csh_tx_biblio_domain_model_editorial.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_biblio_domain_model_editorial');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_biblio_domain_model_libro', 'EXT:biblio/Resources/Private/Language/locallang_csh_tx_biblio_domain_model_libro.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_biblio_domain_model_libro');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_biblio_domain_model_lector', 'EXT:biblio/Resources/Private/Language/locallang_csh_tx_biblio_domain_model_lector.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_biblio_domain_model_lector');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_biblio_domain_model_autor', 'EXT:biblio/Resources/Private/Language/locallang_csh_tx_biblio_domain_model_autor.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_biblio_domain_model_autor');

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_biblio_domain_model_prestamo', 'EXT:biblio/Resources/Private/Language/locallang_csh_tx_biblio_domain_model_prestamo.xlf');
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_biblio_domain_model_prestamo');

    }
);
