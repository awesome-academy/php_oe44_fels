<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Repositories\Topic\TopicRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TopicAdminController extends Controller
{
    protected $topicRepo;

    public function __construct(TopicRepository $topicRepo) {
        $this->topicRepo = $topicRepo;
    }

    public function index()
    {
        $topics = $this->topicRepo->getByPaginate(Config::get('variable.paginate_course'));

        return view('auth.admin.topics', compact(['topics']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->topicRepo->create($request->all());

            return redirect()->route('topics.index')->with('status', trans('insert_success_topic'));

        } catch (\Throwable $th) {

            return redirect()->route('topics.index')->with('status', trans('insert_fail_topic'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        if ($this->topicRepo->update($topic, $request->all())){

            return redirect()->route('topics.index')->with('status', trans('update_success_topic'));
        }
        else{

            return redirect()->route('topics.index')->with('status', trans('update_fail_topic'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        
        if ($this->topicRepo->delete($topic)){

            return redirect()->route('topics.index')->with('status', trans('delete_success_topic'));
        }
        else{

            return redirect()->route('topics.index')->with('status', trans('delete_fail_topic'));
        }

    }
}
