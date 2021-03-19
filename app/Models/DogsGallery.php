<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogsGallery extends Model
{
    use HasFactory;

    protected $table ="dogs_gallery";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo_url',
        'lost_dog_id',
    ];

    public function format()
    {
        return (object) [
            "id" => $this->id,
            "photo_url" => $this->photo_url,
            "lost_dog_id" => $this->lost_dog_id,
            "created_at" => $this->created_at
        ];
    }
}
