<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;
/**
 * Class Media
 * @package App
 */
class Media extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['path','name','thumbnail_path','display_name','caption'];

    /**
     * @var string
     */
    public $baseDir = 'uploads/posts';

    /**
     * Has many associated posts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(){
        return $this->hasMany(Post::class);
    }

    /**
     * @param $name
     * @return mixed
     */
    public static function named($name)
    {
        return  (new static)->saveAs($name);
    }

    /**
     * @param $name
     * @return $this
     */
    public function saveAs($name)
    {
        $this->name = sprintf('%s-%s',time(),$name);
        $this->path = sprintf('%s/%s',$this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('%s/tn-%s',$this->baseDir, $this->name);
        $this->save();
        return $this;
    }

    /**
     * @param UploadedFile $file
     * @return $this
     */
    public function store(UploadedFile $file)
    {
//        $file->move($this->baseDir,$this->name);
        Image::make($file->getRealPath())
            ->fit(1000,500)
            ->save($this->path);

        $this->makeThumbnail();
        return $this;
    }

    /**
     *
     */
    public function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(600,400)
            ->save($this->thumbnail_path);

    }

    /**
     * @throws \Exception
     */
    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);
        parent::delete();
    }

}
