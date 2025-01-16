<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttendenceRequest;
use App\Http\Requests\UpdateAttendenceRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Attendence;
use Illuminate\Http\Request;
use Flash;
use Response;

class AttendenceController extends AppBaseController
{
    /**
     * Display a listing of the Attendence.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attendences = Attendence::selectRaw('
            date,
            COUNT(emp_id) AS total,
            COUNT(IF(status = "Present", 1, NULL)) AS present,
            COUNT(IF(status = "Absent", 1, NULL)) AS absent,
            COUNT(IF(late_status = "Yes", 1, NULL)) AS late,
            COUNT(IF(late_status = "No", 1, NULL)) AS on_time
        ')
            ->groupBy('date')
            ->get();
        return view('attendences.index', compact('attendences'));
    }

    /**
     * Show the form for creating a new Attendence.
     *
     * @return Response
     */
    public function create()
    {
        return view('attendences.create');
    }

    /**
     * Store a newly created Attendence in storage.
     *
     * @param CreateAttendenceRequest $request
     *
     * @return Response
     */
    public function store(CreateAttendenceRequest $request)
    {
        $input = $request->all();
        $attendences = [];
        foreach ($input['emp_id'] as $key => $emp_id) {
            $attendences[] = [
                'date' => $input['date'],
                'emp_id' => $emp_id,
                'status' => $input['status'][$key],
                'late_status' => $input['late_status'][$key]
            ];
        }
        Attendence::insert($attendences);
        Flash::success('Attendence saved successfully.');
        return redirect(route('attendences.index'));
    }

    /**
     * Display the specified Attendence.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($date)
    {
       /** @var Attendence $attendence */
            $attendence = Attendence::selectRaw('
            attendences.*,
            users.name,
            users.last_name,
            users.emp_id as u_emp_id,
            users.id as u_id
        ')
            ->join('users', 'users.id', '=', 'attendences.emp_id')
            ->where('attendences.date', $date)
            ->get();
            if (empty($attendence)) {
                Flash::error('Attendence not found');

                return redirect(route('attendences.index'));
            }
           // dd($attendence, $date);

        return view('attendences.show')->with('attendence', $attendence)->with('date', $date);
    }

    /**
     * Show the form for editing the specified Attendence.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($date)
    {
        /** @var Attendence $attendence */
        $attendence = Attendence::selectRaw('
        attendences.*,
        users.name,
        users.last_name,
        users.emp_id as u_emp_id,
        users.id as u_id
    ')
        ->join('users', 'users.id', '=', 'attendences.emp_id')
        ->where('attendences.date', $date)
        ->get();
        if (empty($attendence)) {
            Flash::error('Attendence not found');

            return redirect(route('attendences.index'));
        }

        return view('attendences.edit')->with('attendence', $attendence)->with('date', $date);
    }

    /**
     * Update the specified Attendence in storage.
     *
     * @param int $id
     * @param UpdateAttendenceRequest $request
     *
     * @return Response
     */
    public function update($date, UpdateAttendenceRequest $request)
    {

        /** @var Attendence $attendence */
        $attendence = Attendence::where('date', $date)->get();

        if (empty($attendence)) {
            Flash::error('Attendence not found');
            return redirect(route('attendences.index'));
        }

        $input = $request->all();
        $attendences = [];
        foreach ($input['emp_id'] as $key => $emp_id) {
            $attendences[] = [
                'date' => $input['date'],
                'emp_id' => $emp_id,
                'status' => $input['status'][$key],
                'late_status' => $input['late_status'][$key]
            ];
        }
        //dd($attendences);
        Attendence::where('date', $date)->delete();
        Attendence::insert($attendences);
        Flash::success('Attendence updated successfully.');

        return redirect(route('attendences.index'));
    }

    /**
     * Remove the specified Attendence from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Attendence $attendence */
        $attendence = Attendence::find($id);

        if (empty($attendence)) {
            Flash::error('Attendence not found');

            return redirect(route('attendences.index'));
        }

        $attendence->delete();

        Flash::success('Attendence deleted successfully.');

        return redirect(route('attendences.index'));
    }
}
