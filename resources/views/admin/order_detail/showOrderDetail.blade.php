@extends('.admin.layouts.master')
@section('custom_style')
    <style>
        @yield('custom_style_level_2')
        .table_header {
            position: relative;
        }

        .container {
            margin-top: 30px;
            margin-left: 100px;
        }

    </style>
@endsection

@section('main_content')
    <h2 class="panel-title">Chi tiết đơn hàng</h2>
    @if(session('message'))
        <div class="alert alert-success alert-dismissible" style="margin-top: 10px">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success </strong>{{session('message')}}
        </div>
    @endif
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3><b>Địa chỉ nhận hàng:</b></h3>
                <div class="col-lg-12 p-0">
                    <p><strong>Họ và tên người dùng:</strong> {{$order->ship_name}}</p>
                    <p><strong>Số điện thoại:</strong> {{$order->ship_phone}}</p>
                    <p><strong>Email:</strong> {{$order->ship_email}}</p>
                    <p><strong>Địa chỉ:</strong> {{$order->ship_address}}</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3><b>Thông tin vận chuyển</b></h3>
                <div class="col-lg-12 p-0">
                    <p><strong>Phương thức vận chuyển:</strong> COD</p>
                    <p><strong>Đơn vị vận chuyển:</strong> GRAB</p>
                    <p><strong>Trạng thái đơn hàng:</strong> @if($order->status == \App\Enums\OrderStatus::Create)
                            Chờ lấy hàng
                        @elseif($order->status == \App\Enums\OrderStatus::Delivery)
                            Đang giao hàng
                        @elseif($order->status == \App\Enums\OrderStatus::Complete)
                            Đã nhận hàng
                        @elseif($order->status == \App\Enums\OrderStatus::Cancel)
                            Đã hủy đơn hàng
                        @endif</p>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center" style="display: flex">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3><b>Thông tin đặt hàng</b></h3>
                <div class="col-lg-12 p-0">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Màu</th>
                            <th>Ảnh</th>
                            <th>Cấu hình</th>
                            <th>Giá/sản phẩm (vnđ)</th>
                            <th>Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_details as $order_detail)
                            <tr>
                                <td>{{\App\Models\Product::find($order_detail->product_option->product_id)->name}}</td>
                                <td>{{\App\Models\Color::find($order_detail->product_option->color_id)->name}}</td>
                                <td><img src="{{$order_detail->product_option->thumbnail}}" alt="" width="50%"></td>
                                <td>{{$order_detail->product_option->ram}}GB/RAM
                                    - {{$order_detail->product_option->rom}}GB/ROM
                                </td>
                                <td>{{number_format($order_detail->unit_price)}} vnđ</td>
                                <td>{{$order_detail->quantity}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <h3><b>Chi tiết đơn hàng</b></h3>
                <div class="col-lg-5 ">
                    <p><strong>Tổng tiền hàng: </strong>{{number_format($order->total_price)}} vnđ</p>
                    <p><strong>Mã đơn hàng: </strong>#{{$order->order_code}}</p>
{{--                    <p><strong>Ngày tạo: </strong>{{$order_detail->created_at}}</p>--}}
                    <p><strong>Thanh toán: </strong>{{$order->is_checkout == \App\Enums\CheckoutStatus::UNPAID ? 'Chưa thanh toán' : 'Đã thanh toán'}}</p>
                </div>
            </div>
        </div>
      <div class="trangthai col-md-9">
          <form action="{{route('update_status_order',$order->id)}}" method="post">
              @csrf
             <div class="row">
                 <div class="form-group col-md-4">
                     <label for=""><b>Trạng thái đơn hàng:</b></label>
                     <select class="form-control"  name="order_status" id="trangthaidonhang">
                         <option {{$order_status == \App\Enums\OrderStatus::Create? 'selected': ''}} value="{{\App\Enums\OrderStatus::Create}}">Chờ lấy hàng</option>
                         <option {{$order_status == \App\Enums\OrderStatus::Delivery? 'selected': ''}} value="{{\App\Enums\OrderStatus::Delivery}}">Đang giao hàng</option>
                         <option {{$order_status == \App\Enums\OrderStatus::Complete? 'selected': ''}} value="{{\App\Enums\OrderStatus::Complete}}">Đã nhận hàng</option>
                         <option {{$order_status == \App\Enums\OrderStatus::Cancel? 'selected': ''}} value="{{\App\Enums\OrderStatus::Cancel}}">Đã hủy đơn hàng</option>
                     </select>
                 </div>
                 <div class="form-group col-md-4">
                     <label for="trangthaithanhtoan"><b>Trạng thái thanh toán:</b></label>
                     <select class="form-control"  name="is_checkout" id="trangthaithanhtoan">
                         <option {{$pay_status == \App\Enums\CheckoutStatus::UNPAID ? 'selected' : ''}} value="{{\App\Enums\CheckoutStatus::UNPAID}}">Chưa thanh toán</option>
                         <option {{$pay_status == \App\Enums\CheckoutStatus::PAID ? 'selected' : ''}} value="{{\App\Enums\CheckoutStatus::PAID}}">Đã thanh toán</option>
                     </select>
                 </div>
                 <label for="">.</label>
                 <div class="form-group col-md-4"><button type="submit" class="btn btn-primary form-control update">Cập nhật</button></div>
             </div>
          </form>
      </div>
    </div>
    <a href="/admin/order" class="cd-top btn btn-primary"><i class="fa fa-long-arrow-left"></i> Trở về</a>
@endsection
@section('custom_js')
    <script>
        $('.sorted').change(function () {
            $('.form_filter').submit()
        })
        $('.sorted2').change(function () {
            $('.form_filter2').submit()
        })

        $('.btn_show_video').click(function () {
            $('.show_video').attr('src', this.slot)
        })
        $('.close_video').click(function () {
            $('.show_video').attr('src', '')
        })

        function changeStatus(id) {
            var perPage = window.location.href.split("/")[4];
            var page = perPage.split('?')[0]
            var protocol = window.location.protocol
            var host = window.location.hostname
            var port = window.location.port
            var url = protocol + '//' + host + ':' + port
            $.get(`${url}/admin/${page}/update-status/${id}`, function (data) {
            });
        }
    </script>
    @yield('Extra_JS')
@endsection
