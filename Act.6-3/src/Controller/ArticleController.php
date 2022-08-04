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
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\Annotations\Delete;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use JMS\Serializer\SerializationContext;




class ArticleController extends AbstractController
{

/**
   * @Rest\Get("api/articles")
    * @Rest\View(serializerGroups={"articles"})
 */
public function liste(ArticleRepository $articlesRepo)
{
   return $articlesRepo->findAll();
;
}


/**
   * @Rest\Get("api/article")
    * @Rest\View(serializerGroups={"articles"})
 */

public function listeById(ArticleRepository $articlesRepo)
{   
    return $articlesRepo->findBylast();
}

/**
    * @Rest\Get("api/article/{id}")
    * @Rest\View(serializerGroups={"articles"})
 */
public function getArticle(Article $article,ArticleRepository $articlesRepo)
{
    return  $articlesRepo->find($article);
 
}

/**
 * @Rest\Post("api/article/", name="ajout")
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
 * @Rest\Put("api/article/{id}", name="edit")
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
                ->setContenu($donnees->contenu)
                ->setAuteur($donnees->auteur)
                ->setDateDePublication($donnees->dateDePublication);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->json($article,201,[]);

}


/**
 * @Rest\Delete("api/article/{id}", name="supprime")
 */
public function removeArticle(Article $article)
{
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($article);
    $entityManager->flush();

    return $this->json($article,201,[]);
}

}
