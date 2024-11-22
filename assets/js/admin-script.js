jQuery(document).ready(function ($) {
    var mediaUploader;

    $("#custom_cursor_upload_button").click(function (e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: "Select Cursor Image",
            button: {
                text: "Use this image",
            },
            multiple: false,
            library: {
                type: "image", // Only allow images
            },
        });

        mediaUploader.on("select", function () {
            var attachment = mediaUploader.state().get("selection").first().toJSON();
            $("#custom_cursor_image").val(attachment.url);
            $("#custom_cursor_preview").html('<img src="' + attachment.url + '" style="max-width: 200px; height: auto;">');
        });

        mediaUploader.open();
    });

    $("#custom_cursor_remove_button").click(function () {
        $("#custom_cursor_image").val("");
        $("#custom_cursor_preview").html("");
    });
});
