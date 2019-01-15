<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
{
    public function UploadImg(){
        //upload image
        $uploaded_img = $this->image;
        $this->fileName =  str_slug($this->title).'.'.$uploaded_img->getClientOriginalExtension();
        $uploaded_img->storePubliclyAs('public/series',$this->fileName);
        return $this;
    }
}
