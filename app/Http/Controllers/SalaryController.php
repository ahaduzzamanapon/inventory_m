<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendence;
use App\Models\Salary;



class SalaryController extends Controller
{
    public function index(){
        $users = User::all();
        return view('salary.index',compact('users'));
    }
    public function process(Request $request){
        $user_ids=$request->user_id;
        $month=$request->process_month;
        $first_date= date('Y-m-01', strtotime($month));
        $last_date= date('Y-m-t', strtotime($month));
        $total_day=date('t', strtotime($month));
        $users = User::whereIn('id', $user_ids)->get();

        foreach($users as $user){
            $attendences = Attendence::where('emp_id', $user->id)
            ->whereBetween('date', [$first_date, $last_date])
            ->get();
            $total_present = $attendences->where('status', 'Present')->count();
            $total_absent = $attendences->where('status', 'Absent')->count();
            $salary=$user->salary;
            $per_day_salary=$salary/$total_day;
            $ba_deduct_day=$total_day-($total_present+$total_absent);


            $total_salary=$total_present*$per_day_salary;
            $ba_deduct=$ba_deduct_day*$per_day_salary;
            $absent_deduct=$total_absent*$per_day_salary;
            $data=[
                'user_id'=>$user->id,
                'emp_id'=>$user->emp_id,
                'month'=>$month,
                'salary'=>$salary,
                'total_present'=>$total_present,
                'total_absent'=>$total_absent,
                'ba_deduct_day'=>$ba_deduct_day,
                'total_salary'=>round($total_salary, 2),
                'ba_deduct'=>round($ba_deduct, 2),
                'absent_deduct'=>round($absent_deduct, 2),
                'gross_salary'=>round($total_salary, 2)
            ];
            $find_salary=Salary::where('user_id', $user->id)->where('month', $month)->first();
            //dd($find_salary);
            if($find_salary){
                $find_salary->update($data);
            }else{
                Salary::create($data);
            }
        }
        return response()->json(['status'=>true]);
    }

    public function get_salary(Request $request){
        $user_id=$request->user_id;
        $process_month=$request->process_month;
        $user_ids=explode(',', $user_id);
        $salaries=Salary::select('salaries.*', 'users.*')
                        ->join('users', 'users.id', '=', 'salaries.user_id')
                        ->whereIn('salaries.user_id', $user_ids)
                        ->where('salaries.month', $process_month)
                        ->get();
        //dd($salaries);
        return view('salary.get_salary',compact('salaries'));
    }
}
