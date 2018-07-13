<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartsController extends Controller
{

    public function footerContactAction(){

        $contactRepository = $this->getDoctrine()->getRepository('AppBundle:Contact');
        $contactsQuery = $contactRepository->createQueryBuilder('c')
            ->where('cg.id != :socialId')
            ->join('AppBundle:ContactGroup', 'cg', 'WITH', 'c.contactGroup = cg')
            ->orderBy('c.contactOrder', 'ASC')
            ->orderBy('cg.contactGroupOrder', 'ASC')
            ->setParameter('socialId', 2)
            ->getQuery()
        ;

        $contacts = $contactsQuery->getResult();

        return $this->render('parts/contact_footer.html.twig', array(
            'contacts' => $contacts
        ));

    }

    public function headerContactAction(){

        $contactRepository = $this->getDoctrine()->getRepository('AppBundle:Contact');
        $contactsQuery = $contactRepository->createQueryBuilder('c')
            ->where('cg.id = :socialId')
            ->join('AppBundle:ContactGroup', 'cg', 'WITH', 'c.contactGroup = cg')
            ->orderBy('c.contactOrder', 'ASC')
            ->orderBy('cg.contactGroupOrder', 'ASC')
            ->setParameter('socialId', 2)
            ->getQuery()
        ;

        $contacts = $contactsQuery->getResult();

        return $this->render('parts/contact_header.html.twig', array(
            'contacts' => $contacts
        ));

    }

    public function footerAboutAction(){

        $pageRepository = $this->getDoctrine()->getRepository('AppBundle:Page');
        $page = $pageRepository->findOneById(2);

        return $this->render('parts/footer_about.html.twig', array(
            'page' => $page
        ));

    }

}