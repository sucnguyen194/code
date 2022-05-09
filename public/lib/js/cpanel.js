function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).html()).select();
    document.execCommand("copy");
    $temp.remove();
    flash({'message': 'Coppy link ảnh thành công!', 'type': 'success'});
}

function nl2br (str, replaceMode, isXhtml) {

    var breakTag = (isXhtml) ? '<br />' : '<br>';
    var replaceStr = (replaceMode) ? '$1'+ breakTag : '$1'+ breakTag +'$2';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, replaceStr);
}

function toogleMenuQuick() {
    $(".menuquick .lst").hasClass("hide") ? ($(".menuquick .lst").removeClass("hide"), $(".menuquick label").removeClass("tg")) : ($(".menuquick .lst").addClass("hide"), $(".menuquick label").addClass("tg"))
}

function genMenuDetail() {
    var n, t, i;
    $(".body-contents").length > 0 && $(".body-contents>h3").length > 1 && (n = "<div class='menuquick'>", n += "<label onclick='toogleMenuQuick()'>Xem nhanh<\/label>", t = 1, i = 1, n += "<ul class='lst'>", $(".body-contents").children().each(function () {
        var f = $(this).parent().attr("class"), u, r;
        f !== "infor" && ($(this).is("h3") || $(this).is("h4")) && (u = $(this).text(), $(this).is("h3") ? ($(this).prop("id", "hmenuid" + t), n += "<a href='#hmenuid" + t + "'>" + u + "<\/a>", t += 1) : (r = u, r.startsWith("-") && (r = r.replace("-", "").trim()), $(this).prop("id", "subhmenuid" + i), n += '<li class="SubQuickMenu"><a  href=\'#subhmenuid' + i + "'>" + r + "<\/a><\/li>", i += 1))
    }), n += "<\/ul>", n += "<\/div>", n += '<div class="list-faq list-scroll">', n += '<div class="middle">', n += '<div class="btn-faq sticky">', n += '<span class="stickyname">Xem nhanh<\/span>', n += '<span class="stickytitle"><\/span>', n += '<b class="collapse"><\/b>', n += "<\/div>", n += "<div class='list-item-fast-view'>", n += "<div class='lst-fast-view'>", t = 1, i = 1, $(".body-contents").children().each(function () {
        var u = $(this).parent().attr("class"), r;
        u !== "infor" && ($(this).is("h3") || $(this).is("h4")) && (r = $(this).text(), $(this).is("h3") ? (n += "<a href='#hmenuid" + t + "' data-id='#hmenuid" + t + "' data-name='" + r + "'>" + r + "<\/a>", t += 1) : (n += "<a href='#subhmenuid" + i + "'>" + r + "<\/a>", i += 1))
    }), n += "<\/div>", n += "<\/div>", n += "<\/div>", $(".body-contents h2").first().after(n))
}

function printInvoice(invoice) {
    var printContents = document.getElementById(invoice).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

function number_format(int){
    if(int > 999 || int < - 999){
        return int.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }else{
        return int;
    }
}

function flash(obj){

    if(obj.hasOwnProperty('errors')){
        $.each( obj.errors, function( key, value ) {
            toastr['error'](value);
        });
    }else if(obj.type){

        toastr[obj.type](obj.message);
    }else if(obj.message){
        toastr['error'](obj.message);
    }else
        toastr['warning']('Đã có lỗi xảy ra');

    if (obj.hasOwnProperty('url') && (obj.url!=null && obj.url!='')){
        window.open(obj.url, obj.target)
    }

}

function changeSeo(){
    $('.change-seo').slideToggle();
}

$(document).ready(function(){

    genMenuDetail();

    $('.change-seo').hide();

    if($('.summerdescription').length){
        tinymce.init({
            language : language,
            plugins: "wordcount textcolor code preview image  link  anchor   charmap media  lists responsivefilemanager",
            toolbar: [
                'preview code | fontsizeselect | fontselect  | bold italic underline strikethrough  | alignleft aligncenter alignright alignjustify | removeformat',
            ],

            height : "150",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],
            relative_urls: false,
            selector: ".summerdescription",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links+"/lib/filemanager/",
            external_plugins: {"filemanager": links+"/lib/filemanager/plugin.min.js"}
        });
    }
});
$(document).ready(function(){
    if($('.summernote').length){
        tinymce.init({
            language : language,
            plugins: "wordcount textcolor image link hr preview anchor code insertdatetime charmap media table print lists responsivefilemanager",
            toolbar: [
                'preview code | styleselect | fontselect  | bold italic underline strikethrough subscript superscript charmap | anchor link unlink image media | forecolor backcolor | cut copy paste | alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | removeformat | undo redo | fontsizeselect | hr insertdatetime print | newdocument | responsivefilemanager',
            ],
            height : "500",
            menubar: true,
            wordcount_countregex: /[\w\u2019\x27\-\u00C0-\u1FFF]+/g,
            wordcount_cleanregex: /[0-9.(),;:!?%#$?\x27\x22_+=\\\/\-]*/g,
            textcolor_cols: 6,
            textcolor_map: [
                'FFF', 'White', 'CCC', 'Light gray', '999', 'Gray2', '666', 'Gray3', '333', 'Dark gray', '000', 'Black',
                'F00', 'Red', '00F', 'Blue', '0F0', 'Green', 'F90', 'Orange', 'FF0', 'Yellow', '0FF', 'Cyan',
                'F0F', 'Magento', '930', 'Burnt orange', '330', 'Dark olive', '030', 'Dark green', '036', 'Dark azure'
            ],
            textcolor_rows: 5,
            fontsize_formats: "8px 9px 10px 11px 12px 13px 14px 15px 16px 17px 18px 19px 20px 22px 24px 26px 28px 30px 35px 40px 45px 50px",
            style_formats: [
                {title: "Header 1", format: "h1"},
                {title: "Header 2", format: "h2"},
                {title: "Header 3", format: "h3"},
                {title: "Header 4", format: "h4"},
                {title: "Header 5", format: "h5"},
                {title: "Header 6", format: "h6"},
                {title: "Paragraph", format: "p"},
                {title: "Blockquote", format: "blockquote"},
                {title: "Div", format: "div"},
                {title: "Pre", format: "pre"}
            ],
            link_class_list: [
                {title: 'Geen', value: ''}
            ],
            table_class_list: [
                {title: 'Tabel', value: 'table'},
                {title: 'Table Style', value: 'table-style'}
            ],

            relative_urls: false,
            selector: ".summernote",
            image_advtab: true,
            filemanager_title: "Filemanager",
            external_filemanager_path: links + "/lib/filemanager/",
            external_plugins: {"filemanager": links + "/lib/filemanager/plugin.min.js"}
        });
    }
});
