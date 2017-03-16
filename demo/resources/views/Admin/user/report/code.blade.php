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
                        {{trans('user.date_created')}}
                    </td>				
                    <td>
                        {{$point['created_at']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.code')}}
                    </td>				
                    <td>
                        {{$point['code']}}
                    </td>
                </tr>
                <tr>
                    <td>
                        {{trans('user.status')}}
                    </td>				
                    <td>
                        {{$status_code[$point['status']]}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">{{trans('user.close')}}</button>
</div>