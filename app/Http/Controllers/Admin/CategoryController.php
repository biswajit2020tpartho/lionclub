<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getIndex()
    {
        if (!AdminHelper::isView()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $request = request();
        $data = [];
        $data['page_title'] = 'Manage Category';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = Category::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or slug like '%".$q."%' )");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = Category::when($q, function($query) use ($q){                           
                            $query->whereRaw("( name like '%".$q."%' or slug like '%".$q."%' )");
                        })->latest()->paginate($limit);

        }
        
            
        return view('admin.category_management.index', $data);
    
    }

    /**
     * Show the form for creating a new resource.
     */
    function getAdd()
    {
        /*if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }*/

        $data = [];
        $data['page_title'] = 'Add Category';
        $data['locales'] = \Config::get('app.locales');
            
        return view('admin.category_management.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    function postAddSave(Request $request)
    {
       /* if (!AdminHelper::isCreate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }*/
        //dd($request->all());
        $request->validate([
            'category_title' => 'required|max:150',                        
            'status' => 'required|numeric'
        ]);
       
        $isdata = Category::where('name' ,$request->input('category_title'))->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Category Already Exists!'); 
        }       

        $slug_val = SlugService::createSlug(Category::class, 'slug', $request->input('category_title')); 
        $cms = new Category ; 
        $cms->name = $request->category_title;
        $cms->slug = $slug_val;       
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-category');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('category added successfully!');
        }else{
            return redirect()->back()->withSuccess('category added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    function getDetail($id)
    {
        if (!AdminHelper::isRead()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }


        $data = [];
        $data['page_title'] = 'Details Category';
        $data['row'] = Category::find($id);



        return view('admin.category_management.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    function getEdit($id)
    {
       /* if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }*/
        $data = [];
        $data['page_title'] = 'Edit Category';
        $data['row'] = Category::find($id);
        $data['locales'] = \Config::get('app.locales');

        //dd($data['row']);

        return view('admin.category_management.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    function postUpdateSave($id, Request $request)
    {
        /*if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }*/
        $request->validate([
            //'page_title' => 'required|alpha_spaces|max:150',
            'category_title' => 'required|max:150',                 
            'status' => 'required|numeric'
        ]);

         $isdata = Category::where('id' ,'!=',$id)->where('name' ,$request->input('category_title'))->get();
       
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Category Already Exists!'); 
        }
      
        $cms = Category::find($id);
        if($cms->category_title!=$request->input('category_title'))
        {
              $slug_val = SlugService::createSlug(Category::class, 'slug', $request->input('category_title'));
              $cms->slug = $slug_val;
        }

        $cms->name = $request->input('category_title');        
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->user_ip = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-category');
        return redirect($return_url)->withSuccess('Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    function getDelete($id)
    {
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        if(!empty($id))
        {
            Category::find($id)->delete();
            return redirect()->back()->withSuccess('Category deleted successfully!');
        }
    }

    public function postActionSelected(Request $request)
    {        
        if (!AdminHelper::isDelete()) {
            return redirect(AdminHelper::adminPath())->withError('Sorry you do not have privilege to access this area !');
        }
        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        if ($button_name == 'delete') {                  
            Category::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            Category::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            Category::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
