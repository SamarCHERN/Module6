<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;


class ArticleController extends AbstractController
{

/**
 * @GET("/articles", name="liste")
 */
public function liste(ArticleRepository $articlesRepo)
{
    $articles = $articlesRepo->findAll();
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);
    $jsonContent = $serializer->serialize($articles, 'json', [
        'circular_reference_handler' => function ($object) {
            return $object->getId();
        }
    ]);

    $response = new Response($jsonContent);

    $response->headers->set('Content-Type', 'application/json');
    return $response;
}

/**
 * @GET("/article", name="derniers")
 */
public function listeById(ArticleRepository $articlesRepo)
{
    $articles = $articlesRepo->findBylast();
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];

    $serializer = new Serializer($normalizers, $encoders);

    $jsonContent = $serializer->serialize($articles, 'json', [
        'circular_reference_handler' => function ($object) {
            return $object->getId();
        }
    ]);

    $response = new Response($jsonContent);

    $response->headers->set('Content-Type', 'application/json');

    return $response;
}

/**
 * @GET("/articles/{id}", name="article")
 */
public function getArticle(Article $article)
{
    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);
    $jsonContent = $serializer->serialize($article, 'json', [
        'circular_reference_handler' => function ($object) {
            return $object->getId();
        }
    ]);
    $response = new Response($jsonContent);
    $response->headers->set('Content-Type', 'application/json');
    return $response;
}

/**
 * @POST("/article", name="ajout")
 */
public function addArticle(Request $request,ManagerRegistry $doctrine)
{
        $article = new Article();

        $donnees = json_decode($request->getContent());
        $article->setTitre($donnees->titre)
                ->setContenu($donnees->contenu)
                ->setAuteur($donnees->auteur)
                ->setDateDePublication($donnees->dateDePublication);
      


        // On sauvegarde en base
        $entityManager = $doctrine->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        // On retourne la confirmation
        return $this->json($article,201,[]);
}

/**
 * @Put("/article/{id}", name="edit")
 */
public function editArticle(Article $article, Request $request,ManagerRegistry $doctrine)
{
        $donnees = json_decode($request->getContent());
        $code = 200;
        if(!$article){
            $article = new Article();
            $code = 201;
        }
        $article->setTitre($donnees->titre)
                ->setContenu($donnees->contenu);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->json($article,201,[]);

}


/**
 * @Delete("/article/{id}", name="supprime")
 */
public function removeArticle(Article $article)
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();

    return $this->json($article,201,[]);
}

}
