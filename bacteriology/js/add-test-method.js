$(document).ready(()=>{
    $('#addtestmethod').click((e)=>{
        e.preventDefault()

        $('#addtestmethod').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        name = $('#name').val()
        acronym = $('#acronym').val()

        if(!name || !acronym) {
            $('#errors').html("Please fill in all fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="name" type="text" value="${name}">
                    <input name="acronym" type="text" value="${acronym}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/add-test-method.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#addtestmethod').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'acronymexists'){
                            $('#errors').html("The acronym you entered already exists.")
                        }
                        else if(data.message == 'success'){
                            toastr.success("Test method added successfully")
                            $('#name').val('')
                            $('#acronym').val('')
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#addtestmethod').removeAttr('disabled')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })
})