<?php
namespace Modules\Brand\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Brand\Models\Brand;
use Modules\Brand\Models\BrandTranslation;

class BrandController extends AdminController
{
    private Brand $brand;

    public function __construct(Brand $brand)
    {
        $this->setActiveMenu(route('brand.admin.index'));
        $this->brand = $brand;
    }

    public function index(Request $request)
    {
        $this->checkPermission('brand_view');
        $listBrand = $this->brand::query() ;
        if (!empty($search = $request->query('s'))) {
            $listBrand->where('name', 'LIKE', '%' . $search . '%');
        }
        $listBrand->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listBrand->get()->toTree(),
            'row'         => $this->brand,
            'translation' => new ($this->brand->getTranslationModelName()),
            'breadcrumbs' => [
                [
                    'name' => __('Brand'),
                    'url'  => route('brand.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Brand::admin.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('brand_update');
        $row = $this->brand::find($id);
        $translation = $row->translate($request->query('lang',get_main_lang()));
        if (empty($row)) {
            return redirect(route('brand.admin.index'));
        }
        $data = [
            'translation' => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => $this->brand::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Brand'),
                    'url'  => route('brand.admin.index')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Brand::admin.detail', $data);
    }

    public function store( Request $request, $id ){
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: can not add data"));
        }
        $this->checkPermission('brand_update');

        if($id>0){
            $row = $this->brand::find($id);
            if (empty($row)) {
                return redirect(route('brand.admin.index'));
            }
        }else{
            $row = $this->brand;
            $row->status = "publish";
        }

        $row->fill($request->input());
        $row->trip_ideas = $request->input('trip_ideas');
        if($request->input('slug')){
            $row->slug = $request->input('slug');
        }
        do_action(\Modules\Brand\Hook::BEFORE_SAVING,$row,$request);
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);
        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Brand updated') );
            }else{
                return redirect(route('brand.admin.index',$row->id))->with('success', __('Brand created') );
            }
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            if(is_array($selected))
            {
                $items = $this->brand::select('id', 'name as text')->whereIn('id',$selected)->take(50)->get();
                return response()->json([
                    'items'=>$items
                ]);
            }else{
                $items = $this->brand::find($selected);
            }

            return [
                'results'=>$items
            ];
        }

        $q = $request->query('q');
        $query = $this->brand::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __("Select at least 1 item!"));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Select an Action!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->brand::where("id", $id);
                if (!$this->hasPermission('brand_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('brand_delete');
                }
                $query->first();
                if(!empty($query)){
                    //Sync child brand
                    $list_childs = $this->brand::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent brand
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = $this->brand::where("id", $id);
                if (!$this->hasPermission('brand_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('brand_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
}
