jQuery(document).ready(function ($) {
    // Append a custom cursor div to the body
    $("body").append('<div class="custom-cursor"></div>');
    var $cursor = $(".custom-cursor");

    // Define SVG styles
    const svgStyles = {
        circle: '<circle cx="50" cy="50" r="50" fill="' + cursorOptions.cursorColor + '"/>',
        triangle: '<polygon points="50,0 0,100 100,100" fill="' + cursorOptions.cursorColor + '"/>',
        star: '<polygon points="50,0 61,35 98,35 68,57 79,91 50,70 21,91 32,57 2,35 39,35" fill="' + cursorOptions.cursorColor + '"/>',
        square: '<rect x="10" y="10" width="80" height="80" fill="' + cursorOptions.cursorColor + '"/>',
        diamond: '<polygon points="50,0 100,50 50,100 0,50" fill="' + cursorOptions.cursorColor + '"/>',
        cross: '<path d="M45 0 H55 V45 H100 V55 H55 V100 H45 V55 H0 V45 H45 Z" fill="' + cursorOptions.cursorColor + '"/>',
    };

    // Set the cursor's SVG based on the selected style
    if (svgStyles[cursorOptions.cursorStyle]) {
        $cursor.html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" style="width: 100%; height: 100%;">' + svgStyles[cursorOptions.cursorStyle] + "</svg>");
    }

    // Apply size and position
    $cursor.css({
        width: cursorOptions.cursorSize + "px",
        height: cursorOptions.cursorSize + "px",
        position: "fixed",
        "pointer-events": "none",
        animation: "none", // No animation by default
    });

    $(document).on("mousemove", function (e) {
        const offsetX = cursorOptions.cursorSize / 2;
        const offsetY = cursorOptions.cursorSize / 2;

        $cursor.css({
            left: e.clientX - offsetX + "px",
            top: e.clientY - offsetY + "px",
        });
    });

    // Add continuous rotate effect on hover
    $("a, button, [data-hover], input[type='submit']").hover(
        function () {
            $cursor.css("animation", "cursor-rotate 1s linear infinite");
        },
        function () {
            $cursor.css("animation", "none");
        }
    );
});
