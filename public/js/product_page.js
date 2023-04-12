
document.addEventListener("DOMContentLoaded", function(event) {

    let next_page = document.getElementById("next_page");
    let prev_page = document.getElementById("prev_page");
    let page_input = document.getElementById("page");
    let filter_form = document.getElementById("filter_form");


    if(next_page){
        next_page.addEventListener('click', function(e) {
            page_input.value = Number(page_input.value) + 1;
            filter_form.submit();
        }, false);
    }

    if(prev_page){
        prev_page.addEventListener('click', function(e) {
            page_input.value = Number(page_input.value) - 1;
            filter_form.submit();
        }, false);
    }
});
