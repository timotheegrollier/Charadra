<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WorldsController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {

      

        return $this->render('worlds/index.html.twig');
    }



    /**
     * @Route("/worlds", name="app_worlds")
     */
    public function worlds(HttpClientInterface $client):Response{

        $token = $this->getParameter('nw_token');

        $response = $client->request(
            'GET',
            'https://firstlight.newworldstatus.com/ext/v1/worlds/charadra',
            ['headers' => ['Authorization' => $token]]
        );



        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'

        $worlds = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $worlds = $response->toArray();
            // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]



        return $this->render('worlds/worlds.html.twig', compact('worlds'));
    }

}
