$(document).ready(()=>{
    loadUsers()

    $('#show').click(()=>{
        $('#show').css('display', 'none')
        $('#hide').css('display', 'block')
        $('#password-input').attr('type', 'text')
    })
    $('#hide').click(()=>{
        $('#hide').css('display', 'none')
        $('#show').css('display', 'block')
        $('#password-input').attr('type', 'password')
    })

    $('#adduser').submit((e)=>{
        e.preventDefault()

        $('#adduserbtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        username = $('#username').val()
        designation = $('#designation').val()
        email = $('#email').val()
        password = $('#password-input').val()

        if(!username || !designation || !email || !password) {
            $('#errors').html("Please fill in all fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="username" type="text" value="${username}">
                    <input name="designation" type="text" value="${designation}">
                    <input name="email" type="text" value="${email}">
                    <input name="password" type="text" value="${password}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/add-user.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#adduserbtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'userexists'){
                            $('#errors').html("The username you entered already exists.")
                        }
                        else if(data.message == 'success'){
                            toastr.success("User added successfully")
                            loadUsers()
                            $('#username').val('')
                            $('#email').val('')
                            $('#password').val('')
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#adduserbtn').removeAttr('disabled', 'false')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })

    function loadUsers(){
        $('#users').load('includes/users.inc.php')
    }
})