import Quill from "quill";
import "quill/dist/quill.snow.css";

const editor = document.querySelector("#description-editor");

if (editor) {
    const input = document.querySelector("#description");

    const quill = new Quill(editor, {
        theme: "snow",
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }],
                ["link"],
            ],
        },
    });

    if (input.value) {
        quill.root.innerHTML = input.value;
    }

    quill.on("text-change", () => {
        input.value = quill.root.innerHTML;
    });
}
