<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class BlogController extends AbstractController
{
        /**
     * @Route("/posts", name="home")
     */
    public function home(): Response
    {
        $client = new Client (['base_uri' => 'https://jsonplaceholder.typicode.com/']);
        $response = $client->request('GET', '/posts');
        $body=$response->getBody();
        $post=json_decode($body);
        return $this->render('blog/home.html.twig',[
            'articles'=>$post
        ]);
    }

    /**
     * @Route("/put/{id}", name="put")
     */
    public function Put(int $id)
    {
        $client = new Client([
            'base_uri' => 'https://jsonplaceholder.typicode.com',
        ]);
          
        $response = $client->request('PUT', '/posts/:id', [
            'json' => [
                'title' => 'Samar',
                'body' => 'cursus symfony'
            ]
        ]);
          
        $body = $response->getBody();
        $articles = json_decode($body);

        return $this->render('blog/show.html.twig',[
            'articles'=>$articles,
        ]);
    }

    
    /**
     * @Route("/create", name="create)
     */
    public function Post()
    {
        $client = new Client (['base_uri' => 'https://jsonplaceholder.typicode.com']);
        $response = $client->request('POST', 'http://httpbin.org/post', [
            'form_params' => [
                'title' => 'abc',
                'body' => '123',
            ]
        ]);
        $response->getStatusCode();
        $body=$response->getBody();
        $post=json_decode($body);  
        return $this->render('blog/show.html.twig',[
            'articles'=>$post,
        ]);
    }

}
