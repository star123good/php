$(document).ready(function(){
    $(document).on("click", "button[type='submit']", function(event){
        event.preventDefault();
        alert("click");
    });
});