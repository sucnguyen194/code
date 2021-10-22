@extends('layouts.layout')
@section('title') Thanh toán @stop
@section('content')
    <div data-elementor-type="wp-page" data-elementor-id="99" class="elementor elementor-99" data-elementor-settings="[]">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <section class="elementor-section elementor-top-section elementor-element elementor-element-0418b39 elementor-section-full_width elementor-section-height-default elementor-section-height-default" data-id="0418b39" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-58d2676" data-id="58d2676" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-a838337 elementor-widget elementor-widget-heading" data-id="a838337" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <h1 class="elementor-heading-title elementor-size-default">Thanh toán</h1>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-f95f354 elementor-widget elementor-widget-woocommerce-breadcrumb" data-id="f95f354" data-element_type="widget" data-widget_type="woocommerce-breadcrumb.default">
                                            <div class="elementor-widget-container">
                                                <nav class="woocommerce-breadcrumb"><a href="/">Trang chủ</a>&nbsp;/&nbsp;Checkout</nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="elementor-section elementor-top-section elementor-element elementor-element-5c5ebec elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="5c5ebec" data-element_type="section">
                    <div class="elementor-container elementor-column-gap-no">
                        <div class="elementor-row">
                            <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-5b83a7d7" data-id="5b83a7d7" data-element_type="column">
                                <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                        <div class="elementor-element elementor-element-414c41a5 elementor-widget elementor-widget-text-editor" data-id="414c41a5" data-element_type="widget" data-widget_type="text-editor.default">
                                            <div class="elementor-widget-container">
                                                <div class="elementor-text-editor elementor-clearfix"><!-- wp:shortcode -->
                                                    <div class="woocommerce" v-if="carts.length == 0">
                                                        <div class="woocommerce-notices-wrapper"></div>
                                                        <p class="cart-empty woocommerce-info">Chưa có sản phẩm nào trong giỏ hàng.</p>	<p class="return-to-shop">
                                                            <a class="button wc-backward" href="/">
                                                                Quay trở lại cửa hàng		</a>
                                                        </p>
                                                    </div>
                                                    <div class="woocommerce" v-else>
                                                        <div class="woocommerce-notices-wrapper"></div>
                                                        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="/checkout" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col2-set" id="customer_details">
                                                                <div class="col-1">
                                                                    <div class="woocommerce-billing-fields">
                                                                        <h3>Thông tin thanh toán</h3>
                                                                        <div class="woocommerce-billing-fields__field-wrapper">
                                                                            <p class="form-row form-row-wide address-field validate-required" id="billing_first_name_field" data-priority="10">
                                                                                <label for="billing_first_name" class="">Họ & tên&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                                                <span class="woocommerce-input-wrapper">
                                      <input type="text" class="input-text " name="data[name]" id="billing_first_name" placeholder="Họ & tên khách hàng nhận hàng" value="{{auth()->user()->name ?? ""}}" autocomplete="given-name" required>
                                      </span></p>
                                                                            <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field" data-priority="50">
                                                                                <label for="billing_address_1" class="">Địa chỉ&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                                                <span class="woocommerce-input-wrapper">
                                      <input type="text" class="input-text " name="data[address]" id="billing_address_1" placeholder="Địa chỉ nhận hàng" value="{{auth()->user()->address ?? ""}}" autocomplete="address-line1" required>
                                      </span></p>
                                                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                                                <label for="billing_phone" class="">Số điện thoại&nbsp;<abbr class="required" title="bắt buộc">*</abbr></label>
                                                                                <span class="woocommerce-input-wrapper">
                                      <input type="tel" class="input-text " name="data[phone]" id="billing_phone" placeholder="Số điện thoại liên hệ" value="{{auth()->user()->phone ?? ""}}" autocomplete="tel" required>
                                      </span></p>
                                                                            <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
                                                                                <label for="billing_phone" class="">Ghi chú đơn hàng&nbsp;</label>
                                                                                <span class="woocommerce-input-wrapper">
                                      <textarea name="data[note]" class="input-text " id="order_comments" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="2" cols="5"></textarea>
                                      </span></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2">
                                                                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                                                            <thead>
                                                                            <tr>
                                                                                <th class="product-name">Sản phẩm</th>
                                                                                <th class="product-total">Tạm tính</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr class="cart_item" v-for="cart in carts">
                                                                                <td class="product-name"> @{{ cart.name }}&nbsp; <strong class="product-quantity">×&nbsp;@{{ cart.qty }}</strong></td>
                                                                                <td class="product-total"><span class="woocommerce-Price-amount amount">
                                      <bdi>@{{ number_format(cart.price * cart.qty) }}<span class="woocommerce-Price-currencySymbol">₫</span></bdi>
                                      </span></td>
                                                                            </tr>
                                                                            </tbody>
                                                                            <tfoot>
                                                                            <tr class="cart-subtotal">
                                                                                <th>Tạm tính</th>
                                                                                <td><span class="woocommerce-Price-amount amount">
                                      <bdi>@{{ cart.total }}<span class="woocommerce-Price-currencySymbol">₫</span></bdi>
                                      </span></td>
                                                                            </tr>
                                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                                <th>Giao hàng</th>
                                                                                <td data-title="Giao hàng"><ul id="shipping_method" class="woocommerce-shipping-methods">
                                                                                        <li>
                                                                                            <input type="hidden" name="shipping_method[0]" data-index="0" id="shipping_method_0_flat_rate2" value="flat_rate:2" class="shipping_method">
                                                                                            <label for="shipping_method_0_flat_rate2">Đồng giá</label>
                                                                                        </li>
                                                                                    </ul></td>
                                                                            </tr>
                                                                            <tr class="order-total">
                                                                                <th>Tổng</th>
                                                                                <td><strong><span class="woocommerce-Price-amount amount">
                                      <bdi>@{{ cart.total }}<span class="woocommerce-Price-currencySymbol">₫</span></bdi>
                                      </span></strong></td>
                                                                            </tr>
                                                                            </tfoot>
                                                                        </table>
                                                                        <div id="payment" class="woocommerce-checkout-payment">
                                                                            <ul class="wc_payment_methods payment_methods methods">
                                                                                <li class="wc_payment_method payment_method_cod">
                                                                                    <label for="payment_method_cod"> Trả tiền mặt khi nhận hàng </label>
                                                                                    <div class="payment_box payment_method_cod">
                                                                                        <p>Trả tiền mặt khi giao hàng</p>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="form-row place-order">
                                                                                <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Đặt hàng" data-value="Đặt hàng">Đặt hàng</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <!-- /wp:shortcode --></div>
                                            </div>
                                        </div>
                                        <div class="elementor-element elementor-element-d18f381 elementor-widget elementor-widget-heading" data-id="d18f381" data-element_type="widget" data-widget_type="heading.default">
                                            <div class="elementor-widget-container">
                                                <p class="elementor-heading-title elementor-size-default"><u>Lưu ý</u>: Quý khách vui lòng Click vào nút ĐẶT HÀNG để gửi đơn hàng cho {{setting()->company}}. Nhân viên công ty sẽ liên hệ lại để chốt đơn, xác nhận phương thức thanh toán và vận chuyển.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<script>
    $('body').addClass('page-template page-template-elementor_header_footer page page-id-99 theme-hello-elementor woocommerce-checkout woocommerce-page woocommerce-js translatepress-vi elementor-default elementor-template-full-width elementor-kit-10 elementor-page elementor-page-99');
</script>
@stop
