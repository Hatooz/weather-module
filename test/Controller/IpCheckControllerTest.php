<?php

namespace Anax\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class IpCheckControllerTest extends TestCase
{
    
    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new IpCheckController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }



    /**
     * Test the route "index".
     */
    public function testIndexAction()
    {
        $this->di->get("session")->start();
        $res = $this->controller->indexActionGet();
        $this->assertInternalType("object", $res);

        // $json = $res[0];
        // $exp = "db is active";
        // $this->assertContains($exp, $json["message"]);
    }

    public function testIndexActionPost()
    {
        // $context = [
        //     "ip_rest" => "127.0.0.1"
        // ];
        // $res = $this->di->get("request")->setBody($context);
        // var_dump($res);
        $this->di->get("session")->start();
        $this->di->get("response")->redirectSelf();
        $res = $this->controller->indexActionPost();
        // $url = substr($_SERVER['REQUEST_URI'], -8);
        
         
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
        // $json = $res[0];
        // $exp = "db is active";
        // $this->assertContains($url, "ip_check");
    }
 


    /**
     * Test the route "dump-di".
     */
    public function testDumpDiActionGet()
    {
        $res = $this->controller->dumpDiActionGet();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $exp = "di contains";
        $this->assertContains($exp, $json["message"]);
        $this->assertContains("configuration", $json["di"]);
        $this->assertContains("request", $json["di"]);
        $this->assertContains("response", $json["di"]);
    }



    /**
     * Test the route "forbidden".
     */
    public function testForbiddenAction()
    {
        $res = $this->controller->forbiddenAction();
        $this->assertInternalType("array", $res);

        $json = $res[0];
        $status = $res[1];

        $exp = "forbidden to access";
        $this->assertContains($exp, $json["message"]);
        $this->assertEquals(403, $status);
    }
}
