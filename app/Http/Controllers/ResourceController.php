<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Category;
use App\Student;


use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ResourceRepository;

use Carbon\Carbon;

class ResourceController extends Controller
{
    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $resources = Resource::all();
        $categories = Category::pluck('name', 'id');
        $filter = $request->filter;

        return view('resources.index', compact('resources', 'categories', 'filter'));
    }
    
    public function autocompleteResource(Request $request)
    {
      $data = Resource::select("resources.name as resources_name", "inventory_tag", "serial_number", "categories.name", "categories.icon")
      ->join('categories', 'resources.category_id', '=', 'categories.id')
      ->where("is_available","=",1)
      ->where("resources.name","LIKE","%{$request->input('query')}%")
      ->orWhere("inventory_tag","LIKE","%{$request->input('query')}%")
      ->orWhere("categories.name","LIKE","%{$request->input('query')}%")
      ->get();

      foreach ($data as $query)
      {
        $results[] = [ 'data' => $query->inventory_tag, 'value' => $query->resources_name .' ('.$query->inventory_tag . ')' ];
      }

      $results_format[] = [ "query" => "Unit", 'suggestions' => $results ];

      return response()->json($results_format[0]);
    }




    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'category_id' => 'integer',
            'inventory_tag' => 'required|max:255',
            'serial_number' => 'max:255',
        ]);
        
        Resource::create(array(
            'name' => $request->name,
            'category_id' => $request->category_id,
            'inventory_tag' => $request->inventory_tag,
            'serial_number' => $request->serial_number,
        ));

        return redirect('/resources');
    }

    public function destroy(Resource $resources)
    {
        $this->authorize('destroy', $resources);
        $resources->delete();

        return redirect('/resources');
    }

    public function edit($id)
    {
      $resource = Resource::findOrFail($id);
      $categories = Category::all()->sortBy('name')->lists('name', 'id');

      return view('resources.edit', compact('resource', 'categories'));
    }

    public function update($id, ResourceRequest $request)
    {
      $resource = Resource::findOrFail($id);
      $resource->update($request->all());
      
      return redirect('resources');
    }

    public function show($id)
    { 
        $resource = Resource::findOrFail($id);
    
        $history = $resource->transactions()->with('student')->get();

        return view('resources.show', compact('resource', 'history') );
    }

    public function import(Request $request)
    {
      $csvFilePath = $request->file('csv')->getRealPath();

      if (($handle = fopen($csvFilePath,'r')) !== FALSE)
      {
        while (($data = fgetcsv($handle, 1000, ',')) !==FALSE)
        {
          $resource = new Resource();
          $resource->name = $data[0];

          $category = Category::where('name', (string)$data[1])->firstOrFail();

          $resource->category_id = $category->id;

          $resource->inventory_tag = $data[2];
          $resource->serial_number = $data[3] ?: null;
          $resource->save();
        }
        fclose($handle);
      }

      return redirect('/resources');
    }
}
