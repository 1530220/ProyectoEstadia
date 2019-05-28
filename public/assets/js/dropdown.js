
$("#country").change(event =>{
    $.get(`/states/${event.target.value}`,function(res,country){
        $("#state").empty();
        res.forEach(element => {
            $("#state").append(`<option value=${element.id}> ${element.name} </option>`);
        });
    });
});


$("#state").change(event =>{
    $.get(`/cities/${event.target.value}`,function(res,state){
        $("#city").empty();
        res.forEach(element => {
            $("#city").append(`<option value=${element.id}> ${element.name} </option>`);
        });
    });
});
