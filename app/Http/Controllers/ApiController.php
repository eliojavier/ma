<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use \Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller {

    /**
     * @var int
     */
    protected $statusCode = IlluminateResponse::HTTP_OK;
    protected $status = 'OK';

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'No Encontradp!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NOT_FOUND)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInvalidParameters($message = 'Parametros Invalidos!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @param $object
     * @param array $data
     * @return mixed
     */
    public function respondCreated($message = 'Creado exitosamente.', $object, $data = [])
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)->respond([
            $object   => $data,
            'message' => $message
        ]);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal Error!')
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        $data = array_merge([
            'result' => $this->getStatus(),
            'code'   => $this->getStatusCode()
        ], $data);

        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param LengthAwarePaginator $items
     * @param $data
     * @return array
     */
    public function respondWithPagination(LengthAwarePaginator $items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count'       => $items->total(),
                'total_pages'       => ceil($items->total() / $items->perPage()),
                'current_page'      => $items->currentPage(),
                'limit'             => $items->perPage(),
                'prev_page_url' =>  $items->previousPageUrl(),
                'next_page_url'     => $items->nextPageUrl()
            ]
        ]);

        return $this->respond($data);
    }

    /**
     * @param $errors
     * @return mixed
     */
    public function respondWithError($errors)
    {
        return $this->setStatus('NOT GOOD')->respond([
            'errors' => $errors,
        ]);
    }

}
