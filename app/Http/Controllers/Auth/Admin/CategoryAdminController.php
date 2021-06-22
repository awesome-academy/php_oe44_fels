<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CategoryAdminController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getByPaginate(Config::get('variable.paginate_category'));

        return view('auth.admin.categories')->with('categories', $categories);
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
            $this->categoryRepo->create($request->all());

            return redirect()->route('categories.index')->with('status', trans('insert_success_category'));
        } catch (\Throwable $th) {

            return redirect()->route('categories.index')->with('status', trans('insert_fail_category'));
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
    public function update(Category $cate, Request $request)
    {
        if ($this->categoryRepo->update($cate, $request->all())) {

            return redirect()->route('categories.index')->with('status', trans('update_success_category'));
        } else {

            return redirect()->route('categories.index')->with('status', trans('update_faile_category'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $cate)
    {
        if ($this->categoryRepo->delete($cate)) {

            return redirect()->route('categories.index')->with('status', trans('delete_success_category'));
        }

        return redirect()->route('categories.index')->with('status', trans('delete_faile_category'));
    }
}
