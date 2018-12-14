<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /**
     * @Route("/api/location", name="locationList")
     */
    public function locationList(Request $request)
    {   
        $request->isXmlHttpRequest();
        $request->query->get('page');
        return $this->json(array('username' => 'jane.doe'));

    }
}
