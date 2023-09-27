function changeColor(event) {
    if(event.value === "WARM") {
        document.documentElement.setAttribute("data-theme", event.id);
    }
    else {
        document.documentElement.setAttribute("data-theme", event.id);
    }
}