<?php
namespace Themes\GoTrip\Brand\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Brand\Models\Brand;
use Modules\Core\Models\Terms;

class ListBrands extends \Modules\Brand\Blocks\ListBrands
{
    public function getOptions()
    {
        $list_service = [];
        foreach (get_bookable_services() as $key => $service) {
            if($key == 'flight') continue;
            $list_service[] = ['value'   => $key,
                               'name' => ucwords($key)
            ];
        }
        return [
            'settings' => [

                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'number',
                    'type'      => 'input',
                    'inputType' => 'number',
                    'label'     => __('Number Item')
                ],
                [
                    'id'            => 'order',
                    'type'          => 'radios',
                    'label'         => __('Order'),
                    'values'        => [
                        [
                            'value'   => 'id',
                            'name' => __("Date Create")
                        ],
                        [
                            'value'   => 'name',
                            'name' => __("Title")
                        ],
                    ],
                ],
                [
                    'id'            => 'order_by',
                    'type'          => 'radios',
                    'label'         => __('Order By'),
                    'values'        => [
                        [
                            'value'   => 'asc',
                            'name' => __("ASC")
                        ],
                        [
                            'value'   => 'desc',
                            'name' => __("DESC")
                        ],
                    ],
                ],
                [
                    'id'           => 'custom_ids',
                    'type'         => 'select2',
                    'label'        => __('List Brand by IDs'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('brand.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                    ],
                    'pre_selected' => route('brand.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ],
            ],
            'category'=>__("Brand")
        ];
    }

    public function content($model = [])
    {


        $list = $this->query($model);


        $data = [
            'rows'         => $list,
            'title'        => $model['title'],
            'desc'         => $model['desc'] ?? "",
            'service_type' => $model['service_type'],
            'layout'       => !empty($model['layout']) ? $model['layout'] : "style_1",
            'to_brand_detail'=>$model['to_brand_detail'] ?? '',
            'view_all_url' => $model['view_all_url'] ?? ''
        ];
        return view('Brand::frontend.blocks.list-brands.index', $data);
    }

}
