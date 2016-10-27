<?php namespace Modules\Meds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Meds\Entities\Patient;
use Modules\Meds\Entities\Med;
use Modules\Meds\Repositories\PatientRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Core\Contracts\Authentication;

class PatientController extends AdminBaseController
{
    /**
     * @var PatientRepository
     */
    private $patient;

    public function __construct(PatientRepository $patient, Authentication $auth)
    {
        parent::__construct();
		
        $this->patient = $patient;
		$this->auth = $auth;
		
//		$this->auth = app('Modules\Core\Contracts\Authentication');
        view()->share('currentUser', $this->auth->check());

		view()->share('statuses', Patient::$statuses);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $patients = $this->patient->all();

        return view('meds::admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('meds::admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->patient->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('meds::patients.title.patients')]));

        return redirect()->route('admin.meds.patient.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Patient $patient
     * @return Response
     */
    public function edit(Patient $patient)
    {

		$this->assetPipeline->requireCss('datepicker.css');
		$this->assetPipeline->requireJs('datepicker.js');
		$this->assetPipeline->requireJs('ckeditor.js');
		
        return view('meds::admin.patients.edit', [
			'patientRoles' => Patient::$roles,
			'medPackage' => Med::$packageList,
		])->with(compact('patient'));
    }
	

    /**
     * Update the specified resource in storage.
     *
     * @param  Patient $patient
     * @param  Request $request
     * @return Response
     */
    public function update(Patient $patient, Request $request)
    {
        $this->patient->update($patient, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('meds::patients.title.patients')]));

        return redirect()->route('admin.meds.patient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Patient $patient
     * @return Response
     */
    public function destroy(Patient $patient)
    {
        $this->patient->destroy($patient);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('meds::patients.title.patients')]));

        return redirect()->route('admin.meds.patient.index');
    }
}
