<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\PropertyRoomType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{

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
        return $this->render('pages/index.html.twig');
    }

}