<?php

namespace App\Http\Controllers;

use App\Models\appoinment;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\Caryear;
use App\Models\Price;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $result = appoinment::whereDate('created_at', Carbon::today())->get();

        if ($result->count() < 5) {

            $model = new appoinment();
            $model->name = $request->name;
            $model->number = $request->number;
            $model->date = $request->date;
            $model->time = $request->time;
            $model->brand = $request->brand;
            $model->model = $request->model;
            $model->year = $request->year;
            $model->service = $request->service;
            $model->price = $request->price;
            $model->location_id = $request->location;
            $model->save();
            $id = $model->id;

            $data = appoinment::where(['id' => $id])->with('location')->get();



            // if (Mail::to('nabeel.shahzad499@gmail.com')->send(new NotifyMail($data))) {
            if (Mail::to('waqasarif588@gmail.com')->send(new NotifyMail($data))) {
                return  Redirect()->back()->with("success", "sucess");
            } else {
                return Redirect()->back()->with("mailerror", "mailerror");
            }
        } else {
            return Redirect()->back()->with("limiterror", "limiterror");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function show(appoinment $appoinment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function edit(appoinment $appoinment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, appoinment $appoinment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\appoinment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function destroy(appoinment $appoinment)
    {
        //
    }
}
