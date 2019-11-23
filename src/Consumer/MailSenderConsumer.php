<?php

namespace App\Consumer;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class MailSenderConsumer implements ConsumerInterface
{
    /**
     * @var AMQPMessage $msg
     * @return void
     */
    public function execute(AMQPMessage $msg) :int
    {
        $body = $msg->body;
        //var_dump($body);

        $response = json_decode($msg->body, true);

        $type = $response["Type"];

        if ($type == "VerificationEmail") $this->sendVerificationEmail($response);

        return 1;
    }

    private function sendVerificationEmail($response) {

        // do something
    }
}