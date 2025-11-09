<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganisationSetup;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{


    public function index()
    {
        // $orgId = Auth::user()->organisationId;
        // $setup = OrganisationSetup::where('organisationId', $orgId)->first();
        // $organisation = Auth::user()->load('organisation.setup')->organisation;

        // $setup = $organisation?->setup;
        // $allComplete = $setup &&
        //     $setup->org_details &&
        //     $setup->tax_details &&
        //     // $setup->pay_schedule &&
        //     $setup->statutory_components &&
        //     $setup->salary_components;

        // if (!$allComplete) {
        //     return redirect()->route('setup');
        // }
        return view('dashboard');
    }

    public function setup()
    {
        $organisation = Auth::user()->load('organisation.setup')->organisation;
        $setup = $organisation?->setup;
        $subSteps = [
            'epf' => $setup?->epf ?? false,
            'esi' => $setup?->esi ?? false,
            'pt' => $setup?->pt ?? false,
        ];
        $statutoryCompleted = collect($subSteps)->every(fn($step) => (bool) $step);
        $steps = [
            'org_details' => $setup?->org_details ?? false,
            'tax_details' => $setup?->tax_details ?? false,
            'statutory_components' => $statutoryCompleted,
            'salary_components' => $setup?->salary_components ?? false,
        ];
        $mainStepCount = 4;
        $subStepCount = count($subSteps);
        $subStepsCompleted = collect($subSteps)->filter()->count();

        $statutoryProgress = $subStepsCompleted / $subStepCount;
        $mainStepsCompleted = 0;
        foreach ($steps as $key => $value) {
            $mainStepsCompleted += is_bool($value) ? (int) $value : $value;
        }

        $progress = round(($mainStepsCompleted / $mainStepCount) * 100);
        return view('setup', compact('steps', 'subSteps', 'progress', 'mainStepsCompleted', 'mainStepCount'));

        // // dd($organisation);

        // $setup = $organisation?->setup;
        // $steps = [
        //     'org_details' => $setup?->org_details ?? false,
        //     'tax_details' => $setup?->tax_details ?? false,
        //     // 'pay_schedule' => $setup?->pay_schedule ?? false,
        //     'epf' => $setup?->epf ?? false,
        //     'esi' => $setup?->esi ?? false,
        //     'pt' => $setup?->pt ?? false,
        //     // 'statutory_components' => $setup?->statutory_components ?? false,
        //     'salary_components' => $setup?->salary_components ?? false,
        // ];
        // $completedCount = collect($steps)->filter()->count();
        // $totalSteps = count($steps);
        // $progress = round(($completedCount / $totalSteps) * 100);

        // return view('setup', compact('steps', 'completedCount', 'totalSteps', 'progress'));
    }
}
