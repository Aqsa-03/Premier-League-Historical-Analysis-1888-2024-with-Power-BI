<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Allotment;
use App\Http\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\CourseContent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreContentRequest;
use App\Http\Requests\UpdateContentRequest;
use App\Http\Requests\StoreCourseContentRequest;
use App\Http\Requests\UpdateCourseContentRequest;

class CourseContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        $contents = CourseContent::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.course-content.list',compact('contents','allotments'));
    }

    public function store(StoreCourseContentRequest $request)
    {
        $teacherId = Auth::user()->teacher->id;
        $validatedData = $request->validated();
        if($request->file('file'))
        {
            $validatedData['file'] = Helper::uploadFile($request->file);
        }
        
        if(CourseContent::create($validatedData + ['teacher_id' => $teacherId]))
        {
            return response()->json(['success'=>true]);
        }
    }

    public function create()
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.course-content.index',compact('allotments'));
    }


    public function show()
    {
        $contents = CourseContent::with('chapter.subject.grade')->get();
        return view('content.list',compact('contents'));
    }

    public function destroy(CourseContent $courseContent)
    {
        if(File::exists(public_path($courseContent->file)))
        {
            File::delete(public_path($courseContent->file));
        }
        
        if($courseContent->delete())
        {
            return redirect()->back();
        }
    }

    public function edit(CourseContent $courseContent)
    {
        $user = Auth::user();
        $allotments = Allotment::where('teacher_id',$user->teacher->id)->with('course:id,name','classCourse:id,name')->get();
        return view('teacher.course-content.edit',compact('allotments','courseContent'));
    }

    public function update(UpdateCourseContentRequest $request,CourseContent $courseContent)
    {
        $validatedData = $request->validated();
        if($request->hasFile('file'))
        {
            if(is_null($courseContent->file))
            {
                $validatedData['file'] = Helper::uploadFile($request->file);
            }
            else
            {
                $validatedData['file'] = Helper::updateFile($request->file,$courseContent->file);
            }
        }
        
        $courseContent->update($validatedData);
        return response()->json(['success'=>true]);
    }
}
