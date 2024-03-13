<?php

namespace App\Http\Controllers;

use App\Helpers\Step;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExampleController extends Controller
{
    /**
     * Index Example
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $step = $request->session()->get('step');
        $dataStep1 = $request->session()->get('dataStep1');

        return view('index')->with([
            'steps' => Step::STEP,
            'active' => $step ? $step : 1,
            'meal' => Step::MEAL,
            'dataStep1' => $dataStep1 ? $dataStep1 : ['meal' => 0, 'count_people' => 1],
        ]);
    }

    public function step1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meal' => ['required', 'numeric', 'in:' . implode(',', [1,2,3])],
            'count_people' => ['required', 'numeric', 'min:1', 'max:10'],
        ]);

        if (!$validator->passes()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        session(['dataStep1' => [
            'meal' => $request->get('meal'),
            'count_people' => $request->get('count_people'),
        ]]);

        return response()->json(['status' => 200]);
    }
}
