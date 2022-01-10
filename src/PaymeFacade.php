<?php

namespace Payment\Payme;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Payment\Payme\Skeleton\SkeletonClass
 */
class PayUzFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'payme';
    }
}