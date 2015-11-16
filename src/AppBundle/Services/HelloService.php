<?php

namespace AppBundle\Services;


class HelloService
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * HelloService constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $name
     * @return string
     */
    public function hello($name)
    {
        $message = \Swift_Message::newInstance()
            ->setTo('i02maarj@uco.es')
            ->setSubject('Hello Service')
            ->setBody($name . ' says hi!');

        $this->mailer->send($message);

        return 'Hello, '.$name;
    }
}