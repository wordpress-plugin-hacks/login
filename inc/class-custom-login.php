<?php
namespace wp\login;
use wp\login\admin\AdminLogin;

/**
 * Class CustomLogin
 * @package wp\login
 */
class CustomLogin
{
    /**
     * just what it says
     *
     * @var
     */
    protected $plugin_name;


    /**
     * what version am I again
     *
     * @var string
     */
    protected $version;

    /**
     * CustomLogin constructor.
     */
    public function __construct()
    {
        $this->plugin_name = "custom-login";
        $this->version = "0.0.1";
        add_action( "admin_init", array( $this, "admin_loader" ) );
    }

    /**
     * @return string
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     *
     */
    public function init()
    {
        include_once plugin_dir_path( __DIR__ ) . "admin/class-admin-login.php";
    }

    /**
     *
     */
    public function admin_loader()
    {
        new AdminLogin();
    }
}