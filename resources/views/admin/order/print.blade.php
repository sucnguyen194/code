<div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="xacnhandondang" id="detailPrintOrder">
                    <div class="CssBillPaperSize"
                         style="background-color:white; padding-left:4px;padding-right:4px; margin-left:0px; font-family:tahoma;line-height: 18px;">
                        <div class="CssPrintRow"
                             style="text-align:center;font-weight:bold;font-size:16px; margin-bottom: 15px">{{setting('site.name', 1)}}</div>
                        <div class="CssPrintRow" style="font-size: 13px;">{!! setting('contact.detail') !!}</div>
                        <div style="text-align:center">-----------------------------------</div>
                        <div
                            style="font-weight:bold;font-size:16px;text-align:center;text-transform: uppercase">
                            Hóa đơn xuất bán
                        </div>
                        <div class="CssPrintRow" style="padding: 2px 0;font-size: 13px;">Ngày giờ: {{date('d/m/Y H:i:s', time())}}
                        </div>
                        <div class="CssPrintRow" style="padding: 2px 0;font-size: 13px;">Thu Ngân: Quản
                            trị {{setting('site.name', 1)}}</div>
                         <div class="CssPrintRow">Số phiếu: #XBA.2021.1084</div>
                        <div class="CssPrintRow" style="padding: 2px 0 4px 0;font-size: 13px;">Khách hàng: {{$order->name}} <span>- {{$order->phone}}</span> <span>- {{$order->address}}</span>
                        </div>
                        <div class="CssBillDetail">
                            <table class="table table-bordered"
                                   style="width: 100%;font-size:12px;line-height: 18px;">
                                <tbody>
                                <tr>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">Tên
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">SL
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">
                                        Đ.giá
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">
                                        T.tiền
                                    </th>
                                </tr>

                                @foreach(json_decode($order->content) as $item)
                                <tr>
                                    <th nowrap=""
                                        style="padding-right:4px;border-bottom:dotted 1px black; white-space: normal;word-break: break-all; width: 250px">
                                        {{$item->name}}
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">
                                        {{$item->qty}}
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">
                                        {{number_format($item->price)}}
                                    </th>
                                    <th nowrap="" style="padding-right:4px;border-bottom:dotted 1px black">
                                        {{number_format($item->price * $item->qty)}}
                                    </th>
                                </tr>
                                @endforeach
                                <tr>
                                    <td nowrap="" colspan="3" class="CssNoLine" style="font-weight: bold">Tổng
                                        cộng
                                    </td>
                                    <td nowrap="" class="CssNoLine" style="font-weight: bold">
                                        {{number_format($order->total)}}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="CssNoLine" colspan="3" style="font-weight: bold">Phải trả:</td>
                                    <td class="CssNoLine" style=" font-weight: bold">{{number_format($order->total)}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="CssNoLine" colspan="4"><span
                                            style="font-style: italic; font-weight: bold">Bằng chữ:  <span class="read-total"></span> </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="CssBillDetail" style="font-size: 12px">
                            <strong>* Ghi chú:
                                <div style="padding-left: 15px"></div>
                            </strong>
                        </div>
                        <div style="font-style:italic; margin-top:10px;text-align:center; font-size: 13px">Khách
                            hàng vui lòng kiểm tra kĩ, hàng đã thanh toán, ra khỏi cửa hàng, cửa hàng không chịu trách
                            nhiệm!
                        </div>
                        <div style="margin-top:10px;text-align:center; font-size: 13px">Xin cảm ơn Quý khách!
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span
                        class="icon-button"><i class="fe-arrow-left"></i></span> Quay lại
                </button>

                <button type="button" class="btn btn-purple waves-effect waves-light"
                        onclick="PrintElem('#detailPrintOrder')"><span class="icon-button"><i
                            class="pe-7s-print"></i></span> In đơn hàng
                </button>
            </div>
        </div>
</div>

<script>
    let total = {{$order->total}};
    $('.read-total').html(DocTienBangChu(total));


    function DocSo3ChuSo(baso)
    {
        var ChuSo =new Array(" không"," một"," hai"," ba"," bốn"," năm"," sáu"," bảy"," tám"," chín");

        var tram;
        var chuc;
        var donvi;
        var KetQua= "";
        tram=parseInt(baso/100);
        chuc=parseInt((baso%100)/10);
        donvi=baso%10;
        if(tram==0 && chuc==0 && donvi==0) return "";
        if(tram!=0)
        {
            KetQua += ChuSo[tram] + " trăm";
            if ((chuc == 0) && (donvi != 0)) KetQua += " linh";
        }
        if (chuc != 0 && chuc != 1)
        {
            KetQua += ChuSo[chuc] + " mươi";
            if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh";
        }
        if (chuc == 1) KetQua += " mười";
        switch (donvi)
        {
            case 1:
                if ((chuc != 0) && (chuc != 1))
                {
                    KetQua += " mốt ";
                }
                else
                {
                    KetQua += ChuSo[donvi];
                }
                break;
            case 5:
                if (chuc == 0)
                {
                    KetQua += ChuSo[donvi];
                }
                else
                {
                    KetQua += " lăm ";
                }
                break;
            default:
                if (donvi != 0)
                {
                    KetQua += ChuSo[donvi];
                }
                break;
        }
        return KetQua;
    }

    function DocTienBangChu(SoTien)
    {
        var Tien =new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");
        var lan=0;
        var i=0;
        var so=0;
        var KetQua="";
        var tmp="";
        var ViTri = new Array();
        if(SoTien<0) return "Số tiền âm !";
        if(SoTien==0) return "Không đồng !";
        if(SoTien>0)
        {
            so=SoTien;
        }
        else
        {
            so = -SoTien;
        }
        if (SoTien > 8999999999999999)
        {
            //SoTien = 0;
            return "Số quá lớn!";
        }
        ViTri[5] = Math.floor(so / 1000000000000000);
        if(isNaN(ViTri[5]))
            ViTri[5] = "0";
        so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
        ViTri[4] = Math.floor(so / 1000000000000);
        if(isNaN(ViTri[4]))
            ViTri[4] = "0";
        so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
        ViTri[3] = Math.floor(so / 1000000000);
        if(isNaN(ViTri[3]))
            ViTri[3] = "0";
        so = so - parseFloat(ViTri[3].toString()) * 1000000000;
        ViTri[2] = parseInt(so / 1000000);
        if(isNaN(ViTri[2]))
            ViTri[2] = "0";
        ViTri[1] = parseInt((so % 1000000) / 1000);
        if(isNaN(ViTri[1]))
            ViTri[1] = "0";
        ViTri[0] = parseInt(so % 1000);
        if(isNaN(ViTri[0]))
            ViTri[0] = "0";
        if (ViTri[5] > 0)
        {
            lan = 5;
        }
        else if (ViTri[4] > 0)
        {
            lan = 4;
        }
        else if (ViTri[3] > 0)
        {
            lan = 3;
        }
        else if (ViTri[2] > 0)
        {
            lan = 2;
        }
        else if (ViTri[1] > 0)
        {
            lan = 1;
        }
        else
        {
            lan = 0;
        }
        for (i = lan; i >= 0; i--)
        {
            tmp = DocSo3ChuSo(ViTri[i]);
            KetQua += tmp;
            if (ViTri[i] > 0) KetQua += Tien[i];
            if ((i > 0) && (tmp.length > 0)) KetQua += ' ';//&& (!string.IsNullOrEmpty(tmp))
        }
        if (KetQua.substring(KetQua.length - 1) == ' ')
        {
            KetQua = KetQua.substring(0, KetQua.length - 1);
        }
        KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
        return KetQua + ' đồng';//.substring(0, 1);//.toUpperCase();// + KetQua.substring(1);

    }

</script>


<style type="text/css">
    @media all {
        .page-break {
            display: none;
            page-break-before: avoid;
        }
    }

    @media print {
        .page-break {
            display: none;
            page-break-before: avoid;
        }
    }

    @page {
        margin: 0mm;
        padding: 0px;
        font-size: 14px
    }

    @page :first {
        margin-top: 0cm /* Top margin on first page 10cm */
    }

</style>
