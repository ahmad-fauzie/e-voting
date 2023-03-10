<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use App\Exports\FeedbackExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        return view('feedback.index');
    }

    public function fetchAllFeedback(){
        $user = Auth::user();
        $feedbacks = $user->level == 'admin' ? Feedback::orderBy('created_at', 'desc')->get() : Feedback::where('id_user', $user->id)->orderBy('created_at', 'desc')->get();
        $data = '';
        $export = '';
        if($feedbacks->count() > 0){
            foreach($feedbacks as $feedback){
                $data .= '<div class="card">
                <div class="card-content p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-3">' . $feedback->name . '</h4>
                        <div class="deleteIcon" id="' . $feedback->id . '" style="padding-bottom: 0.3rem;">
                            <i class="bi bi-trash text-danger" style="height: fit-content; font-size: 15px; cursor: pointer;"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="card-subtitle mb-3">' . $feedback->feedback . '</h6>
                            <p class="fst-italic">Created at : ' . $feedback->getDate($feedback->created_at) . '</p>
                        </div>
                        <div class="rate col-md-6">
                            <input type="radio" ' . ($feedback->rating == '5' ? 'checked' : '') . ' id="star5" class="rate"
                                value="5" />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" ' . ($feedback->rating == '4' ? 'checked' : '') . ' id="star4" class="rate"
                                value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" ' . ($feedback->rating == '3' ? 'checked' : '') . ' id="star3" class="rate"
                                value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" ' . ($feedback->rating == '2' ? 'checked' : '') . ' id="star2" class="rate"
                                value="2">
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" ' . ($feedback->rating == '1' ? 'checked' : '') . ' id="star1" class="rate"
                                value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-3 d-flex justify-content-between">
                </div>
            </div>';
            }
            $export .= '<button class="btn btn-primary d-flex text-white p-2" id="btn_export"><i class="bi bi-file-earmark-arrow-down d-block h-auto"></i>
            <span class="d-none d-md-block ps-1">Export</span></button>';
        } else{
            $data = '';
            $export = '';
        }
        return response()->json([
            'status' => 200,
            'data' => $data,
            'export' => $export,
        ]);
    }

    public function store(Request $request){
        $user = Auth::user();
        $feedback = Feedback::all()->where('id_user', $user->id);
        if($feedback->count() >= 3) {
            return response()->json([
                'status' => 404,
                'message' => 'Maaf Maksimal Feedback hanya 3x.'
            ]);
        }
        $feedbackData = [
            'id_user' => $user->id,
            'login' => $request->login,
            'name' => $user->name,
            'daftar' => $user->level == 'admin' ? '' : $request->daftar ,
            'reset' => $request->reset,
            'dashboard' => $request->dashboard,
            'siswa' => $user->level == 'admin' ? $request->siswa : '',
            'kandidat' => $user->level == 'admin' ? $request->kandidat : '',
            'voting' => $user->level == 'admin' ? '' : $request->voting,
            'qna' => $request->qna,
            'hasil' => $request->hasil,
            'jadwal' => $user->level == 'admin' ? $request->jadwal : '',
            'rating' => $request->rating,
            'profile' => $user->level == 'admin' ? $request->profile : '',
            'feedback' => $request->feedback
        ];
        Feedback::create($feedbackData);
        return response()->json([
            'status' => 200,
            'message' => 'Terima Kasih Atas Feedbacknya.'
        ]);
    }

    public function export(){
        return Excel::download(new FeedbackExport, 'Feedback.xlsx');
    }

    public function deleteFeedback(Request $request){
        Feedback::destroy($request->id);
        return response()->json([
            'status' => 200,
        ]);
    }
}
