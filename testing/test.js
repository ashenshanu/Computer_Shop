// jsFile.js
$.ajax({
    url: "/backend/phpFile.php",
    type: "POST",
    data: { function_name: "function_to_call" },
    success: function(response) {
       console.log(response);
    }
 });
 