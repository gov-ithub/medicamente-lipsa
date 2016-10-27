<?php namespace Modules\Meds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Meds\Entities\Contact;
use Modules\Meds\Repositories\ContactRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ContactController extends AdminBaseController
{
    /**
     * @var ContactRepository
     */
    private $contact;

    public function __construct(ContactRepository $contact)
    {
        parent::__construct();

        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$contacts = $this->contact->all();

        return view('meds::admin.contacts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('meds::admin.contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->contact->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('meds::contacts.title.contacts')]));

        return redirect()->route('admin.meds.contact.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function edit(Contact $contact)
    {
        return view('meds::admin.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Contact $contact
     * @param  Request $request
     * @return Response
     */
    public function update(Contact $contact, Request $request)
    {
        $this->contact->update($contact, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('meds::contacts.title.contacts')]));

        return redirect()->route('admin.meds.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return Response
     */
    public function destroy(Contact $contact)
    {
        $this->contact->destroy($contact);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('meds::contacts.title.contacts')]));

        return redirect()->route('admin.meds.contact.index');
    }
}
