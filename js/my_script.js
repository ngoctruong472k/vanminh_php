function isEmpty(o, t) {
    return "" != o ? !1 : ("undefined" != typeof t && alert(t), !0)
}
function isPhone(o, t) {
    return (o.length==10 && (o.substr(0,2)==8)) || (o.length==10 && (o.substr(0,2)==9)) || (o.length==10 && (o.substr(0,2)==7)) || (o.length==10 && (o.substr(0,2)==5)) || (o.length==10 && (o.substr(0,2)==3)) ? !1 : ("undefined" != typeof t && alert(t), !0)
}
function isEmail(o, t) {
    return emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/, emailRegExp.test(o) ? !1 : ("undefined" != typeof t && alert(t), !0)
}

function isSpace(o, t) {
    for (var p = 0; p < o.length; p++)
        if (" " == o.charAt(p)) return "undefined" != typeof t && alert(t), !0;
    return !1
}

function isCharacters(o, t) {
    if ("" == o) return !1;
    var p = /^[a-zA-Z0-9-]+$/;
    return p.test(o) ? !1 : ("undefined" != typeof t && alert(t), !0)
}

function isRepassword(o, t, p) {
    return "" == t ? !1 : o == t ? !1 : ("undefined" != typeof p && alert(p), !0)
}

function isCharacterlimit(o, t, p, e) {
    return "" == o ? !1 : (p = parseInt(p), e = parseInt(e), o.length >= p && o.length <= e ? !1 : ("undefined" != typeof t && alert(t), !0))
}

function add_popup(o) {
    $("body").append('<div class="login-popup"><div class="close-popup">x</div><div class="popup_thongbao"><p class="tieude_tb">Thông báo</p><p class="popup_kq">' + o + "</p></div></div>"), $(".thongbao").html(""), $(".login-popup").fadeIn(300), $(".login-popup").width($(".popup_thongbao").width() + "px");
    var t = $(".login-popup").width() / 2;
    return $(".login-popup").css({
        width: $(".popup_thongbao").width() + "px",
        "margin-left": -t,
        top: "-100px"
    }), $(".login-popup").animate({
        top: "100px"
    }, 500), $("body").append('<div id="baophu"></div>'), $("#baophu").fadeIn(300), !1
}
$(document).ready(function() {
    function o() {
        try {
            $.browserSelector(), $("html").hasClass("chrome") && $.smoothScroll()
        } catch (o) {}
    }
    setTimeout(function() {
        $("#pre-loader").fadeOut(1e3)
    }, 400), $("body").append('<div id="toptop" title="Lên đầu trang">Back to Top</div>'), $(window).scroll(function() {
        0 != $(window).scrollTop() ? $("#toptop").fadeIn() : $("#toptop").fadeOut()
    }), $("#toptop").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 500)
    }), o(), $("#baophu, .close-popup").live("click", function() {
        $("#baophu, .login-popup").fadeOut(300, function() {
            $("#baophu").remove(), $(".login-popup").remove()
        })
    })
});