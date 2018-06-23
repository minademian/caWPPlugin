<?php
if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ));
            } else {
                error_log( $log );
            }
        }
    }
}

if (!function_exists('debugvar')) {
    function debugvar ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                echo '<pre>';print_r( $log );echo '</pre>';
            } else {
                echo '<pre>';var_dump( $log );echo '</pre>';
            }
        }
    }
}