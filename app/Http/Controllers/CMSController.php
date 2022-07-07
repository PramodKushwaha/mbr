<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CMSController extends Controller {

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used to render page listing 
     * @return type Mixed
     */
    public function index() {
        $pages = Page::leftjoin('pages as pp', 'pp.id', 'pages.parent_id')->get(['pages.*', 'pp.title as parent_page']);
        return view('cms.index', ['data' => $pages]);
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used render page add form  
     * @return type Mixed
     */
    public function create() {
        $parentPage = Page::pluck('title', 'id');
        return view('cms.form', ['pages' => $parentPage]);
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used to store page record
     * @param Request $request
     * @return type Mixed
     */
    public function store(Request $request) {
        try {
            $inputs = $request->all();
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            $inputs['slug'] = Str::slug($inputs['title']);
            unset($inputs['_token']);
            $inputs['created_at'] = Carbon::now();
            $inputs['updated_at'] = Carbon::now();
            $page = Page::insert($inputs);
            if ($page) {
                return redirect('cms')->with('success', 'Page added sucessfully.');
            }
        } catch (\Exception $ex) {
            return redirect('cms/create')->with('error', $ex->getMessage());
        }
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used to render edit page 
     * @param type $id
     * @return type Mixed
     */
    public function edit($id) {
        $parentPage = Page::pluck('title', 'id');
        $page = Page::find($id);
        return view('cms.form', ['pages' => $parentPage, 'page' => $page]);
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used to update page record 
     * @param Request $request
     * @param type $id
     * @return type Mixed
     */
    public function update(Request $request, $id) {
        try {
            $inputs = $request->all();
            $request->validate([
                'title' => 'required',
                'content' => 'required',
            ]);
            unset($inputs['_token']);
            $inputs['updated_at'] = Carbon::now();
            $page = Page::where('id', $id)->update($inputs);
            if ($page) {
                return redirect('cms')->with('success', 'Page updated sucessfully.');
            }
        } catch (\Exception $ex) {
            return redirect('cms/edit/' . $id)->with('error', $ex->getMessage());
        }
    }

    /**
     * @author Pramod Kushwaha
     * 
     * This function is used to delete page record 
     * @param Request $request
     * @return type Mixed
     */
    public function destroy(Request $request) {
        try {
            $inputs = $request->all();
            $page = Page::find($inputs['id']);
            if ($page->delete()) {
                return json_encode(['status' => 'success', 'message' => 'Page deleted sucessfully.']);
            }
        } catch (\Exception $ex) {
            return redirect('cms')->with('success', $ex->getMessage());
        }
    }

    public function getPages() {
        $pages = Page::get();
        $menu = Page::buildMenu($pages->toArray());
        return view('pages.index', ['navs' => $menu]);
    }

    public function showPage($slug) {
        $tmpSlug = explode('/', $slug);
        $finalSlug = end($tmpSlug);
        $page = Page::where('slug', $finalSlug)->first();
        return view('pages.contain', ['page' => !empty($page) ? $page->toArray() : []]);
    }

}
