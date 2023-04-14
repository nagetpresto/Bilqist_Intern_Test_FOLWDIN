<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractsResource extends JsonResource
{
    public $status;
    public $msg;
    
    public function __construct($status, $msg, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->msg = $msg;
    }

    public function toArray($request)
    {
        return [
            'success' => $this->status,
            'messages' => $this->msg,
            'data' => $this->resource->map(function ($contract) {
                return [
                    'id' => $contract->id,
                    'employee_id' => $contract->employee_id,
                    'employee' => $contract->employee, // already loaded by eager loading
                    'positions_id' => $contract->positions_id,
                    'position' => $contract->position, // already loaded by eager loading
                    'status' => $contract->status,
                ];
            }),
        ];
    }

}


