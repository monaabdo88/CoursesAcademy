<?php

namespace App\Http\Requests;

use App\Series;
use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
    public function UploadImg(){
        //upload image
        $uploaded_img = $this->image;
        $this->fileName =  str_slug($this->title).'.'.$uploaded_img->getClientOriginalExtension();
        $uploaded_img->storePubliclyAs('series',$this->fileName);
        return $this;
    }
    public function store_series(){
        //create new series
        Series::create([
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => 'series/'.$this->fileName,
            'slug' => str_slug($this->title)
        ]);
    }
}
