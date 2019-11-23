<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use OldSound\RabbitMqBundle\OldSoundRabbitMqBundle;

class SenderController extends Controller
{

    /**
     * @Route("/create_user", name="create_user", methods={"GET"})
     */
    public function postCreateUser(Request $request)
    {

        $message = ["Type"=>"VerificationEmail","Firstname"=>$request->get('firstname'),"Lastname"=>$request->get('lastname'),"Email"=>$request->get('email')];
        $rabbitMessage = json_encode($message);


        $this->get('old_sound_rabbit_mq.emailing_producer')->setContentType('application/json');
        $this->get('old_sound_rabbit_mq.emailing_producer')->publish($rabbitMessage);

        return new JsonResponse(array('Status' => 'OK'));

    }
}
