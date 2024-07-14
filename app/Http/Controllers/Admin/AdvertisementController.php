<?php

namespace App\Http\Controllers\Admin;

use AdminHelper;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdvertisementController extends Controller
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
        $data['page_title'] = 'Manage Advertisement';

        $data['limit'] = $limit = (!empty($request->get('limit'))?$request->get('limit'):20);
        $q = $request->get('q');

        $filter_clumn = $request->get('filter_column');
        $sorting = $request->get('sorting');
        if($filter_clumn!='')
        {
            $data['rows'] = Advertisement::when($q, function($query) use ($q){                           
                            $query->whereRaw("( title like '%".$q."%' or slug like '%".$q."%' )");
                        })->orderBy($filter_clumn,$sorting)->paginate($limit);

        }
        else
        {
            $data['rows'] = Advertisement::when($q, function($query) use ($q){                           
                            $query->whereRaw("( title like '%".$q."%' or slug like '%".$q."%' )");
                        })->latest()->paginate($limit);

        }
            
        return view('admin.advertisement_management.index', $data);
    
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
        $data['page_title'] = 'Add Advertisement';
        $data['locales'] = \Config::get('app.locales');
            
        return view('admin.advertisement_management.add', $data);
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
            'advertisement_title' => 'required|max:150|unique:advertisement,title',
            'published_date'      => 'required|date_format:Y-m-d',
            'short_description' => 'required|max:150',                        
            'description' => 'required',    
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric'
        ]);
       
        $isdata = Advertisement::where('title' ,$request->input('advertisement_title'))->get();
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Advertisement Already Exists!'); 
        }       

        $featured_image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/advertisement/'.$date);
            $image->move($destinationPath, $name);
            $featured_image = 'admin/uploads/images/advertisement/'.$date.'/'.$name;           
        }

        $slug_val = SlugService::createSlug(Advertisement::class, 'slug', $request->input('advertisement_title')); 
        $cms = new Advertisement ; 
        $cms->title = $request->input('advertisement_title');
        $cms->slug = $slug_val; 
        $cms->description = $request->input('description'); 
        $cms->short_description = $request->input('short_description');
        $cms->banner_image = $featured_image; 
        $cms->status = $request->input('status');
        $cms->publish_date = $request->input('published_date');
        $cms->updated_by = AdminHelper::myId();
        $cms->created_by = AdminHelper::myId();
        $cms->ip_address = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save();       

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-advertisement');
        if($request->input('submit')=='Save')
        {
            return redirect($return_url)->withSuccess('advertisement added successfully!');
        }else{
            return redirect()->back()->withSuccess('advertisement added successfully!');
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
        $data['page_title'] = 'Details Advertisement';
        $data['row'] = Advertisement::find($id);
        return view('admin.advertisement_management.detail', $data);
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
        $data['page_title'] = 'Edit Advertisement';
        $data['row'] = Advertisement::find($id);
        $data['locales'] = \Config::get('app.locales');

        //dd($data['row']);

        return view('admin.advertisement_management.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    function postUpdateSave($id, Request $request)
    {
        if (!AdminHelper::isUpdate()) {
            return redirect(AdminHelper::adminPath('manage-advertisement'))->withError('Sorry you do not have privilege to access this area !');
        }
        $request->validate([
            'advertisement_title' => 'required|max:150|unique:advertisement,title,'.$id,
            'published_date'      => 'required|date_format:Y-m-d',      
            'short_description' => 'required|max:150',                        
            'description' => 'required',    
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:5000',        
            'status' => 'required|numeric'
        ]);

        $isdata = Advertisement::where('id' ,'!=',$id)->where('title' ,$request->input('advertisement_title'))->get();       
        if(!$isdata->isEmpty()){
           return redirect()->back()->withError('Advertisement Already Exists!'); 
        }
      
        $cms = Advertisement::find($id);

        $featured_image = $cms->banner_image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = 'featured-image-'.time().'.'.$image->getClientOriginalExtension();
            $date = date('d-m-Y');
            $destinationPath = public_path('admin/uploads/images/advertisement/'.$date);
            $image->move($destinationPath, $name);
            $featured_image = 'admin/uploads/images/advertisement/'.$date.'/'.$name;           
        }
        if($cms->advertisement_title!=$request->input('advertisement_title'))
        {
              $slug_val = SlugService::createSlug(Advertisement::class, 'slug', $request->input('advertisement_title'));
              $cms->slug = $slug_val;
        }

        $cms->title = $request->input('advertisement_title');
        $cms->slug = $slug_val; 
        $cms->description = $request->input('description'); 
        $cms->short_description = $request->input('short_description');
        $cms->banner_image = $featured_image; 
        $cms->status = $request->input('status');
        $cms->updated_by = AdminHelper::myId();
        $cms->publish_date = $request->input('published_date');
        $cms->ip_address = $request->ip();
        $cms->updated_at = date('Y-m-d H:i:s');
        $cms->save(); 

        $return_url = (!empty($request->input('return_url'))?$request->input('return_url'):AdminHelper::adminPath().'/manage-advertisement');
        return redirect($return_url)->withSuccess('Advertisement updated successfully!');
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
            Advertisement::find($id)->delete();
            return redirect()->back()->withSuccess('Advertisement deleted successfully!');
        }
    }

    public function postActionSelected(Request $request)
    {        
        
        $id_selected = $request->input('checkbox');
        $button_name = $request->input('button_name');
        $message = "No action taken";
        if (empty($id_selected)) {
            AdminHelper::redirect($_SERVER['HTTP_REFERER'], 'Please select at least one data!', 'warning');
        }

        if ($button_name == 'delete') {  
            if (!AdminHelper::isDelete()) {
                return redirect(AdminHelper::adminPath('manage-advertisement'))->withError('Sorry you do not have privilege to access this area !');
            }                
            Advertisement::whereIn('id', $id_selected)->delete();

            AdminHelper::insertLog("Deleted data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip());            

            $message = "The selected data deleted successfully !";

            return redirect()->back()->withSuccess($message);
        }  

        if($button_name == 'active')      
        {
            if (!AdminHelper::isUpdate('manage-advertisement')) {
                return redirect(AdminHelper::adminPath('manage-advertisement'))->withError('Sorry you do not have privilege to access this area !');
            }
            Advertisement::whereIn('id', $id_selected)->update(['status'=>1, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data activated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        if($button_name == 'inactive')      
        {
            if (!AdminHelper::isUpdate('manage-advertisement')) {
                return redirect(AdminHelper::adminPath('manage-advertisement'))->withError('Sorry you do not have privilege to access this area !');
            }
            Advertisement::whereIn('id', $id_selected)->update(['status'=>0, 'updated_at'=>date('Y-m-d H:i:s')]);

            AdminHelper::insertLog("Updated data ".implode(',', $id_selected)." by ".AdminHelper::myName()." ip: ".$request->ip()); 

            $message = "The selected data inactivated successfully !";
            return redirect()->back()->withSuccess($message);
        }

        return redirect()->back()->withError($message);
    }
}
