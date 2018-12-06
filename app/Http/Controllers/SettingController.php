<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Setting;


class SettingController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        if (Auth::check()) {
          if (!Auth::user()->is('admin')) {
            flash('شما مجوز دسترسی به صفحهٔ مدیریت را ندارید');
            return Redirect::to(url('login'))->send();
          }
        }
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Setting $setting)
    {
        $setting = Setting::first();

        if (!$setting) {
          $setting = new Setting;
          $setting->shortName = 'آموزش زبان';
          $setting->fullName = 'آموزشگاه زبان ققنوس';
          $setting->save();
        }
        return view('admin.setting.index', compact('setting'));
        /**/


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
        $setting = new Setting;
        $setting->fill($request->all())->save();

        flash('تنظیمات شما با موفقیت ذخیره شد');
        return redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

/*      $this->validate($request, [
          'intro1_picture' => 'mimes:jpeg,png|max:500',
          'intro2_picture' => 'mimes:jpeg,png|max:500',
          'intro3_picture' => 'mimes:jpeg,png|max:500',
          'intro4_picture' => 'mimes:jpeg,png|max:500',
      ]);*/

      $setting = Setting::first();
      $setting->fill($request->all())->save();
/*
      if ( $request->hasFile('intro1_picture') ) {
          // The file
          $file = $request->file('intro1_picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('intro1_picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/intro/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $intro1_picture = 'intro1_picture/' . $extention . '/' . $name;
      }

      if ( $request->hasFile('intro2_picture') ) {
          // The file
          $file = $request->file('intro2_picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('intro2_picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/intro/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $intro2_picture = 'intro2_picture/' . $extention . '/' . $name;
      }

      if ( $request->hasFile('intro3_picture') ) {
          // The file
          $file = $request->file('intro3_picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('intro3_picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/intro/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $intro3_picture = 'intro3_picture/' . $extention . '/' . $name;
      }

      if ( $request->hasFile('intro4_picture') ) {
          // The file
          $file = $request->file('intro4_picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('intro4_picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/intro/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $intro4_picture = 'intro4_picture/' . $extention . '/' . $name;
      }*/

      flash('تنظیمات شما با موفقیت ذخیره شد');
      return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
