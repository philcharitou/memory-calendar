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
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        foreach ($request->file('images') as $imagefile) {
            $image = new Photo();
            $path = $imagefile->store('images', 's3');
            $image->url = $path;
            $image->location = $request->location;
            $image->save();
        }

        // Update relationship with contacts and components
        $this->add_albums($event, $request);

        // Save resource
        $event->save();

        return redirect()->back();
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
        $event = Event::create([
            'item_code' => $request->item_code,
            'name' => $request->name,
            'product_category' => $request->product_category,
            'parent_category' => $request->parent_category,
        ]);

        // Update relationship with contacts and components
        $this->add_albums($event, $request);

        // Save resource
        $event->save();


        $event = Event::where('id', $id)->first();

        /** Update Component */
        // Identification Field(s)
        $event->item_code = $request->item_code;
        $event->name = $request->name;
        $event->product_category = $request->product_category;
        $event->parent_category = $request->parent_category;

        // Update relationship with contacts and components
        $this->add_albums($event, $request);

        // Save resource
        $event->save();

        return redirect()->back();
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

        foreach($event->photos as $photo) {
            $array[] = $photo->url;
        }

        return json_encode(array(0, $event->name, $event->location, $event->description, $array));
    }

    /**
     * Add Albums
     *
     * @param $component
     * @param $request
     * @return float|int|mixed
     */
    public function add_albums($event, $request) {
        $event->albums()->detach();

        // Update vendor relationships
        for ($i = 0; $i < $request->contact_count; $i++) {
            if ($request->has('vendor' . $i) && $request->{'vendor' . $i} != "") {

                $vendor = Album::where('company', $request->{'vendor' . $i})->first();

                $event->albums()->attach($vendor->id, [
                    'vendor' => $request->{"vendor" . $i},
                    'currency' => $request->{"vendor_currency" . $i},
                    'price' => $request->{"vendor_price" . $i},
                    'quantity' => $request->{"vendor_quantity" . $i},
                    'unit' => $request->{"vendor_unit" . $i},
                    'order' => $i
                ]);
            }
        }
    }
}
