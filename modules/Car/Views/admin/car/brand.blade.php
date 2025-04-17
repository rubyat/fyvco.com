<div class="panel">
    <div class="panel-title"><strong>{{__("Brand")}}</strong></div>
    <div class="panel-body">
        @if(is_default_lang())
            <div class="form-group">
                <label class="control-label">{{__("Brand")}}</label>
                @if(!empty($is_smart_search))
                    <div class="form-group-smart-search">
                        <div class="form-content">
                            <?php
                            $brand_name = "";
                            $list_json = [];
                            $traverse = function ($brands, $prefix = '') use (&$traverse, &$list_json , &$brand_name,$row) {
                                foreach ($brands as $brand) {
                                    $translate = $brand->translate();
                                    if ($row->brand_id == $brand->id){
                                        $brand_name = $translate->name;
                                    }
                                    $list_json[] = [
                                        'id' => $brand->id,
                                        'title' => $prefix . ' ' . $translate->name,
                                    ];
                                    $traverse($brand->children, $prefix . '-');
                                }
                            };
                            $traverse($car_brand);
                            ?>
                            <div class="smart-search">
                                <input type="text" class="smart-search-brand parent_text form-control" placeholder="{{__("-- Please Select --")}}" value="{{ $brand_name }}" data-onLoad="{{__("Loading...")}}"
                                       data-default="{{ json_encode($list_json) }}">
                                <input type="hidden" class="child_id" name="brand_id" value="{{$row->brand_id ?? Request::query('brand_id')}}">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="">
                        <select name="brand_id" class="form-control">
                            <option value="">{{__("-- Please Select --")}}</option>
                            <?php
                            $traverse = function ($brands, $prefix = '') use (&$traverse, $row) {
                                foreach ($brands as $brand) {
                                    $selected = '';
                                    if ($row->brand_id == $brand->id)
                                        $selected = 'selected';
                                    printf("<option value='%s' %s>%s</option>", $brand->id, $selected, $prefix . ' ' . $brand->name);
                                    $traverse($brand->children, $prefix . '-');
                                }
                            };
                            $traverse($car_brand);
                            ?>
                        </select>
                    </div>
                @endif
            </div>
        @endif


    </div>
</div>
