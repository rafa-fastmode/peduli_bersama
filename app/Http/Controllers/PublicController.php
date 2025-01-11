<?php

namespace App\Http\Controllers;

use App\Models\Kampayes;
use Illuminate\Http\Request;
use App\Models\Gambars;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch images and campaigns
        $Gambars = Gambars::all();
        $Kdata = Kampayes::all();
        
        // Provide placeholder images if no images are available or less than 6
        $defaultImages = [
            (object)['image_path' => 'image/placeholder.jpg'],
            (object)['image_path' => 'image/placeholder.jpg'],
            (object)['image_path' => 'image/placeholder.jpg'],
            (object)['image_path' => 'image/placeholder.jpg'],
            (object)['image_path' => 'image/placeholder.jpg'],
            (object)['image_path' => 'image/placeholder.jpg'],
        ];
    
        if ($Gambars->count() < 6) {
            // Add placeholder images to make up the difference
            $remainingImages = 6 - $Gambars->count();
            $Gambars = $Gambars->concat(array_slice($defaultImages, 0, $remainingImages));
        }
    
        // Ensure Kdata has exactly 6 campaigns
        $dummyCampaigns = [
            (object)[
                'id' => 1,
                'title' => 'Dummy Campaign 1',
                'deskripsi' => 'This is a dummy description for campaign 1.',
                'target_dana' => 1000000,
                'end_date' => now()->addDays(10),
            ],
            (object)[
                'id' => 2,
                'title' => 'Dummy Campaign 2',
                'deskripsi' => 'This is a dummy description for campaign 2.',
                'target_dana' => 2000000,
                'end_date' => now()->addDays(15),
            ],
            (object)[
                'id' => 3,
                'title' => 'Dummy Campaign 3',
                'deskripsi' => 'This is a dummy description for campaign 3.',
                'target_dana' => 3000000,
                'end_date' => now()->addDays(20),
            ],
            (object)[
                'id' => 4,
                'title' => 'Dummy Campaign 4',
                'deskripsi' => 'This is a dummy description for campaign 4.',
                'target_dana' => 4000000,
                'end_date' => now()->addDays(25),
            ],
            (object)[
                'id' => 5,
                'title' => 'Dummy Campaign 5',
                'deskripsi' => 'This is a dummy description for campaign 5.',
                'target_dana' => 5000000,
                'end_date' => now()->addDays(30),
            ],
            (object)[
                'id' => 6,
                'title' => 'Dummy Campaign 6',
                'deskripsi' => 'This is a dummy description for campaign 6.',
                'target_dana' => 6000000,
                'end_date' => now()->addDays(35),
            ],
        ];
    
        if ($Kdata->count() < 6) {
            // Add dummy campaigns to make up the difference
            $remainingCampaigns = 6 - $Kdata->count();
            $Kdata = $Kdata->concat(array_slice($dummyCampaigns, 0, $remainingCampaigns));
        }
    
        return view('public.home', compact('Gambars', 'Kdata'));
    }


    public function donasi()
    {

        $galleryItems = Kampayes::all();
    
        return view('public.donasi', compact('galleryItems'));
    }

    public function detail(string $id)
    {
        $Kdata = Kampayes::find($id);
        $Gambars = Gambars::where('id_kampanye', $id)->get();
        return view('public.detail', compact('Kdata', 'Gambars'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $Kdata = Kampayes::where('title', 'like', "%".$search."%")
                ->orWhere('deskripsi', 'like', "%".$search."%")
                ->get();
        } else {
            $Kdata = Kampayes::all();
        }
    
        return view('public.search', compact('Kdata', 'search'));
    }  



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}