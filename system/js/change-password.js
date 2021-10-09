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

    $('#changepassword').submit((e)=>{
        e.preventDefault()

        $('#changepasswordbtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        password = $('#password-input').val()

        if(!password) {
            $('#errors').html("Please fill in all fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="username" type="text" value="${getUrlVars().u}">
                    <input name="password" type="text" value="${password}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/change-password.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#changepasswordbtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'success'){
                            toastr.success("Password changed successfully")
                            $('#password-input').val('')
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#changepasswordbtn').removeAttr('disabled')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })

    function getUrlVars()
    {
        let vars = [], hash;
        let hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(let i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
})