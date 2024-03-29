<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Event;
use App\Models\Photo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     * Methods within this instance can only be accessed by users who are:
     * A) authenticated
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all events
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return null;
    }

    /**
     * Display form for component creation
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        return view('create_event');
    }

    /**
     * Display resource
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show()
    {
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | string | max:255',
            'location' => 'required | string | max:255',
            'description' => 'string | max:2042',
        ]);

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        foreach ($request->file('images') as $file) {

            $path = $file->store('images', 's3');

            Storage::disk('s3')->setVisibility($path, 'public');

            $image = Photo::create([
                'url' => $path,
                'name' => basename($path),
            ]);


            $event->photos()->attach($image);
        }

        // Save resource
        $event->save();

        return redirect()->route('home')->with('success', '');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * multiple returns
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->first();

        return view('edit_event')
            ->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required | string | max:255',
            'location' => 'required | string | max:255',
            'description' => 'string | max:2042',
        ]);

        $event = Event::where('id', $id)->first();

        $event->name = $request->name;
        $event->location = $request->location;
        $event->description = $request->description;

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $path = $file->store('images', 's3');

                Storage::disk('s3')->setVisibility($path, 'public');

                $image = Photo::create([
                    'url' => $path,
                    'name' => basename($path),
                ]);


                $event->photos()->attach($image);
            }
        }

        // Save resource
        $event->save();

        return redirect()->route('home')->with('success', '');
    }

    /**
     * Delete the selected component.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Event::where('id', $id)->first()->delete();

        return redirect()->back();
    }

    /**
     * Send data to view
     *
     * @param $request
     * @return mixed
     */
    public function getDate(Request $request) {
        $event = Event::where('date', $request->date)->first();

        $array = [];

        if(isset($event)) {
            foreach($event->photos as $key => $photo) {
                $array[] = Storage::disk('s3')->url($photo->url);
            }

            return json_encode(array(0, $event->name, $event->location, $event->description, $array, Carbon::parse($event->date)->format('M d'), route('events.edit', [$event->id])));
        } else {
            return json_encode([]);
        }
    }

    /**
     * Add Albums
     *
     * @param $component
     * @param $request
     * @return float|int|mixed
     */
    public function add_photos($event, $request) {
        return null;
    }
}
