@if(Request::is('/'))
    <div class="fixed_menu_bottom_cont">
        <div class="fixed_menu_bottom">
            <div class="box-submit"><a href="#" class="large_bt"
                    name="search engine"><span>Search Car/Villa</span><i class="fa fa-search"></i></a></div>
            <div class="Whatsapp_cont">
                <a hdata-tipo="linkwhatsapp" href="#"
                    target="_blank" rel="external noopener" name="Whatsapp" title="Whatsapp" style="margin-left:auto;"
                    onclick="$wc_leads.track.event('Lead','Click','Whatsapp click');"><span>Whatsapp</span><i
                        class="whatsapp_button"></i></a>
            </div>
        </div>

    </div>
@endif