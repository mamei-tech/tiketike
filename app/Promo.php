<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\File;
use Illuminate\Support\Facades\DB;

class Promo extends Model implements HasMedia
{
    use HasMediaTrait;

    // Explicit table definition for the model
    protected $table = 'promos';
    // Explicit primary key definition for the model
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'type', 'active', 'status', 'expdate', 'client', 'alternative', 'website'
    ];

    public function getClient(){
        return $this->belongsTo('App\PromoClient', 'client');
    }

    /* Only jpg or png files are allowed */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('promos')
            ->singleFile()
            ->acceptsFile(function (File $file) {

                // Checking if the file already exist in the database
                $exists = DB::table('media')
                    ->where('file_name', '=' ,$file->name)
                    ->where('mime_type', '=' ,$file->mimeType)
                    ->where('disk', '=' ,'promos')
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

    public function canUpdateName($inputName) {

        $promo = Promo::where('name', $inputName)->first();

        if(!$promo)
            return true;
        else if ($promo && $promo->name == $this->name)
            return true;
        else {
            return false;
        }
    }
}
