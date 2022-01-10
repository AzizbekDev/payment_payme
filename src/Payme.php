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
     * @throws \Exception
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
     * @param $model
     * @param $amount
     * @throws \Exception
     */
    public function validateModel($model, $amount){
        if (is_null($model))
            throw new \Exception('Modal can\'t be null');
        if (is_null($amount) || $amount == 0)
            throw new \Exception('Amount can\'t be null or 0');
    }

    /**
     * @throws \Exception
     */
    public function validateDriver(){
        if (is_null($this->driverClass))
            throw new \Exception('Driver not selected');
    }
}