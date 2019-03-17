<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\File;
use Khsing\World\World;

class UserProfile extends Model implements HasMedia
{
    use HasMediaTrait;


    // Explicit table definition for the model
    protected $table = 'usersprofiles';
    // Explicit primary key definition for the model
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'langcode', 'bio', 'addrss', 'phone', 'zipcode', 'balance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo(City::class,'city','id');
    }

    /* Only jpg or png files are allowed */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('avatars')
            ->singleFile()
            ->acceptsFile(function (File $file) {

                // Checking if the file already exist in the database
                $exists = DB::table('media')
                    ->where('file_name', '=' ,$file->name)
                    ->where('mime_type', '=' ,$file->mimeType)
                    ->where('disk', '=' ,'avatars')
                    ->where('size', '=' ,$file->size)
                    ->exists();

                if ($exists)
                    return false;
                if (!($file->mimeType === 'image/jpeg') or !($file->mimeType !== 'image/png'))
                    return false;
                else
                    return true;
            });
    }
}


