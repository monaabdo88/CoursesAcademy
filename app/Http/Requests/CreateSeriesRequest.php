<?php

namespace App\Http\Requests;

use App\Series;

class CreateSeriesRequest extends SeriesRequest
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
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ];
    }
    public function store_series(){
        //create new series
        $series = Series::create([
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => 'series/'.$this->fileName,
            'slug' => str_slug($this->title)
        ]);
        session()->flash('success','Series Created Successfully');
        return redirect()->route('series.show',$series->slug);
    }
}
