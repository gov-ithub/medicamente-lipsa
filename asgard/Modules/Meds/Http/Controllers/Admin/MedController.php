<?php namespace Modules\Meds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Meds\Entities\Med;
use Modules\Meds\Repositories\MedRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class MedController extends AdminBaseController
{
    /**
     * @var MedRepository
     */
    private $med;

    public function __construct(MedRepository $med)
    {
        parent::__construct();

        $this->med = $med;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$meds = $this->med->all();

        return view('meds::admin.meds.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('meds::admin.meds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->med->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('meds::meds.title.meds')]));

        return redirect()->route('admin.meds.med.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Med $med
     * @return Response
     */
    public function edit(Med $med)
    {
        return view('meds::admin.meds.edit', compact('med'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Med $med
     * @param  Request $request
     * @return Response
     */
    public function update(Med $med, Request $request)
    {
        $this->med->update($med, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('meds::meds.title.meds')]));

        return redirect()->route('admin.meds.med.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Med $med
     * @return Response
     */
    public function destroy(Med $med)
    {
        $this->med->destroy($med);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('meds::meds.title.meds')]));

        return redirect()->route('admin.meds.med.index');
    }
}
