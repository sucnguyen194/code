<div>
  <table align="center" cellpadding="0" cellspacing="0" style="background-color:#d4eefb;margin:auto;border-collapse:collapse;font-family:verdana;color:#222">
    <tbody>
      <tr>
        <td style="padding:20px 30px;width:auto"><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:white;margin:auto">
          <tbody>
            <tr>
              <td style="background-color:#00c0f1"><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%">
                <tbody>
                  <tr style="border:1px solid #b3e4fc">
                    <td style="width:80%;font-size:22px;font-family:arial;color:#ffffff;font-weight:bold;padding:25px 0 20px 20px"> Liên hệ từ khách hàng,<br></td>
                    <td style="padding-right:20px;width:50%"></td>
                  </tr>
                </tbody>
              </table></td>
            </tr>
            <tr style="border-left:1px solid #b3e4fc;border-right:1px solid #b3e4fc">
              <td height="5"></td>
            </tr>
            <tr style="border-left:1px solid #b3e4fc;border-right:1px solid #b3e4fc;border-bottom:1px solid #b3e4fc">
              <td><table cellpadding="0" cellspacing="0" style="border-collapse:collapse;font-size:12px">
                <tbody>
                  <tr>
                    <td style="padding-left:20px;padding-right:20px;padding-bottom:30px;font-family:verdana,arial;padding-top:10px"><h3>Thông tin liên hệ</h3>
                      <table>
                        <tbody>
                        @if(request()->has('data.name'))
                          <tr>
                            <td style="width:150px">Tên khách hàng: </td>
                            <td>{{request()->input('data.name')}}</td>
                          </tr>
                        @endif

                        @if(request()->has('data.email'))
                          <tr>
                            <td style="width:150px">Email: </td>
                            <td>{{request()->input('data.email')}}</td>
                          </tr>
                          @endif

                        @if(request()->has('data.phone'))
                          <tr>
                            <td style="width:150px">Số điện thoại: </td>
                            <td>{{request()->input('data.phone')}}</td>
                          </tr>
                          @endif

                        @if(request()->has('data.note'))
                          <tr>
                            <td style="width:150px">Lời nhắn: </td>
                            <td>{{request()->input('data.note')}}</td>
                          </tr>
                        @endif
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
              </td>
            </tr>
            <tr>
              <td style="padding:5px; font-size: 11px">Website: <a href="{{route('home')}}" target="_blank">{{setting('site.name.'.session('lang'))}} </td>
              </tr>
            </tbody>
          </table></td>
        </tr>
      </tbody>
    </table>
    <div class="yj6qo"></div>
    <div class="adL"> </div>
  </div>