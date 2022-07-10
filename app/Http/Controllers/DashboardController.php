<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        ## Användare
        // https://laracasts.com/discuss/channels/laravel/laravel-calculate-percentage-increase-or-decrease-in-users-from-last-30-days
        $stats = User::query()
        ->select('id')
        ->addSelect(['last_30' => User::selectRaw('count(*) as total')
                        ->whereDate('created_at', '<', now()->subDays(30))])
        ->addSelect(['new_users' => User::selectRaw('count(*) as total')
                        ->whereDate('created_at', '>=', now()->subDays(30))])
                        ->first();
        
        // TODO; This logic seems to be stupid
        if (!$stats->last_30 == 0.0){
            $total_percentage = round((($stats->new_users - $stats->last_30) / $stats->last_30)*100, 0);
        }else{
            $total_percentage = 0;
        }

        $total_users = User::count();

        ## Frågor
        $total_answer = Answer::query()
        ->select('id')
        ->addSelect(['last_30_answers' => Answer::selectRaw('count(*) as total')
                        ->whereDate('created_at', '<', now()->subDays(30))])
        ->addSelect(['new_answers' => Answer::selectRaw('count(*) as total')
                        ->whereDate('created_at', '>=', now()->subDays(30))])
        ->first();

        // TODO; This logic seems to be stupid
        if(!empty($total_answer)){
            $total_percentage_answers = round((($total_answer->new_answers - $total_answer->last_30_answers) / $total_answer->last_30_answers)*100, 0);
        }else{
            $total_answer = 0;
            $total_percentage_answers = 0;
        }


        # Mer frågor
        $total_answer = Answer::selectRaw('count(*) as total')
                ->addSelect(['total_wrong' => Answer::selectRaw('count(*) as total_wrong')
                        ->whereAnswer(0)])
                ->addSelect(['total_correct' => Answer::selectRaw('count(*) as total_correct')
                        ->whereAnswer(1)])
        ->first();

        ## Senast registrerad användare
        $latest_registred_user = User::latest()->first();

        return Inertia::render('Dashboard/Index', [
            'total_percentage' => $total_percentage,
            'total_percentage_answers' => $total_percentage_answers,
            'total_users' => $total_users,
            'total_answers' => $total_answer->total,
            'total_correct' => $total_answer->total_correct,
            'total_wrong' => $total_answer->total_wrong,
            'latest_registred_user' => $latest_registred_user
        ]);
    }
}
