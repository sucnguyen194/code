! function (t) {
    "use strict";
    t("#tooltip-hover").tooltipster(),
    t("#tooltip-hover-session").tooltipster(),
        t("#tooltip-events").tooltipster({
        trigger: "click"
    }), t("#tooltip-html").tooltipster({
        content: t('<p style="text-align:left;"><strong>SoufflÃ© chocolate cake powder.</strong> Applicake lollipop oat cake gingerbread.</p>'),
        minWidth: 300,
        maxWidth: 300,
        position: "right"
    }), t("#tooltip-touch").tooltipster({
        touchDevices: !1
    }), t("#tooltip-animation").tooltipster({
        animation: "grow"
    }), t("#tooltip-interaction").tooltipster({
        contentAsHTML: !0,
        interactive: !0
    }), t("#tooltip-multiple").tooltipster({
        animation: "swing",
        content: "North",
        multiple: !0,
        position: "top"
    }), t("#tooltip-multiple").tooltipster({
        content: "East",
        multiple: !0,
        position: "right"
    }), t("#tooltip-multiple").tooltipster({
        animation: "grow",
        content: "South",
        delay: 200,
        multiple: !0,
        position: "bottom"
    }), t("#tooltip-multiple").tooltipster({
        animation: "fall",
        content: "West",
        multiple: !0,
        position: "left"
    })
}(jQuery);
