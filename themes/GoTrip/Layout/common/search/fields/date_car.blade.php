<div class="searchMenu-date form-date-search-hotel position-relative item">
    
    <div class="car_pick_time d-flex">

        <div class="time_picker_single_part">
            <h4 class="text-15 fw-500 ls-2 lh-16">{{ $field['title'] }}</h4>
            <div class="time_date_picker_form">
                <div class="date-wrapper">
                    <div class="fvy_date_picker_area">
                        <div class="fvy_date_picker" data-x-dd-click="searchMenu-date">
                            <span class="js-first-date render check-in-render">{{Request::query('start',display_date(strtotime("today")))}}</span>
                        </div>
                    
                    </div>
                </div>
    
                <div class="fvy_date_picker_time">
                    <span class="js-first-date render check-in-render-">12:PM</span>
                </div>
            </div>
        </div>
    





        <div class="time_picker_single_part">
            <h4 class="text-15 fw-500 ls-2 lh-16">{{ $field['title'] }}</h4>
            <div class="time_date_picker_form">
                <div class="date-wrapper">
                    
                    <div class="fvy_date_picker_area">
                        <div class="fvy_date_picker" data-x-dd-click="searchMenu-date">
                            <span class="js-last-date render check-out-render">{{Request::query('end',display_date(strtotime("+1 day")))}}</span>
                        </div>
                    
                    </div>
                </div>

                <div class="fvy_date_picker_time">
                    <span class="js-first-date render check-in-render-">12:PM</span>
                </div>
            </div>
        </div>



    </div>



    <input type="hidden" class="check-in-input" value="{{Request::query('start',display_date(strtotime("today")))}}" name="start">
    <input type="hidden" class="check-out-input" value="{{Request::query('end',display_date(strtotime("+1 day")))}}" name="end">
    <input type="text" class="check-in-out absolute invisible" name="date" value="{{Request::query('date',date("Y-m-d")." - ".date("Y-m-d",strtotime("+1 day")))}}">
</div>
