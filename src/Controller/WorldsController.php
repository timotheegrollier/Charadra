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
    public function index(HttpClientInterface $client): Response
    {

        $response = $client->request(
            'GET',
            'https://firstlight.newworldstatus.com/ext/v1/worlds/charadra',['headers'=>['Authorization'=> 'Bearer FIRSTLIGHTv4.v4.local.JZ69-Lg7yUssuhe56yNY79XjkMvv4aVXQf3T4GpPHPCBkSQkWAgQhpz9bQomwhnNjuXbh3lSOPtjMKBBhtc6ZtTr8Z8SnBA79dZ6PmnFx0btSz7ckBFXZ3E00oBgmnymSEwCxWKkVd7csjFzCg3q8-sptcYhO92tkR1qzLeaxkgaWEj5eHiRJg9HfWYkQ_KDZ-lWOndG1zyIZitDSGLRuEQi7vt1OK6BET5XcfqANqW3_3GjwOiTWvqIONkK0tGZ2UAzjV6aZzVK1c4F--HIUMr29zWdiawg6MGNYy-7E0L2']]
        );



        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $worlds = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $worlds = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]


        return $this->render('worlds/index.html.twig', compact('worlds'));
    }


}
