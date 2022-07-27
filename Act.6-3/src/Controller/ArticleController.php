<?php

namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
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
use FOS\RestBundle\Controller\Annotations\Delete;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;



/**
 * @Rest\Route("api/article")
 */

class ArticleController extends AbstractController
{

/**
 * @Rest\Get("/lire")
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
 * @Rest\Get("/")
 */

public function listeById(ArticleRepository $articlesRepo)
{
    $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
    
    $articles = $articlesRepo->findBylast();
    // $encoders = [new JsonEncoder()];
    // $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer(array(new GetSetMethodNormalizer($classMetadataFactory)),array('json' => new JsonEncoder()));
    $jsonContent = $serializer->serialize($articles, 'json', [
        'circular_reference_handler' => function ($object) {
            return $object->getId();
        }
    ]);
    $response = new Response($jsonContent);
    $response->headers->set('Content-Type', 'application/json');
    $response=$this->json($articles,200,[],['groups'=>'articles']);
    return $response;
}

/**
 * @Rest\Get("/{id}")
 */
public function getArticle(Article $article)
{
    $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
    // $encoders = [new JsonEncoder()];
    // $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer(array(new GetSetMethodNormalizer($classMetadataFactory)),array('json' => new JsonEncoder()));
    $jsonContent = $serializer->serialize($article, 'json', [
        'circular_reference_handler' => function ($object) {
            return $object->getId();
        }
    ]);
    $response = new Response($jsonContent);
    $response->headers->set('Content-Type', 'application/json',['groups' => 'articles']);
    $response=$this->json($article,200,[],['groups'=>'articles']);
    return $response;
}

/**
 * @Post("/", name="ajout")
 */
public function addArticle(Request $request,ManagerRegistry $doctrine)
{
    $article = new Article();
    $donnees = json_decode($request->getContent());
    $article->setTitre($donnees->titre)
            ->setContenu($donnees->contenu)
            ->setAuteur($donnees->auteur)
            ->setDateDePublication($donnees->dateDePublication);
    $entityManager = $doctrine->getManager();
    $entityManager->persist($article);
    $entityManager->flush();
    return $this->json($article,201,[],['groups'=>'articles']);
}

/**
 * @Put("/{id}", name="edit")
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
        return $this->json($article,201,[],['groups'=>'articles']);

}


/**
 * @Delete("/{id}", name="supprime")
 */
public function removeArticle(Article $article)
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();

    return $this->json($article,201,[]);
}

}
