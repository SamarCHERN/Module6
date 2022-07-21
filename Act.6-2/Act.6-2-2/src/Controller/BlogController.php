<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="app_blog")
     */
    public function GetGuzzleRequest()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://127.0.0.1:8000/articles');
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/index.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/blog/{id}", name="id")
     */
    public function GetIdtGuzzleRequest(int $id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://127.0.0.1:8000/articles'."/".$id);
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/id.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/post", name="post")
     */
    public function PostGuzzleRequest()
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "http://127.0.0.1:8000"]);
        $options = [
            'form_params' => [
                "titre" => "new title"
               ]
           ]; 
        $response = $client->post("/article", $options);
        return $this->render('blog/blog.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }

    
    /**
     * @Route("/put/{id}", name="put")
     */
    public function PutGuzzleRequest($id)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "http://127.0.0.1:8000"]);
        $options = [
            'form_params' => [
                "titre" => "put title"
               ]
           ]; 
        $response = $client->put("/article"."/".$id, $options);
        return $this->render('blog/blog.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }


    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function DeleteGuzzleRequest($id)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "http://127.0.0.1:8000"]);
  
        $response = $client->delete("/article"."/".$id);
        return $this->render('blog/blog.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }
}