<?php

namespace Groovey\Breadcrumb;

use Pimple\Container;

class Breadcrumb
{
    private $html;
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function add($title, $url = '', $template = '')
    {
        $app      = $this->app;
        $template = ($template) ?: 'default.html';
        $template = 'breadcrumbs/'.$template;

        $this->html .= $app['twig']->render($template, [
                                    'title' => $title,
                                    'url'   => $url,
                                ]);
    }

    public function render()
    {
        return $this->html;
    }
}
