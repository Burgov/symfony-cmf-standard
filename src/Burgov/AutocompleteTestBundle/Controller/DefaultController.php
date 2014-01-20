<?php

namespace Burgov\AutocompleteTestBundle\Controller;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $formBuilder = $this->get('form.factory')->createBuilder()
            ->add('path', 'autocomplete', array(
                'class' => 'Symfony\Cmf\Bundle\SimpleCmsBundle\Model\Page',
                'template' => 'BurgovAutocompleteTestBundle:Default:page_select2.html.twig',
                'search_fields' => array('s.id'),
                'query_builder' => function(ObjectRepository $or) {
                    return $or->createQueryBuilder('s');
                }
            ))
        ;

        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        return $this->render('BurgovAutocompleteTestBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
