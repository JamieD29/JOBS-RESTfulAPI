<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::where("type", 'Full-Time')->get();
        // dd($jobs);
        return response()->json(Job::all());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'salary' => 'required|string',
            'company.name' => 'required|string',
            'company.description' => 'required|string',
            'company.contactEmail' => 'required|email',
            'company.contactPhone' => 'required|string',
        ]);

        $job = Job::create($validated);

        return response()->json($job, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }
        return response()->json($job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $job = Job::find($id);
        //$request_data = $request->getContent();
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|string',
            'type' => 'sometimes|string',
            'description' => 'sometimes|string',
            'location' => 'sometimes|string',
            'salary' => 'sometimes|string',
            'company.name' => 'sometimes|string',
            'company.description' => 'sometimes|string',
            'company.contactEmail' => 'sometimes|email',
            'company.contactPhone' => 'sometimes|string',
        ]);

        $job->title = $request['title'];
        $job->type = '12312312';
        $job->update();
        $jobUpdate = Job::find($request['_id'])->update(['title' => $request['title']]);
        // $jobUpdate->title = $request['title'];
        // dd($jobUpdate);
        // $jobUpdate->save();
        //    $res =  $jobUpdate->save(['title' => '12312312312']);
        // $res = $jobUpdate->update(['title' => $request['title']]);
        return response()->json(data: $jobUpdate);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $validateData = $request->validate([
            'title' => 'sometimes|string',
            'type' => 'sometimes|string',
            'description' => 'sometimes|string',
            'location' => 'sometimes|string',
            'salary' => 'sometimes|string',
            'company.name' => 'sometimes|string',
            'company.description' => 'sometimes|string',
            'company.contactEmail' => 'sometimes|email',
            'company.contactPhone' => 'sometimes|string',
        ]);

        $job->update($validateData);


        // 
        return response()->json($job->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::find($id);
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        $job->delete();
        return response()->json(['message' => 'Job deleted successfully']);
    }
}
