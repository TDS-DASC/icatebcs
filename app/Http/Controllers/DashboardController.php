<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\TrainingField;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

   // function () {return view('admin.home');}
    public function index(){
        $widgets = $this->getWidgets();

       $trainig_field_graph_data = TrainingField::with('courses')
      ->get();

      foreach($trainig_field_graph_data as $mc){
        $mc['course_amount']  =  $mc->courses->count();
       
      }

    //    $mo = $more_courses->courses;
  //     $courses_by_training_field = TrainingField::orderBy()

  //return $more_courses->courses;
    $trainig_field_graph_data = $trainig_field_graph_data->sortByDesc('course_amount')->take(10);


   // return $trainig_field_graph_data;
        return view('admin.home', compact('widgets', 'trainig_field_graph_data'));
        
    }

    public function getWidgets(){
        $total_students = Student::count();
        $widgets[] =['total_students' => $total_students];

        $total_instructors = Instructor::count();
        $widgets[] = ['total_instructors' => $total_instructors];

        $total_courses = Course::count();
        $widgets[] = ['total_courses' => $total_courses];

        $total_training_fields = TrainingField::count();
        $widgets[] = ['total_training_fields' =>  $total_training_fields];

        return $widgets;
    }
}
