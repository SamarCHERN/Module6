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
        $request = $client->get('https://jsonplaceholder.typicode.com/posts');// Url of your choosing
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
        $request = $client->get('https://jsonplaceholder.typicode.com/posts/'.$id);// Url of your choosing
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/id.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/post/{id}", name="GetUserId")
     */
    public function GetUserIdtGuzzleRequest(int $id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://jsonplaceholder.typicode.com/posts?userId='.$id);// Url of your choosing
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/userid.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/blog/{id}/comments", name="comments")
     */
    public function GetCommentstGuzzleRequest(int $id)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://jsonplaceholder.typicode.com/posts'."/".$id."/"."comments");// Url of your choosing
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/comments.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/comments/{postid}", name="commentsbypost")
     */
    public function GetCommentsBypostGuzzleRequest(int $postid)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://jsonplaceholder.typicode.com/comments?postId='.$postid);// Url of your choosing
        $response = $request->getBody();
        $articles=json_decode($response);
        return $this->render('blog/comments.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/post", name="post")
     */
    public function PostGuzzleRequest()
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "https://jsonplaceholder.typicode.com"]);
        $options = [
            'form_params' => [
                "title" => "new title"
               ]
           ]; 
        $response = $client->post("/posts", $options);
        return $this->render('blog/post.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }

    
    /**
     * @Route("/put/{id}", name="put")
     */
    public function PutGuzzleRequest($id)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "https://jsonplaceholder.typicode.com"]);
        $options = [
            'form_params' => [
                "title" => "put title"
               ]
           ]; 
        $response = $client->put("/posts"."/".$id, $options);
        return $this->render('blog/put.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }

    /**
     * @Route("/patch/{id}", name="patch")
     */
    public function PatchGuzzleRequest($id)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "https://jsonplaceholder.typicode.com"]);
        $options = [
            'form_params' => [
                "body"=>"new body"
               ]
           ]; 
        $response = $client->patch("/posts"."/".$id, $options);
        return $this->render('blog/patch.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function DeleteGuzzleRequest($id)
    {
        $client = new \GuzzleHttp\Client(["base_uri" => "https://jsonplaceholder.typicode.com"]);
  
        $response = $client->delete("/posts"."/".$id);
        return $this->render('blog/delete.html.twig', [
            'articles'=> $response->getBody()
        ]);
    }
}