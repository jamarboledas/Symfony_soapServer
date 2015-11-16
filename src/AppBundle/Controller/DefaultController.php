<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/server", name="server")
     */
    public function serverAction()
    {
        $server = new \SoapServer('web/public/hello.wsdl');
        $server->setObject($this->get('hello_service'));

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }

    /**
     * @Route("/client", name="client")
     */
    public function clientAction()
    {
        $client = new \SoapClient('/server?wsdl', true);

        $result = $client->call('hello', array('name' => 'Scott'));
    }
}