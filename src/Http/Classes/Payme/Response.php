<?php

namespace Payment\Payme\Http\Classes\Payme;

use Payment\Payme\Http\Classes\Payme\Request;
use Payment\Payme\Http\Classes\PaymentException;

class Response
{
    /**
     * Response constructor.
     * @param Request $request request object.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Sends response with the given result and error.
     * @param mixed $result result of the request.
     * @param mixed|null $error error.
     */
    public function send($result, $error = null)
    {
        header('Content-Type: application/json; charset=UTF-8');

        $response['jsonrpc'] = '2.0';
        $response['id']      = $this->request->id;
        $response['result']  = $result;
        $response['error']   = $error;

        echo json_encode($response);
    }

    /**
     * Generates PaymentException exception with given parameters.
     * @param int $code error code.
     * @param string|array $message error message.
     * @param string $data parameter name, that resulted to this error.
     * @throws PaymentException
     */
    public function error($code, $message = null, $data = null)
    {
        throw new PaymentException($this->request->id, $message, $code, $data);
    }
}