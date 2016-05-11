<?php

namespace wp\login\admin;

class AdminLogin
{
    /**
     * AdminLogin constructor.
     */
    public function __construct()
    {
        add_action( 'register_form', array( $this, 'loader' ) );
    }
    
    public function loader()
    {
        include_once plugin_dir_path( __FILE__ ) . "admin/front/login-screen.php";
    }
}