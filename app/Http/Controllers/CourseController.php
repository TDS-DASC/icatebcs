<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Themes;
use App\Models\TrainingField;
use Illuminate\Support\Carbon;


class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // validar que pueda entrar a /cursos
        $instructors = Instructor::all();
        $training_fields = TrainingField::all();
        $courses = Course::with('training_field', 'instructors')->get();
        /**
         * Agregar temas para que no se tengan que repetir
         */
        //$themes = Themes::all();
        
        //$course = Course::find(1);
        //$course->instructors()->sync([1]);

        $course = Course::with('training_field', 'instructors.courses')->get()->find(1);

        return view('admin.courses.index', compact('courses','instructors', 'training_fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // validar que pueda crear un curso nuevo
        $training_fields = TrainingField::all();
        $instructors = Instructor::all();
        
        return view('admin.courses.create', compact('training_fields', 'instructors'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //return $request;
        // validar que pueda guardar un curso nuevo
        $request['key'] = CourseController::getCourseKey($request);
        $course = Course::create($request->all());
        if($course){
            if(isset($request->themes)){
                $themes = $request->themes[0];
                $themes = explode(',', $themes);
                foreach ($themes as $theme) {
                    $themeCreate = new Themes();
                    $themeCreate->name = $theme;
                    $themeCreate->course_id = $course->id;
                    $themeCreate->save();
                }
            }
            $course->instructors()->sync($request->instructors);
            
            return redirect()->route('course.index')->with('success', 'se creo exitosamente el curso');
        }

        return redirect()->back()->with('error', 'no se pudo crear el curso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with('training_field', 'instructors:id,name,first_name,last_name,key,curp', 'themes', 'groups.place.center:id,name')->get()->find($id);
        //autenticar al usuario
        $training_fields = TrainingField::all();
        $instructors = Instructor::all();
        if ($course){
            # return $course;
            return view('admin.courses.detail', compact('course','instructors', 'training_fields'));
        }
        return redirect()->back()->with('error', 'no tienes acceso');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // validar si puede editar
        $course = Course::with('themes', 'instructors', 'training_field')->get()->find($id);
        $instructors = Instructor::all();
        $training_fields = TrainingField::all();
        //return $course;
        
        return view('admin.courses.edit', compact('course', 'instructors', 'training_field'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request)
    {
        // validar el que pueda editar
        $course = Course::find($request->id);
        if($course){
            $course->update($request->all());
            // error_log(json_encode($request->all()));
            $course->instructors()->sync($request->instructors);
            return redirect()->back()->with('success', 'se actualizo el curso');
        }
        return redirect()->back()->with('error', 'no se pudo actualizar el curso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // validar si puede editar/borrar
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'se eliminó el registro');
        }
        return redirect()->back()->with('error', 'no se pudo eliminar el registro');
    }

    public static function getCourseKey($request){
        // determiar las siglas de la clave por el tipo de curso 
        $siglas_tipo = [
            'Regular' =>
                ['siglas' => 'REG', 'id_digits' => 3, 'appends' => []],        
            'Extensión' => 
                ['siglas' => 'EXT', 'id_digits' => 3, 'appends' => []],
            'CAE' =>
                ['siglas' => 'CAE', 'id_digits' => 3, 'appends' => []],
            'EBC' => 
                ['siglas' => 'EBC', 'id_digits' => 2, 'appends' => ['C']],
            'Integral' =>
                ['siglas' => 'INT', 'id_digits' => 2, 'appends' => []],
            'CAD' => 
                ['siglas' => 'CAD', 'id_digits' => 3, 'appends' => []]
        
        ];

        $type = collect($siglas_tipo[$request->type_course]); // datos que varian dependiendo del tipo de curso


        $last_course_same_type = Course::latest()->where('type_course', $request->type_course)->first();        
        error_log(json_encode($last_course_same_type));
        // ID incremental por tipo
        $type_id = -1;
        $current_year = Carbon::now();
        if($last_course_same_type && ($last_course_same_type->created_at->diffInYears($current_year) == 0)){
            $digit_amount = $type->get('id_digits', 3) * -1;
            error_log($digit_amount);
            $type_id = (int)substr($last_course_same_type->key, $digit_amount);
        }

        $appends = collect($type->get('appends'));

        $training_field = TrainingField::find($request->training_field_id);

        //25-AD-2005C   => [25, AD, 2005C]
        $array_key = collect(explode('-', $training_field->key));
        $key =
            $array_key->get(0, '').'-'// El Primer número 25 de la (((clave))) corresponde al Campo de Formación Profesional (CFP) de la DGCFT.
            
            .$array_key->get(1, '').'-'
            
            .'IC' //Las letras IC es una referencia a ICATEBCS ya que los cursos son del instituto  
            
            .substr($array_key->get(2, date('Y')), 2, 2).$appends->get(0, '').'-' // año de diseño del curso? 
            
            .$type->get('siglas', '').'-' //Las letras INT corresponden al tipo de curso en este caso es INTEGRAL.
            
            .str_pad($type_id+1, $type->get('id_digits', ''), '0', STR_PAD_LEFT); //1 es el consecutivo según la secuencia y numeración ordenada que se le da a los cursos por tipo.
      

      return $key;
    }
}
