<?php
namespace App\EventListener;

class ExceptionListener
{
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function onError($event)
    {
        $e = $event->getException();

        $response = $event->getResponse()->withStatus($e->getCode());
        $event->setResponse($response);

        $response->getBody()->write($this->template->render("error/50x", [
            'title' => $e->getMessage(),
            'exception' => $e,
        ]));
    }
}
