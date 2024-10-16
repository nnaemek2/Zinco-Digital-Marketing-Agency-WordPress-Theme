<?php

    /**
     * This class just is used for older theme
     */
    class ReduxFrameworkInstances {

        /**
         * Get Instance
         * Get Redux_Instances instance
         * OR an instance of ReduxFramework by [opt_name]
         *
         * @param  string|false $opt_name the defined opt_name.
         *
         * @return ReduxFramework class instance
         */
        public static function get_instance( $opt_name = false ) {

            if ( $opt_name && class_exists('Redux_Instances') ) {
                return Redux_Instances::get_instance($opt_name);
            }

            return null;
        }

    }
