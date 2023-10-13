<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Http\Requests\GroupRequest;
use App\Models\Center;
use App\Models\Course;
use App\Models\Day;
use Illuminate\Support\Carbon;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::with('place.center:id,name', 'instructor:id,name,first_name,last_name,key,curp', 'course:id,name', 'days')->get();

    #  retun $groups;
        return view('admin.groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $courses = Course::with('instructors')->get();
        $center_data = Center::with('places')->get();
        $students = Student::all();
        $days = Day::all();

        return view('admin.groups.create', compact('courses', 'center_data', 'students', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
     
        $center = Center::select('short_name')->where('id', $request->center_id)->first();

    
            
            // no hay cambio de año
            $current_year = Carbon::now();
            $last_group = Group::latest()->where('center_id', $request->center_id)->first();
            $year_id = -1;


            if($last_group && ($last_group->created_at->diffInYears($current_year) == 0)){
                $year_id = (int)substr($last_group->key, -3);
            }

            $request['key'] = date("y") .'-'. $center->short_name . '-'. str_pad($year_id+1, 3, '0', STR_PAD_LEFT);
            $group = Group::create($request->all());
            $group->save();
            $group->students()->syncWithoutDetaching($request->students);
            $group->days()->syncWithoutDetaching($request->days);
            if($group){
                return redirect()->action([GroupController::class, 'index']);
                // return response()->json(['grupo' => $group]); // respuests de test
            }

        return redirect()->back()->with('error', 'No se pudo crear el grupo');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        $group->load('students:id,no_control,name,first_name,last_name,curp');
        $group->load('instructor:id,key,name,first_name,last_name,curp');
        $group->load('course.training_field', 'course.themes');
        $group->load('place.center', 'place.address.city');
        $group->load('days');

        // return $group;

        // return response()->json($group);
        return view('admin.groups.detail', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);
        $group->load('students:id,no_control,name,first_name,last_name',
        'instructor:id,key,name,first_name,last_name',
        'course',
        'place.center','days');

        $courses = Course::with('instructors')->get();
        $center_id = $group->place->center->id;
        $center = Center::where('id', $center_id)->with('instructors', 'places')->get();
        $students = Student::all();
        $days = Day::all();
        return view('admin.groups.edit', compact('group', 'center', 'courses', 'students', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request)
    {
        $group = Group::find($request->group_id);        
        if($group){
            $group->students()->sync($request->students);
            $group->days()->sync($request->days);
            $group->update($request->except('center_id'));
      //       $group->load('students');
       //      return response()->json($group);
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'no se pudo actualizar el grupo');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        if($group){
            $group->delete();
            return redirect()->back()->with('success', 'ok');
        }
        return redirect()->back()->with('error', 'no se pudo borrar el grupo');
    }
}
