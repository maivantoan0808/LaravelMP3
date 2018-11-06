<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->repository->latest()->get();
        return view('backend.admin.category.index', compact('categories'));
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
    public function store(CategoryRequest $request)
    {
        $request->merge([
            'slug' => str_slug($request->name),
        ]);

        $category = $this->repository->create($request->all());

        Toastr::success('Category Successfully Created', 'Success');
        return redirect()->route('admin.category.index');
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
        $category = $this->repository->find($id);
        return view('backend.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $request->merge([
            'slug' => str_slug($request->name),
        ]);
        $this->repository->update($request->all(), $id);

        Toastr::success('Category Successfully Updated', 'Success');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        Toastr::success('Category Successfully Deleted', 'Success');
        return redirect()->back();
    }
}
