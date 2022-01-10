<?php

namespace Payment\Payme;
use Payment\Payme\Http\Classes\PaymeService;
use Payment\Payme\Http\Classes\PaymeException;

class Payme
{
    const PAYME = 'payme';
    protected $driverClass = null;

    /**
     * Payme constructor.
     */
    public function __construct()
    {
        // TODO: make some initializations
    }

    /**
     * Select payment driver
     * @param null $driver
     * @return $this
     */
    public function driver($driver = 'payme'){
        switch ($driver){
            case self::PAYME:
                $this->driverClass = new PaymeService;
                break;
        }
        return $this;
    }

    /**
     * @return $this
     * @throws \PaymeException
     */
    public function handle(){
        $this->validateDriver();
        try{
            return $this->driverClass->run();
        }catch(PaymeException $e){
            return $e->response();
        }

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function validateDriver(){
        if (is_null($this->driverClass))
            throw new \Exception('Driver not selected');
    }
}