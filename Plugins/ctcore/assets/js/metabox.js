;( function( $ )
{
    var SRFEMetabox = SRFEMetabox || {};

    SRFEMetabox._initialized = false;
    SRFEMetabox._reduxFieldInitialized = false;

    SRFEMetabox.init = function()
    {
        if ( this._initialized )
        {
            return false;
        }

        this._initialized = true;

        if ( 'undefined' !== typeof EFrameworkMetaboxLocalize )
        {
            this.getErrors( EFrameworkMetaboxLocalize );
            this.getWarnings( EFrameworkMetaboxLocalize );
            // this.postFormats( EFrameworkMetaboxLocalize );
        }

        var saveBtns = document.querySelectorAll( '#publishing-action .button[name="save"], #save-action .button[mame="save"], #addtag #submit, #edittag input[type="submit"]' );

        for ( var i = saveBtns.length - 1; i >= 0; i-- )
        {
            saveBtns[i].addEventListener( 'click', function()
            {
                window.onbeforeunload = null;
            });
        }

        this.formSubmit();
    };

    SRFEMetabox.getErrors = function( data )
    {
        if ( 'undefined' == typeof data.errors || $.isEmptyObject( data.errors ) )
        {
            return;
        }
        console.log( data.errors );

        for ( var id in data.errors )
        {
            var $field = $( '#' + id );
            if ( $field.length )
            {
                $field.parent().append( $( '<div class="redux-th-error">' ).html( data.errors[id] ) );
                $field.parent().addClass( 'redux-field-error' );
            }
        }

        $( '.redux-container' ).each( function()
        {
            var container = $( this );
            var totalErrors = container.find( '.redux-field-error' ).length;

            if ( totalErrors > 0 )
            {
                container.find( ".redux-field-errors span" ).text( totalErrors );
                container.find( ".redux-field-errors" ).slideDown();
                container.find( '.redux-group-tab' ).each( function()
                {
                    var total = $( this ).find( '.redux-field-error' ).length;
                    if ( total > 0 )
                    {
                        var sectionRel = $( this ).attr( 'data-rel' );
                        container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).prepend( '<span class="redux-menu-error">' + total + '</span>' );
                        container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).addClass( "hasError" );
                        var subParent = container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).parents( '.hasSubSections:first' );
                        if ( subParent )
                        {
                            subParent.find( '.redux-group-tab-link-a:first' ).addClass( 'hasError' );
                        }
                    }
                } );
            }
        } );
    };

    SRFEMetabox.getWarnings = function( data )
    {
        if ( 'undefined' == typeof data.warnings || $.isEmptyObject( data.warnings ) )
        {
            return;
        }

        for ( var id in data.warnings )
        {
            var $field = $( '#' + id );
            if ( $field.length )
            {
                $field.parent().append( $( '<div class="redux-th-warning">' ).html( data.warnings[id] ) );
                $field.parent().addClass( 'redux-field-warning' );
            }
        }

        $( '.redux-container' ).each( function()
        {
            var container = $( this );
            var totalErrors = container.find( '.redux-field-warning' ).length;

            if ( totalErrors > 0 )
            {
                container.find( ".redux-field-warnings span" ).text( totalErrors );
                container.find( ".redux-field-warnings" ).slideDown();
                container.find( '.redux-group-tab' ).each( function()
                {
                    var total = $( this ).find( '.redux-field-warning' ).length;
                    if ( total > 0 )
                    {
                        var sectionRel = $( this ).attr( 'data-rel' );
                        container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).prepend( '<span class="redux-menu-warning">' + total + '</span>' );
                        container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).addClass( "hasError" );
                        var subParent = container.find( '.redux-group-tab-link-a[data-key="' + sectionRel + '"]' ).parents( '.hasSubSections:first' );
                        if ( subParent )
                        {
                            subParent.find( '.redux-group-tab-link-a:first' ).addClass( 'hasError' );
                        }
                    }
                } );
            }
        } );
    };

    SRFEMetabox.pageTemplates = function()
    {
        var self = this;

        if ( 'undefined' == typeof data.page_templates || $.isEmptyObject( data.page_templates ) )
        {
            return;
        }

        for ( var boxid in data.page_templates )
        {
            var $box = $( '#' + boxid );

            if ( $box.length )
            {
                $box.hide();
            }

            if ( -1 !== $.inArray( $( '#page_template' ).val(), data.page_templates[ boxid ] ) )
            {
                if ( ! $box.is( ':visible' ) )
                {
                    $box.fadeIn( 300 );
                    if ( ! self._reduxFieldInitialized )
                    {
                        $.redux.initFields();
                        self._reduxFieldInitialized = true;
                    }
                }
            }
        }

        $( '#page_template' ).on( 'change', function()
        {
            var v;

            if ( $( this ).is( ':checked' ) )
            {
                v = $( this ).val();
            }
            else
            {
                return;
            }

            for ( var boxid in data.page_templates )
            {
                var $box = $( '#' + boxid );

                if ( $box.length )
                {
                    if ( -1 !== $.inArray( v, data.page_templates[ boxid ] ) )
                    {
                        if ( ! $box.is( ':visible' ) )
                        {
                            $box.fadeIn( 300 );
                            if ( ! self._reduxFieldInitialized )
                            {
                                $.redux.initFields();
                                self._reduxFieldInitialized = true;
                            }
                        }
                    }
                    else
                    {
                        if ( $box.is( ':visible' ) )
                        {
                            $box.fadeOut( 50 );
                        }
                    }
                }
            }
        } );
    };

    SRFEMetabox.postFormats = function( data )
    {
        var self = this;

        if ( 'undefined' == typeof data.post_formats || $.isEmptyObject( data.post_formats ) )
        {
            return;
        }

        for ( var boxid in data.post_formats )
        {
            var $box = $( '#' + boxid );

            if ( $box.length )
            {
                $box.hide();
            }

            if ( -1 !== $.inArray( $( 'input[name="post_format"]' ).val(), data.post_formats[ boxid ] ) )
            {
                if ( ! $box.is( ':visible' ) )
                {
                    $box.fadeIn( 300 );
                    if ( ! self._reduxFieldInitialized )
                    {
                        $.redux.initFields();
                        self._reduxFieldInitialized = true;
                    }
                }
            }
        }

        $( 'input[name="post_format"]' ).on( 'change', function()
        {
            var v;

            if ( $( this ).is( ':checked' ) )
            {
                v = $( this ).val();
            }
            else
            {
                return;
            }

            for ( var boxid in data.post_formats )
            {
                var $box = $( '#' + boxid );

                if ( $box.length )
                {
                    if ( -1 !== $.inArray( v, data.post_formats[ boxid ] ) )
                    {
                        if ( ! $box.is( ':visible' ) )
                        {
                            $box.fadeIn( 300 );
                            if ( ! self._reduxFieldInitialized )
                            {
                                $.redux.initFields();
                                self._reduxFieldInitialized = true;
                            }
                        }
                    }
                    else
                    {
                        if ( $box.is( ':visible' ) )
                        {
                            $box.fadeOut( 50 );
                        }
                    }
                }
            }
        } );
    };

    SRFEMetabox.formSubmit = function()
    {
        if ( 'undefined' == typeof adminpage )
        {
            return;
        }

        var submitBtn,
            $formFields;
            defaults = [];

        if ( 'edit-tags-php' == adminpage )
        {
            submitBtn = document.querySelector( 'form#addtag #submit' );
            $formFields = $( '.redux-container input[name], .redux-container select[name], .redux-container textarea[name]' );

            if ( submitBtn && $formFields.length )
            {
                $formFields.each( function()
                {
                    $( this ).data( 'srfe-metabox-default-value', $( this ).val() );
                });

                submitBtn.addEventListener( 'click', function( e )
                {
                    // Silly query again for updated DOM which may exists
                    $formFields = $( '.redux-container input[name], .redux-container select[name], .redux-container textarea[name]' );
                    $formFields.each( function()
                    {
                        if ( $( this ).prev( '.select2-container' ).length )
                        {
                            $( this ).val( $( this ).data( 'srfe-metabox-default-value' ) ).trigger( 'change.select2' );
                        }
                        else if ( $( this ).closest( '.wp-picker-container' ).length )
                        {
                            $( this ).next( '.button' ).trigger( 'click' );
                        }
                        else
                        {
                            $( this ).val( $( this ).data( 'srfe-metabox-default-value' ) ).change();
                        }
                    });

                    $notice = $( '.redux-container .redux-save-warn' );

                    if ( $notice.length )
                    {
                        $notice.hide();
                    }
                });
            }
        }
    };

    $(document).on('click', 'input#publish', function (e) {
        window.onbeforeunload = function(e) {};
    });

    document.addEventListener( 'DOMContentLoaded', function()
    {
        SRFEMetabox.init();
    });
})( jQuery );
