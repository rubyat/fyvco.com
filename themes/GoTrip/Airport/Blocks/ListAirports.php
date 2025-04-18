<?php
namespace Themes\GoTrip\Airport\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Airport\Models\Airport;
use Modules\Core\Models\Terms;

class ListAirports extends \Modules\Airport\Blocks\ListAirports
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
                    'id'            => 'layout',
                    'type'          => 'radios',
                    'label'         => __('Style'),
                    'values'        => [
                        [
                            'value'   => 'style_1',
                            'name' => __("Style 1")
                        ],
                        [
                            'value'   => 'style_2',
                            'name' => __("Style 2")
                        ],
                        [
                            'value'   => 'style_3',
                            'name' => __("Style 3")
                        ],
                        [
                            'value'   => 'style_4',
                            'name' => __("Style 4")
                        ],
                        [
                            'value'   => 'style_5',
                            'name' => __("Style 5")
                        ],
                        [
                            'value'   => 'style_6',
                            'name' => __("Style 6")
                        ],
                        [
                            'value'   => 'style_7',
                            'name' => __("Style 7")
                        ],
                        [
                            'value'   => 'style_8',
                            'name' => __("Style 8")
                        ],
                        [
                            'value'   => 'style_9',
                            'name' => __("Style 9")
                        ],
                        [
                            'value'   => 'style_10',
                            'name' => __("Style 10")
                        ]
                    ]
                ],
                [
                    'id'            => 'service_type',
                    'type'          => 'checklist',
                    'listBox'          => 'true',
                    'label'         => "<strong>".__('Service Type')."</strong>",
                    'values'        => $list_service,
                ],
                [
                    'id'        => 'title',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Title')
                ],
                [
                    'id'        => 'desc',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Desc')
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
                    'label'        => __('List Airport by IDs'),
                    'select2'      => [
                        'ajax'     => [
                            'url'      => route('airport.admin.getForSelect2'),
                            'dataType' => 'json'
                        ],
                        'width'    => '100%',
                        'multiple' => "true",
                    ],
                    'pre_selected' => route('airport.admin.getForSelect2', [
                        'pre_selected' => 1
                    ])
                ],
                [
                    'type'=> "checkbox",
                    'label'=>__("Link to airport detail page?"),
                    'id'=> "to_airport_detail",
                    'default'=>false,
                    'conditions' => ['layout' => ['style_1','style_2','style_3','style_4','style_6','style_7','style_9','style_10']]
                ],
                [
                    'id'        => 'view_all_url',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('View All Url'),
                    'conditions'=> ["layout" => "style_1"]
                ],
            ],
            'category'=>__("Airport")
        ];
    }

    public function content($model = [])
    {
        

        $list = $this->query($model);


        $brandList = Terms::where("attr_id", 17)->get();

        
        $data = [
            'rows'         => $list,
            'brandList'         => $brandList,
            'title'        => $model['title'],
            'desc'         => $model['desc'] ?? "",
            'service_type' => $model['service_type'],
            'layout'       => !empty($model['layout']) ? $model['layout'] : "style_1",
            'to_airport_detail'=>$model['to_airport_detail'] ?? '',
            'view_all_url' => $model['view_all_url'] ?? ''
        ];
        return view('Airport::frontend.blocks.list-airports.index', $data);
    }

}
