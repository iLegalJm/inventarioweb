import "./bootstrap";
import "datatables.net-buttons/js/buttons.html5.mjs";
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
