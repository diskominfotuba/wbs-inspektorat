<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class PengaduanResource extends JsonResource
{
    //define properti
    public $status;
    public $message;
    // public $resource;
    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'success'   => $this->status,
        //     'message'   => $this->message,
        //     'metadata'      => $this->resource
        // ];
        return [];
    }

  public function toResponse($request): JsonResponse
    {
        Carbon::setLocale('id');

        if ($this->resource instanceof LengthAwarePaginator) {
            $items = collect($this->resource->items())->map(function ($item) {
                // Format tanggal
                if (isset($item['tanggal'])) {
                    $item['tanggal'] = Carbon::parse($item['tanggal'])->translatedFormat('l, d-m-Y');
                }

                if (isset($item['file']) && $item['file']) {
                    $item['file'] = \Illuminate\Support\Facades\Storage::disk('s3')->url($item['file']);
                }


                // Hilangkan created_at dan updated_at
                return Arr::except($item, ['created_at', 'updated_at']);
            });

            return response()->json([
                'success'   => $this->status,
                'message'   => $this->message,
                'data'      => $items,
                'pagination' => [
                    'current_page' => $this->resource->currentPage(),
                    'last_page'    => $this->resource->lastPage(),
                    'per_page'     => $this->resource->perPage(),
                    'total'        => $this->resource->total(),
                ],
            ]);
        }

        // Data non-paginated
        $data = $this->resource;

        if (isset($data['tanggal'])) {
            $data['tanggal'] = Carbon::parse($data['tanggal'])->translatedFormat('l, d-m-Y');
        }

        if (isset($item['file']) && $item['file']) {
            $item['file'] = \Illuminate\Support\Facades\Storage::disk('s3')->url($item['file']);
        }

        $data = Arr::except($data, ['created_at', 'updated_at']);

        return response()->json([
            'success' => $this->status,
            'message' => $this->message,
            'data'    => $data,
        ]);
    }

}
