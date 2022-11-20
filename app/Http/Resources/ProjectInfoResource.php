<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Engineer;
use App\Http\Resources\EngineerResource;

class ProjectInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'amount' => number_format($this->amount),
            'details' => $this->details,
            'contractor' => $this->contractor,
            'project_inspector_id' => new EngineerResource(Engineer::find($this->project_inspector_id)),
            'project_engineer_id' => new EngineerResource(Engineer::find($this->project_engineer_id)),
            'start_date' => $this->start_date,
            'original_completion_date' => $this->original_completion_date,
            'revised_completion_date' => $this->revised_completion_date,
            'photos' => InfraPhotoResource::collection($this->images),
        ];
    }
}
