tinyMCE.init({
    mode: "textareas",
    width: "500px",
    height: "340px",
    theme_advanced_buttons3: "",
    theme_advanced_toolbar_align: "left",
    theme_advanced_toolbar_location: "top",
    plugins: [
        "advlist autolink lists link image charmap preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    entity_encoding: "raw",
    theme_advanced_buttons1_add: "forecolorpicker,fontsizeselect",
    theme_advanced_buttons2_add: "media",
    theme_advanced_disable: "styleselect",
    extended_valid_elements: "script[type|src|charset|defer]",
    relative_urls: false,
    remove_script_host: false,
    convert_urls: false,
    link_assume_external_targets: true
});