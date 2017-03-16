<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">{{trans("user.view")}}</h4>
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
                        {{trans('user.date_buys')}}
                    </td>				
                    <td>
                        {{date("d-m-Y",$order['date_buy'])}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.total_price')}}
                    </td>				
                    <td>
                        {{number_format($order['price'])}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.total_profit')}}
                    </td>				
                    <td>
                        {{number_format($order['profit'])}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.address_shop')}}
                    </td>				
                    <td>
                        {{$order['address_shop']}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">{{trans('user.close')}}</button>
</div>