@section('title','Danh sách đơn hàng | Admin')
@extends('.admin.layouts.table')
@section('title_table','Danh sách đơn hàng')
@section('custom_style_level_2')
    .Product_Action{
    min-width:120px;
    }
    #addToTable{
    display:none;
    }
@endsection
@section('option_filter')
    <div class="form-group col-sm-6" style="padding-left: 2px">
        <select name="status" id="" class="form-control sorted2">
            <option value="0">Trạng thái đơn hàng</option>
            <option {{$status == \App\Enums\OrderStatus::Create ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Create}}">Khởi tạo</option>
            <option {{$status == \App\Enums\OrderStatus::Delivery ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Delivery}}">Đang giao hàng</option>
            <option {{$status == \App\Enums\OrderStatus::Complete ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Complete}}">Hoàn thành</option>
            <option {{$status == \App\Enums\OrderStatus::Cancel ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Cancel}}">Đã hủy</option>
        </select>
    </div>
    <div class="form-group col-sm-6" style="padding-left: 2px">
        <select name="status" id="" class="form-control sorted2">
            <option value="0">Trạng thái thanh toán</option>
            <option {{$status == \App\Enums\OrderStatus::Create ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Create}}">Khởi tạo</option>
            <option {{$status == \App\Enums\OrderStatus::Delivery ?'selected' :'' }} value="{{\App\Enums\OrderStatus::Delivery}}">Đang giao hàng</option>
        </select>
    </div>
@endsection
@section('filter_form')
    <div class="form-group col-sm-5">
        <input value="{{$key_search}}" type="text" class="form-control" placeholder="Enter keyword" name="search">
    </div>
    <div class="form-group col-sm-4">
        <button class="btn btn-primary">Tìm kiếm</button>
        <button class="btn btn-danger">Loại bỏ bộ lọc</button>
    </div>
    <div class="form-group col-sm-3">
        <select name="sort" id="" class="form-control sorted">
            <option value="" hidden>Sắp xếp</option>
            <option {{$sort ==  \App\Enums\Sort::SORT_ID_ASC ? 'selected' : ''}} value="{{\App\Enums\Sort::SORT_ID_ASC}}">ID tăng dần</option>
            <option {{$sort ==  \App\Enums\Sort::SORT_ID_DESC ? 'selected' : ''}} value="{{\App\Enums\Sort::SORT_ID_DESC}}">ID giảm dần</option>
            <option {{$sort ==  \App\Enums\Sort::SORT_CREATED_AT_ASC ? 'selected' : ''}} value="{{\App\Enums\Sort::SORT_CREATED_AT_ASC}}">Cũ nhất trước</option>
            <option {{$sort ==  \App\Enums\Sort::SORT_CREATED_AT_DESC ? 'selected' : ''}} value="{{\App\Enums\Sort::SORT_CREATED_AT_DESC}}">Mới nhất trước</option>
        </select>
    </div>
@endsection

@section('extra_filter')
    <div style="height: 100px" class="col-md-12 row">
        <form action="" method="get" id="form_filter">
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="user_name" value="{{$user_name}}" placeholder="Tìm kiếm theo tên người nhận">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" value="{{$ship_address}}" name="ship_address" placeholder="Tìm kiếm theo địa chỉ">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" value="{{$order_code}}" name="order_code" placeholder="Tìm kiếm theo mã đơn hàng">
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" value="{{$user_phone}}" name="user_phone" placeholder="Tìm kiếm theo số điện thoại">
            </div>
            <div class="form-group col-md-3">
                <select name="date_filter" id="" class="form-control date_filter">
                    <option  value="" hidden>Lọc theo ngày</option>
                    <option {{$date_filter == 'now' ? 'selected' : ''}} value="now">Hôm nay</option>
                    <option {{$date_filter == '7day' ? 'selected' : ''}} value="7day">7 ngày gần đây</option>
                    <option {{$date_filter == '15day' ? 'selected' : ''}} value="15day">15 ngày gần đây</option>
                    <option {{$date_filter == '30day' ? 'selected' : ''}} value="30day">1 tháng gần đây</option>
                </select>
            </div>
            <div class="form-group col-md-3 row">
                <div class="col-md-3">
                    <label for="">Từ ngày</label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" placeholder="helo">
                </div>
            </div>
            <div class="form-group col-md-3 row">
                <div class="col-md-3">
                    <label for="">Đến ngày</label>
                </div>
                <div class="col-md-9">
                    <input type="date" class="form-control" placeholder="helo">
                </div>
            </div>


            <div class="form-group col-md-3 row m-0 p-0">
                <div class="col-md-6 form-group">
                    <button class="btn btn-primary form-control">Lọc</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('table_head')
    <tr>
        <th>Chọn</th>
        <th>Mã đơn hàng</th>
        <th>Tổng giá</th>
        <th>Họ và tên</th>
        <th>Số điện thoại</th>
        <th>Địa chỉ</th>
        <th>Trạng thái thanh toán</th>
        <th>Trạng thái đơn hàng</th>
        <th>Ngày tạo</th>
        <th>Thao tác</th>
    </tr>
@endsection
@section('table_body')
    @foreach($list as $item)
        <tr class="gradeX">
            <td>
                <input type="checkbox" class="checkbox_choice" value="{{$item->id}}">
            </td>
            <td># {{$item->order_code}}</td>
            <td>{{number_format($item->total_price)}} vnđ</td>
            <td>{{$item->ship_name}}</td>
            <td>{{$item->ship_phone}}</td>
            <td>{{$item->ship_address}}</td>
            <td>{{$item->is_checkout == \App\Enums\CheckoutStatus::UNPAID ? 'Chưa thanh toán' : 'Đã thanh toán'}}</td>
            <td>
                @if($item->status == \App\Enums\OrderStatus::Create)
                    Người dùng đã tạo đơn hàng
                @elseif($item->status == \App\Enums\OrderStatus::Delivery)
                    Cửa hàng đang giao hàng
                @elseif($item->status == \App\Enums\OrderStatus::Complete)
                    Người dùng đã nhận hàng
                @elseif($item->status == \App\Enums\OrderStatus::Cancel)
                    Người dùng đã hủy đơn hàng
                @endif
            </td>
            <td>{{date_format($item->created_at,'d/m/Y')}}</td>
            <td class="actions text-center">
                <a style="color: #4b74fa" href="/admin/order-detail/{{$item->id}}/show" class="on-default remove-row">Chi tiết</a>
            </td>
        </tr>
    @endforeach
    <div style="position: absolute;bottom: 20px">
        <p>Doanh thu : {{number_format($amount)}} vnđ</p>
        <span style="margin-right: 30px">Check all <input id="check_all" type="checkbox" style="transform: translateY(2px)"></span>
        <select name="order_status" id="order_status" style="width: 130px">
            <option hidden>Cập nhật đơn hàng</option>
            <option value="{{\App\Enums\OrderStatus::Cancel}}">Người dùng đã hủy đơn hàng</option>
            <option value="{{\App\Enums\OrderStatus::Complete}}">Người dùng đã nhận hàng</option>
            <option value="{{\App\Enums\OrderStatus::Delivery}}">Cửa hàng đang giao hàng</option>
            <option value="{{\App\Enums\OrderStatus::Create}}">Người dùng đã tạo đơn hàng</option>
        </select>
        <button class="btn btn-primary btn_submit" style="width: 120px">Apply</button>
        <form action="{{route('update_status')}}" id="form_update_status" method="post" style="width: 0;height: 0;overflow: hidden!important;">
            @csrf
            <div style="width: 0;height: 0;overflow: hidden!important;">
                <input type="text" name="array_id" id="array_id">
                <input type="text" name="desire" id="desire">
            </div>
        </form>
    </div>
@endsection

@section('Extra_JS')
    <script>
        document.addEventListener('DOMContentLoaded',function (){
            $('#check_all').change(function (){
                if ($(this).is(':checked')){
                    $('.checkbox_choice').prop( "checked", true )
                }else {
                    $('.checkbox_choice').prop( "checked", false )
                }
            })
            $('#order_status').change(function (){
                $('#desire').val(this.value)
            })
            $('.btn_submit').click(function (){
                var checkboxs = document.querySelectorAll('.checkbox_choice')
                var items = []
                for (let i = 0; i < checkboxs.length; i++) {
                    if(checkboxs[i].checked){
                        items.push(checkboxs[i].value)
                    }
                }
                $('#array_id').val(JSON.stringify(items))
                if ($('#desire').val() === ''){
                    alert('Vui lòng chọn thao tác để tiếp tục')
                }else {
                    $('#form_update_status').submit()
                }
            })
        })
        $('#is_member').change(function (){
            $('#form_filter').submit()
        })
        $('.date_filter').change(function (){
            $('#form_filter').submit()
        })
    </script>
@endsection


