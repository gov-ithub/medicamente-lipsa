<?php namespace Modules\Meds\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Modules\Meds\Entities\Reply;
use Modules\Meds\Repositories\ReplyRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ReplyController extends AdminBaseController
{
    /**
     * @var ReplyRepository
     */
    private $reply;

    public function __construct(ReplyRepository $reply)
    {
        parent::__construct();

        $this->reply = $reply;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$replies = $this->reply->all();

        return view('meds::admin.replies.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('meds::admin.replies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->reply->create($request->all());

        flash()->success(trans('core::core.messages.resource created', ['name' => trans('meds::replies.title.replies')]));

        return redirect()->route('admin.meds.reply.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Reply $reply
     * @return Response
     */
    public function edit(Reply $reply)
    {
        return view('meds::admin.replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Reply $reply
     * @param  Request $request
     * @return Response
     */
    public function update(Reply $reply, Request $request)
    {
        $this->reply->update($reply, $request->all());

        flash()->success(trans('core::core.messages.resource updated', ['name' => trans('meds::replies.title.replies')]));

        return redirect()->route('admin.meds.reply.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Reply $reply
     * @return Response
     */
    public function destroy(Reply $reply)
    {
        $this->reply->destroy($reply);

        flash()->success(trans('core::core.messages.resource deleted', ['name' => trans('meds::replies.title.replies')]));

        return redirect()->route('admin.meds.reply.index');
    }
}
