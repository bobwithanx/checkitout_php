<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Resource;
use App\Category;
use App\Repositories\ResourceRepository;

class ResourceController extends Controller
{
    /**
     * The inventory repository instance.
     *
     * @var StudentRepository
     */
    protected $resources;

    /**
     * Create a new controller instance.
     *
     * @param  StudentRepository  $tasks
     * @return void
     */
    public function __construct(ResourceRepository $resources)
    {
        $this->middleware('auth');

        $this->resources = $resources;
    }

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

        return view('resources.index', compact('resources', 'categories'));
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

      public function destroy(Request $request, Resource $resource)
      {
          $this->authorize('destroy', $resource);
          $resource->delete();

          return redirect('/resources');
      }

      public function show($id)
      { 
          $resource = Resource::findOrFail($id);
      
          return view('resources.show')->with('resource', $resource);
      }
}
