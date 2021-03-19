<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostDogs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'last_seen_at',
        'posted_by',
        'found_at',
        'found_by',
    ];

    /**
     * Get the user associated with who found the dog
     */
    public function whoFoundIt()
    {
        return $this->hasOne(User::class, "id", "found_by");
    }

    /**
     * Get the user associated with who posted the dog
     */
    public function whoPostedIt()
    {
        return $this->hasOne(User::class, "id", "posted_by");
    }

    /**
     * Get the photos associated with the post
     */
    public function dogGallery()
    {
        return $this->hasMany(DogsGallery::class, "lost_dog_id", "id");
    }

    public function format()
    {
        return (object) [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "last_seen_at" => $this->last_seen_at,
            "dog_gallery" => $this->dogGallery,
            "posted_by" => $this->whoPostedIt,
            "found_by" => $this->whoFoundIt,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
