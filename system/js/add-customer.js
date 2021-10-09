$(document).ready(()=>{
    $('#addcustomer').click((e)=>{
        e.preventDefault()

        $('#addcustomer').attr('disabled', 'true')
        
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

        if(!company_name || !type || !customer_category || !phone || !email || !address) {
            $('#errors').html("Please fill in all fields")
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
                    url: 'includes/add-customer.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#addcustomer').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'customerexists'){
                            $('#errors').html("The company name you entered already exists.")
                        }
                        else if(data.message == 'success'){
                            toastr.success("Customer added successfully")
                            $('#company_name').val('')
                            $('#type').val('')
                            $('#phone').val('')
                            $('#email').val('')
                            $('#address').val('')
                            $('#address2').val('')
                            $('#group_name').val('')
                            $('#description').val('')
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#addcustomer').removeAttr('disabled')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })
})