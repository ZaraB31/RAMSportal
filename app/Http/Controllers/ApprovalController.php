<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Approval;
use App\Models\Ammendment;
use Auth;

class ApprovalController extends Controller
{
    public function approve($id) {
        $project = Project::findOrFail($id);
        $userID = Auth::id();

        $approval = Approval::create([
            'project_id' => $id,
            'user_id' => $userID,
        ]);

        $ammendment = Ammendment::create([
            'project_id' => $id,
            'version' => 1,
            'comment' => 'Initial Version',
        ]);

        $fileName = (new PDFController)->generateRAMS($id, $ammendment['version']);

        $ammendment['fileName'] = $fileName;
        $ammendment->save();

        return redirect()->route('showProject', $id)->with('success', 'Project Approved!');
    }
}
