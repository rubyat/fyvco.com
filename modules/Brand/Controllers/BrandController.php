<?php
namespace Modules\Brand\Controllers;

use App\Http\Controllers\Controller;
use Modules\Brand\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function index(Request $request)
    {

    }

    public function detail(Request $request, $slug)
    {
        $row = $this->brand::where('slug', $slug)->where("status", "publish")->first();;
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
        return view('Brand::frontend.detail', $data);
    }

    public function searchForSelect2( Request $request ){
        $search = $request->query('search');
        $query = Brand::select('bravo_brands.*', 'bravo_brands.name as title')->where("bravo_brands.status","publish");
        if ($search) {
            $query->where('bravo_brands.name', 'like', '%' . $search . '%');

            if( setting_item('site_enable_multi_lang') && setting_item('site_locale') != app()->getLocale() ){
                $query->leftJoin('bravo_brand_translations', function ($join) use ($search) {
                    $join->on('bravo_brands.id', '=', 'bravo_brand_translations.origin_id');
                });
                $query->orWhere(function($query) use ($search) {
                    $query->where('bravo_brand_translations.name', 'LIKE', '%' . $search . '%');
                });
            }

        }
        $res = $query->orderBy('name', 'asc')->limit(20)->get();
        if(!empty($res) and count($res)){
            $list_json = [];
            foreach ($res as $brand) {
                $translate = $brand->translate();
                $list_json[] = [
                    'id' => $brand->id,
                    'title' => $translate->name,
                ];
            }
            return $this->sendSuccess(['data'=>$list_json]);
        }
        return $this->sendError(__("Brand not found"));
    }
}
