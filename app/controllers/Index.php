<?php

namespace Controller;

class Index extends AbstractController
{

    public function indexAction()
    {
        $this->view['hello'] = 'world';
    }

}