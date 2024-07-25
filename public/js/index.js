let toolbarsOptions = [
    // text style
    ["bold", "italic", "underline", "strike"],
    // text size
    [{ size: ["small", "normal", "large", "Huge"] }],
    // list
    [{ list: "ordered" }, { list: "bullet" }],
    // alignment
    [{ align: [] }],
    // header
    [{ header: [1, 2, 3, 4, 5, 6, false] }],
    // images
    ["image"],
];

let quill = new Quill("#editor", {
    debug: "info",
    modules: {
        toolbar: toolbarsOptions,
    },
    placeholder: "Buat Pengaduan Anda Disini..",
    theme: "snow",
});
