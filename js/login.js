$(document).ready(()=>{
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
    $('#login').click((e)=>{
        e.preventDefault()
        $('#dynamic_form').remove()
        username = $('#username').val()
        designation = $('#designation').val()
        password = $('#password-input').val()

        if(!username || !password || !designation) {
            $('#errors').html("Please fill in all fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="username" type="text" value="${username}">
                    <input name="designation" type="text" value="${designation}">
                    <input name="password" type="password" value="${password}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/login.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        data = JSON.parse(data);
                        if(data.message == 'nouser'){
                            $('#errors').html("The user you entered does not exist.")
                        }
                        else if(data.message == 'wrongpassword'){
                            $('#errors').html("The password you entered is incorrect.")
                        }
                        else if(data.message == 'wrongdesignation'){
                            $('#errors').html("Wrong designation selected for user.")
                        }
                        else if(data.message == 'success'){
                            if(designation == 'System')
                                window.location.href = 'system/home.php'
                            else if(designation == 'Bacteriology')
                                window.location.href = 'bacteriology/home.php'
                            else if(designation == 'Entomology')
                                window.location.href = 'entomology/home.php'
                            else if(designation == 'Molecular')
                                window.location.href = 'molecular/home.php'
                            else if(designation == 'Mycology')
                                window.location.href = 'mycology/home.php'
                            else if(designation == 'Nematology')
                                window.location.href = 'nematology/home.php'
                            else if(designation == 'Tissue Culture')
                                window.location.href = 'tissue-culture/home.php'
                            else if(designation == 'Virology')
                                window.location.href = 'virology/home.php'
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })
})