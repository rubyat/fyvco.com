<?php
namespace Modules\Airport\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Airport\Models\Airport;
use Modules\Airport\Models\AirportTranslation;

class AirportController extends AdminController
{
    private Airport $airport;

    public function __construct(Airport $airport)
    {
        $this->setActiveMenu(route('airport.admin.index'));
        $this->airport = $airport;
    }

    public function index(Request $request)
    {
        $this->checkPermission('airport_view');
        $listAirport = $this->airport::query() ;
        if (!empty($search = $request->query('s'))) {
            $listAirport->where('name', 'LIKE', '%' . $search . '%');
        }
        $listAirport->orderBy('created_at', 'asc');
        $data = [
            'rows'        => $listAirport->get()->toTree(),
            'row'         => $this->airport,
            'translation' => new ($this->airport->getTranslationModelName()),
            'breadcrumbs' => [
                [
                    'name' => __('Airport'),
                    'url'  => route('airport.admin.index')
                ],
                [
                    'name'  => __('All'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Airport::admin.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('airport_update');
        $row = $this->airport::find($id);
        $translation = $row->translate($request->query('lang',get_main_lang()));
        if (empty($row)) {
            return redirect(route('airport.admin.index'));
        }
        $data = [
            'translation' => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => $this->airport::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Airport'),
                    'url'  => route('airport.admin.index')
                ],
                [
                    'name'  => __('Edit'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Airport::admin.detail', $data);
    }

    public function store( Request $request, $id ){
        if(is_demo_mode()){
            return redirect()->back()->with('danger',__("DEMO MODE: can not add data"));
        }
        $this->checkPermission('airport_update');

        if($id>0){
            $row = $this->airport::find($id);
            if (empty($row)) {
                return redirect(route('airport.admin.index'));
            }
        }else{
            $row = $this->airport;
            $row->status = "publish";
        }

        $row->fill($request->input());
        $row->trip_ideas = $request->input('trip_ideas');
        if($request->input('slug')){
            $row->slug = $request->input('slug');
        }
        do_action(\Modules\Airport\Hook::BEFORE_SAVING,$row,$request);
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);
        if ($res) {
            if($id > 0 ){
                return back()->with('success',  __('Airport updated') );
            }else{
                return redirect(route('airport.admin.index',$row->id))->with('success', __('Airport created') );
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
                $items = $this->airport::select('id', 'name as text')->whereIn('id',$selected)->take(50)->get();
                return response()->json([
                    'items'=>$items
                ]);
            }else{
                $items = $this->airport::find($selected);
            }

            return [
                'results'=>$items
            ];
        }

        $q = $request->query('q');
        $query = $this->airport::select('id', 'name as text')->where("status","publish");
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
                $query = $this->airport::where("id", $id);
                if (!$this->hasPermission('airport_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('airport_delete');
                }
                $query->first();
                if(!empty($query)){
                    //Sync child airport
                    $list_childs = $this->airport::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent airport
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = $this->airport::where("id", $id);
                if (!$this->hasPermission('airport_manage_others')) {
                    $query->where("create_user", Auth::id());
                    $this->checkPermission('airport_update');
                }
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Updated success!'));
    }
}
