<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionsResource extends JsonResource
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
            'data' => $this->resource,
        ];
    }
}
