<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectsReports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DateController;

use function PHPUnit\Framework\isNull;

class ProjectController extends DateController
{
    public function GetAllProject()
    {
        if (auth()->user()->role == 0) {
            $projects = Project::all();
        } else {
            $mapProject = DB::table('projects_user_map')->where('user_id', auth()->user()->id)->get();
            $projects = array();
            foreach ($mapProject as $map) {
                $projects[] = Project::where('id', $map->project_id)->first();
            }
        }
        return view('project.project', compact('projects'));
    }

    public function GetProjectById($id)
    {
        $project = Project::find($id);
        $project_reports = ProjectsReports::where('projects_id', $project->id)->get();
        foreach ($project_reports  as $object) {
            $dd = explode(" ", $object->created_at);
            $object->persian_date = $dd[1] . " " . DateController::toShaDate($dd[0]);
        }
        return view('project.project-view', compact('project_reports', 'id'));
    }

    public function AddProject()
    {
        return view('project.project-add');
    }

    public function StoreProject(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required'
        ]);
        Project::create([
            'title' => $request->title,
            'address' => $request->address
        ]);
        return redirect()->back()->with('success', 'کارمند با موفقیت ثبت گردید');
    }

    public function DeleteProject($id)
    {
        Project::destroy($id);
        $reports = DB::table('projects_reports')->where('projects_id', $id)->get();
        foreach ($reports as $report){
            DB::table('projects_reports_files')->where('projects_reports_id', $report->id)->delete();
        }
        DB::table('projects_reports')->where('projects_id', $id)->delete();
        DB::table('projects_license')->where('project_id', $id)->delete();
        return redirect()->route('Project.all');
    }

    public function AddProjectReport($p_id)
    {
        return view('project.project-view-upload', compact('p_id'));
    }

    public function StoreProjectReport(Request $request)
    {
        $request->validate([
            'projects_id' => 'required',
            'title' => 'required'
        ]);
        $projectsReports = ProjectsReports::create([
            'projects_id' => $request->projects_id,
            'title' => $request->title,
            'description' => $request->description
        ]);
        //dd($projectsReports->id);
        $files = $request->file('attachment');
        if ($request->hasFile('attachment')) {
            foreach ($files as $file) {
                DB::table('projects_reports_files')->insert([
                    'projects_reports_id' => $projectsReports->id,
                    'file' => base64_encode(file_get_contents($file)),
                    'type' => ''
                ]);
            }
        }
        return redirect()->back()->with('success', 'مستند با موفقیت ثبت گردید');
    }

    public function GetProjectReportsById($p_id, $id)
    {
        $project_report = ProjectsReports::find($id);
        $files = DB::table('projects_reports_files')->where('projects_reports_id', $id)->get();
        for ($i = 0; $i < count($files); $i++) {
            $files[$i]->file = 'data:image/;base64,' . $files[$i]->file;
        }
        $dd = explode(" ", $project_report->created_at);
        $project_report->persian_date = $dd[1] . " " . DateController::toShaDate($dd[0]);
        return view('project.project-report-view', compact('project_report', 'files', 'p_id'));
    }

    public function GetProjectLicense($id)
    {
        $project = Project::find($id);
        $project_license= DB::table('projects_license')->where('project_id', $id)->get();
        for ($i = 0; $i < count($project_license); $i++) {
            $project_license[$i]->file = 'data:image/;base64,' . $project_license[$i]->file;
        }
        return view('project.project-license', compact('project_license', 'id', 'project'));
    }

    public function AddProjectLicense($p_id)
    {
        return view('project.project-license-upload', compact('p_id'));
    }

    public function StoreProjectLicense(Request $request)
    {
        $request->validate([
            'projects_id' => 'required',
            'title' => 'required'
        ]);
        $files = $request->file('attachment');
        if ($request->hasFile('attachment')) {
            foreach ($files as $file) {
                DB::table('projects_license')->insert([
                    'project_id' => $request->projects_id,
                    'title' => $request->title,
                    'file' => base64_encode(file_get_contents($file)),
                    'type' => ''
                ]);
            }
        }
        return redirect()->back()->with('success', 'مستند با موفقیت ثبت گردید');
    }
}
