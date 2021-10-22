<div style="width:350px!important">
    <h2><strong>Đơn hàng mới</strong></h2>
    <hr>
    <strong>Thông tin khách hàng</strong>
    <hr>
    <p>Tên khách hàng: {{$name}}</p>
    <p>Số điện thoại: {{$phone}}</p>
    <p>Email: {{$email}}</p>
    <hr>
    <strong>Thông tin đơn hàng</strong>

    <div class="thontindonhang" id="mydiv">
        <table border="0" width="100%" class="tblSkin table-responsive" style="border:unset; line-height: 30px">
            <tbody>
            <tr class="tblSkinHeader" style="border-bottom: 1px solid">
                <td style="border:none"><strong>Tên sản phẩm</strong></td>
                <td align="center" style="border:none"><strong>SL</strong></td>
                <td align="center" style="border:none"><strong>Đ.giá</strong></td>
                <td align="center" style="border:none"><strong>T.tiền</strong></td>
            </tr>
            @foreach($orders as $k=>$item)
                <tr class="tblSkinRow" id="671529g0" style="border-bottom: 1px solid">
                    <td style="border:none">
                        <div class="right_Option_card">
                            <strong class="orderName">{{$item->name}}</strong>
                        </div>
                    </td>
                    <td style="border:none" align="center"> {{$item->qty}}</td>
                    <td align="center" style="width: 65px;border:none">{{$item->price}}</td>
                    <td align="center" style="width: 65px;border:none"><span id="total_t_671529">{{$item->price*$item->qty}}</span></td>
                </tr>
            @endforeach
            <tr class="tblSkinRow">
                <td align="left" colspan="2" style="border:none"><span class="totalmoney">Tổng tiền</span></td>
                <td align="right" colspan="2" style="border:none"><span id="lblTotalPriceShopCart"><span id="lblTotalPrice" >{{Cart::total()}} </span></span></td>
            </tr>
            </tbody>
        </table>
    </div>
    <hr>
    <p><strong>Tổng tiền: {{number_format($total)}} </strong></p>
</div>
