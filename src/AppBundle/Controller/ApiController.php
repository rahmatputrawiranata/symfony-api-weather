<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApiController extends Controller
{
    /**
     * @Route("/api/location", name="locationList")
     * @Method("GET")
     */
    public function locationList(Request $request)
    {   

        $jPath = file_get_contents(__DIR__.'\dummy\au_city.json');
        $data = json_decode($jPath, true);
        return new jsonResponse(
            [
                'msg'=>'data',
                'data'=> $data
            ],
            Response::HTTP_OK
        );
    }
}
