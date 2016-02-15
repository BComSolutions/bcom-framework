<?php

class RM_Transient {
    
    /**
     * Function to get named cached transient menu
     *
     * @param  string  $name
     * @return string
     * @added 2.3
     * @edited 2.4 - Added option to use transient caching
     */
    
    static function getTransientMenu( $data ) {

        $Transient = ResponsiveMenu::getOption( 'RMUseTran' );

        if( $Transient ) :
            
            $cachedKey = $data['RM'] . '_' . get_current_blog_id();
            $cachedMenu = get_transient( $cachedKey );
            
        else :
            
            $cachedMenu = false;
        
        endif;

        if( $cachedMenu === false ) :

            $cachedMenu = self::createTransientMenu( $data );

            if( $Transient )
                set_transient( $cachedKey, $cachedMenu );
        
        endif;
        
        return $cachedMenu;
        
    }
    
     /**
     * Function to create named cached transient menu
     *
     * @param  string  $name
     * @return array
     * @added 2.3
     */
    
    static function createTransientMenu( $data ) {
        if ( $data['RMThemeLocation'] ) { // if theme_location is used, menu is no used 
            $data['RM'] = null;
        }
        $cachedMenu = wp_nav_menu( array(
                'theme_location' => $data['RMThemeLocation'], 
                'menu' => $data['RM'],
                'menu_class' => 'responsive-menu',
                'depth' => $data['RMDepth'] ,
                'walker' => ( !empty( $data['RMWalker'] ) ) ? new $data['RMWalker'] : '', // Add by Mkdgs
                'echo' => false 
                )
            );
        
        return $cachedMenu;
        
    }
    
    /**
     * Function to clear all transient menus
     *
     * @return null
     * @added 2.3
     */
    
    static function clearTransientMenus() {
        
        if( ResponsiveMenu::hasMenus() ) :

            foreach( ResponsiveMenu::getMenus() as $menu ) :

                delete_transient( $menu->slug . '_' . get_current_blog_id() );

            endforeach;

        endif;
        
    }
    
}
