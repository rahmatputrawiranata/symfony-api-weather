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
        foreach($data as $k){
            $zip = $k['Postal Code'];
            $name = $k['Place Name'];

            $dat[] =  $zip . ' - ' . $name ;
        }
        return new jsonResponse(
            $dat,
            Response::HTTP_OK
        );
    }

    /**
     * @Route("/api/weather", name="weather")
     * @Method("POST")
     */
    public function weatherMap(Request $request)
    {

        $api_key = '0c0a594e554a11447c34e2533ae5c803';
        $city = $request->request->get('where');
        $city = explode(" - ", $city);
        $cityF = $city[1];
        $jPath = file_get_contents(__DIR__.'\dummy\au_city.json');
        $json = json_decode($jPath, true);
        foreach($json as $k){
            if($k['Place Name'] == $cityF){
                    $lat = $k['Latitude'];
                    $lon = $k['Longitude'];
                
                    $api_key = '0c0a594e554a11447c34e2533ae5c803';
                    $weather_map = 'http://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon.'&appid='.$api_key;
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, $weather_map);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    $output=curl_exec($ch);
                    curl_close($ch);

                    $data = json_decode($output);
                    return new jsonResponse(
                        $data,
                        Response::HTTP_OK
                    );
            }
        }
    }
}
