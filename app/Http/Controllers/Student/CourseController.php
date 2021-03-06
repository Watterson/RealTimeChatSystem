<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Course;
use App\University as Uni;
use App\Module;
use App\UserCourse;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex(Request $request)
    {
      $courses = Course::all();
      $return = [];
        foreach ($courses as $course) {
            $user = User::find($course->leader_id);
            $name =  $user->first_name . ' ' . $user->last_name;
            $uni = Uni::find($course->university_id);
            $return[] = [$course->title, $course->description, $name, $uni->name, $course->id];
        }
      return view('student.index', [
        'courses' => $return,
      ]);
    }

    public function viewCourse(Request $request)
    {
      $id = Request()->input('courseId');

      $course = Course::find($id);
      $uni = Uni::find($course->university_id);
      $return = [];
      $modules = Module::where('course_id', $id)
                        ->get();
      $joined = UserCourse::where('course_id', $id)
                          ->where('user_id', Auth::id())
                          ->get();
        foreach ($modules as $module) {
            $user = User::find($module->leader_id);
            $name =  $user->first_name . ' ' . $user->last_name;
            $return[] = [$module->title, $module->description, $name];
        }




      return view('student.viewCourse', [
        'course' => $course,
        'modules' => $return,
        'joined' => $joined,
        'uni' => $uni,
      ]);
    }

    public function joinCourse(Request $request)
    {
      $id = Request()->input('courseId');
      $course = Course::find($id);
      $validatedData = $request->validate([
        'key' => 'required|in:'.$course->access_key,
       ]);

       $userCourse = new UserCourse;

       $userCourse->user_id = Auth::id();
       $userCourse->course_id = $id;

       $userCourse->save();
       $path = 'student/course/view?id='.$id;
       return Redirect()->to($path);

      // code...
    }

    public function getView()
    {
      $id = Request()->input('courseId');
      $course = Course::find($id);
      $modules = Module::where('course_id', $id)
                        ->get();

      return View('student.course.view');
    }




}
