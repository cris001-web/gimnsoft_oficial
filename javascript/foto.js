(function(){
    function filePreview(input){
       if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e){
            $('#imagePreview').html("<img src='"+e.target.result+"'/>")

        }
        reader.readAsDataURL(input.files[0]);

       } 
    }
    $('#imagen').change(function(){
        filePreview(this);
    });
})();
