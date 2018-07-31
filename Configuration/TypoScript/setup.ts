
plugin.tx_biblio_editorial {
    view {
        templateRootPaths.0 = EXT:biblio/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_biblio_editorial.view.templateRootPath}
        partialRootPaths.0 = EXT:biblio/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_biblio_editorial.view.partialRootPath}
        layoutRootPaths.0 = EXT:biblio/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_biblio_editorial.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_biblio_editorial.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_biblio_libro {
    view {
        templateRootPaths.0 = EXT:biblio/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_biblio_libro.view.templateRootPath}
        partialRootPaths.0 = EXT:biblio/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_biblio_libro.view.partialRootPath}
        layoutRootPaths.0 = EXT:biblio/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_biblio_libro.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_biblio_libro.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_biblio_autor {
    view {
        templateRootPaths.0 = EXT:biblio/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_biblio_autor.view.templateRootPath}
        partialRootPaths.0 = EXT:biblio/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_biblio_autor.view.partialRootPath}
        layoutRootPaths.0 = EXT:biblio/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_biblio_autor.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_biblio_autor.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_biblio_lector {
    view {
        templateRootPaths.0 = EXT:biblio/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_biblio_lector.view.templateRootPath}
        partialRootPaths.0 = EXT:biblio/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_biblio_lector.view.partialRootPath}
        layoutRootPaths.0 = EXT:biblio/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_biblio_lector.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_biblio_lector.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

plugin.tx_biblio_prestamo {
    view {
        templateRootPaths.0 = EXT:biblio/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_biblio_prestamo.view.templateRootPath}
        partialRootPaths.0 = EXT:biblio/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_biblio_prestamo.view.partialRootPath}
        layoutRootPaths.0 = EXT:biblio/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_biblio_prestamo.view.layoutRootPath}
    }
    persistence {
        storagePid = {$plugin.tx_biblio_prestamo.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 1
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
}

config.tx_extbase.view.widget.TYPO3\CMS\Fluid\ViewHelpers\Widget\PaginateViewHelper.templateRootPath = EXT:biblio/Resources/Private/Layouts/

page.includeJSFooter{
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    dropzone = EXT:biblio/Resources/Public/Javascript/dropzone.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    select2Min = EXT:biblio/Resources/Public/Javascript/select2.min.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    select2LocaleEs = EXT:biblio/Resources/Public/Javascript/select2_locale_es.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    bootstrapDatepicker = EXT:biblio/Resources/Public/Javascript/bootstrap-datepicker.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    bootstrapDatepickerEs = EXT:biblio/Resources/Public/Javascript/bootstrap-datepicker.es.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    bootstrapSortable = EXT:biblio/Resources/Public/Javascript/bootstrap-sortable.js
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    moment = EXT:biblio/Resources/Public/Javascript/moment.min.js

    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    validaRut = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/validaRut.js
    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    validaUsername = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/validaUsername.js
    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    creacionCaratula = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/generarCaratula.js
    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    creacionTalonarios = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/generarTalonarios.js
    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    liquidacionCaratula = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/liquidarCaratula.js
    # cat=plugin.tx_ecomply/javascript; type=string; label=Javascript main
    servicioGenerico = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/servicioGenerico.js
    # cat=plugin.tx_ceisrendiciontransporte/javascript; type=string; label=Javascript main
    util = EXT:ceis_rendicion_transporte/Resources/Public/Javascript/util.js

    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    mainFile = EXT:biblio/Resources/Public/Javascript/main.js
    mainFile.disableCompression = 1
    mainFile.excludeFromConcatenation = 1
}

page.includeCSS{
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    select2 = EXT:biblio/Resources/Public/Css/select2.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    select2Bootstrap = EXT:biblio/Resources/Public/Css/select2-bootstrap.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    bootstrapDatepickerCss = EXT:biblio/Resources/Public/Css/datepicker3.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    bootstrapSortableCss = EXT:biblio/Resources/Public/Css/bootstrap-sortable.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    #dropzone = EXT:biblio/Resources/Public/Css/dropzone.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    #basic = EXT:biblio/Resources/Public/Css/basic.css
    # cat=plugin.tx_biblio/javascript; type=string; label=Javascript main
    dropzoneStyle = EXT:biblio/Resources/Public/Css/dropzoneStyle.css
}

# these classes are only used in auto-generated templates
plugin.tx_biblio._CSS_DEFAULT_STYLE (
    	textarea.f3-form-error {
    		background-color:#FF9F9F;
    		border: 1px #FF0000 solid;
    	}

    	input.f3-form-error {
    		background-color:#FF9F9F;
    		border: 1px #FF0000 solid;
    	}

    	.typo3-messages .message-error {
    		color:red;
    	}

    	.typo3-messages .message-ok {
    		color:green;
    	}

        .tx-biblio th{
            text-align: center;
        }

        .tx-biblio td{
            text-align: center;
        }
)
