<?php

class RM_JSModel extends RM_BaseModel {
    
    
    /**
     * Function to create the file to hold the JS file
     *
     * @param string $js
     * @return file
     * @added 1.6
     */
    
    static function createJSFile( $js ) {

        
        $file = fopen( RM_Registry::get( 'config', 'plugin_data_dir' ) . '/js/responsive-menu-' . get_current_blog_id() . '.js', 'w' );
        
        $jsFile = fwrite( $file, $js );
        
        fclose( $file );
        
        if( !$file ) 
            RM_Status::set( 'error', __( 'Unable to create JS file', 'responsive-menu' ) );
                
        return $jsFile;
        
        
    }  
    
    
    /**
     * Function to format, create and get the JS itself
     *
     * @param array $options
     * @return string
     * @added 1.0
     */
    
    static function getJS( $options ) {
        
        
        $setHeight = $options['RMPos'] == 'fixed' ? '' : " \$RMjQuery( '#responsive-menu' ).css( 'height', \$RMjQuery( document ).height() ); ";
        $breakpoint = empty($options['RMBreak']) ? "600" : $options['RMBreak'];
        
        $RMPushCSS = empty( $options['RMPushCSS'] ) ? "" : $options['RMPushCSS'];

        $slideOpen = $options['RMAnim'] == 'push' && !empty($options['RMPushCSS']) ? " \$RMjQuery( 'body' ).addClass( 'RMPushOpen' ); " : '';
        $slideRemove = $options['RMAnim'] == 'push' && !empty($options['RMPushCSS']) ? " \$RMjQuery( 'body' ).removeClass( 'RMPushOpen' ); " : '';

        /* Added 1.8 */
        switch( $options['RMSide'] ) :
            case 'left' : $side = 'left'; break;
            case 'right' : $side = 'right'; break;
            case 'top' : $side = 'top'; break;
            case 'bottom' : $side = 'top'; break;
            default : $side = 'left'; break;
        endswitch;
                
        /* Added 2.0 */
        switch( $options['RMSide'] ) :
            case 'left' : $width = $options['RMWidth']; $neg = '-'; break;
            case 'right' : $width = $options['RMWidth']; $neg = '-'; break;
            case 'top' : $width = '100'; $neg = '-'; break;
            case 'bottom' : $width = '100'; $neg = ''; break;
            default : $width = '75'; break;
        endswitch;
        
        switch( $options['RMSide']  ) :
            case 'left' : $pushSide = 'left'; $pos = ''; break;
            case 'right' : $pushSide = 'left'; $pos = '-'; break;
            case 'top' : $pushSide = 'marginTop'; $pos = ''; break;
            case 'bottom' : $pushSide = 'marginTop'; $pos = '-'; break;
        endswitch;

        switch( $options['RMSide']  ) :
            case 'left' : $pushBtnSide = 'left';  break;
            case 'right' : $pushBtnSide = 'right';  break;
            case 'top' : $pushBtnSide = 'top';  break;
            case 'bottom' : $pushBtnSide = 'bottom'; break;
        endswitch;
		
        $sideSlideOpen = $side == 'right' && empty( $slideOpen ) ? " \$RMjQuery( 'body' ).addClass( 'RMPushOpen' ); " : '';
        $sideSlideRemove =  $side == 'right' && empty( $slideRemove ) ? " \$RMjQuery( 'body' ).removeClass( 'RMPushOpen' ); " : '';
        
        /* Added 2.3 */
        
        $trigger = isset( $options['RMTrigger'] ) ? $options['RMTrigger'] : RM_Registry::get( 'defaults', 'RMTrigger' );
        
        $speed = $options['RMAnimSpd'] * 1000;
        
        /* Added 2.5 */
        
        $location = $options['RMLoc'];
        
        /*
        |--------------------------------------------------------------------------
        | Slide Push Animation
        |--------------------------------------------------------------------------
        |
        | This is where we deal with the JavaScript needed for the push animations
        |
        */

        $slideOver = " var MenuWidth = \$RMjQuery('#responsive-menu').width(); ";

        /* Only for the push animation */
        if( $options['RMAnim'] == 'push' ) :

            if( $options['RMSide'] == 'top' || $options['RMSide'] == 'bottom' ) :

                $slideOver .= "

                    var MenuHeight = \$RMjQuery( '#responsive-menu' ).css( 'height' );

                    \$RMjQuery( '$RMPushCSS' ).animate( { $pushSide: \"{$pos}\" + MenuHeight }, {$speed}, 'linear' );


                ";

                if( $options['RMPushBtn'] ) :

                    $slideOver .= "

                        \$RMjQuery( '#click-menu' ).animate( { $pushBtnSide: \"{$pos}\" + MenuHeight }, {$speed}, 'linear' );
                        \$RMjQuery( '#click-menu' ).css( '$location', 'auto' );

                        ";

                endif;

            else :

                $slideOver .= "

                    \$RMjQuery( '$RMPushCSS' ).animate( { $pushSide: {$pos}MenuWidth }, {$speed}, 'linear' );


                ";

                if( $options['RMPushBtn'] && ( $pushBtnSide == $location ) ) :

                    $slideOver .= "

                        \$RMjQuery( '#click-menu' ).animate( { $location: MenuWidth + 20 }, {$speed}, 'linear' );
                        \$RMjQuery( '#click-menu' ).css( '{$location}', 'auto' );

                    ";

                endif;


            endif;

        endif;

        $slideOverCss = $options['RMAnim'] == 'push' && !empty($options['RMPushCSS']) ? " \$RMjQuery( '$RMPushCSS' ).addClass( 'RMPushSlide' ); " : '';

        $slideBack = $options['RMAnim'] == 'push' && !empty($options['RMPushCSS']) ? " \$RMjQuery( '$RMPushCSS' ).animate( { $pushSide: \"0\" }, {$speed}, 'linear' ); " : '';

        if( $options['RMPushBtn'] && $options['RMAnim'] == 'push' && ( $pushBtnSide == $location ) ) :

            $slideBack .= "

                \$RMjQuery( '#click-menu' ).animate( { $pushBtnSide: '{$options['RMRight']}%' }, {$speed}, 'linear', function() {

                    \$RMjQuery( '#click-menu' ).removeAttr( 'style' );

                });

            ";

        endif;

        $slideOverCssRemove = $options['RMAnim'] == 'push' && !empty($options['RMPushCSS']) ? " \$RMjQuery( '$RMPushCSS' ).removeClass( 'RMPushSlide' ); " : '';



        /*
        |--------------------------------------------------------------------------
        | Change to X or Clicked Menu Image Option
        |--------------------------------------------------------------------------
        |
        | This is where we deal with the JavaScript needed to change the main lines
        | to an X or click image if this option has been set
        |
        */

        if( $options['RMX'] || $options['RMClickImgClicked'] ) : 

            $closeX = " \$RMjQuery( '#click-menu #RMX' ).css( 'display', 'none' );
                        \$RMjQuery( '#click-menu #RM3Lines' ).css( 'display', 'block' ); ";

            $showX = " \$RMjQuery( '#click-menu #RM3Lines' ).css( 'display', 'none' );
                         \$RMjQuery( '#click-menu #RMX' ).css( 'display', 'block' ); ";        
        else :

            $closeX = "";
            $showX = "";

        endif;            

        /*
        |--------------------------------------------------------------------------
        | Menu Expansion Options
        |--------------------------------------------------------------------------
        |
        | This is where we deal with the array of expansion options, the current
        | combinations are:
        |
        | - Auto Expand Current Parent Items ['RMExpandPar']
        | - Auto Expand Current Parent Items + Auto Expand Sub-Menus ['RMExpandPar'] && ['RMExpand']
        | - Auto Expand Sub-Menus ['RMExpand']
        | - None !['RMExpandPar'] && !['RMExpand']
        |
        */

        $activeArrow = $options['RMArImgA'] ? '<img src="' . $options['RMArImgA'] . '" />' : json_decode( $options['RMArShpA'] );
        $inactiveArrow = $options['RMArImgI'] ? '<img src="' . $options['RMArImgI'] . '" />' : json_decode( $options['RMArShpI'] );
           

        if ( !$options['RMExpand'] ) :

            $clickedLink = '<span class=\"appendLink rm-append-inactive\">' . $inactiveArrow . '</span>';  
            $clickLink = '<span class=\"appendLink rm-append-inactive\">' . $inactiveArrow . '</span>';  

        else :

            $clickedLink = '<span class=\"appendLink rm-append-active\">' . $activeArrow . '</span>';
            $clickLink = '<span class=\"appendLink rm-append-active\">' . $activeArrow . '</span>'; 

        endif;

        if( $options['RMExpandPar'] ) :

            $clickedLink = '<span class=\"appendLink rm-append-active\">' . $activeArrow . '</span>';
            $clickLink = '<span class=\"appendLink rm-append-inactive\">' . $inactiveArrow . '</span>'; 

        endif;

        if( $options['RMExpandPar'] && $options['RMExpand'] ) :

            $clickedLink = '<span class=\"appendLink rm-append-active\">' . $activeArrow . '</span>';
            $clickLink = '<span class=\"appendLink rm-append-active\">' . $activeArrow . '</span>'; 

        endif;


        /*
        |--------------------------------------------------------------------------
        | Initialise Output
        |--------------------------------------------------------------------------
        |
        | Initialise the JavaScript output variable ready for appending
        |
        */   

        $js = null;

        /*
        |--------------------------------------------------------------------------
        | Strip Tags If Needed
        |--------------------------------------------------------------------------
        |
        | Determine whether to use the <script> tags (when using internal scripts)
        |
        */       

        $js .= $options['RMExternal'] ? '' : '<script>';

        /*
        |--------------------------------------------------------------------------
        | Initial Setup
        |--------------------------------------------------------------------------
        |
        | Setup the initial noConflict and document ready checks
        |
        */   

        $js .= "

            var \$RMjQuery = jQuery.noConflict();

            \$RMjQuery( document ).ready( function() {

        ";

        /*
        |--------------------------------------------------------------------------
        | Stop Main Parent Item Clicks
        |--------------------------------------------------------------------------
        |
        | Stop clicks on the main parent items if option selected
        | Added 2.0
        */ 

        if( $options['RMIgnParCli'] ) :

            $js .= "

                \$RMjQuery( '#responsive-menu ul > li.menu-item-has-children' ).children( 'a' ).addClass( 'rm-click-disabled' );

                \$RMjQuery( '#responsive-menu ul > li.menu-item-has-children' ).children( 'a' ).on( 'click', function( e ) {

                    e.preventDefault();

                });

                \$RMjQuery( '#responsive-menu ul > li.page_item_has_children' ).children( 'a' ).addClass( 'rm-click-disabled' );

                \$RMjQuery( '#responsive-menu ul > li.page_item_has_children' ).children( 'a' ).on( 'click', function( e ) {

                    e.preventDefault();

                });

            ";

        endif;

        /*
        |--------------------------------------------------------------------------
        | Closes the menu on page clicks
        |--------------------------------------------------------------------------
        |
        | Close menu on page clicks if required
        | Added 2.0
        */ 

        if( $options['RMCliToClo'] ) :

            $js .= "

                \$RMjQuery( document ).bind( 'vclick', function( e ) {  

                    if( e.which != 2 && !\$RMjQuery( e.target ).closest( '#responsive-menu, {$trigger}' ).length ) { 

                        closeRM(); 

                    } 

                });

            ";

        endif;


         /*
        |--------------------------------------------------------------------------
        | Click Menu Function
        |--------------------------------------------------------------------------
        |
        | This is our Click Handler to determine whether or not to open or close 
        | the menu when the click menu button has been clicked.
        |
        */

        $js .= "

            var isOpen = false;

            \$RMjQuery( document ).on( 'click', '{$trigger}', function() {

                $setHeight

                !isOpen ? openRM() : closeRM();

            });

        ";

        /*
        |--------------------------------------------------------------------------
        | Menu Open Function
        |--------------------------------------------------------------------------
        |
        | This is the main function that deals with opening the menu and then sets
        | its state to open
        |
        */

        $js.= "

            function openRM() {

                $slideOpen  
                $sideSlideOpen
                $slideOverCss
                $slideOver
                $showX

                \$RMjQuery( '#responsive-menu' ).css( 'display', 'block' ); 
                \$RMjQuery( '#responsive-menu' ).addClass( 'RMOpened' );  
                \$RMjQuery( '#click-menu' ).addClass( 'click-menu-active' );  

                \$RMjQuery( '#responsive-menu' ).stop().animate( { $side: \"0\" }, $speed, 'linear', function() { 

                  $setHeight

                  isOpen = true;

                } ); 

            }

        ";

        /*
        |--------------------------------------------------------------------------
        | Menu Close Function
        |--------------------------------------------------------------------------
        |
        | This is the main function that deals with Closing the Menu and then sets
        | its state to closed
        |
        | Added by Bhupender
        | Modified negative width to take directly width of menu instead of '%', 
        | this works for condition where animation is push and max width of menu is less then %
        |
        */

        $js .= "

            function closeRM() {

                $slideBack

                \$RMjQuery( '#responsive-menu' ).animate( { $side: {$neg}\$RMjQuery( '#responsive-menu' ).width() }, $speed, 'linear', function() {

                    $slideRemove
                    $sideSlideRemove
                    $slideOverCssRemove
                    $closeX
                    \$RMjQuery( '#responsive-menu' ).css( 'display', 'none' );  
                    \$RMjQuery( '#responsive-menu' ).removeClass( 'RMOpened' );  
                    \$RMjQuery( '#click-menu' ).removeClass( 'click-menu-active' ); 

                    isOpen = false;

                } );

            }

        ";

        /*
        |--------------------------------------------------------------------------
        | Menu Resize Function
        |--------------------------------------------------------------------------
        |
        | This is the main function that deals with resizing the page and is used 
        | to judge whether the menu needs closing once the screen is resized
        |
        |
        | Added by Bhupender
        | - Modified negative width to take directly width of menu instead of '%', 
        |   this works for condition where animation is push and max width of menu is less then %

        */

        $js .= "

            \$RMjQuery( window ).resize( function() { 

            	\$RMjQuery( '#responsive-menu' ).stop( true, true );
            	
                $setHeight

                if( \$RMjQuery( window ).width() > $breakpoint ) { 

                    if( \$RMjQuery( '#responsive-menu' ).css( '$side' ) != -\$RMjQuery( '#responsive-menu' ).width() ) {

                        closeRM();

                    }

                }

            });

        ";


        /*
        |--------------------------------------------------------------------------
        | Expand children links of parents
        |--------------------------------------------------------------------------
        |
        | Section to automatically expand children links of parents if necessary
        | Added 2.0
        |
        */

        if( $options['RMExpandPar'] ) :

            $js .= "

                \$RMjQuery( '#responsive-menu ul ul' ).css( 'display', 'none' );

                \$RMjQuery( '#responsive-menu .current_page_ancestor.menu-item-has-children' ).children( 'ul' ).css( 'display', 'block' );
                \$RMjQuery( '#responsive-menu .current-menu-ancestor.menu-item-has-children' ).children( 'ul' ).css( 'display', 'block' );
                \$RMjQuery( '#responsive-menu .current-menu-item.menu-item-has-children' ).children( 'ul' ).css( 'display', 'block' );

                \$RMjQuery( '#responsive-menu .current_page_ancestor.page_item_has_children' ).children( 'ul' ).css( 'display', 'block' );
                \$RMjQuery( '#responsive-menu .current-menu-ancestor.page_item_has_children' ).children( 'ul' ).css( 'display', 'block' );
                \$RMjQuery( '#responsive-menu .current-menu-item.page_item_has_children' ).children( 'ul' ).css( 'display', 'block' );

            ";

        endif;

        /*
        |--------------------------------------------------------------------------
        | Add Toggle Buttons
        |--------------------------------------------------------------------------
        |
        | This is the main section that deals with Adding the correct Toggle buttons
        | when needed to the links
        |
        */

        if( $options['RMExpand'] ) :
            $js .= " \$RMjQuery( '#responsive-menu ul ul' ).css( 'display', 'block' ); ";
        endif;
        
        $js .= " 

            var clickLink = '{$clickLink}';
            var clickedLink = '{$clickedLink}';

            \$RMjQuery( '#responsive-menu .responsive-menu li' ).each( function() {

                if( \$RMjQuery( this ).children( 'ul' ).length > 0 ) {

                    if( \$RMjQuery( this ).find( '> ul' ).css( 'display' ) == 'none' ) {

                        \$RMjQuery( this ).prepend( clickLink );  

                    } else {

                        \$RMjQuery( this ).prepend( clickedLink );  

                    }

                }

            });

        ";

        /*
        |--------------------------------------------------------------------------
        | Accordion Animation
        |--------------------------------------------------------------------------
        |
        | This is the part that deals with the accordion animation
		| Currently only works to one level of depth
        |
        */     

        if( $options['RMAccordion'] && $options['RMAccordion'] == 'accordion' ) :

            $accordion = " 

            if( \$RMjQuery( this ).closest( 'ul' ).is( '.responsive-menu' ) ) {

                \$RMjQuery( '.accordion-open' ).removeClass( 'accordion-open' );

				\$RMjQuery( this ).parent( 'li' ).addClass( 'accordion-open' );	
								
				\$RMjQuery( '.responsive-menu > li:not( .accordion-open ) > ul' ).slideUp();
				
				if( \$RMjQuery( this ).siblings( 'ul' ).is( ':visible' ) ) {
					\$RMjQuery( this ).parent( 'li' ).removeClass( 'accordion-open' );	
				} else {
					\$RMjQuery( this ).parent( 'li' ).addClass( 'accordion-open' );	
				}
				
				\$RMjQuery( '.responsive-menu > li > .appendLink' ).removeClass( 'rm-append-inactive' );
				\$RMjQuery( '.responsive-menu > li > .appendLink' ).addClass( 'rm-append-active' );		
                
                var AllClosed = true;
                
				\$RMjQuery( '.responsive-menu > li > .appendLink' ).each( function( i ) {
					\$RMjQuery( this ).html( \$RMjQuery( this ).hasClass( 'rm-append-active' ) ? '{$inactiveArrow}' : '{$activeArrow}' );	
					AllClosed = \$RMjQuery( this ).parent( 'li' ).hasClass( 'accordion-open' )? false : AllClosed;		
				});
				
				\$RMjQuery( this ).removeClass( 'rm-append-active' );
				\$RMjQuery( this ).addClass( 'rm-append-inactive' );
				
				if( AllClosed ) {
					\$RMjQuery( this ).removeClass( 'rm-append-inactive' );
					\$RMjQuery( this ).addClass( 'rm-append-active' );
				
				}
								
            }

            ";

        else :

            $accordion = null;

        endif;


        /*
        |--------------------------------------------------------------------------
        | Toggle Buttons Function
        |--------------------------------------------------------------------------
        |
        | This is the function that deals with toggling the toggle buttons
        |
        */                

        $js .= "   

            \$RMjQuery( '.appendLink' ).on( 'click', function() { 

                $accordion

                \$RMjQuery( this ).nextAll( '#responsive-menu ul ul' ).slideToggle(); 

                \$RMjQuery( this ).html( \$RMjQuery( this ).hasClass( 'rm-append-active' ) ? '{$inactiveArrow}' : '{$activeArrow}' );
                \$RMjQuery( this ).toggleClass( 'rm-append-active rm-append-inactive' );

                $setHeight

            });

            \$RMjQuery( '.rm-click-disabled' ).on( 'click', function() { 

                $accordion

                \$RMjQuery( this ).nextAll( '#responsive-menu ul ul' ).slideToggle(); 

                \$RMjQuery( this ).siblings( '.appendLink' ).html( \$RMjQuery( this ).hasClass( 'rm-append-active' ) ? '{$inactiveArrow}' : '{$activeArrow}' );
                \$RMjQuery( this ).toggleClass( 'rm-append-active rm-append-inactive' );

                $setHeight

            }); 

        ";

        /*
        |--------------------------------------------------------------------------
        | Finally Hide Appropriate Hidden Objects
        |--------------------------------------------------------------------------
        |
        | This is the function that deals with toggling the toggle buttons
        |
        */                

        $js .= "   

            \$RMjQuery( '.rm-append-inactive' ).siblings( 'ul' ).css( 'display', 'none' );

        ";

        /*
        |--------------------------------------------------------------------------
        | Menu Closing Options
        |--------------------------------------------------------------------------
        |
        | This is where we set the menu to retract if a link is clicked
        | Added 1.9
        |
        */

        if ( isset( $options['RMClickClose'] ) && $options['RMClickClose'] == 'close' ) : 

           $js .= " 
               \$RMjQuery( '#responsive-menu ul li a' ).on( 'click', function() { 

                   closeRM();

               } );";

        endif;

        /*
        |--------------------------------------------------------------------------
        | Close Tags
        |--------------------------------------------------------------------------
        |
        | This closes the initial document ready call
        |
        */ 

        $js .= '}); ';

        /*
        |--------------------------------------------------------------------------
        | Strip Tags If Needed
        |--------------------------------------------------------------------------
        |
        | Determine whether to use the <script> tags (when using internal scripts)
        |
        */       

        $js .= $options['RMExternal'] ? '' : '</script>';


        /*
        |--------------------------------------------------------------------------
        | Return Finished Script
        |--------------------------------------------------------------------------
        |
        | Finally we return the final script back
        |
        */   

        return $js;

        
    }
    

}