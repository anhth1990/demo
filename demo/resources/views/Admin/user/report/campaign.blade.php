<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">{{trans("user.view_detail_point")}}</h4>
</div>
<div class="modal-body">
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr>
                    <th>
                        DDD
                    </th>
                    <th>
                        XXXX
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {{trans('user.config_using_order')}}
                    </td>				
                    <td>
                        {{$name_config}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.config_using')}}
                    </td>				
                    <td>
                        {{$type_config[$config['scoring']]}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.price_point')}}
                    </td>				
                    <td>
                        {{number_format($config['block'])}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">{{trans('user.close')}}</button>
</div>