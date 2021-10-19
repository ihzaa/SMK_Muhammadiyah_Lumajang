<?php

namespace App\Traits;

trait CanGenerateUrlFromColumn
{
    private function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

        return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
    }


    /**
     * Generate URL with severals parameters
     *
     * @param string $route_name Name of the route
     * @param array $column Parameters of the route, the key is route param name and the value is the column name
     *
     * @throws None
     * @author Ihza
     * @return string full url
     */
    public function generateUrl($route_name, array $column)
    {
        $model = $this;
        foreach ($column as $k => $v) {
            $column[$k] = $this->clean($model->$v);
        }
        return route($route_name, $column);
    }
}
