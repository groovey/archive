<?php

namespace Groovey\Paging;

use Pimple\Container;

class Paging
{
    private $app;
    private $offset;
    private $limit;
    private $currentPage;
    private $totalPage;
    private $navigation;
    private $totalRecords;

    public function __construct(Container $app, $limit, $navigation)
    {
        $this->app        = $app;
        $this->limit      = $limit;
        $this->navigation = $navigation;
    }

    public function offset()
    {
        return $this->offset;
    }

    public function limit($value = '')
    {
        if ($value) {
            return $this->limit = $value;
        }

        return $this->limit;
    }

    public function navigation($value = '')
    {
        if ($value) {
            return $this->navigation = $value;
        }

        return $this->navigation;
    }

    public function total()
    {
        return $this->totalRecords;
    }

    public function process($currentPage, $totalRecords)
    {
        $limit        = $this->limit;
        $navigation   = $this->navigation;

        $currentPage  = (int) $currentPage;
        $totalRecords = (int) $totalRecords;
        $limit        = max(intval($limit), 1);
        $navigation   = max(intval($navigation), 1);

        $totalPage    = max(ceil($totalRecords / $limit), 1);
        $currentPage  = min(max($currentPage, 1), $totalPage);
        $offset       = max(($currentPage - 1) * $limit, 0);

        $this->offset       = $offset;
        $this->limit        = $limit;
        $this->currentPage  = $currentPage;
        $this->totalPage    = $totalPage;
        $this->navigation   = $navigation;
        $this->totalRecords = $totalRecords;
    }

    public function render()
    {
        $app          = $this->app;
        $offset       = $this->offset;
        $limit        = $this->limit;
        $currentPage  = $this->currentPage;
        $totalPage    = $this->totalPage;
        $navigation   = $this->navigation;
        $totalRecords = $this->totalRecords;

        $arrow = [];
        if ($currentPage == 1) {
            $arrow['first']    = 'disabled';
            $arrow['previous'] = 'disabled';
        } else {
            $arrow['first']    = '';
            $arrow['previous'] = '';
        }

        $display = floor($navigation / 2);
        $start   = max(($currentPage - $display), 1);
        $end     = $start + ($navigation - 1);

        if ($start > ($totalPage - $navigation)) {
            $start = max($totalPage - $navigation + 1, 1);
        }

        $navigator = [];
        for ($i = $start; $i <= $end; ++$i) {
            if ($i > $totalPage) {
                break;
            }

            if ($i == $currentPage) {
                $navigator[$i] = 'active';
            } else {
                $navigator[$i] = '';
            }
        }

        if ($currentPage >= $totalPage) {
            $arrow['next'] = 'disabled';
            $arrow['last'] = 'disabled';
        } else {
            $arrow['next'] = '';
            $arrow['last'] = '';
        }

        return $app['twig']->render('paging/paging.html', [
                                    'arrow'        => $arrow,
                                    'navigator'    => $navigator,
                                    'totalRecords' => $totalRecords,
                                ]);
    }
}
