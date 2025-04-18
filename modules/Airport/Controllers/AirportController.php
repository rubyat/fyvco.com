<?php
namespace Modules\Airport\Controllers;

use App\Http\Controllers\Controller;
use Modules\Airport\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public $airport;
    public function __construct(Airport $airport)
    {
        $this->airport = $airport;
    }

    public function index(Request $request)
    {

    }

    public function detail(Request $request, $slug)
    {
        $row = $this->airport::where('slug', $slug)->where("status", "publish")->first();;
        if (empty($row)) {
            return redirect('/');
        }
        $translation = $row->translate();
        $data = [
            'row' => $row,
            'translation' => $translation,
            'seo_meta' => $row->getSeoMetaWithTranslation(app()->getLocale(), $translation),
            'breadcrumbs'       => [
                [
                    'name'  => $translation->name,
                    'class' => 'active'
                ],
            ],
        ];
        $this->setActiveMenu($row);
        return view('Airport::frontend.detail', $data);
    }

    public function searchForSelect2( Request $request ){
        $search = $request->query('search');
        $query = Airport::select('bravo_airports.*', 'bravo_airports.name as title')->where("bravo_airports.status","publish");
        if ($search) {
            $query->where('bravo_airports.name', 'like', '%' . $search . '%');

            if( setting_item('site_enable_multi_lang') && setting_item('site_locale') != app()->getLocale() ){
                $query->leftJoin('bravo_airport_translations', function ($join) use ($search) {
                    $join->on('bravo_airports.id', '=', 'bravo_airport_translations.origin_id');
                });
                $query->orWhere(function($query) use ($search) {
                    $query->where('bravo_airport_translations.name', 'LIKE', '%' . $search . '%');
                });
            }

        }
        $res = $query->orderBy('name', 'asc')->limit(20)->get();
        if(!empty($res) and count($res)){
            $list_json = [];
            foreach ($res as $airport) {
                $translate = $airport->translate();
                $list_json[] = [
                    'id' => $airport->id,
                    'title' => $translate->name,
                ];
            }
            return $this->sendSuccess(['data'=>$list_json]);
        }
        return $this->sendError(__("Airport not found"));
    }
}
