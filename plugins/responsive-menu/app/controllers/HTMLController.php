<?php


class RM_HTMLController extends RM_BaseController {
    
    
    /**
     * Prepare the HTML for display on the front end
     *
     * @return null
     * @added 1.0
     */
    
    static function prepare() {
        
        
        if( !ResponsiveMenu::getOption( 'RMShortcode' ) )
            add_action( 'wp_footer', array( 'RM_HTMLController', 'display' ) );
        
        
    }
    
    
    /**
     * Creates the view for the menu and echos it out
     *
     * @return string
     * @added 1.0
     */
    
    static function display( $args = null ) {
        
        /* Unfortunately this messy section is due to shortcodes converting all args to lowercase */
        
        if( $args ) :
            
            if( $args['rm'] )
                $args['RM'] = $args['rm'];
            
            if( $args['menu'] )
                $args['RM'] = $args['menu'];
            
            if( $args['title'] )
                $args['RMTitle'] = $args['title'];
            
            if( $args['title_link'] )
                $args['RMTitleLink'] = $args['title_link'];
            
            if( $args['title_open'] )
                $args['RMTitleLoc'] = $args['title_open'];
            
            if( $args['html'] )
                $args['RMHtml'] = $args['html'];
            
            if( $args['html_loc'] )
                $args['RMHtmlLoc'] = $args['html_loc'];
            
            if( $args['title_img'] )
                $args['RMImage'] = $args['title_img'];
            
            if( $args['search_loc'] )
                $args['RMSearchPos'] = $args['search_loc'];
            
            if( $args['btn_img'] )
                $args['RMClickImg'] = $args['btn_img'];
            
            if( $args['btn_img_clicked'] )
                $args['RMClickImgClicked'] = $args['btn_img_clicked'];
            
            if( $args['btn_title'] )
                $args['RMClickTitle'] = $args['btn_title'];
            
            endif;
        
        $options = ResponsiveMenu::getOptions();
        
        RM_View::make( 'menu', $args ? array_merge( $options, $args ) : $options );
        RM_View::make( 'click-button', $args ? array_merge( $options, $args ) : $options );
     
        
    }
    
    
}