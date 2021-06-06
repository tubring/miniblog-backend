<?php 

namespace App\QueryFilters;

use Clousure;
use Illuminate\Http\Request;

Abstract Class Filter
{

    public function handle(Request $request, Closure $next){
        if(!$request->has($this->filtername())){
            return $next($request);
        }

        $builder = $next($request);

        return $this->applyFilter($builder);
    }

    protected abstract function applyFilter($builder);

    protected function filterName()
    {
        $name = class_basename($this);

        return $name;



    }

}