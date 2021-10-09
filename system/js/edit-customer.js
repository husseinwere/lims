$(document).ready(()=>{
    $('#editcustomer').submit((e)=>{
        e.preventDefault()

        $('#editcustomer').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        company_name = $('#company_name').val()
        type = $('#type').val()
        customer_category = $('#customer_category').val()
        phone = $('#phone').val()
        email = $('#email').val()
        address = $('#address').val()
        address2 = $('#address2').val()
        description = $('#description').val()

        if(!company_name || !type || !customer_category || !phone || !email || !address{
            $('#errors').html("Please fill in all required fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="company_name" type="text" value="${company_name}">
                    <input name="type" type="text" value="${type}">
                    <input name="customer_category" type="text" value="${customer_category}">
                    <input name="phone" type="text" value="${phone}">
                    <input name="email" type="text" value="${email}">
                    <input name="address" type="text" value="${address}">
                    <input name="address2" type="text" value="${address2}">
                    <input name="description" type="text" value="${description}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/edit-customer.inc.php?c='+getUrlVars().c,
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#editcustomer').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'customerexists'){
                            $('#errors').html("The new company name you entered is already in use.")
                        }
                        else if(data.message == 'success'){
                            toastr.success("Customer updated successfully")
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#editcustomer').removeAttr('disabled')
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