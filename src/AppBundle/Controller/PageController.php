<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AdminPagesToAccess;
use Symfony\Component\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{

    private $router;
    public function __construct(Router $router)
    {
        $this->router = $router;
    }


    /**
     * @Route("/{_locale}", name="homepage",
     * requirements={
     *      "_locale": "es|en|de|ru"
     *  },
     *  defaults={
     *      "_locale": "en"
     *  }
     * )
     */
    public function indexAction(Request $request, $_locale = "en")
    {
        $arrayOfRouts = $this->router->getRouteCollection()->getIterator()->getArrayCopy();
        $adminRouteCategories = [];

        $routeName = "";
        $routePath = "";
        foreach ($arrayOfRouts as $key => $val){
            $explodedKey = explode('_',$key);

            if($explodedKey[0] == 'admin' and $explodedKey[1] == 'app'){
                $mainPath = $val->getPath();
                $path = explode('/',$mainPath);

                if($path[1] == 'admin' and $path[2] == 'app'){
                    $routeName = $path[3]."_".$path[count($path)-1];
                    $routePath = "^".$mainPath;

                    if(array_key_exists(strtoupper($path[3]),$adminRouteCategories )){
                        array_push( $adminRouteCategories[strtoupper($path[3])] ,[strtoupper($routeName),$routePath]);
                    }else{
                        $adminRouteCategories[strtoupper($path[3])] = [];
                        array_push( $adminRouteCategories[strtoupper($path[3])] ,[strtoupper($routeName),$routePath]);
                    }
                }
            }
        }

        dump($adminRouteCategories);
        $em = $this->getDoctrine()->getManager();
        foreach ($adminRouteCategories as $arc){
            foreach ($arc as $a){
                $adminPageToAccess = new AdminPagesToAccess();
                $adminPageToAccess->setPageName($a[0]);
                $adminPageToAccess->setPagePath($a[1]);
                $em->persist($adminPageToAccess);
                $em->flush();
            }
        }

        die;
        return $this->render('pages/index.html.twig');
    }

}